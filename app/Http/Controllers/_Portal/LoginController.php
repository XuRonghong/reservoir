<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\FuncController;
use App\ModBanner;
use App\SysGroupMember;
use App\SysMember;
use App\SysMemberInfo;
use App\SysMemberVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LoginController extends _PortalController
{
    /*
     * 登入畫面
     */
    public function index ()
    {
        $this -> module = [ 'login' ];
        //$this -> _init();
        $this->view = View()->make( "_portal." . implode( '.' , $this->module ) );



        // set_meta_og
            $og = [
                "url"           => url('login'),
                "type"          => "website",
                "title"         => config( '_website.web_title' ),
                "description"   => config( '_website.web_description' ),
                "images"        => 'portal_assets/dist/img/logo.png',
            ];
        $this->view->with( 'og' , $og );
        session()->put( 'SEO.vTitle' , trans('_portal.home.index.login') );

        return $this->view;
    }

    /*
     * 登入判斷
     */
    public function doLogin ( Request $request )
    {
        $userId  = ( $request->exists( 'userId' ) ) ? $request->input( 'userId' ) : "" ;
        $vAccount  = ( $request->exists( 'vAccount' ) ) ? $request->input( 'vAccount' ) : "" ;
        $vPassword = ( $request->exists( 'vPassword' ) ) ? $request->input( 'vPassword' ) : "" ;

        //帳號email格式是否正確
//        if ( $vAccount!="" && !FuncController::_isValidEmail( $vAccount )) {
//            $this->rtndata ['status'] = 0;
//            $this->rtndata ['message'] = trans( '_web_message.register.error_account' );
//            return response()->json( $this->rtndata );
//        }
        //會員編碼是否為空
        if ( $userId == "" && $vAccount == "") {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.empty_account' );
            return response()->json( $this->rtndata );
        }

        //帳號是否存在
        $mapStaff ['iUserId'] = $vAccount;//$userId;
        $mapMember ['vAccount'] = $vAccount;
        $DaoMember = SysMember::where( $mapMember )->orWhere( $mapStaff )->first();
        if ( !$DaoMember)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }
        if ($DaoMember->vPassword != hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode ))
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_password' );
            return response()->json( $this->rtndata );
        }
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


        $DaoMemberInfo = SysMemberInfo::query()->find( $DaoMember->iId );
        // Member
        session()->put( 'shop_member', json_decode( json_encode( $DaoMember ), true ) );
        // MemberInfo
        session()->put( 'shop_member.info', json_decode( json_encode( $DaoMemberInfo ), true ) );



        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.login.success' );
        $this->rtndata ['rtnurl'] = ( session()->has( 'rtnurl' ) ) ? session()->pull( 'rtnurl' ) : url( '' );

        return response()->json( $this->rtndata );
    }

    /*
     * 其他方登入
     */
    public function doLoginOther ( Request $request )
    {
        $vAccount  = ( $request->exists( 'vAccount' ) ) ? $request->input( 'vAccount' ) : "";
        $vPassword = ( $request->exists( 'vPassword' ) ) ? $request->input( 'vPassword' ) : "";
        $type = ( $request->exists( 'type' ) ) ? $request->input( 'type' ) : "other";

        if ($vAccount == "")
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }

        $mapMember ['vAccount'] = $vAccount;
        $DaoMember = SysMember::where( $mapMember )->first();
        if ( !$DaoMember) {
            $str = md5( uniqid( mt_rand(), true ) );
            $uuid = substr( $str, 0, 8 ) . '-';
            $uuid .= substr( $str, 8, 4 ) . '-';
            $uuid .= substr( $str, 12, 4 ) . '-';
            $uuid .= substr( $str, 16, 4 ) . '-';
            $uuid .= substr( $str, 20, 12 );
            do {
                $userid = rand( 1000000001, 1099999999 );
                $check = SysMember::where( "iUserId", $userid )->first();
            } while ($check);

            $date_time = time();
            $DaoMember = new SysMember ();
            $DaoMember->iUserId = $userid;
            $DaoMember->vUserCode = $uuid;
            $DaoMember->vAgentCode = config( '_config.agent_code' ) . "-" . $type;
            $DaoMember->iAcType = 999; //
            $DaoMember->vAccount = $vAccount;
            $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
            $DaoMember->iCreateTime = $DaoMember->iUpdateTime = $date_time;
            $DaoMember->vCreateIP = $request->ip();
            $DaoMember->bActive = 1;
            $DaoMember->iStatus = 1;

            if ($DaoMember->save()) {
                $DaoMemberInfo = new SysMemberInfo();
                $DaoMemberInfo->iMemberId = $DaoMember->iId;
                $DaoMemberInfo->vUserImage = "/images/empty.jpg";
                $DaoMemberInfo->vUserName = ( $request->exists( 'vUserName' ) ) ? $request->input( 'vUserName' ) : $vAccount;
                $DaoMemberInfo->vUserID =   ( $request->exists( 'vUserID' ) ) ? $request->input( 'vUserID' ) : "";
                $DaoMemberInfo->iUserBirthday = time();
                $DaoMemberInfo->vUserContact = ( $request->exists( 'vUserContact' ) ) ? $request->input( 'vUserContact' ) : "";
                $DaoMemberInfo->vUserEmail = "";
                $DaoMemberInfo->save();

                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans( '_web_message.register.success' );
                $this->rtndata ['rtnurl'] = ( session()->has( 'rtnurl' ) ) ? session()->pull( 'rtnurl' ) : url( 'login' );

                $DaoGroupMember = new SysGroupMember();
                $DaoGroupMember->iGroupId = 5;
                $DaoGroupMember->iMemberId = $DaoMember->iId;
                $DaoGroupMember->iCreateTime = $DaoGroupMember->iUpdateTime = time();
                $DaoGroupMember->iStatus = 1;
                $DaoGroupMember->save();

                //
               // CoinController::_CheckActivityRegister( $DaoMember->iId );

            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.register.fail' );
                return response()->json( $this->rtndata );
            }
        } else {
//            switch ($type) {
//                case 'FB':
//                    $access_token = $request->input( 'accessToken' );
//                    $fb = new Facebook( [
//                        'app_id' => config( '_config.fb_appid' ),
//                        'app_secret' => config( '_config.fb_secret' ),
//                        'default_graph_version' => config( '_config.fb_ver' ),
//                    ] );
//                    try {
//                        $response = $fb->get( '/me', $access_token );
//                    }
//                    catch (FacebookResponseException $e) {
//                        // When Graph returns an error
//                        $this->rtndata ['status'] = 0;
//                        $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
//                        return response()->json( $this->rtndata );
//                    }
//                    catch (FacebookSDKException $e) {
//                        // When validation fails or other local issues
//                        $this->rtndata ['status'] = 0;
//                        $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
//                        return response()->json( $this->rtndata );
//                    }
//                    //$me = $response->getGraphUser();
//                    break;
//                case 'GPLUS':
//                    break;
//                default:
//            }
        }

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

        // Member
        session()->put( 'shop_member', json_decode( json_encode( $DaoMember ), true ) );
        // MemberInfo
        $DaoMemberInfo = SysMemberInfo::query()->find( $DaoMember->iId );
        session()->put( 'shop_member.info', json_decode( json_encode( $DaoMemberInfo ), true ) );

        // MemberGroup join ModActivitySchedule
        $iGroupId = SysGroupMember::query()->where('iMemberId', '=', $DaoMember->iId)->first()->iGroupId;
        if ( !$iGroupId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = '會員無群組';
            return response()->json( $this->rtndata );
        }
        $iActivityScheduleId = ModActivityScheduleGroup::query()->where('iGroupId', '=', $iGroupId)->first()->iActivityScheduleId;
        // ActivitySchedule
        $DaoActivitySchedule = ModActivitySchedule::query()->where( 'iId', '=', $iActivityScheduleId )->first();
        $DaoActivityScheduleInfo = ModActivityScheduleInfo::query()->where( 'iActivityScheduleId', '=', $iActivityScheduleId )->first();
        session()->put('shop_activity_schedule', json_decode( json_encode( $DaoActivitySchedule ), true ) );
        session()->put('shop_activity_schedule_info', json_decode( json_encode( $DaoActivityScheduleInfo ), true ) );
        //
        $this->order_limit_price = $DaoActivityScheduleInfo->iOrderLimitPrice ;
        $this->order_code = $DaoActivityScheduleInfo->vOrderCode ;


        //Activity
        //CoinController::_CheckActivityLogin();

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.login.success' );
        $this->rtndata ['rtnurl'] = ( session()->has( 'rtnurl' ) ) ? session()->pull( 'rtnurl' ) : url( 'member_center/information' );

        return response()->json( $this->rtndata );
    }

    /*
	 * 寄送郵件驗證重設密碼
	 */
    public function doSendVerification ( Request $request )
    {

        $userId  = ( $request->exists( 'userId' ) ) ? $request->input( 'userId' ) : "" ;
        $vAccount = ( $request->exists( 'vAccount' ) ) ? $request->input( 'vAccount' ) : "";

//        if (  $vAccount!="" && !FuncController::_isValidEmail( $vAccount )) {
//            $this->rtndata ['status'] = 0;
//            $this->rtndata ['message'] = trans( '_web_message.register.error_account' );
//            return response()->json( $this->rtndata );
//        }

        if ($vAccount == "" && $userId == "")
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }


        $mapStaff ['iUserId'] = $vAccount;//$userId;
        $mapMember ['vAccount'] = $vAccount;
        $DaoMember = SysMember::where( $mapMember )->orWhere( $mapStaff )->first();
        if ( !$DaoMember)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }

        // email: 若不是內部登入,信箱就是帳號
        $mapMemberInfo ['iMemberId'] = $DaoMember->iId;
        $DaoMemberInfo = SysMemberInfo::where( $mapMemberInfo )->first();
        if ( $DaoMemberInfo->vUserEmail != '' ){
            $email = $DaoMemberInfo->vUserEmail;
        } else {
            $email = ($vAccount != "") ? $vAccount : $DaoMember->vAccount.'@'.$DaoMember->vAgentCode.'.com';
        }

        //
        $verification = "";
        for ( $i = 0 ; $i < config( '_config.verification.limit' ) ; $i++ ) {
            if (rand( 0, 1 )) {
                $verification .= rand( 1, 9 );
            } else {
                $str_arr = config( '_parameter.str_arr' );
                $verification .= $str_arr [rand( 0, count( $str_arr ) - 1 )];
            }
        }

        $DaoMemberVerification = SysMemberVerification::find( $DaoMember->iId );
        if ( !$DaoMemberVerification) {
            $DaoMemberVerification = new SysMemberVerification ();
            $DaoMemberVerification->iMemberId = $DaoMember->iId;
            $DaoMemberVerification->vVerification = $verification;
            $DaoMemberVerification->iStartTime = time();
            $DaoMemberVerification->iEndTime = $DaoMemberVerification->iStartTime + config( '_config.verification.time' );
            $DaoMemberVerification->iStatus = 0;
        } else {
            $DaoMemberVerification->vVerification = $verification;
            $DaoMemberVerification->iStartTime = time();
            $DaoMemberVerification->iEndTime = $DaoMemberVerification->iStartTime + config( '_config.verification.time' );
            $DaoMemberVerification->iStatus = 0;
        }

        if ($DaoMemberVerification->save()) {
            //
            Mail::send( '_template_email.forgot' , [ 'verification' => $verification ] , function( $message ) use ( $email ) {
                    $message->to( $email )->subject( trans( '_web_message.verification.forgot_password' ) );
                } );

            session()->put( 'verification.memberid', $DaoMember->iId );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.verification.success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.verification.dail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     * 密碼重設
     */
    public function doResetPassword ( Request $request )
    {
        $vVerification = ( $request->exists( 'vVerification' ) ) ? $request->input( 'vVerification' ) : "";
        $vPassword      = ( $request->exists( 'vPassword' ) ) ? $request->input( 'vPassword' ) : "";

        $mapMemberVerification['vVerification'] = $vVerification;
        $mapMemberVerification['iStatus'] = 0;
        $DaoMemberVerification = SysMemberVerification::where( $mapMemberVerification )->find( session( 'verification.memberid' ) );
        if ( !$DaoMemberVerification)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.verification.error' );
            return response()->json( $this->rtndata );
        }

        $DaoMember = SysMember::find( $DaoMemberVerification->iMemberId );
        if ( !$DaoMember)
        {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.verification.error' );
            return response()->json( $this->rtndata );
        }
        $DaoMember->iUpdateTime = time();
        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
        if ( $DaoMember->save() ) {
            $DaoMemberVerification->iStatus = 1;
            $DaoMemberVerification->save();
            //Logs
            session()->flush();
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
            $this->rtndata ['rtnurl'] = url( 'login' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
