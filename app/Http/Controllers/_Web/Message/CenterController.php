<?php

namespace App\Http\Controllers\_Web\Message;

use App\ModTraceCheck;
use Illuminate\Http\Request;
use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;
use App\ModDeviceToken;
use App\ModMessage;
use App\SysMember;
use App\SysMemberInfo;


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
        $this->_init();
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.index');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        $this->view->with('vTitle', $this->vTitle);
        $this->view->with('vSummary', '通知中心' );
        $this->view->with( 'permission', $this->Permission );

        //撈取資訊資料表
        if (session('member.iAcType')<10){
            $DaoMessage = $this->getDaoMessage( false , false);     //網站管理員不用階級check
        } else {

            $DaoMessage = $this->getDaoMessage( false , true);
        }

        if ($DaoMessage){
            //
            $Dao = [];
            $message_total = 0;         //重新計算訊息數量
            foreach ($DaoMessage as $var)
            {
                //主要分 系統訊息 與 地震通知 種類
                if ($var->iType > 50){
                    $message_total ++;
                    $Dao[] = $var;      //物件的重新組合
                    //
                    $var->url = url('web/message/center/attr') . '/' . $var->iId;

                    // 訊息type=89 : 連結存在Detail內 ， 關於地震水庫審核表
                    if($var->iType == 89){
                        $var->url = $var->vDetail;
                    }
                }
                //圖片處理,假如NULL給他個預設值
                if ( !$var->vImages){
                    $var->vImages = env('APP_URL') . '/images/favicon.png';
                }
            }
        }
