<?php

namespace App\Http\Controllers\_Web\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;
use App\SysMember;
use App\SysMemberInfo;
use App\SysGroupMember;
use App\LogLogin;


class IndexController extends _WebController
{

    /*
     *
     */
    function __construct ()
    {
        $this->module = [ 'member' ];
        $this->vTitle = 'Index';
    }


    /*
     *
     */
    public function index ()
    {
        $this->module = [ 'member' ];
        $this->view = View()->make( "_web." . implode( '.' , $this->module ) . '.index' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '' );

        return $this->view;
    }


    /*
     * all list ajax
     */
    public function getList ( Request $request )
    {
        $this->_init();
        $sort_arr = [];
        $search_arr = [];
        $search_word =    $request->input('sSearch') ? $request->input('sSearch') : '' ;
        $iDisplayLength = $request->input('iDisplayLength') ? $request->input('iDisplayLength') : 0 ;
        $iDisplayStart =  $request->input('iDisplayStart') ? $request->input('iDisplayStart') : 0 ;
        $sEcho =          $request->input('sEcho' ) ? $request->input('sEcho') : '' ;
        $column_arr =     $request->input('sColumns' ) ? $request->input('sColumns') : '' ;
        $column_arr = explode( ',', $column_arr );
        foreach ($column_arr as $key => $item)
        {
            if ($item == "") {
                unset( $column_arr[$key] );
                continue;
            }
            if ($request->input( 'bSearchable_' . $key ) == "true") {
                $search_arr[$key] = $item;
            }
            if ($request->input( 'bSortable_' . $key ) == "true") {
                $sort_arr[$key] = $item;
            }
        }
        $sort_name = $sort_arr[ $request->input( 'iSortCol_0' ) ];
        $sort_dir = $request->input( 'sSortDir_0' );


        $map['iStatus'] = 1;
        $total_count = SysMember::query()->where($map)
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })->where('iAcType','<>',1)
            ->count();

        $data_arr = SysMember::query()->where($map)
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })->where('iAcType','<>',1)
            ->orderBy( $sort_name, $sort_dir )
            ->skip( $iDisplayStart )
            ->take( $iDisplayLength )
            ->get();
        if ( !$data_arr)
        {
            $this->rtndata['status'] = 0;
            $this->rtndata['message'] = ['Oops! 沒有使用者資訊!'];
            return $this->rtndata;
        }
        foreach ($data_arr as $key => $var)
        {
//            $var->DT_RowId = $var->iId;
            if ($var->iAcType < 10){
                $var->iAcType = $this->Permission['2'];
            } elseif ($var->iAcType < 20){
                $var->iAcType = $this->Permission['10'];
            } elseif ($var->iAcType < 30){
                $var->iAcType = $this->Permission['20'];
            } elseif ($var->iAcType < 40){
                $var->iAcType = $this->Permission['30'];
            } elseif ($var->iAcType < 50){
                $var->iAcType = $this->Permission['40'];
            } elseif ($var->iAcType < 60){
                $var->iAcType = $this->Permission['50'];
            } elseif ($var->iAcType < 70){
                $var->iAcType = $this->Permission['60'];
            } else {
                $var->iAcType = "一般人員";
            }
//            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
//            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
//            $var->iLoginTime = date( 'Y/m/d H:i:s' , $var->iLoginTime );
        }


        $this->rtndata ['status'] = 1;
        $this->rtndata ['sEcho'] = $sEcho;
        $this->rtndata ['iTotalDisplayRecords'] = $total_count;
        $this->rtndata ['iTotalRecords'] = $total_count;
        $this->rtndata ['aaData'] = $total_count ? $data_arr : [];

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function add (Request $request)
    {
        $this->_init();
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.add' => url( 'web/' . implode( '/', $this->module ) . "/add" )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '新增會員' );
        $this->view->with( 'permission', $this->Permission );
        return $this->view;
    }


    /*
    *
    */
    public function doAdd ( Request $request )
    {
        $vAccount  = ( $request->exists( 'vAccount' ) ) ? $request->input( 'vAccount' ) : "";
        $vPassword = ( $request->exists( 'vPassword1') ) ? $request->input( 'vPassword1' ) : "";
        $vPassword2 = ( $request->exists( 'vPassword2') ) ? $request->input( 'vPassword2' ) : "";
        $iAcType =    ( $request->exists( 'iAcType') ) ? $request->input( 'iAcType' ) : "";
        $vUserName =  ( $request->exists( 'vUserName') ) ? $request->input( 'vUserName' ) : "";
        $vUserEmail = ( $request->exists( 'vUserEmail') ) ? $request->input( 'vUserEmail' ) : "";
        $vUserContact = ( $request->exists( 'vUserContact') ) ? $request->input( 'vUserContact' ) : "";
        $vUserAddress = ( $request->exists( 'vUserAddress') ) ? $request->input( 'vUserAddress' ) : "";

        //
        if ( $vPassword != $vPassword2 ) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = '密碼確認錯誤';
            return response()->json( $this->rtndata );
        }
        //帳號email格式錯誤，退回
