<?php

namespace App\Http\Controllers\_Web\_Admin;

use App\Http\Controllers\_Web\_WebController;
use App\SysCategory;
use Illuminate\Http\Request;


class CategoryController extends _WebController
{

    public $module = [ 'admin', 'category' ];

    /*
     *
     */
    public function index ()
    {
        $this->breadcrumb = [
            $this->module[0] => "#",
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

        $map ['iParentId'] = 0;
        $total_count = SysCategory::where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->where( $map )->count();

        $data_arr = SysCategory::where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->orderBy( $sort_name, $sort_dir )->skip( $iDisplayStart )->take( $iDisplayLength )->where( $map )->get();
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
    public function doAdd ( Request $request )
    {
        $maxRank = SysCategory::max( 'iRank' );
        $Dao = new SysCategory ();
        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iCategoryType = 99;
        $Dao->iParentId = 0;
        $Dao->vCategoryValue = ( $request->exists( 'vCategoryValue' ) ) ? $request->input( 'vCategoryValue' ) : "";
        $Dao->vCategoryName = ( $request->exists( 'vCategoryName' ) ) ? $request->input( 'vCategoryName' ) : "";
        $Dao->vImages = ( $request->exists( 'vImages' ) ) ? $request->input( 'vImages' ) : "";
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->iRank = $maxRank + 1;
        $Dao->iStatus = 1;
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.add_success' );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'add', json_encode( $Dao ) );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.add_fail' );
        }
        $this->rtndata ['status'] = 1;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doSave ( Request $request )
    {
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao = SysCategory::find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        if ($request->exists( 'vCategoryValue' )) {
            $Dao->vCategoryValue = htmlspecialchars( $request->input( 'vCategoryValue' ) );
        }
        if ($request->exists( 'vCategoryName' )) {
            $Dao->vCategoryName = htmlspecialchars( $request->input( 'vCategoryName' ) );
        }
        if ($request->exists( 'vImages' )) {
            $Dao->vImages = htmlspecialchars( $request->input( 'vImages' ) );
        }
        if ($request->exists( 'iStatus' )) {
            $Dao->iStatus = ( $Dao->iStatus ) ? 0 : 1;
        }
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
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
    public function sub ( $pid )
    {
        $this->breadcrumb = [
            $this->module[0] => "#",
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.sub' => url( 'web/' . implode( '/', $this->module ) . '/sub' )
        ];
        $this->func = "web." . implode( '.', $this->module ) . ".sub";
        $this->__initial();
        $map['iParentId'] = 0;
        $map['bDel'] = 0;
        $Dao = SysCategory::where( $map )->find( $pid );
        if ( !$Dao) {
            session()->put( 'check_empty.message', trans( '_web_message.empty_id' ) );

            return redirect( 'web/' . implode( '/', $this->module ) );
        }
        $this->view->with( 'info', $Dao );

        return $this->view;
    }

    /*
     *
     */
    public function getListSub ( Request $request, $pid )
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

        $map['iParentId'] = $pid;
        $map['bDel'] = 0;
        $total_count = SysCategory::where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->where( $map )->count();

        $data_arr = SysCategory::where( function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        } )->orderBy( $sort_name, $sort_dir )->skip( $iDisplayStart )->take( $iDisplayLength )->where( $map )->get();
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
            $var->vImages = $var->vImages ? $var->vImages : asset( '/images/empty.jpg' );
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

    public function doSaveSub ( Request $request, $pid )
    {
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $map['iParentId'] = $pid;
        $Dao = SysCategory::where( $map )->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }

        $Dao->iRank = $request->exists( 'iRank' ) ? $request->input( 'iRank' ) : $Dao->iRank ;

        if ($request->exists( 'vCategoryValue' )) {
            $Dao->vCategoryValue = $request->input( 'vCategoryValue' );
        }
        if ($request->exists( 'vCategoryName' )) {
            $Dao->vCategoryName = $request->input( 'vCategoryName' );
        }
        if ($request->exists( 'vImages' )) {
            $Dao->vImages = $request->input( 'vImages' );
        }
        if ($request->exists( 'iStatus' )) {
            $Dao->iStatus = ( $Dao->iStatus ) ? 0 : 1;
        }
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
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
    public function doAddSub ( Request $request, $pid )
    {
        $DaoParent = SysCategory::find( $pid );
        if ( !$DaoParent) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $maxRank = SysCategory::max( 'iRank' );
        $Dao = new SysCategory ();
        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iCategoryType = $DaoParent->iCategoryType;
        $Dao->iParentId = $DaoParent->iId;
        $Dao->vCategoryValue = ( $request->exists( 'vCategoryValue' ) ) ? $request->input( 'vCategoryValue' ) : "";
        $Dao->vCategoryName = ( $request->exists( 'vCategoryName' ) ) ? $request->input( 'vCategoryName' ) : "";
        $Dao->vImages = ( $request->exists( 'vImages' ) ) ? $request->input( 'vImages' ) : "";
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->iRank = $maxRank + 1;
        $Dao->iStatus = 1;
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.add_success' );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'add', json_encode( $Dao ) );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.add_fail' );
        }
        $this->rtndata ['status'] = 1;

        return response()->json( $this->rtndata );
    }
}