//        foreach ($DaoMessage as $var){
//            $var->url = url('web/message/attr') . '/' . $var->iId;
//        }
        $this->view->with( 'info', $Dao );
        $this->view->with('total', $message_total );

        return $this->view;
    }


    /*
     * all list ajax
     */
    public function getList ( Request $request )
    {
        $this->_init();
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
            ->where('iType', '>', 50)
            ->count();

        $data_arr = ModMessage::query()->where($map)
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            ->where('iType', '>', 50)
            ->orderBy( $sort_name, $sort_dir )
            ->skip( $iDisplayStart )
            ->take( $iDisplayLength );
        if ( !$data_arr)
        {
            $this->rtndata['status'] = 0;
            $this->rtndata['message'] = ['Oops! 沒有資料!'];
            return $this->rtndata;
        }
        //---------------------------------------------------------------
            if (session('member.iAcType')>9){
                $data_arr = $data_arr
                    ->where('iHead', '>', session('member.iAcType'))
                    ->get();     //階級check
            } else {
                $data_arr = $data_arr->get();
            }
        //---------------------------------------------------------------
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
                    $var->iSource = 'System';//.$var->iSource
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
        $this->_init();
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.add' => url( 'web/' . implode( '/', $this->module ) . "/add" )
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        $this->view->with('vTitle', $this->vTitle);
        $this->view->with('vSummary', '新增通知' );
        $this->view->with( 'permission', $this->Permission );

        //////
        //SERVER密鑰  存資料庫
        //送出推播、掛在WEB通知 (Android)
        ///////
        $API_SERVER_ACCESS_KEY = "AAAAMUWvMtg:APA91bEnWZfQmcGGl4aFsHscJqTGVWLgIGDTnDNAzuqyt1vYy_uKgsQjlBSvfm3eAAGI7jGZ1P0GgE8QHdmb-H0imVjwiYGFScen_W9hQqTcbBs5p0OjychEovihcrSxydIkjqdZWlpS";
        $sendNotifyMessageHeaders = '
        {
            "Content-Type":"application/json",
            "Authorization":"key="+"'.$API_SERVER_ACCESS_KEY.'"
        }';
        $this->view->with( 'sendNotifyMessageHeaders', urlencode($sendNotifyMessageHeaders) );
        //////



        return $this->view;
    }


    /*
    *
    */
    public function doAdd ( Request $request )
    {
        try {
            $Dao = new ModMessage();
            $Dao->iType =   ($request->exists('iType')) ? $request->input('iType') : 99;     // type:99 預設message訊息
            $Dao->iSource = ($request->exists('iSource')) ? $request->input('iSource') : 2;
            $Dao->iHead =   ($request->exists('iHead')) ? $request->input('iHead') : 0;
            $Dao->vTitle =  ($request->exists('vTitle')) ? $request->input('vTitle') : "";
            $Dao->vSummary =($request->exists('vSummary')) ? $request->input('vSummary') : "";
            $Dao->vDetail = ($request->exists('vDetail')) ? $request->input('vDetail') : '';
            $Dao->vImages = ($request->exists('vImages')) ? $request->input('vImages') : "";
            $Dao->vNumber = 'MESS'.date('ymd',time()).rand(000, 999);
            $Dao->vReadman = session('member.iId') . ';';     //紀錄哪些使用者讀過
            $Dao->iStartTime =  ($request->exists('iStartTime')) ? $request->input('iStartTime') : time();
            $Dao->iEndTime =    ($request->exists('iEndTime')) ? $request->input('iEndTime') : 0;
            $Dao->iCheck = 0;
            $Dao->iCreateTime = $Dao->iUpdateTime = time();
            $Dao->iStatus = ($request->exists('iStatus')) ? $request->input('iStatus') : 1;
            $Dao->bDel = 0;

            if ($Dao->save()) {
                //Logs
                $this->_saveLogAction($Dao->getTable(), $Dao->iId, 'add', json_encode($Dao , JSON_UNESCAPED_UNICODE) );

                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans('_web_message.add_success');
                $this->rtndata ['rtnurl'] = url('web/' . implode('/', $this->module));


                //************** Android app 端要的資料
                $this->rtndata ['newid'] = $Dao->iId;

                $arr_memberid = SysMember::query()->where('iStatus' , 1)->where('iAcType', '<', $Dao->iHead)->pluck('iId');
                $map['bDel'] = 0;
                $arr_token = ModDeviceToken::query()->where($map)->whereIn('iMemberId', $arr_memberid)->pluck('vToken');

                $this->rtndata ['heads_token'] = $arr_token;
                //**************

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
        $this->_init();
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.add');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode('.', $this->module) . '.edit' => url('web/' . implode('/', $this->module) . "/edit" . $id )
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        $this->view->with('vTitle', $this->vTitle);
        $this->view->with('vSummary', '編輯通知' );
        $this->view->with( 'permission', $this->Permission );

        //////
        //SERVER密鑰  存資料庫
        //送出推播、掛在WEB通知 (Android)
        ///////
        $API_SERVER_ACCESS_KEY = "AAAAMUWvMtg:APA91bEnWZfQmcGGl4aFsHscJqTGVWLgIGDTnDNAzuqyt1vYy_uKgsQjlBSvfm3eAAGI7jGZ1P0GgE8QHdmb-H0imVjwiYGFScen_W9hQqTcbBs5p0OjychEovihcrSxydIkjqdZWlpS";
        $sendNotifyMessageHeaders = '
        {
            "Content-Type":"application/json",
            "Authorization":"key="+"'.$API_SERVER_ACCESS_KEY.'"
        }';
        $this->view->with( 'sendNotifyMessageHeaders', urlencode($sendNotifyMessageHeaders) );
        //////


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
        $Dao->iType = ( $request->exists( 'iType' ) ) ? $request->input( 'iType' ) : $Dao->iType;
        $Dao->iSource = ( $request->exists( 'iSource' ) ) ? $request->input( 'iSource' ) : $Dao->iSource;
        $Dao->iHead = ( $request->exists( 'iHead' ) ) ? $request->input( 'iHead' ) : $Dao->iHead;
        $Dao->vTitle = ( $request->exists( 'vTitle' ) ) ? $request->input( 'vTitle' ) : $Dao->vTitle;
        $Dao->vSummary = ( $request->exists( 'vSummary' ) ) ? $request->input( 'vSummary' ) : $Dao->vSummary;
        $Dao->vDetail = ( $request->exists( 'vDetail' ) ) ? $request->input( 'vDetail' ) : $Dao->vDetail;
        $Dao->vReadman = session('member.iAcType').";";
        $Dao->vImages = ( $request->exists( 'vImages' ) ) ? $request->input( 'vImages' ) : $Dao->vImages;
//        $Dao->vNumber = rand( 1000000001, 1099999999 );
        $Dao->iStartTime = ( $request->exists( 'iStartTime' ) ) ? $request->input( 'iStartTime' ) : $Dao->iStartTime;
        $Dao->iEndTime = ( $request->exists( 'iEndTime' ) ) ? $request->input( 'iEndTime' ) : $Dao->iEndTime;
//        $Dao->iCheck = ( $request->input( 'iCheck' ) ) ? $request->input( 'iCheck' ) : 0;
        $Dao->iUpdateTime = time();

        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode($Dao , JSON_UNESCAPED_UNICODE)  );

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

        if ($request->exists( 'bActive' )) {
            $Dao->bActive = ( $request->input( 'bActive' ) == "change" ) ? !$Dao->bActive : $request->input( 'bActive' );
        }
        if ($request->exists( 'iStatus' )) {
            $Dao->iStatus = ( $request->input( 'iStatus' ) == "change" ) ? !$Dao->iStatus : $request->input( 'iStatus' );
        }
        $Dao->iRank = $request->input( 'iRank' ) ? $request->input( 'iRank' ) : $Dao->iRank ;
        $Dao->iUpdateTime = time();

        if ($Dao->save()) {
            if ($request->exists( 'iStatus' )) {
                $DaoInfo = SysMemberInfo::query()->where('iMemberId' , '=', $Dao->iId)->first();
                $DaoInfo->iMemberId = 0;
                $DaoInfo->save();
            }

            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
            $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode($Dao , JSON_UNESCAPED_UNICODE)  );
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
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'delete', json_encode($Dao , JSON_UNESCAPED_UNICODE)  );

            /* 訊息刪除 連考核表予刪除 */
            $mapTC['bDel'] = 0;
            $DaoTC = ModTraceCheck::query()->where( $mapTC )->where('iSource', '=', $id )->first();
            if ( !$DaoTC) {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.empty_id' );
                return response()->json( $this->rtndata );
            }
            $DaoTC->bDel = 1;
            $DaoTC->iUpdateTime = time();
            $DaoTC->save();

            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.delete_success' );
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
        $this->_init();
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.attr');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode( '.', $this->module ) . '.attributes' => url( 'web/' . implode( '/', $this->module ) . '/attr/' . $id )
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        $this->view->with('vTitle', $this->vTitle);
        $this->view->with('vSummary', '通知中心更多詳細' );
        $this->view->with( 'permission', $this->Permission );

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
                //'網站管理員'
                case 2:
                    $var->iSource = $this->Permission['2'];
                    break;
                //'水庫管理員';
                case 10:
                    $var->iSource = $this->Permission['10'];
                    break;
                case 20:
                    $var->iSource = $this->Permission['20'];
                    break;
                case 30:
                    $var->iSource = $this->Permission['30'];
                    break;
                //'水利署人員';
                case 40:
                    $var->iSource = $this->Permission['40'];
                    break;
                case 50:
                    $var->iSource = $this->Permission['50'];
                    break;
                case 60:
                    $var->iSource = $this->Permission['60'];
                    break;
                default:
                    $var->iSource = 'event';//.$var->iSource
            }
            switch ($var->iType){
                case 99:
                    $var->iType = '訊息';
                    break;
                case 89:
                    $var->iType = '確認訊息';
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
                //'水庫管理員';
                case 10:
                    $var->iCheck = $this->Permission['10'];
                    break;
                case 20:
                    $var->iCheck = $this->Permission['20'];
                    break;
                case 30:
                    $var->iCheck = $this->Permission['30'];
                    break;
                //'水利署人員';
                case 40:
                    $var->iCheck = $this->Permission['40'];
                    break;
                case 50:
                    $var->iCheck = $this->Permission['50'];
                    break;
                case 60:
                    $var->iCheck = $this->Permission['60'];
                    break;
                case 70:
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
        $Dao = ModMessage::query()->where($mapMessage)->where('iType','>', 50)->update(array('bDel'=>1,'iUpdateTime'=>time()));
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        //Logs
        $this->_saveLogAction( 'mod_tracecheck', 9999999999, 'delete', json_encode($Dao , JSON_UNESCAPED_UNICODE)  );

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.delete_success' );

        return response()->json( $this->rtndata );
    }
}