//        if ( !FuncController::_isValidEmail( $vUserEmail )) {
//            $this->rtndata ['status'] = 0;
//            $this->rtndata ['message'] = trans( '_web_message.register.error_account' );
//            return response()->json( $this->rtndata );
//        }
        //帳號存在，退回
        $map ['vAccount'] = $vAccount;
        $DaoMember = SysMember::query()->where( $map )->first();
        if ($DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.account_not_empty' );
            return response()->json( $this->rtndata );
        }


        $str = md5( uniqid( mt_rand(), true ) );
        $uuid = substr( $str, 0, 8 ) . '-';
        $uuid .= substr( $str, 8, 4 ) . '-';
        $uuid .= substr( $str, 12, 4 ) . '-';
        $uuid .= substr( $str, 16, 4 ) . '-';
        $uuid .= substr( $str, 20, 12 );
        do {
            $userid = rand( 1000000001, 1099999999 );
            $check = SysMember::query()->where( "iUserId", $userid )->first();
        } while ($check);

        //
        $date_time = time();
        $DaoMember = new SysMember ();
        $DaoMember->vAgentCode = config( '_config.agent_code' );
        $DaoMember->iUserId = $userid;
        $DaoMember->vUserCode = $uuid;
        $DaoMember->iAcType = $iAcType; //
        $DaoMember->vAccount = $vAccount;
        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode );
        $DaoMember->vCreateIP = $request->ip();
        $DaoMember->iCreateTime = $DaoMember->iUpdateTime = $date_time;
        $DaoMember->iLoginTime = 0;
        $DaoMember->bActive = 1;
        $DaoMember->iStatus = 1;
        if ($DaoMember->save()) {
            //註冊會員的詳情資料
            $DaoMemberInfo = new SysMemberInfo();
            $DaoMemberInfo->iMemberId = $DaoMember->iId;
            $DaoMemberInfo->vUserImage = ( $request->input( 'vUserImage' ) ) ? $request->input( 'vUserImage' ) : "/images/empty.jpg";
            $DaoMemberInfo->vUserName = $vUserName;
            $DaoMemberInfo->vUserID =   ( $request->exists( 'vUserID' ) )   ? $request->input( 'vUserID' ) : "";
            $DaoMemberInfo->iUserBirthday = time();
            $DaoMemberInfo->vUserEmail = $vUserEmail;
            $DaoMemberInfo->vUserContact = $vUserContact;
            $DaoMemberInfo->vUserAddress = $vUserAddress;
            $DaoMemberInfo->save();

            //註冊會員的群組,預設'5'的一般會員群組
            $DaoGroupMember = new SysGroupMember();
            $DaoGroupMember->iGroupId = 5;
            $DaoGroupMember->iMemberId = $DaoMember->iId;
            $DaoGroupMember->iCreateTime = $DaoGroupMember->iUpdateTime = time();
            $DaoGroupMember->iStatus = 1;
            $DaoGroupMember->save();

            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.register.success' ).trans( '_web_message.register.verification' );
//            $this->rtndata ['rtnurl'] = ( session()->has( 'rtnurl' ) ) ? session()->pull( 'rtnurl' ) : url( 'login' );
            $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );

