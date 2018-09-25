<?php

namespace App\Http\Controllers\_Web\Message;

use App\LogLogin;
use App\ModDeviceToken;
use App\ModMessage;
use Illuminate\Http\Request;
use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;
use App\SysMember;
use App\SysMemberInfo;
use App\SysGroupMember;
use App\ModReservoirMeta;
use App\ModReservoir;


class CenterController extends _WebController
{

    /*
     *
     */
    function __construct ()
    {
        $this->module = [ 'message' , 'center' ];
        $this->vTitle = 'Index';
    }


    /*
     *
     */
    public function index ()
    {
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.index');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        session()->put( 'SEO.vTitle' , '通知中心' );
        $this->view->with( 'vSummary', '' );

        //撈取資訊資料表
        $DaoMessage = $this->getDaoMessage( false);
        foreach ($DaoMessage as $var){
            $var->url = url('web/message/attr') . '/' . $var->iId;
        }
        $this->view->with( 'info', $DaoMessage );
        $this->view->with('total', $DaoMessage->count() );

        return $this->view;
    }


    /*
     * all list ajax
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

        //
        $map['bDel'] = 0;
        $total_count = ModMessage::query()->where($map)
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            ->count();

        $data_arr = ModMessage::query()->where($map)
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            ->orderBy( $sort_name, $sort_dir )
            ->skip( $iDisplayStart )
            ->take( $iDisplayLength )
            ->get();
        if ( !$data_arr)
        {
            $this->rtndata['status'] = 0;
            $this->rtndata['message'] = ['Oops! 沒有資料!'];
            return $this->rtndata;
        }
        foreach ($data_arr as $key => $var)
        {
            //
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
            switch ($var->iSource){
                case 2:
                    $var->iSource = '網站管理員';
                    break;
                case 10:
                    $var->iSource = '水庫管理員';
                    break;
                default:
                    $var->iSource = 'event';//.$var->iSource
            }
            switch ($var->iType){
                case 99:
                    $var->iType = '訊息';
                    break;
                case 15:
                    $var->iType = '已通知';
                    break;
                case 10:
                    $var->iType = '已回報';
                    break;
                case 5:
                    $var->iType = '未回報';
                    break;
                case 0:
                    $var->iType = '已發送';
                    break;
            }
            //圖片
            $image_arr = [];
            $tmp_arr = explode( ';', $var->vImages );
            $tmp_arr = array_filter( $tmp_arr );
            foreach ($tmp_arr as $item) {
                $image_arr[] = FuncController::_getFilePathById( $item );
            }
            if ($tmp_arr){
                $var->vImages = $image_arr;
            } else {
                $var->vImages = [];
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
    public function add (Request $request)
    {
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.add' => url( 'web/' . implode( '/', $this->module ) . "/add" )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        session()->put( 'SEO.vTitle' , '新增通知' );
        $this->view->with( 'vSummary', '' );

        return $this->view;
    }


    /*
    *
    */
    public function doAdd ( Request $request )
    {
        try {
            $Dao = new ModMessage();
//        $Dao->iRank = null; //$maxRank + 1;
//        $Dao->iCategoryType = 0; //( $request->input( 'iType' ) ) ? $request->input( 'iType' ) : 0;
            $Dao->iType = ($request->input('iType')) ? $request->input('iType') : 99;
            $Dao->iSource = ($request->input('iSource')) ? $request->input('iSource') : 0;
            $Dao->iHead = ($request->input('iHead')) ? $request->input('iHead') : 0;
            $Dao->vTitle = ($request->input('vTitle')) ? $request->input('vTitle') : "";
            $Dao->vSummary = ($request->input('vSummary')) ? $request->input('vSummary') : "";
            $Dao->vDetail = ($request->input('vDetail')) ? $request->input('vDetail') : '';
//        $Dao->vUrl = ( $request->input( 'vUrl' ) ) ? $request->input( 'vUrl' ) : "";
            $Dao->vImages = ($request->input('vImages')) ? $request->input('vImages') : "";
            $Dao->vNumber = rand(1000000001, 1099999999);
            $Dao->iStartTime = ($request->input('iStartTime')) ? $request->input('iStartTime') : time();
            $Dao->iEndTime = ($request->input('iEndTime')) ? $request->input('iEndTime') : 0;
//        $Dao->iCheck = ( $request->input( 'iCheck' ) ) ? $request->input( 'iCheck' ) : 0;
            $Dao->iCreateTime = $Dao->iUpdateTime = time();
            $Dao->iStatus = ($request->input('iStatus')) ? $request->input('iStatus') : 1;
            $Dao->bDel = 0;

            if ($Dao->save()) {
                //Logs
                $this->_saveLogAction($Dao->getTable(), $Dao->iId, 'add', json_encode($Dao));

                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans('_web_message.add_success');
                $this->rtndata ['rtnurl'] = url('web/' . implode('/', $this->module));

                // Android app 端要得到的資料
                $this->rtndata ['newid'] = $Dao->iId;

                $arr_memberid = SysMember::query()->where('iStatus' , 1)->where('iAcType', '<', $Dao->iHead)->pluck('iId');
                $map['bDel'] = 0;
                $arr_token = ModDeviceToken::query()->where($map)->whereIn('iMemberId', $arr_memberid)->pluck('vToken');

                $this->rtndata ['heads_token'] = $arr_token;
            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans('_web_message.add_fail');
            }
        } catch (\Exception $e){
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = $e->getMessage();
        }

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function edit ( $id )
    {
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.add');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode('.', $this->module) . '.edit' => url('web/' . implode('/', $this->module) . "/edit" . $id )
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        session()->put( 'SEO.vTitle' , '編輯' );
        $this->view->with( 'vSummary', '' );


//        $map['iStatus'] = 1;
        $map['bDel'] = 0;
        $Dao = ModMessage::query()->where($map)->find($id);
        if ($Dao) {
            //
            $var = $Dao;
            switch ($var->iSource){
                case 2:
                    $var->iSource = '網站管理員';
                    break;
                case 10:
                    $var->iSource = '水庫管理員';
                    break;
                default:
                    $var->iSource = 'event';//.$var->iSource
            }
            switch ($var->iType){
                case 99:
                    $var->iType = '訊息';
                    break;
                case 15:
                    $var->iType = '已通知';
                    break;
                case 10:
                    $var->iType = '已回報';
                    break;
                case 5:
                    $var->iType = '未回報';
                    break;
                case 0:
                    $var->iType = '已發送';
                    break;
            }
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
        $id = $request->input( 'iId', 0 );
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $Dao = ModMessage::query()->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

//        $Dao->iRank = null; //$maxRank + 1;
//        $Dao->iCategoryType = 0; //( $request->input( 'iType' ) ) ? $request->input( 'iType' ) : 0;
        $Dao->iType = ( $request->input( 'iType' ) ) ? $request->input( 'iType' ) : 99;
        $Dao->iSource = ( $request->input( 'iSource' ) ) ? $request->input( 'iSource' ) : 0;
        $Dao->iHead = ( $request->input( 'iHead' ) ) ? $request->input( 'iHead' ) : 0;
        $Dao->vTitle = ( $request->input( 'vTitle' ) ) ? $request->input( 'vTitle' ) : "";
        $Dao->vSummary = ( $request->input( 'vSummary' ) ) ? $request->input( 'vSummary' ) : "";
        $Dao->vDetail = ( $request->input( 'vDetail' ) ) ? $request->input( 'vDetail' ) : '';
//        $Dao->vUrl = ( $request->input( 'vUrl' ) ) ? $request->input( 'vUrl' ) : "";
        $Dao->vImages = ( $request->input( 'vImages' ) ) ? $request->input( 'vImages' ) : "";
        $Dao->vNumber = rand( 1000000001, 1099999999 );
        $Dao->iStartTime = ( $request->input( 'iStartTime' ) ) ? $request->input( 'iStartTime' ) : 0;
        $Dao->iEndTime = ( $request->input( 'iEndTime' ) ) ? $request->input( 'iEndTime' ) : 0;
//        $Dao->iCheck = ( $request->input( 'iCheck' ) ) ? $request->input( 'iCheck' ) : 0;
        $Dao->iUpdateTime = time();

        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );

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
                $DaoInfo->iMemberId = 0;
                $DaoInfo->save();
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
    function doDel ( Request $request )
    {
        $id = $request->input( 'iId', 0 );
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        $map['bDel'] = 0;
        $Dao = ModMessage::query()->where( $map )->find( $id );
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
    public function attr (Request $request , $id)
    {
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.attr');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode( '.', $this->module ) . '.attributes' => url( 'web/' . implode( '/', $this->module ) . '/attr/' . $id )
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        session()->put( 'SEO.vTitle' , '更多資訊' );
        $this->view->with( 'vSummary', '' );

        //
//        $mapMessage['iStatus'] = 1;
        $mapMessage['bDel'] = 0;
        $DaoMessage = ModMessage::query()->where($mapMessage)->find($id);
        if ($DaoMessage){
            //
            $DaoMessage->iCreateTime = date( 'Y/m/d H:i:s', $DaoMessage->iCreateTime );
            $DaoMessage->iUpdateTime = date( 'Y/m/d H:i:s', $DaoMessage->iUpdateTime );
            $DaoMessage->iStartTime = date( 'Y/m/d H:i:s', $DaoMessage->iStartTime );
            //
            $var = $DaoMessage;
            switch ($var->iSource){
                case 2:
                    $var->iSource = '網站管理員';
                    break;
                case 10:
                    $var->iSource = '水庫管理員';
                    break;
                default:
                    $var->iSource = 'event';//.$var->iSource
            }
            switch ($var->iType){
                case 99:
                    $var->iType = '訊息';
                    break;
                case 15:
                    $var->iType = '已通知';
                    break;
                case 10:
                    $var->iType = '已回報';
                    break;
                case 5:
                    $var->iType = '未回報';
                    break;
                case 0:
                    $var->iType = '已發送';
                    break;
            }
            switch ($var->iCheck){
                case 0:
                    $var->iCheck = '無';
                    break;
                case 10:
                    $var->iCheck = '水庫管理員';
                    break;
                case 20:
                    $var->iCheck = '水庫審查員';
                    break;
                case 30:
                    $var->iCheck = '中央水利署人員';
                    break;
                case 40:
                    $var->iCheck = '全體人員';
                    break;
            }
        }
        $this->view->with( 'info', $DaoMessage );

        return $this->view;
    }


    /*
     *
     */
    public function doDelAll ( Request $request )
    {
        if ( session('member.iAcType' , 0) != 1) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        $mapMessage['bDel'] = 0;
        $Dao = ModMessage::query()->where($mapMessage)->get();
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        foreach ($Dao as $var){
            $var->bDel = 1;
            $var->iUpdateTime = time();
            if (!$var->save()) {
                //Logs
                $this->_saveLogAction( $var->getTable(), $var->iId, 'delete', json_encode( $var ) );
            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.delete_fail' );
                return response()->json( $this->rtndata );
            }
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.delete_success' );

        return response()->json( $this->rtndata );
    }
}
