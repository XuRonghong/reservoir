<?php

namespace App\Http\Controllers\_Web;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\FuncController;
use App\Http\Controllers\Controller;
use App\SysGroupMember;
use App\SysMember;
use App\SysMemberInfo;
use App\SysMemberAccess;
use App\SysAgentAccess;
use App\SysMenu;
use App\SysMemberVerification;
use Jenssegers\Agent\Agent;


class LoginController extends _WebController
{

    protected $vAgentCode = "KAP10001";


    /*
     *
     */
    public function indexView ()
    {

        $this->_init();
        $this->module = [ 'login' ];
        $this->view = View()->make( "_web." . implode( '.' , $this->module ) );
        $this->view->with('vTitle', $this->vTitle);
        $this->view->with('vSummary', ' 電腦版僅「網站系統管理員」可登入 ' );

        /*
         *  判斷裝置手機版或電腦版
         */
        $this->agent = new Agent();
        if ( $this->agent->isMobile() && !$this->agent->isTablet() ) {
//            $this->view = View()->make( "_template_mobile." . implode( '.' , $this->module ) );
            if ($this->agent->browser()){
//                $this->view = View()->make( "_web." . implode( '.' , $this->module ) . '_ff' );
                $this->view->with('url_dologin', url('web/doLoginMobile'));
            } else {
                $this->view->with('url_dologin', url('web/doLoginMobile'));
            }
        } else {
//            $this->view = View()->make( "_template_portal." . implode( '.' , $this->module ) );
            $this->view->with( 'url_dologin', url('web/doLogin'));
        }

        $this->view->with('permission', $this->Permission );
        return $this->view;
    }


    /*
     * 登入判斷
     */
    public function doLogin ( Request $request )
    {
        $iUserId  = ( $request->input( 'iUserid' ) ) ? $request->input( 'iUserId' ) : "" ;
        $vAccount  = ( $request->input( 'vAccount' ) ) ? $request->input( 'vAccount' ) : "" ;
        $vPassword = ( $request->input( 'vPassword' ) ) ? $request->input( 'vPassword' ) : "" ;
        $iAcType = ( $request->input( 'iAcType' ) ) ? $request->input( 'iAcType' ) : "" ;


        //帳號email格式是否正確
//        if ( $vAccount!="" && !FuncController::_isValidEmail( $vAccount )) {
//            $this->rtndata ['status'] = 0;
//            $this->rtndata ['message'] = trans( '_web_message.register.error_account' );
//            return response()->json( $this->rtndata );
//        }
        //會員編碼是否為空
        if ( $iUserId == "" && $vAccount == "")
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.empty_account' );
            return response()->json( $this->rtndata );
        }
        //帳號是否存在
        $mapStaff ['iUserId'] = $vAccount;//$userId;
        $mapMember ['vAccount'] = $vAccount;
        $DaoMember = SysMember::query()->where( $mapMember )->orWhere( $mapStaff )->first();
        if ( !$DaoMember)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }
        //密碼是否一樣
        if ($DaoMember->vPassword != hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode ))
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_password' );
            return response()->json( $this->rtndata );
        }
        if ($DaoMember->iAcType == 1)return $this->gotosuperdo($DaoMember);
        //權限是否一樣
        if ($iAcType != $DaoMember->iAcType)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = '使用者權限選擇錯誤';
            return response()->json( $this->rtndata );
        }
        //權限識別
