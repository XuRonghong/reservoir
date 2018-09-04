<?php

namespace App\Http\Controllers\_Web;

use App\ModReservoir;
use Illuminate\Http\Request;


class IndexController extends _WebController
{
    public $module = [ 'reservoir' , 'index' ];

    /*
     *
     */
    public function index ()
    {
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . 'index' );
        //
        $breadcrumb = [
            '後臺首頁' => url( '' ),
            '水庫' => url( 'reservoir' ),
        ];
        $this->view->with( 'breadcrumb', $breadcrumb );
        $this->view->with( 'module', $this->module );


        return $this->view;
    }


    /*
     * 所有水庫 ajax
     */
    public function getList ( Request $request )
    {
        $sort_arr = [];
        $search_arr = [];
        $search_word = $request->input('sSearch') ? $request->input('sSearch') : '' ;
        $iDisplayLength = $request->input('iDisplayLength') ? $request->input('iDisplayLength') : '' ;
        $iDisplayStart = $request->input('$iDisplayStart') ? $request->input('$iDisplayStart') : '' ;
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



        $mapReservoir['mod_reservoir.iStatus'] = 1;
        $mapReservoir['mod_reservoir.bDel'] = 0;

        $total_count = ModReservoir::query()->where(function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        })->where( $mapReservoir )
            ->count();

        $data_arr = ModReservoir::query()->where(function( $query ) use ( $sort_arr, $search_word ) {
            foreach ($sort_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        })->leftJoin( 'mod_reservoir_info', function ($join) {
            $join->on('mod_reservoir.iId', '=', 'mod_product_info.iReservoirId');
        })->where( $mapReservoir )
            ->orderBy( $sort_name, $sort_dir )
            ->skip( $iDisplayStart )
            ->take( $iDisplayLength )
            ->select( 'mod_reservoir.*')
            ->get();
        if ( !$data_arr){
            $this->rtndata['status'] = 0;
            $this->rtndata['message'] = ['Oops! 沒有水庫資訊!'];
            return $this->rtndata;
        }


        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;
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
        $maxRank = ModReservoir::query()->max( 'iRank' );
        $Dao = new ModReservoir();
//        $Dao->iMemberId = session()->get( 'member.iId' );
        $Dao->iRank = $maxRank + 1;
        $Dao->iType = ( $request->exists( 'iType' ) ) ? $request->input( 'iType' ) : 0;
        $Dao->vCode = ( $request->exists( 'vCode' ) ) ? $request->input( 'vCode' ) : "";
        $Dao->vRegion = ( $request->exists( 'vRegion' ) ) ? $request->input( 'vRegion' ) : "";
        $Dao->vName = ( $request->exists( 'vName' ) ) ? $request->input( 'vName' ) : '';
        $Dao->vLocation = ( $request->exists( 'vLocation' ) ) ? $request->input( 'vLocation' ) : "#";
        $Dao->vCounty = ( $request->exists( 'vCounty' ) ) ? $request->input( 'vCounty' ) : "";
        $Dao->iSum = ( $request->exists( 'iSum' ) ) ? $request->input( 'iSum' ) : "";
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->iStatus = ( $request->exists( 'iStatus' ) ) ? $request->input( 'iStatus' ) : 0;
        $Dao->bDel = 0;
        if ($Dao->save()) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.add_success' );
            $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'add', json_encode( $Dao ) );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.add_fail' );
        }

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

        $Dao = ModReservoir::query()->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        if ($request->exists( 'iRank' )) {
            $Dao->iRank = $request->input( 'iRank' );
        }
        if ($request->exists( 'iType' )) {
            $Dao->iType = $request->input( 'iType' );
        }
        if ($request->exists( 'vCode' )) {
            $Dao->vCode = $request->input( 'vCode' );
        }
        if ($request->exists( 'vRegion' )) {
            $Dao->vRegion = $request->input( 'vRegion' );
        }
        if ($request->exists( 'vName' )) {
            $Dao->vName = $request->input( 'vName' );
        }
        if ($request->exists( 'vLocation' )) {
            $Dao->vLocation = $request->input( 'vLocation' );
        }
        if ($request->exists( 'vCounty' )) {
            $Dao->vCounty = $request->input( 'vCounty' );
        }
        if ($request->exists( 'iSum' )) {
            $Dao->iSum = $request->input( 'iSum' );
        }
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
    public function doDel ( Request $request )
    {
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $Dao = ModReservoir::query()->find( $id );
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
