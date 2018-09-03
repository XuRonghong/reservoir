<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_Web\_Admin\Group;

use App\Http\Controllers\_Web\_WebController;
use App\SysGroup;
use App\SysMember;
use Illuminate\Http\Request;

class _GroupController extends _WebController
{
    /*
     * $iGroupType : 3.employee 4.store 5.blogger 6.supplier 999.customer
     * $iAcType : 31.employee 41.store 51.blogger 61.supplier 999.customer
     */

    /*
     *
     */
    public function index ()
    {
        $this->breadcrumb = [
            $this->module[0] . '.' . $this->module[1] => "#",
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->func = "web." . implode( '.', $this->module );
        $this->__initial();

        return $this->view;
    }

    /*
     *
     */
    public function getList ( Request $request )
    {
        $search_word = $request->input( 'sSearch' );
        $iDisplayLength = $request->input( 'iDisplayLength' );
        $iDisplayStart = $request->input( 'iDisplayStart' );
        $sEcho = $request->input( 'sEcho' );
        $sort_arr = explode( ',', $request->input( 'sColumns' ) );
        $sort_name = $sort_arr[$request->input( 'iSortCol_0' )];
        $sort_dir = $request->input( 'sSortDir_0' );
        //remove null
        $sort_arr = array_filter( $sort_arr );

        $map = [];
        $map['iGroupType'] = $this->iGroupType;

        $total_count = SysGroup::join( "sys_member_info", function( $join ) {
            $join->on( 'sys_member_info.iMemberId', '=', 'sys_group.iManagerId' );
        } )->where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->where( $map )->select( 'sys_group.*', 'sys_member_info.vUserName' )->count();

        $data_arr = SysGroup::join( "sys_member_info", function( $join ) {
            $join->on( 'sys_member_info.iMemberId', '=', 'sys_group.iManagerId' );
        } )->where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->where( $map )->select( 'sys_group.*', 'sys_member_info.vUserName' )->orderBy( $sort_name, $sort_dir )->skip( $iDisplayStart )->take( $iDisplayLength )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['sEcho'] = $sEcho;
        $this->rtndata ['iTotalDisplayRecords'] = $total_count;
        $this->rtndata ['iTotalRecords'] = $total_count;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
    *
    */
    public function getMember ( Request $request )
    {
        $search_word = $request->input( 'sSearch' );
        $iDisplayLength = $request->input( 'iDisplayLength' );
        $iDisplayStart = $request->input( 'iDisplayStart' );
        $sEcho = $request->input( 'sEcho' );
        $sort_arr = explode( ',', $request->input( 'sColumns' ) );
        $sort_name = $sort_arr[$request->input( 'iSortCol_0' )];
        $sort_dir = $request->input( 'sSortDir_0' );
        //remove null
        $sort_arr = array_filter( $sort_arr );

        $map = [];
        switch ($this->iAcType) {
            case 999:
                break;
            default:
                $map['iAcType'] = $this->iAcType;
        }

        $total_count = SysMember::join( 'sys_member_info', function( $join ) {
            $join->on( 'sys_member_info.iMemberId', '=', 'sys_member.iId' );
        } )->where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->where( $map )->count();
        $data_arr = SysMember::join( 'sys_member_info', function( $join ) {
            $join->on( 'sys_member_info.iMemberId', '=', 'sys_member.iId' );
        } )->where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->where( $map )->orderBy( $sort_name, $sort_dir )->skip( $iDisplayStart )->take( $iDisplayLength )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUserBirthday = date( 'Y/m/d', $var->iUserBirthday );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['sEcho'] = $sEcho;
        $this->rtndata ['iTotalDisplayRecords'] = $total_count;
        $this->rtndata ['iTotalRecords'] = $total_count;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doAdd ( Request $request )
    {
        $vGroupName = $request->exists( 'vGroupName' ) ? $request->input( 'vGroupName' ) : "";
        if ($vGroupName == "") {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.error_account' );

            return response()->json( $this->rtndata );
        }
        $map ['vGroupName'] = $vGroupName;
        $DaoMember = SysGroup::where( $map )->first();
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

        $DaoGroup = new SysGroup();
        $DaoGroup->iMemberId = session( 'member.iId' );
        $DaoGroup->iManagerId = session( 'member.iId' );
        $DaoGroup->iGroupType = $this->iGroupType;
        $DaoGroup->vGroupCode = $uuid;
        $DaoGroup->vGroupName = $vGroupName;
        $DaoGroup->iLimitCount = 0;
        $DaoGroup->iCreateTime = $DaoGroup->iUpdateTime = time();
        if ($DaoGroup->save()) {
            //Logs
            $this->_saveLogAction( $DaoGroup->getTable(), $DaoGroup->iId, 'add', json_encode( $DaoGroup ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.register.success' );
            $this->rtndata ['rtnurl'] = url( 'web/admin/group/employee' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.register.fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doSave ( Request $request )
    {
        $id = $request->exists( 'iId' ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao = SysGroup::find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        if ($request->exists( 'iManagerId' )) {
            $Dao->iManagerId = $request->input( 'iManagerId' );
        }
        if ($request->exists( 'vGroupName' )) {
            $Dao->vGroupName = $request->input( 'vGroupName' );
        }
        if ($request->exists( 'iStatus' )) {
            $Dao->iStatus = ( $Dao->iStatus ) ? 0 : 1;
        }
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
