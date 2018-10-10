<?php

namespace App\Http\Controllers\_Web\Reservoir;

use Illuminate\Http\Request;
use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;
use App\ModReservoir;
use App\ModReservoirInfo;
use App\ModReservoirMeta;


class MetaController extends _WebController
{

    /*
     *
     */
    function __construct ()
    {
        $this->module = [ 'reservoir', 'meta' ];
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
        $this->view->with( 'vSummary', '水庫規格' );

        return $this->view;
    }


    /*
     * 所有水庫meta ajax
     */
    public function getList ( Request $request )
    {
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
        $sort_name = $sort_arr[ $request->input( 'iSortCol_0' ) ];
        $sort_dir = $request->input( 'sSortDir_0' );


        $mapReservoirMeta['bDel'] = 0;
        $total_count = ModReservoirMeta::query()->where( $mapReservoirMeta )
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            ->count();

        $data_arr = ModReservoirMeta::query()->where( $mapReservoirMeta )
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            ->orderBy( $sort_name, $sort_dir )
            ->skip( $iDisplayStart )
            ->take( $iDisplayLength )
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
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.add' => url( 'web/' . implode( '/', $this->module ) . "/add" )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '新增水庫規格' );

        return $this->view;
    }


    /*
     *
     */
    public function doAdd ( Request $request )
    {
        $maxRank = ModReservoirMeta::query()->max( 'iRank' );
        $Dao = new ModReservoirMeta();
        $Dao->iRank = $maxRank + 1;         //順序 越大越後面
        $Dao->vStructure = ( $request->input( 'vStructure' ) ) ? $request->input( 'vStructure' ) : "";
        $Dao->vLevel = ( $request->input( 'vLevel' ) ) ? $request->input( 'vLevel' ) : "";
        $Dao->iHeight = ( $request->input( 'iHeight' ) ) ? $request->input( 'iHeight' ) : 0;
        $Dao->iStoreTotal = ( $request->input( 'iStoreTotal' ) ) ? $request->input( 'iStoreTotal' ) : 0;
        $Dao->vGrade = ( $request->input( 'vGrade' ) ) ? $request->input( 'vGrade' ) : "";
        $Dao->vTrustRegion = ( $request->input( 'vTrustRegion' ) ) ? $request->input( 'vTrustRegion' ) : '';
        $Dao->vNumber = ( $request->input( 'vNumber' ) ) ? $request->input( 'vNumber' ) : "";
        $Dao->vNet = ( $request->input( 'vNet' ) ) ? $request->input( 'vNet' ) : '';
        $Dao->vAreaCode = ( $request->input( 'vAreaCode' ) ) ? $request->input( 'vAreaCode' ) : '';
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->iStatus = ( $request->input( 'iStatus' ) ) ? $request->input( 'iStatus' ) : 1;
        $Dao->bDel = 0;
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction($Dao->getTable(), $Dao->iId, 'add', json_encode($Dao));

            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans('_web_message.add_success');
            $this->rtndata ['rtnurl'] = url('web/' . implode('/', $this->module));
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
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.edit' => url( 'web/' . implode( '/', $this->module ) . '/edit/' . $id )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '編輯水庫規格' );


        $map['bDel'] = 0;
        $Dao = ModReservoirMeta::query()->where($map)
            ->where( 'iId', '=', $id )
            ->orWhere('vNumber', '=', $id)
            ->first();
        if ( !$Dao) {
//            session()->put( 'check_empty.message', trans( '_web_message.empty_id' ) );
            return redirect( 'web/' . implode( '/', $this->module ) );
        }

        //
        $this->view->with( 'info', $Dao );

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

        $Dao = ModReservoirMeta::query()->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        if ($request->input( 'iRank' )) {
            $Dao->iRank = $request->input( 'iRank' );
        }
        if ($request->input( 'vStructure' )) {
            $Dao->vStructure = $request->input( 'vStructure' );
        }
        if ($request->input( 'vLevel' )) {
            $Dao->vLevel = $request->input( 'vLevel' );
        }
        if ($request->input( 'iHeight' )) {
            $Dao->iHeight = $request->input( 'iHeight' );
        }
        if ($request->input( 'iStoreTotal' )) {
            $Dao->iStoreTotal = $request->input( 'iStoreTotal' );
        }
        if ($request->input( 'vGrade' )) {
            $Dao->vGrade = $request->input( 'vGrade' );
        }
        if ($request->input( 'vTrustRegion' )) {
            $Dao->vTrustRegion = $request->input( 'vTrustRegion' );
        }
        if ($request->input( 'vNumber' )) {
            $Dao->vNumber = $request->input( 'vNumber' );
        }
        if ($request->input( 'vNet' )) {
            $Dao->vNet = $request->input( 'vNet' );
        }
        if ($request->input( 'vAreaCode' )) {
            $Dao->vAreaCode = $request->input( 'vAreaCode' );
        }
        if ($request->input( 'iStatus' )) {
            $Dao->iStatus = ( $request->input( 'iStatus' ) == "change" ) ? !$Dao->iStatus : $request->input( 'iStatus' );
        }
        $Dao->iUpdateTime = time();

        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
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
        $map['bDel'] = 0;
        $Dao = ModReservoirMeta::query()->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
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
        $Dao = ModReservoirMeta::query()->find( $id );
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
