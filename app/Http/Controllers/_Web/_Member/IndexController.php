<?php

namespace App\Http\Controllers\_Web\_Member;

use App\Http\Controllers\_Web\_WebController;
use App\SysMember;
use App\SysMemberInfo;
use Illuminate\Http\Request;

class IndexController extends _WebController
{
    public $module = [ 'member', 'userinfo' ];

    /*
     *
     */
    public function index ()
    {
        $this->breadcrumb = [
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->func = "web." . implode( '.', $this->module );
        $this->__initial();

        $DaoUserInfo = SysMember::join( 'sys_member_info', function( $join ) {
            $join->on( 'sys_member_info.iMemberId', '=', 'sys_member.iId' );
        } )->find( session( 'member.iId' ) );
        $this->view->with( 'info', $DaoUserInfo );

        return $this->view;
    }

    /*
     *
     */
    public function doSave ( Request $request )
    {
        $Dao = SysMember::find( session( 'member.iId' ) );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
            $DaoMemberInfo = SysMemberInfo::find( session( 'member.iId' ) );
            if ($request->exists( 'vUserName' )) {
                $DaoMemberInfo->vUserName = $request->input( 'vUserName' );
            }
            if ($request->exists( 'vUserNameE' )) {
                $DaoMemberInfo->vUserNameE = $request->input( 'vUserNameE' );
            }
            if ($request->exists( 'vUserTitle' )) {
                $DaoMemberInfo->vUserTitle = $request->input( 'vUserTitle' );
            }
            if ($request->exists( 'vUserID' )) {
                $DaoMemberInfo->vUserID = $request->input( 'vUserID' );
            }
            if ($request->exists( 'iUserBirthday' )) {
                $DaoMemberInfo->iUserBirthday = strtotime( $request->input( 'iUserBirthday' ) );
            }
            if ($request->exists( 'vUserEmail' )) {
                $DaoMemberInfo->vUserEmail = $request->input( 'vUserEmail' );
            }
            if ($request->exists( 'vUserContact' )) {
                $DaoMemberInfo->vUserContact = $request->input( 'vUserContact' );
            }
            if ($request->exists( 'vUserZipCode' )) {
                $DaoMemberInfo->vUserZipCode = $request->input( 'vUserZipCode' );
            }
            if ($request->exists( 'vUserCity' )) {
                $DaoMemberInfo->vUserCity = $request->input( 'vUserCity' );
            }
            if ($request->exists( 'vUserArea' )) {
                $DaoMemberInfo->vUserArea = $request->input( 'vUserArea' );
            }
            if ($request->exists( 'vUserAddress' )) {
                $DaoMemberInfo->vUserAddress = $request->input( 'vUserAddress' );
            }
            $DaoMemberInfo->save();
            //Logs
            $this->_saveLogAction( $DaoMemberInfo->getTable(), $DaoMemberInfo->iMemberId, 'edit', json_encode( $DaoMemberInfo ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
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
        $vPassword = ( $request->exists( 'vPassword' ) ) ? $request->input( 'vPassword' ) : "";
        $vPasswordNew = ( $request->exists( 'vPasswordNew' ) ) ? $request->input( 'vPasswordNew' ) : "new";

        $DaoMember = SysMember::find( session( 'member.iId' ) );
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
            $this->rtndata ['rtnurl'] = url( 'login' );
            //Logs
            $this->_saveLogAction( $DaoMember->getTable(), $DaoMember->iId, 'edit', json_encode( $DaoMember ) );
            session()->forget( 'shop_member' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