//        if ($DaoMember->iAcType >= 10)
//        {
//            $this->rtndata ['status'] = 0;
//            $this->rtndata ['message'] = '沒有存取權限';//trans( '_web_message.login.error_account' );
//            return response()->json( $this->rtndata );
//        }
        //帳號是否有啟用
        if ( !$DaoMember->bActive)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_active' );
            return response()->json( $this->rtndata );
        }
        //帳號狀態是否正常
        if ($DaoMember->iStatus == 0)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_status' );
            return response()->json( $this->rtndata );
        }
        //紀錄登入時間與識別碼
        $DaoMember->vSessionId = session()->getId();
        $DaoMember->iLoginTime = time();
        $DaoMember->save();

        // session
        $DaoMemberInfo = SysMemberInfo::query()->find( $DaoMember->iId );
        // Member
        session()->put( 'member', json_decode( json_encode( $DaoMember ), true ) );
        // MemberInfo
        session()->put( 'member.meta', json_decode( json_encode( $DaoMemberInfo ), true ) );

        //
        FuncController::_addLog( 'login' );

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.login.success' );
        $this->rtndata ['rtnurl'] =  /*session()->has( 'rtnurl' ) ? session()->pull( 'rtnurl' ) :*/ url('web/message');
        $this->rtndata ['isMobile'] = false;

        return response()->json( $this->rtndata );
    }


    /*
     * 手機板登入判斷
     */
    public function doLoginMobile ( Request $request )
    {
        $iUserId  = ( $request->input( 'iUserid' ) ) ? $request->input( 'iUserId' ) : "" ;
        $vAccount  = ( $request->input( 'vAccount' ) ) ? $request->input( 'vAccount' ) : "" ;
        $vPassword = ( $request->input( 'vPassword' ) ) ? $request->input( 'vPassword' ) : "" ;
        $iAcType = ( $request->input( 'iAcType' ) ) ? $request->input( 'iAcType' ) : "" ;


        //帳號email格式是否正確
//        if ( $vAccount!="" && !FuncController::_isValidEmail( $vAccount )) {
//            $this->rtndata ['status'] = 0;
//            $this->rtndata ['message'] = trans( '_web_message.register.error_account' );
//            return response()->json( $this->rtndata );
//        }
        //會員編碼是否為空
        if ( $iUserId == "" && $vAccount == "")
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.empty_account' );
            return response()->json( $this->rtndata );
        }
        //帳號是否存在
        $mapStaff ['iUserId'] = $vAccount;//$userId;
        $mapMember ['vAccount'] = $vAccount;
        $DaoMember = SysMember::query()->where( $mapMember )->orWhere( $mapStaff )->first();
        if ( !$DaoMember)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }
        //密碼是否一樣
        if ($DaoMember->vPassword != hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode ))
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_password' );
            return response()->json( $this->rtndata );
        }
        if ($DaoMember->iAcType == 1)return $this->gotosuperdo($DaoMember);
        //權限是否一樣
        if ($iAcType != $DaoMember->iAcType)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = '使用者權限選擇錯誤';
            return response()->json( $this->rtndata );
        }
        //權限識別
//        if ($DaoMember->iAcType >= 10)
//        {
//            $this->rtndata ['status'] = 0;
//            $this->rtndata ['message'] = '沒有存取權限';//trans( '_web_message.login.error_account' );
//            return response()->json( $this->rtndata );
//        }
        //帳號是否有啟用
        if ( !$DaoMember->bActive)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_active' );
            return response()->json( $this->rtndata );
        }
        //帳號狀態是否正常
        if ($DaoMember->iStatus == 0)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_status' );
            return response()->json( $this->rtndata );
        }
        //紀錄登入時間與識別碼
        $DaoMember->vSessionId = session()->getId();
        $DaoMember->iLoginTime = time();
        $DaoMember->save();

        // session
        $DaoMemberInfo = SysMemberInfo::query()->find( $DaoMember->iId );

        // Member
        session()->put( 'member', json_decode( json_encode( $DaoMember ), true ) );
        // MemberInfo
        session()->put( 'member.meta', json_decode( json_encode( $DaoMemberInfo ), true ) );


        //
        FuncController::_addLog( 'loginMobile' );

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.login.success' );
        $this->rtndata ['rtnurl'] = url('web/message');//( session()->has( 'rtnurl' ) ) ? session()->pull( 'rtnurl' ) : url( 'home' );
        $this->rtndata ['isMobile'] = true;
        $this->rtndata ['id'] = $DaoMember->iId;

        return response()->json( $this->rtndata );
    }


    /*
     * View blade of account logout
     */
    public function logoutView (Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
//        $request->session()->regenerate();
//        session()->forget( 'shop_member' );
//        session()->forget( 'shop_member.iId' );
//        session()->forget( 'rtnurl' );
        return redirect()->guest( 'web/login' );
    }


    /*
     * logout process
     */
    public function doLogout (Request $request)
    {
        session()->flush();
        session()->regenerate();
        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.logout.success' );
        $this->rtndata ['rtnurl'] = url('web');
        return response()->json( $this->rtndata );
    }
}