//            Mail::send( '_email.welcome' , [ 'url' => url( 'doActive' ) . '/' . $uuid ], function( $message ) use ( $vAccount ) {
//                $message->to( $vAccount, '會員' )->subject( 'Register Success!' );
//            } );

            //
            //CoinController::_CheckActivityRegister( $DaoMember->iId );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.fail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function edit ( $id )
    {
        if (session('member.iAcType') > 9 && session('member.iId') != $id){
            return redirect ()->guest ( 'web/login' );
        };
        if ($id == 1 && session('member.iId') != $id){
            return redirect ()->guest ( 'web/login' );
        };

        $this->_init();
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.add');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode('.', $this->module) . '.edit' => url('web/' . implode('/', $this->module) . "/edit/" . $id )
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '編輯會員' );
        $this->view->with( 'permission', $this->Permission );


        $DaoMember = SysMember::query()->find($id);//->where('iUserId','=',$id)->first();
        if (!$DaoMember) {
//            session()->put('check_empty.message', trans('_web_message.empty_id'));
            return redirect('web/' . implode('/', $this->module));
        }
        $this->view->with( 'info', $DaoMember );

        return $this->view;
    }


    /*
     *
     */
    public function doSave ( Request $request )
    {
        $id = $request->input( 'iId', 0 );
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $Dao = SysMember::query()->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        if ($request->input( 'iAcType' )) {
            $Dao->iAcType = $request->input( 'iAcType' );
        }
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
//            $DaoMemberInfo = SysMemberInfo::find( session( 'member.iId' ) );
//            if ($request->exists( 'vUserName' )) {
//                $DaoMemberInfo->vUserName = $request->input( 'vUserName' );
//            }
//            if ($request->exists( 'vUserNameE' )) {
//                $DaoMemberInfo->vUserNameE = $request->input( 'vUserNameE' );
//            }
//            if ($request->exists( 'vUserTitle' )) {
//                $DaoMemberInfo->vUserTitle = $request->input( 'vUserTitle' );
//            }
//            if ($request->exists( 'vUserID' )) {
//                $DaoMemberInfo->vUserID = $request->input( 'vUserID' );
//            }
//            if ($request->exists( 'iUserBirthday' )) {
//                $DaoMemberInfo->iUserBirthday = strtotime( $request->input( 'iUserBirthday' ) );
//            }
//            if ($request->exists( 'vUserEmail' )) {
//                $DaoMemberInfo->vUserEmail = $request->input( 'vUserEmail' );
//            }
//            if ($request->exists( 'vUserContact' )) {
//                $DaoMemberInfo->vUserContact = $request->input( 'vUserContact' );
//            }
//            if ($request->exists( 'vUserZipCode' )) {
//                $DaoMemberInfo->vUserZipCode = $request->input( 'vUserZipCode' );
//            }
//            if ($request->exists( 'vUserCity' )) {
//                $DaoMemberInfo->vUserCity = $request->input( 'vUserCity' );
//            }
//            if ($request->exists( 'vUserArea' )) {
//                $DaoMemberInfo->vUserArea = $request->input( 'vUserArea' );
//            }
//            if ($request->exists( 'vUserAddress' )) {
//                $DaoMemberInfo->vUserAddress = $request->input( 'vUserAddress' );
//            }
//            $DaoMemberInfo->save();
//            //Logs
//            $this->_saveLogAction( $DaoMemberInfo->getTable(), $DaoMemberInfo->iMemberId, 'edit', json_encode( $DaoMemberInfo ) );

            // session
            $DaoMember = SysMember::query()->find( $id/*session()->get( 'member.iId')*/ );
            $DaoMemberInfo = SysMemberInfo::query()->find( $id/*session()->get( 'member.iId')*/ );
            // Member
            session()->put( 'member', json_decode( json_encode( $Dao ), true ) );
            // MemberInfo
//            session()->put( 'member.meta', json_decode( json_encode( $DaoMemberInfo ), true ) );
            //
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
            $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
    *
    */
    function doSaveShow ( Request $request )
    {
        $id = $request->input( 'iId', 0 );
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        $Dao = SysMember::query()->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        if ($request->input( 'bActive' )) {
            $Dao->bActive = ( $request->input( 'bActive' ) == "change" ) ? !$Dao->bActive : $request->input( 'bActive' );
        }
        if ($request->input( 'iStatus' )) {
            $Dao->iStatus = ( $request->input( 'iStatus' ) == "change" ) ? !$Dao->iStatus : $request->input( 'iStatus' );
        }
        $Dao->iRank = $request->input( 'iRank' ) ? $request->input( 'iRank' ) : $Dao->iRank ;
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            if ($request->input( 'iStatus' )) {
                $DaoInfo = SysMemberInfo::query()->where('iMemberId' , '=', $Dao->iId)->first();
                if ($DaoInfo){
                    $DaoInfo->iMemberId = 0;
                    $DaoInfo->save();
                }
            }

            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
            $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function doSavePassword ( Request $request )
    {
        $vPassword    = ( $request->exists( 'vPassword' ) ) ? $request->input( 'vPassword' ) : "";
        $vPasswordNew = ( $request->exists( 'vPasswordNew' ) ) ? $request->input( 'vPasswordNew' ) : "";

        $id = $request->input( 'iId', 0 );
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $DaoMember = SysMember::query()->find( $id );
        if ( !$DaoMember) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.account_not_empty' );
            return response()->json( $this->rtndata );
        }
        if ($DaoMember->vPassword != hash( 'sha256', $DaoMember->vAgentCode . $vPassword . $DaoMember->vUserCode )) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_password' );
            return response()->json( $this->rtndata );
        }
        $DaoMember->vPassword = hash( 'sha256', $DaoMember->vAgentCode . $vPasswordNew . $DaoMember->vUserCode );
        $DaoMember->iUpdateTime = time();
        if ($DaoMember->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
            $this->rtndata ['rtnurl'] = url( 'web/login' );
            //Logs
            $this->_saveLogAction( $DaoMember->getTable(), $DaoMember->iId, 'edit', json_encode( $DaoMember ) );
            session()->forget( 'member' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function attr (Request $request , $id)
    {
        $this->_init();
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.attr');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode('.', $this->module) . '.meta' => url('web/' . implode('/', $this->module) . "/meta/" . $id)
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '更多資訊' );
        $this->view->with( 'permission', $this->Permission );


        $DaoMember = SysMember::query()->find($id);
        if (!$DaoMember) {
            session()->put('check_empty.message', trans('_web_message.empty_id'));
            return redirect('web/' . implode('/', $this->module));
        }
        $DaoMember->iCreateTime = date( 'Y/m/d H:i:s', $DaoMember->iCreateTime );
        $DaoMember->iUpdateTime = date( 'Y/m/d H:i:s', $DaoMember->iUpdateTime );
        $DaoMember->iLoginTime = $DaoMember->iLoginTime ? date( 'Y/m/d H:i:s' , $DaoMember->iLoginTime ) : '';

        $this->view->with( 'info', $DaoMember );

        return $this->view;
    }



}
