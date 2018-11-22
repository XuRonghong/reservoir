<?php

namespace App\Http\Controllers\_Web;

use Illuminate\Http\Request;
use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;
use App\ModInstructions;
use App\SysMember;


class MonitorController extends _WebController
{

    /*
     *
     */
    function __construct ()
    {
        $this->module = [ 'instructions', 'monitor' ];
        $this->vTitle = 'Index';
    }


    /*
     *
     */
    public function index ()
    {
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.index' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '重要監測運整' );
        $this->view->with( 'add_url', url('web/' . implode( '/' , $this->module ) . '/add') );

        return $this->view;
    }


    /*
     *  ajax
     */
    public function getList ( Request $request )
    {
        $this->_init();

        $sort_arr = [];
        $search_arr = [];
        $search_word = $request->input('sSearch') ? $request->input('sSearch') : '' ;
        $iDisplayLength = $request->input('iDisplayLength') ? $request->input('iDisplayLength') : 0 ;
        $iDisplayStart = $request->input('iDisplayStart') ? $request->input('iDisplayStart') : 0 ;
        $sEcho = $request->input( 'sEcho' ) ? $request->input('sEcho') : '' ;
        $column_arr = $request->input( 'sColumns' ) ? $request->input('sColumns') : '' ;
        $column_arr = explode( ',', $column_arr );
        foreach ($column_arr as $key => $item) {
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
        $sort_name = $request->input( 'iSortCol_0' )? $sort_arr[ $request->input( 'iSortCol_0' ) ] : 'mod_instructions.iId';
        $sort_dir = $request->input( 'sSortDir_0' )? $request->input( 'sSortDir_0' ) : 'desc';


        $map['mod_instructions.bDel'] = 0;
        $map['mod_instructions.iType'] = 21;     // 11.系統操作說明  21.重要監測運整
        $total_count = ModInstructions::query()->where( $map )
            ->leftJoin( 'mod_reservoir', function( $join ) {
                $join->on( 'mod_reservoir.iId', '=', 'mod_instructions.iReservoir' );
            })
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            ->count();

        $data_arr = ModInstructions::query()->where( $map )
            ->leftJoin( 'mod_reservoir', function( $join ) {
                $join->on( 'mod_reservoir.iId', '=', 'mod_instructions.iReservoir' );
            })
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            ->orderBy( $sort_name, $sort_dir )
            ->skip( $iDisplayStart )
            ->take( $iDisplayLength )
            ->select([
                'mod_instructions.iId' ,
                'mod_instructions.vFile' ,
                'mod_instructions.iReservoir' ,
                'mod_reservoir.vName'
            ])
            ->get();

        if ( !$data_arr){
            $this->rtndata['status'] = 0;
            $this->rtndata['message'] = ['Oops! 沒有資訊!'];
            return $this->rtndata;
        }
        foreach ($data_arr as $key => $var)
        {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
            //
//            $var->iMemberId = SysMember::query()->where('iId', '=', $var->iMemberId)->first() ->vAccount;
            //圖片檔案路徑

            $image_arr = [];
            $tmp_arr = explode( ';', $var->vFile );
            $tmp_arr = array_filter( $tmp_arr );
            foreach ($tmp_arr as $item) {
                $image_arr[] = FuncController::_getFilePathById( $item );
            }
            if ($tmp_arr){
                $var->vFile = $image_arr;
            } else {
                $var->vFile = [];
            }
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
    public function add ()
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
        $this->view->with( 'vSummary', '重要監測運整-新增' );
        $this->view->with( 'reservoir', $this->Reservoir );     //水庫列表

        return $this->view;
    }


    /*
     *
     */
    public function doAdd ( Request $request )
    {
        $Dao = new ModInstructions();
        $Dao->iRank = 0;         //順序 越大越後面
        $Dao->iType = 21;       //11.系統操作說明     21.重要監測運整
        $Dao->iMemberId = session('member.iId');

        $Dao->iReservoir = ( $request->exists( 'iReservoir' ) ) ? $request->input( 'iReservoir' ) : "";
        $Dao->vFile = ( $request->exists( 'vImage1' ) ) ? $request->input( 'vImage1' ).';' : '';
        $Dao->vFile .= ( $request->exists( 'vImage2' ) ) ? $request->input( 'vImage2' ).';' : '';
        $Dao->vFile .= ( $request->exists( 'vImage3' ) ) ? $request->input( 'vImage3' ).';' : '';

        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->iStatus = ( $request->exists( 'iStatus' ) ) ? $request->input( 'iStatus' ) : 1;
        $Dao->bDel = 0;

        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans('_web_message.add_success');
            $this->rtndata ['rtnurl'] = url('web/' . implode('/', $this->module));
            //Logs
            $this->_saveLogAction($Dao->getTable(), $Dao->iId, 'add', json_encode($Dao));
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.add_fail' );
        }

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function edit ( $id )
    {
        $this->_init();
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.edit' => url( 'web/' . implode( '/', $this->module ) . '/edit/' . $id )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '重要監測運整-編輯' );

        $map['bDel'] = 0;
        $map['iId'] = $id;
        $Dao = ModInstructions::query()->where($map)->first();
        if ( !$Dao) {
            return redirect( 'web/' . implode( '/', $this->module ) );
        }

        //檔案路徑
        $image_arr = [];
        $tmp_arr = explode( ';', $Dao->vFile );
        $tmp_arr = array_filter( $tmp_arr );
        $Dao->vFileId = $tmp_arr;
        foreach ($tmp_arr as $item) {
            $image_arr[] = FuncController::_getFilePathById( $item );
        }
        if ($tmp_arr){
            $Dao->vFile = $image_arr;
        } else {
            $Dao->vFile = [];
        }

        //
        $this->view->with( 'info', $Dao );
        $this->view->with( 'reservoir', $this->Reservoir );

        return $this->view;
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

        $Dao = ModInstructions::query()->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        if ($request->exists( 'iReservoir' )) {
            $Dao->iReservoir = $request->input( 'iReservoir' );
        }
        //
        if ($request->exists( 'vImage1' )) {
            $Dao->vFile = $request->input( 'vImage1' ) .';' ;
        }
        if ($request->exists( 'vImage2' )) {
            $Dao->vFile .= $request->input( 'vImage2' ) .';' ;
        }
        if ($request->exists( 'vImage3' )) {
            $Dao->vFile .= $request->input( 'vImage3' ) .';' ;
        }
        //
        if ($request->exists( 'iStatus' )) {
            $Dao->iStatus = ( $request->input( 'iStatus' ) == "change" ) ? !$Dao->iStatus : $request->input( 'iStatus' );
        }
        $Dao->iUpdateTime = time();

        if ($Dao->save()) {
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
    function doSaveShow ( Request $request )
    {
        $id = $request->input( 'iId', 0 );
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        $map['bDel'] = 0;
        $Dao = ModInstructions::query()->where($map)->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        //隨點隨改
        if ($request->exists( 'vTitle' )) {
            $Dao->vTitle = $request->input( 'vTitle' );
        }
        if ($request->exists( 'iStatus' )) {
            $Dao->iStatus = ( $request->input( 'iStatus' ) == "change" ) ? !$Dao->iStatus : $request->input( 'iStatus' );
        }
        $Dao->iRank = $request->exists( 'iRank' ) ? $request->input( 'iRank' ) : $Dao->iRank ;
        $Dao->iUpdateTime = time();

        if ($Dao->save()) {
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
    public function doDel ( Request $request )
    {
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        $Dao = ModInstructions::query()->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        $Dao->bDel = 1;
        $Dao->iUpdateTime = time();

        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.delete_success' );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'delete', json_encode( $Dao ) );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.delete_fail' );
        }

        return response()->json( $this->rtndata );
    }
}
