<?php

namespace App\Http\Controllers\_Web\Reservoir;

use App\ModReservoir;
use App\ModReservoirInfo;
use App\ModReservoirMeta;
use Illuminate\Http\Request;
use App\Http\Controllers\FuncController;
use App\Http\Controllers\_Web\_WebController;


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
        session()->put( 'SEO.vTitle' , '水庫meta' );
        $this->view->with( 'vSummary', '' );

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
//            ->leftJoin( 'mod_reservoir_info', function ($join) {
//                $join->on('mod_reservoir.iId', '=', 'mod_reservoir_info.iReservoirId');
//            })
            ->count();

        $data_arr = ModReservoirMeta::query()->where( $mapReservoirMeta )
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
//            ->leftJoin( 'mod_reservoir_info', function ($join) {
//                $join->on('mod_reservoir.iId', '=', 'mod_reservoir_info.iReservoirId');
//            })
            ->orderBy( $sort_name, $sort_dir )
            ->skip( $iDisplayStart )
            ->take( $iDisplayLength )
//            ->select( 'mod_reservoir.*' ,
//                'mod_reservoir_info.vImages',
//                'mod_reservoir_info.iSafeValue')
            ->get();
        if ( !$data_arr){
            $this->rtndata['status'] = 0;
            $this->rtndata['message'] = ['Oops! 沒有水庫meta資訊!'];
            return $this->rtndata;
        }
        foreach ($data_arr as $key => $var) {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
//            //圖片
//            $image_arr = [];
//            $tmp_arr = explode( ';', $var->vImages );
//            $tmp_arr = array_filter( $tmp_arr );
//            foreach ($tmp_arr as $item) {
//                $image_arr[] = FuncController::_getFilePathById( $item );
//            }
//            $var->vImages = $image_arr;
//            //
//            $var->vCategoryNum = ( $var->iCategoryId > 0 ) ? FuncController::_getCategoryNum( $var->iCategoryId ) . str_pad( $var->iId, 6, 0, STR_PAD_LEFT ) : "";
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
        session()->put( 'SEO.vTitle' , '水庫meta新增' );
        $this->view->with( 'vSummary', '' );

        return $this->view;
    }


    /*
     *
     */
    public function doAdd ( Request $request )
    {
        $maxRank = ModReservoirMeta::query()->max( 'iRank' );
        $Dao = new ModReservoirMeta();
//        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iRank = $maxRank + 1;
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

//            $DaoInfo = new ModReservoirInfo();
//            $DaoInfo->iReservoirId = $Dao->iId;
//            $DaoInfo->iRank = null;
//            $DaoInfo->iType = ( $request->input( 'iType' ) ) ? $request->input( 'iType' ) : 0;
//            $DaoInfo->vCode = 0; //( $request->input( 'vCode' ) ) ? $request->input( 'vCode' ) : "";
//            $DaoInfo->vImages = ( $request->input( 'vImages' ) ) ? $request->input( 'vImages' ) : "";
//            $DaoInfo->vSafe = ( $request->input( 'vSafe' ) ) ? $request->input( 'vSafe' ) : '';
//            $DaoInfo->iSafeValue = ( $request->input( 'iSafeValue' ) ) ? $request->input( 'iSafeValue' ) : 0;
//            $DaoInfo->iSum = 0; //( $request->input( 'iSum' ) ) ? $request->input( 'iSum' ) : 0;
//            $DaoInfo->iCreateTime = $DaoInfo->iUpdateTime = time();
//            $DaoInfo->iStatus = ( $request->input( 'iStatus' ) ) ? $request->input( 'iStatus' ) : 1;
//            $DaoInfo->bDel = 0;
//            if ($DaoInfo->save()) {
                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans('_web_message.add_success');
                $this->rtndata ['rtnurl'] = url('web/' . implode('/', $this->module));
                //Logs
//                $this->_saveLogAction($DaoInfo->getTable(), $DaoInfo->iId, 'add', json_encode($DaoInfo));
//            } else {
//                $this->rtndata ['status'] = 0;
//                $this->rtndata ['message'] = trans( '_web_message.add_fail' ) . 'info';
//            }
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
        session()->put( 'SEO.vTitle' , '編輯' );
        $this->view->with( 'vSummary', '' );


        $map['bDel'] = 0;
//        $Dao = ModReservoirMeta::query()->where( $map )->find( $id );
        $Dao = ModReservoirMeta::query()->where($map)
            ->where( 'iId', '=', $id )
            ->orWhere('vNumber', '=', $id)
            ->first();
        if ( !$Dao) {
//            session()->put( 'check_empty.message', trans( '_web_message.empty_id' ) );
            return redirect( 'web/' . implode( '/', $this->module ) );
        }
        //圖片
//        $image_arr = [];
//        $tmp_arr = explode( ';', $DaoReservoir->vImages );
//        $tmp_arr = array_filter( $tmp_arr );
//        foreach ($tmp_arr as $item) {
//            $image_arr[$item] = FuncController::_getFilePathById( $item );
//        }
//        $DaoReservoir->vImages = $image_arr;

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
//            $DaoInfo = ModReservoirInfo::query()->where( 'iReservoirId', '=',  $id )->first();
//            if ( !$DaoInfo) {
//                $this->rtndata ['status'] = 0;
//                $this->rtndata ['message'] = trans( '_web_message.empty_id' ) . 'info';
//                return response()->json( $this->rtndata );
//            }
//            if ($request->exists( 'vImages' )) {
//                $DaoInfo->vImages = $request->input( 'vImages' );
//            }
//            if ($request->exists( 'iSafeValue' )) {
//                $DaoInfo->iSafeValue = $request->input( 'iSafeValue' );
//            }
//            $DaoInfo->iUpdateTime = time();
//            if ($DaoInfo->save()) {
                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans( '_web_message.save_success' );
                $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );
                //Logs
//                $this->_saveLogAction( $DaoInfo->getTable(), $DaoInfo->iId, 'edit', json_encode( $DaoInfo ) );
//            } else {
//                $this->rtndata ['status'] = 0;
//                $this->rtndata ['message'] = trans( '_web_message.save_fail' ) . 'info';
//            }
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
//        if ($request->exists( 'bOpen' )) {
//            $Dao->bOpen = ( $request->input( 'bOpen' ) == "change" ) ? !$Dao->bOpen : $request->input( 'bOpen' );
//        }
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
