<?php

namespace App\Http\Controllers\_Web\Reservoir;

use Illuminate\Http\Request;
use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;
use App\ModReservoir;
use App\ModReservoirInfo;


class IndexController extends _WebController
{

    /*
     *
     */
    function __construct ()
    {
        $this->module = [ 'reservoir' ];
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
        $this->view->with( 'vSummary', '' );

        return $this->view;
    }


    /*
     * 所有水庫 ajax
     */
    public function getList ( Request $request )
    {
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


        $mapReservoir['mod_reservoir.bDel'] = 0;
        $total_count = ModReservoir::query()->where( $mapReservoir )
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            ->count();

        $data_arr = ModReservoir::query()->where( $mapReservoir )
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            // ->orderBy( trim($sort_name), $sort_dir )
            ->skip( $iDisplayStart )
            ->take( $iDisplayLength )
            ->get();
        if ( !$data_arr){
            $this->rtndata['status'] = 0;
            $this->rtndata['message'] = ['Oops! 沒有水庫資訊!'];
            return $this->rtndata;
        }
        foreach ($data_arr as $key => $var)
        {
            $var->DT_RowId = $var->iId;
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->vImages = [];//url('images/empty.jpg');
            $var->iSafeValue = 0;

            $DaoInfo = ModReservoirInfo::query()->where('iReservoirId','=',$var->iId)->first();
            if ( !$DaoInfo)continue;
            //安全值
            $var->iSafeValue = $DaoInfo->iSafeValue ? $DaoInfo->iSafeValue : 0;
            //圖片
            $image_arr = [];
            $tmp_arr = explode( ';', $DaoInfo->vImages );
            $tmp_arr = array_filter( $tmp_arr );
            foreach ($tmp_arr as $item) {
                $image_arr[] = FuncController::_getFilePathById( $item );
            }
            if ($tmp_arr){
                $var->vImages = $image_arr;
            } else {
                $var->vImages = [];
            }
            //
            switch ($DaoInfo->iType){
                case 1:
                    $var->iType = $this->ReservoirType[1];
                    break;
                case 2:
                    $var->iType = $this->ReservoirType[2];
                    break;
                case 3:
                    $var->iType = $this->ReservoirType[3];
                    break;
                case 4:
                    $var->iType = $this->ReservoirType[4];
                    break;
                default:
                    $var->iType = '0';
                    break;
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
        $this->view->with( 'vSummary', '新增水庫資料' );

        $this->view->with( 'reservori_category', $this->ReservoirType );
        return $this->view;
    }


    /*
     *
     */
    public function doAdd ( Request $request )
    {
        $Dao = new ModReservoir();
        $Dao->iRank = 0;
//        $Dao->iType = ( $request->input( 'iType' ) ) ? $request->input( 'iType' ) : 0;
        $Dao->vCode = ( $request->input( 'vCode' ) ) ? $request->input( 'vCode' ) : "";
        $Dao->vRegion = ( $request->input( 'vRegion' ) ) ? $request->input( 'vRegion' ) : "";
        $Dao->vName = ( $request->input( 'vName' ) ) ? $request->input( 'vName' ) : '';
        $Dao->vLocation = ( $request->input( 'vLocation' ) ) ? $request->input( 'vLocation' ) : "#";
        $Dao->vCounty = ( $request->input( 'vCounty' ) ) ? $request->input( 'vCounty' ) : "";
        $Dao->iSum = ( $request->input( 'iSum' ) ) ? $request->input( 'iSum' ) : 0;
        $Dao->iCreateTime = $Dao->iUpdateTime = time();
        $Dao->iStatus = ( $request->input( 'iStatus' ) ) ? $request->input( 'iStatus' ) : 1;
        $Dao->bDel = 0;
        $Dao->contact1=$request->input("contact1","");
        $Dao->contact_tel1=$request->input("contact_tel1","");
        $Dao->contact2=$request->input("contact2","");
        $Dao->contact_tel2=$request->input("contact_tel2","");
        $Dao->contact3=$request->input("contact3","");
        $Dao->contact_tel3=$request->input("contact_tel3","");
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction($Dao->getTable(), $Dao->iId, 'add', json_encode($Dao));

            $DaoInfo = new ModReservoirInfo();
            $DaoInfo->iReservoirId = $Dao->iId;
            $DaoInfo->iRank = 0;
            $DaoInfo->iType = ( $request->input( 'iType' ) ) ? $request->input( 'iType' ) : 0;
            $DaoInfo->vCode = 0; //( $request->input( 'vCode' ) ) ? $request->input( 'vCode' ) : "";
            $DaoInfo->vImages = ( $request->input( 'vImages' ) ) ? $request->input( 'vImages' ) : "";
            $DaoInfo->vSafe = ( $request->input( 'vSafe' ) ) ? $request->input( 'vSafe' ) : '';
            $DaoInfo->iSafeValue = ( $request->input( 'iSafeValue' ) ) ? $request->input( 'iSafeValue' ) : 0;
            $DaoInfo->iSum = 0; //( $request->input( 'iSum' ) ) ? $request->input( 'iSum' ) : 0;
            $DaoInfo->iCreateTime = $DaoInfo->iUpdateTime = time();
            $DaoInfo->iStatus = ( $request->input( 'iStatus' ) ) ? $request->input( 'iStatus' ) : 1;
            $DaoInfo->bDel = 0;

            if ($DaoInfo->save()) {
                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans('_web_message.add_success');
                $this->rtndata ['rtnurl'] = url('web/' . implode('/', $this->module));
                //Logs
                $this->_saveLogAction($DaoInfo->getTable(), $DaoInfo->iId, 'add', json_encode($DaoInfo));
            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.add_fail' ) . 'info';
            }
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
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.add');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode('.', $this->module) . '.edit' => url('web/' . implode('/', $this->module) . '/edit/' . $id )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '編輯水庫資料' );


        $mapReservoir['mod_reservoir.bDel'] = 0;
        $DaoReservoir = ModReservoir::query()->where($mapReservoir)
            ->leftJoin('mod_reservoir_info', function ($join) {
                $join->on('mod_reservoir.iId', '=', 'mod_reservoir_info.iReservoirId');
            })
            ->select(
                'mod_reservoir.iId',
                'mod_reservoir.vCode',
                'mod_reservoir.vRegion',
                'mod_reservoir.vName',
                'mod_reservoir.vLocation',
                'mod_reservoir.vCounty',
                'mod_reservoir.iCreateTime',
                'mod_reservoir.iUpdateTime',
                'mod_reservoir.iSum',
                'mod_reservoir.iStatus',
                'mod_reservoir.bDel',
                'mod_reservoir.contact1',
                'mod_reservoir.contact_tel1',
                'mod_reservoir.contact2',
                'mod_reservoir.contact_tel2',
                'mod_reservoir.contact3',
                'mod_reservoir.contact_tel3',
                'mod_reservoir_info.vImages',
                'mod_reservoir_info.vSafe',
                'mod_reservoir_info.iSafeValue')
            ->find($id);
        if ($DaoReservoir) {
            //圖片
            $image_arr = [];
            $tmp_arr = explode( ';', $DaoReservoir->vImages );
            $tmp_arr = array_filter( $tmp_arr );
            foreach ($tmp_arr as $item) {
                $image_arr[$item] = FuncController::_getFilePathById( $item );
            }
            if ($tmp_arr){
                $DaoReservoir->vImages = $image_arr;
            } else {
                $DaoReservoir->vImages = [];
            }

            switch ($DaoReservoir->iType){
                case 1:
                    $DaoReservoir->iType = $this->ReservoirType[1];
                    break;
                case 2:
                    $DaoReservoir->iType = $this->ReservoirType[2];
                    break;
                case 3:
                    $DaoReservoir->iType = $this->ReservoirType[3];
                    break;
                case 4:
                    $DaoReservoir->iType = $this->ReservoirType[4];
                    break;
            }
        }
        //
        $this->view->with( 'info', $DaoReservoir );
        $this->view->with( 'reservori_category', $this->ReservoirType );

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

        $Dao = ModReservoir::query()->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        if ($request->input( 'iRank' )) {
            $Dao->iRank = $request->input( 'iRank' );
        }
        if ($request->input( 'vCode' )) {
            $Dao->vCode = $request->input( 'vCode' );
        }
        if ($request->input( 'vRegion' )) {
            $Dao->vRegion = $request->input( 'vRegion' );
        }
        if ($request->input( 'vName' )) {
            $Dao->vName = $request->input( 'vName' );
        }
        if ($request->input( 'vLocation' )) {
            $Dao->vLocation = $request->input( 'vLocation' );
        }
        if ($request->input( 'vCounty' )) {
            $Dao->vCounty = $request->input( 'vCounty' );
        }
        if ($request->input( 'iSum' )) {
            $Dao->iSum = $request->input( 'iSum' );
        }
        if ($request->input( 'iStatus' )) {
            $Dao->iStatus = ( $request->input( 'iStatus' ) == "change" ) ? !$Dao->iStatus : $request->input( 'iStatus' );
        }
        $Dao->contact1=$request->input("contact1","");
        $Dao->contact_tel1=$request->input("contact_tel1","");
        $Dao->contact2=$request->input("contact2","");
        $Dao->contact_tel2=$request->input("contact_tel2","");
        $Dao->contact3=$request->input("contact3","");
        $Dao->contact_tel3=$request->input("contact_tel3","");

        $Dao->iUpdateTime = time();

        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );

            $DaoInfo = ModReservoirInfo::query()->where( 'iReservoirId', '=',  $id )->first();
            if ( !$DaoInfo) {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.empty_id' ) . 'info';
                return response()->json( $this->rtndata );
            }

            if ($request->input( 'iType' )) {
                $DaoInfo->iType = $request->input( 'iType' );
            }
            if ($request->input( 'vImages' )) {
                $DaoInfo->vImages = $request->input( 'vImages' );
            }
            if ($request->input( 'iSafeValue' )) {
                $DaoInfo->iSafeValue = $request->input( 'iSafeValue' );
            }
            $DaoInfo->iUpdateTime = time();

            if ($DaoInfo->save()) {
                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans( '_web_message.save_success' );
                $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );
                //Logs
                $this->_saveLogAction( $DaoInfo->getTable(), $DaoInfo->iId, 'edit', json_encode( $DaoInfo ) );
            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.save_fail' ) . 'info';
            }
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
        $Dao = ModReservoir::query()->find( $id );
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


    /*
     *
     */
    function attributes ( $id )
    {
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.attributes' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.attributes' => url( 'web/' . implode( '/', $this->module ) . '/attributes/' . $id )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '水庫資料更多資訊' );


        $mapReservoir['bDel'] = 0;
//        $map['iReservoirId'] = $id;
        $DaoReservoir = ModReservoir::query()->where( $mapReservoir )->find( $id );
        if ($DaoReservoir) {
            $this->view->with( 'info', $DaoReservoir );
        } else {
            session()->put( 'check_empty.message', 'Reservoir不存在' );
            return redirect( 'web/' . implode( '/', $this->module ) );
        }

        $mapReservoirInfo['bDel'] = 0;
        $mapReservoirInfo['iReservoirId'] = $id;
        $DaoReservoirInfo = ModReservoirInfo::query()->where( $mapReservoirInfo )->get();
        $this->view->with( 'attributes', $DaoReservoirInfo );

        return $this->view;
    }

}
