<?php

namespace App\Http\Controllers\_Web\MemberCenter;

use App\SysGroupMember;
use App\SysMember;
use App\SysMemberInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\ModBanner;
use App\Http\Controllers\_Portal\_PortalController;


class InformationController extends _PortalController
{
    public $member_active = 'information';

    /*
     * member_center have 3 area
     */
    public function index ( Request $request , $head = null )
    {
        $this -> module = [ 'member_center', 'index' ];
        $this->view = View()->make( "_web." . implode( '.' , $this->module ) );


        //
        if ( $head == "resetpw" ) {
            //更改密碼路徑
            $this->view->with( 'control' , 'resetpw' );
        } else {
            //預設顯示會員資料
            $this->view->with( 'control' , 'member' );
        }


        //會員資料
        $DaoMember = SysMember::query()->leftJoin( 'sys_member_info', function ($join){
                $join->on( 'iId' , '=' , 'iMemberId' );
            })->find( session( 'shop_member.iId' , 0 ) );
        $DaoMember->iUserBirthday = $DaoMember->iUserBirthday ? $DaoMember->iUserBirthday : 0 ;
        $DaoMember->iUserBirthday = date( 'Y-m-d' , $DaoMember->iUserBirthday);
        $this->view->with( 'member', $DaoMember );


        //公司部門群組
        $DaoGroupMem = SysGroupMember::query()->leftJoin( 'sys_group', function ($join){
                $join->on( 'iGroupId' , '=' , 'iId' );
            })->where( 'sys_group_member.iMemberId' , '=' , session( 'shop_member.iId' , 0 ) )
            ->first();
        $this->view->with( 'member_company' , $DaoGroupMem->vGroupName );


        //
        $breadcrumb = [
            trans('_portal.home.title') => url( '' ),
        ];
        $this->view->with( 'breadcrumb', $breadcrumb );
        $this->view->with( 'member_active', $this->member_active );
        session()->put( 'SEO.vTitle' , trans('_portal.member_center.title') );
        //存上一頁網址，來源
        $this->putPrevPageToSession();

        return $this->view;
    }



    /*
    * ajax member save
    */
    public function doSave ()
    {
        $id = ( session()->has( 'shop_member.iId' ) ) ? session( 'shop_member.iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.login.error_account' );
            return response()->json( $this->rtndata );
        }
        //會員資料
        $Dao = SysMemberInfo::query()->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        if (Input::has( 'vUserName' )) {
            $Dao->vUserName = Input::get( 'vUserName' );
        }
        if (Input::has( 'vUserNameE' )) {
            $Dao->vUserNameE = Input::get( 'vUserNameE' );
        }
        if (Input::has( 'vDepartment' )) {
            $Dao->vDepartment = Input::get( 'vDepartment' );
        }
        if (Input::has( 'vUserTitle' )) {
            $Dao->vUserTitle = Input::get( 'vUserTitle' );
        }
        if (Input::has( 'vUserID' )) {
            $Dao->vUserID = Input::get( 'vUserID' );
        }
        if (Input::has( 'iUserBirthday' )) {
            $Dao->iUserBirthday = strtotime( Input::get( 'iUserBirthday' ) );
        }
        if (Input::has( 'vUserEmail' )) {
            $Dao->vUserEmail = Input::get( 'vUserEmail' );
        }
        if (Input::has( 'vUserContact' )) {
            $Dao->vUserContact = Input::get( 'vUserContact' );
        }
        if (Input::has( 'vUserZipCode' )) {
            $Dao->vUserZipCode = Input::get( 'vUserZipCode' );
        }
        if (Input::has( 'vUserCity' )) {
            $Dao->vUserCity = Input::get( 'vUserCity' );
        }
        if (Input::has( 'vUserArea' )) {
            $Dao->vUserArea = Input::get( 'vUserArea' );
        }
        if (Input::has( 'vUserAddress' )) {
            $Dao->vUserAddress = Input::get( 'vUserAddress' );
        }
        //
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
            $this->rtndata ['rtnurl'] = url( 'member_center' );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iMemberId, 'edit', json_encode( $Dao ) );

            $DaoMember = SysMember::query()->find( $id );
            $DaoMember->iUpdateTime = time();
            $DaoMember->save();
            // Member
            session()->put( 'shop_member', json_decode( json_encode( $DaoMember ), true ) );
            // MemberInfo
            session()->put( 'shop_member.info', json_decode( json_encode( $Dao ), true ) );

        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
     * ajax member save password for resetpassword
     */
    public function doSavePassword ( Request $request )
    {

        $vPassword    = ( $request->exists( 'vPassword' ) ) ? $request->input( 'vPassword' ) : "";
        $vPasswordNew = ( $request->exists( 'vPasswordNew' ) ) ? $request->input( 'vPasswordNew' ) : "";

        $DaoMember = SysMember::query()->find( session( 'shop_member.iId' ) );
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
            session()->forget( 'shop_member.info' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

}
