<?php

namespace App\Http\Controllers\_Web\Record;

use Illuminate\Http\Request;
use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;
use App\ModMessage;
use App\ModTraceCheck;
use App\ModReservoir;
use App\SysMemberAccess;


class TraceController extends _WebController
{

    /*
     *
     */
    function __construct ()
    {
        $this->module = ['record' , 'trace'];
        $this->vTitle = 'Index';
    }


    /*
     * on
     */
    public function index ()
    {
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.index');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '追蹤查核簽核' );

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
        $total_count = ModTraceCheck::query()->where($map)
            ->where(function( $query ) use ( $search_arr, $search_word ) {
                foreach ($search_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            ->count();

        $data_arr = ModTraceCheck::query()->where($map)
            ->where(function( $query ) use ( $search_arr, $search_word ) {
                foreach ($search_arr as $item) {
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
            $var->message = ModMessage::query()->where('bDel','=',0)->find($var->iSource);       //用來源去找是哪個訊息存進來
            if ($var->message) {
                //訊息來源者
                switch ($var->message->iSource) {
                    case 2:
                        $var->message->iSource = $this->Permission['2'];
                        break;
                    case 10:
                        $var->message->iSource = $this->Permission['10'];
                        break;
                    case 20:
                        $var->message->iSource = $this->Permission['20'];
                        break;
                    case 30:
                        $var->message->iSource = $this->Permission['30'];
                        break;
                    case 40:
                        $var->message->iSource = $this->Permission['40'];
                        break;
                    case 50:
                        $var->message->iSource = $this->Permission['50'];
                        break;
                    case 60:
                        $var->message->iSource = $this->Permission['60'];
                        break;
                }
                //訊息狀態種類
                switch ($var->message->iType) {
                    case 99:
                        $var->message->iType = '訊息';
                        break;
                    case 15:
                        $var->message->iType = '已通知';
                        break;
                    case 10:
                        $var->message->iType = '已回報';
                        break;
                    case 5:
                        $var->message->iType = '未回報';
                        break;
                    case 0:
                        $var->message->iType = '已發送';
                        break;
                }
                //
                $var->message->iCreateTime = date( 'Y/m/d H:i:s', $var->message->iCreateTime );
                //傳訊息目標者
                switch ($var->message->iHead) {
                    case 20:
                        $var->message->iHead = '待'.$this->Permission['10'].'確認';
                        break;
                    case 30:
                        $var->message->iHead = '待'.$this->Permission['20'].'確認';
                        break;
                    case 40:
                        $var->message->iHead = '待'.$this->Permission['30'].'確認';
                        break;
                    case 50:
                        $var->message->iHead = '待'.$this->Permission['40'].'確認';
                        break;
                    case 60:
                        $var->message->iHead = '待'.$this->Permission['50'].'確認';
                        break;
                    case 70:
                        $var->message->iHead = '表單已通過全部審核';
                        break;
                }
            } else {
//                unset($data_arr[$key]);
//                continue;
                $var->message = null;
            }
            //
            $var->DT_RowId = $var->iId;
            //
            $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
            $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
            
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
     * on 選擇哪個水庫
     */
    public function add (Request $request)
    {
        //非該權限者，退回
        if (session('member.iAcType')<10 || session('member.iAcType')>19){
            return redirect()->back();
        }

        $this->_init();

        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.add' => url( 'web/' . implode( '/', $this->module ) . "/add" )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', '追蹤查核簽核' );
        $this->view->with( 'vSummary', '蓄水庫與引水建造物安全檢查彙整表 1/3' );

        $map['bDel'] = 0;
        $select = ['iId', 'vName'];
        $Dao = ModReservoir::query()->where($map)->select($select)->get();
        $this->view->with( 'reservoir', $Dao );

        return $this->view;
    }

    /*
     * on 選擇填寫水庫的子項目並記錄喜好
     */
    public function add2 (Request $request)
    {
        //非該權限者，退回
        if (session('member.iAcType')<10 || session('member.iAcType')>19){
            return redirect()->back();
        }

        $this->_init();
        $reservoir_id = $request->get('reservoir') ? $request->get('reservoir') : 0;


        //使用者對水庫的喜好設定
        $map['bOpen'] = 1;
        $map['iMemberId'] = session('member.iId');
        $map['iTargetKey'] = $reservoir_id;       //水庫id
        $DaoSysMemAccess = SysMemberAccess::query()->where($map)->first();
        //已有偏好設定則跳過此步驟
        if ($DaoSysMemAccess)
        {

            $url = url('web/record/trace/add3') . '?reservoir=' . $reservoir_id;
            return redirect($url);

        }
        else
        {

            $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add2' );
            $this->breadcrumb = [
                $this->vTitle => url( 'web' ),
                implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
                implode( '.', $this->module ) . '.add2' => url( 'web/' . implode( '/', $this->module ) . "/add2" )
            ];
            $this->view->with( 'breadcrumb', $this->breadcrumb );
            $this->view->with( 'module', $this->module );
            $this->view->with( 'vTitle', '追蹤查核簽核' );
            $this->view->with( 'vSummary', '蓄水庫與引水建造物安全檢查彙整表 2/3' );
            $this->view->with( 'reservoirId', $reservoir_id );
            $this->view->with( 'TraceTable', $this->TraceTable );
            //
            $reservoir_name = ModReservoir::query()->find($reservoir_id) ->vName;
            $this->view->with( 'reservoir_name', $reservoir_name );

        }

        return $this->view;
    }

    /*
     * on
     */
    public function doAdd2 ( Request $request )
    {
        try {

            $this->_init();
            $TargetKey = ($request->exists('iTargetKey')) ? $request->input('iTargetKey') : 0;

                $map['bOpen'] = 1;
                $map['iTargetKey'] = $TargetKey;
                $Dao = SysMemberAccess::query()->where($map)->first();
                if (!$Dao){
                    $Dao = new SysMemberAccess();
                }

            $Dao->iMemberId = session('member.iId');
            $Dao->iTargetKey = $TargetKey;
            $Dao->iMenuId = ($request->exists('iMenuId')) ? $request->input('iMenuId') : 0;
            $Dao->vDetail = ($request->exists('vDetail')) ? $request->input('vDetail') : '';
            $Dao->iNumber = ($request->exists('iNumber')) ? $request->input('iNumber') : time();
            $Dao->bOpen = ($request->exists('bOpen')) ? $request->input('bOpen') : 1;
            $Dao->bSet = ($request->exists('bSet')) ? $request->input('bSet') : 1;

            if ($Dao->save()) {
                $this->_saveLogAction($Dao->getTable(), $Dao->iId, 'add', json_encode($Dao , JSON_UNESCAPED_UNICODE) );

                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans('_web_message.add_success');
                $this->rtndata ['rtnurl'] = url('web/record/trace/add3') . '?reservoir=' . $Dao->iTargetKey;
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
     * on 選擇哪個水庫
     */
    public function edit_Add (Request $request)
    {
        //非該權限者，退回
        if (/*session('member.iAcType')<10 ||*/ session('member.iAcType')>10){
            return redirect()->back();
        }

        $this->_init();

        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.add' => url( 'web/' . implode( '/', $this->module ) . "/add" )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', '編輯 追蹤查核簽核' );
        $this->view->with( 'vSummary', '蓄水庫與引水建造物安全檢查彙整表 1/3' );

        $map['bDel'] = 0;
        $select = ['iId', 'vName'];
        $Dao = ModReservoir::query()->where($map)->select($select)->get();
        $this->view->with( 'reservoir', $Dao );
        $this->view->with( 'isEdit', 1 );

        return $this->view;
    }

    /*
     * on 修改檢查表的個別水庫偏好設定 (sys_member_access)
     */
    public function edit_Add2 ( Request $request )
    {
            //非該權限者，退回
            if (/*session('member.iAcType')<10 ||*/ session('member.iAcType')>10){
                return redirect()->back();
            }

            $this->_init();
            $reservoir_id = $request->get('reservoir') ? $request->get('reservoir') : 0;


            //編輯使用者對水庫的喜好設定
            $map['bOpen'] = 1;
//            $map['iMemberId'] = session('member.iId');
            $map['iTargetKey'] = $reservoir_id;       //水庫id
            $DaoSysMemAccess = SysMemberAccess::query()->where($map)->first();
            if ($DaoSysMemAccess)
            {
                $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add2' );
                $this->breadcrumb = [
                    $this->vTitle => url( 'web' ),
                    implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
                    implode( '.', $this->module ) . '.add2' => url( 'web/' . implode( '/', $this->module ) . "/add2" )
                ];
                $this->view->with( 'breadcrumb', $this->breadcrumb );
                $this->view->with( 'module', $this->module );
                $this->view->with( 'vTitle', '追蹤查核簽核' );
                $this->view->with( 'vSummary', '蓄水庫與引水建造物安全檢查彙整表 2/3' );
                $this->view->with( 'reservoirId', $reservoir_id );
                $this->view->with( 'TraceTable', $this->TraceTable );
                $this->view->with( 'info', $DaoSysMemAccess );
            }
            //不存在偏好設定則跳過此步驟
            else
            {
                $url = url('web/record/trace') ;
                return redirect($url);
            }

        return $this->view;
    }

    /*
     * on  (sys_member_access)
     */
    public function doSave_Add2 ( Request $request )
    {
        try {

            $this->_init();

            $iTargetKey = ($request->exists('iTargetKey')) ? $request->input('iTargetKey') : 0;

            $map['bOpen'] = 1;
            $map['iTargetKey'] = $iTargetKey;
            $Dao = SysMemberAccess::query()->where($map)->first();

//            $Dao->iMemberId = session('member.iId');
            if ($request->exists('iMenuId')){
                $Dao->iMenuId = $request->input('iMenuId') ;
            }
            if ($request->exists('vDetail')){
                $Dao->vDetail = $request->input('vDetail') ;
            }
//            if ($request->exists('iNumber')){
                $Dao->iNumber = time();//$request->input('iNumber') ;
//            }
            if ($request->exists('bOpen')){
                $Dao->bOpen = $request->input('bOpen') ;
            }
            if ($request->exists('bSet')){
                $Dao->bSet = $request->input('bSet') ;
            }

            if ($Dao->save()) {
                $this->_saveLogAction($Dao->getTable(), $Dao->iId, 'add', json_encode($Dao , JSON_UNESCAPED_UNICODE));

                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans( '_web_message.save_success' );
                $this->rtndata ['rtnurl'] = url('web/record/trace') ;
            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.save_fail' );
            }

        } catch (\Exception $e){
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = $e->getMessage();
        }

        return response()->json( $this->rtndata );
    }

    /*
     * on 正式填表 (安全檢查表根據每個水庫有不同的偏好選項)
     */
    public function add3 (Request $request)
    {
        //非該權限者，退回
        if (session('member.iAcType')<10 || session('member.iAcType')>19){
            return redirect()->back();
        }

        $this->_init();
        $id = $request->get('reservoir') ? $request->get('reservoir') : 0;

        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add3' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.add3' => url( 'web/' . implode( '/', $this->module ) . "/add3" )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', '追蹤查核簽核' );
        $this->view->with( 'vSummary', '蓄水庫與引水建造物安全檢查彙整表 3/3' );


        ///
        ///  /////
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


        //喜好設定的水庫與水庫名
        $select = ['iId', 'vName'];
        $DaoReservoir = ModReservoir::query()->select($select)->find($id);
        $this->view->with( 'reservoir_name', $DaoReservoir? $DaoReservoir->vName : '' );
        $this->view->with( 'reservoir_id', $id );


        $this->view->with( 'TraceTable', json_encode($this->TraceTable) );
        //使用者對水庫的喜好設定
        $mapSysMemAccess['bOpen'] = 1;
        $mapSysMemAccess['iMemberId'] = session('member.iId');
        $mapSysMemAccess['iTargetKey'] = $id;       //水庫id
        $DaoSysMemAccess = SysMemberAccess::query()->where($mapSysMemAccess)->first();
        if ($DaoSysMemAccess)
            $this->view->with( 'memberAccess', $DaoSysMemAccess );

        return $this->view;
    }

    /*
    * on  (mod_tracecheck)
    */
    public function doAdd3 ( Request $request )
    {
        $this->_init();

        try {
            $reservoir_name = ($request->exists('reservoir')) ? $request->input('reservoir') : '';

            $Dao = new ModTraceCheck();     //追蹤查核表
//        $Dao->iParentId = 0;
//        $Dao->iRank = null; //$maxRank + 1;
//        $Dao->iCategoryType = 0;
            $Dao->iType = ($request->exists('iType')) ? $request->input('iType') : 99;
            $Dao->iSource = ($request->exists('iSource')) ? $request->input('iSource') : 0;
            $Dao->iHead = ($request->exists('reservoirId')) ? $request->input('reservoirId') : '';       //目標者放水庫id
//            $Dao->vTitle = ($request->exists('vTitle')) ? $request->input('vTitle') : "";
//            $Dao->vSummary = ($request->exists('vSummary')) ? $request->input('vSummary') : "";
            $Dao->vDetail = ($request->exists('vDetail')) ? $request->input('vDetail') : '';     //json
//        $Dao->vUrl = ( $request->exists( 'vUrl' ) ) ? $request->input( 'vUrl' ) : "";
            $Dao->vImages = ($request->exists('vImages')) ? $request->input('vImages') : "";
            $Dao->vNumber = rand(1000000001, 1099999999);
//            $Dao->iStartTime = ($request->exists('iStartTime')) ? $request->input('iStartTime') : time();
//            $Dao->iEndTime = ($request->exists('iEndTime')) ? $request->input('iEndTime') : 0;
            $Dao->iCheck = 10;
            $Dao->iCreateTime = $Dao->iUpdateTime = time();
            $Dao->iStatus = ($request->exists('iStatus')) ? $request->input('iStatus') : 1;
            $Dao->bDel = 0;

            if ($Dao->save()) {
                $this->_saveLogAction($Dao->getTable(), $Dao->iId, 'add', json_encode($Dao , JSON_UNESCAPED_UNICODE) );

                //************************************************************************
                    $message = '發送給 ' . $this->Permission['20'];
                    $vSummary = '<h5>待'.$this->Permission['20'].'確認</h5>';


                    $DaoMessage = new ModMessage();
                    $DaoMessage->iType = 89;     // type:89 蓄水庫與引水建造物安全檢查彙整表
                    $DaoMessage->iSource = 10;
                    $DaoMessage->iHead = 30;    //目標人員權限小於20
                    $DaoMessage->vTitle = date('Y',time()).'年'.$reservoir_name.'上半年度安全檢查表';//蓄水庫與引水建造物安全檢查彙整表';
                    $DaoMessage->vSummary = '<h5>'.$vSummary.'</h5>';
                    //$DaoMessage->vSummary .= $vSummary;// . $this->Permission['20'];
                    $DaoMessage->vDetail = ''.url('web/record/trace/attributes'). '/'. $Dao->iId;
                    $DaoMessage->vImages = env('APP_URL') . '/images/favicon.png';
                    $DaoMessage->vNumber = 'TRACE'.date('ymd',time()).rand(000, 999);
                    $DaoMessage->vReadman = session('member.iId') . ';';     //紀錄哪些使用者讀過
    //                $DaoMessage->iStartTime = time();
    //                $DaoMessage->iEndTime = time() + (60 * 30);   //30分鐘後
                    $DaoMessage->iCheck = 10;    //目標人員是否確認
                    $DaoMessage->iCreateTime = time();
                    $DaoMessage->iUpdateTime = time();
                    $DaoMessage->iStatus = 1;
                    $DaoMessage->bDel = 0;
                    $DaoMessage->save();

                    $Dao->iSource = $DaoMessage->iId;
                    $Dao->save();
                //************************************************************************

                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = $message;
                $this->rtndata ['rtnurl'] = url('web/' . implode('/', $this->module));
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
     * on
     */
    public function edit ( Request $request , $id )
    {
        if (session('member.iAcType')<10 || session('member.iAcType')>19){
            return redirect()->back();
        }

        //預設，產出基本設定值
        $this->_init();
        $reservoir_id = $request->get('reservoir') ? $request->get('reservoir') : 0;

        $this->view = View()->make('_web.' . implode('.', $this->module) . '.add3');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode('.', $this->module) . '.edit' => url('web/' . implode('/', $this->module) . "/edit" . $id )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '蓄水庫與引水建造物安全檢查彙整表' );


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
        $Dao = ModTraceCheck::query()->where($map)->find($id);
        if ($Dao) {
            //
            $Dao->iCheck_message = 10; //預設值: 只有第一線(權限:10)確認過訊息
            $Dao->message = ModMessage::query()->find($Dao->iSource);       //用來源去找是哪個訊息存進來
            if($Dao->message) {
                $Dao->message->iCreateTime = date('Y/m/d H:i:s', $Dao->message->iCreateTime);
                $Dao->message->iUpdateTime = date('Y/m/d H:i:s', $Dao->message->iUpdateTime);
                //誰已check過訊息?
                $Dao->iCheck_message = $Dao->message->iCheck;
            }
            //
            $this->view->with( 'info', $Dao );
        }



        //使用者對水庫的喜好設定
        $mapSysMemAccess['bOpen'] = 1;
        $mapSysMemAccess['iMemberId'] = session('member.iId');
        $mapSysMemAccess['iTargetKey'] = ($Dao && $Dao->iHead)? $Dao->iHead : $reservoir_id;       //水庫id
        $DaoSysMemAccess = SysMemberAccess::query()->where($mapSysMemAccess)->first();
        if ($DaoSysMemAccess)
        {
            //顯示水庫對應的檢查表大項目
                $this->view->with( 'TraceTable', json_encode($this->TraceTable) );
                $this->view->with( 'memberAccess', $DaoSysMemAccess );

                $Dao = ModReservoir::query()->find($mapSysMemAccess['iTargetKey']);
                $this->view->with( 'reservoir_name', $Dao? $Dao->vName : '' );
                $this->view->with( 'reservoir_id', $id );
        }
        else
        {
            //沒有偏好，回到檢查表的水庫偏好設定..
                $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add2' );
                $this->breadcrumb = [
                    $this->vTitle => url( 'web' ),
                    implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
                    implode( '.', $this->module ) . '.add2' => url( 'web/' . implode( '/', $this->module ) . "/add2" )
                ];
                $this->view->with( 'breadcrumb', $this->breadcrumb );
                $this->view->with( 'module', $this->module );
                $this->view->with( 'vTitle', '追蹤查核簽核' );
                $this->view->with( 'vSummary', '蓄水庫與引水建造物安全檢查彙整表 2/3' );
                $this->view->with( 'reservoirId', $mapSysMemAccess['iTargetKey'] );
                $this->view->with( 'TraceTable', json_encode($this->TraceTable) );
                $this->view->with( 'fromUrl', url()->current(). '?reservoir=' . $mapSysMemAccess['iTargetKey'] );

        }

        return $this->view;
    }


    /*
     * on 檢查表審核過  紀錄並傳送給下一階級
     */
    public function doSave ( Request $request )
    {
        //************************************************************************
        $this->_init();
        //送審退回
        $doRefuse = $request->exists( 'refuse')? $request->input( 'refuse') : false;

        $id = $request->input( 'iId', 0 );

        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $Dao = ModMessage::query()->where( 'iType', '=', 89)->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        if (!$doRefuse) {
            switch (session('member.iAcType')) {
                case 10:
                    $message = '發送給 ' . $this->Permission['20'];
                    $vSummary = '待'.$this->Permission['20'].'確認';
                    break;
                case 20:
                    $message = '發送給 ' . $this->Permission['30'];
                    $vSummary = '待'.$this->Permission['30'].'確認';
                    break;
                case 30:
                    $message = '發送給 ' . $this->Permission['40'];
                    $vSummary = '待'.$this->Permission['40'].'確認';
                    break;
                case 40:
                    $message = '發送給 ' . $this->Permission['50'];
                    $vSummary = '待'.$this->Permission['50'].'確認';
                    break;
                case 50:
                    $message = '發送給 ' . $this->Permission['60'];
                    $vSummary = '待'.$this->Permission['60'].'確認';
                    break;
                case 60:
//                    $message = '發送給 ' . $this->Permission['70'];
                    $message = '表單已通過全部審核';
                    $vSummary = '表單已通過全部審核';
                    break;
            }
        } else {
            switch (session('member.iAcType')) {
                case 10:
                    $message = '表單重新填寫';
                    $vSummary = '表單重新填寫';
                    $Dao->vReadman = '';
                    break;
                case 20:
                    $message = '退還給 ' . $this->Permission['10'];
                    $vSummary = '拒絕表單，請'.$this->Permission['10'].'重新審核';
                    $Dao->vReadman = '';
                    break;
                case 30:
                    $message = '退還給 ' . $this->Permission['20'];
                    $vSummary = '拒絕表單，請'.$this->Permission['20'].'重新審核';
                    $Dao->vReadman = '';
                    break;
                case 40:
                    $message = '退還給 ' . $this->Permission['30'];
                    $vSummary = '拒絕表單，請'.$this->Permission['30'].'重新審核';
                    $Dao->vReadman = '';
                    break;
                case 50:
                    $message = '退還給 ' . $this->Permission['40'];
                    $vSummary = '拒絕表單，請'.$this->Permission['40'].'重新審核';
                    $Dao->vReadman = '';
                    break;
                case 60:
                    $message = '退還給 ' . $this->Permission['50'];
                    $vSummary = '拒絕表單，請'.$this->Permission['50'].'重新審核';
                    $Dao->vReadman = '';
                    break;
            }
        }

        //************************************************************************
        if (!$doRefuse)
        {
            //重新編寫訊息概要
            $Dao->vSummary = '<h5>'.$vSummary.'</h5>';
            //$Dao->vSummary .= $vSummary;// . $this->Permission['20'];
            $Dao->iCheck += 10; //有確認的目標權限人員
            $Dao->iHead += 10;  //目標人員權限再加10
            $Dao->iStartTime = time();
            if ($Dao->save()) {
                //Logs
                $this->_saveLogAction($Dao->getTable(), $Dao->iId, 'edit', json_encode($Dao , JSON_UNESCAPED_UNICODE) );

                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = $message;
                $this->rtndata ['rtnurl'] = url('web/' . implode('/', $this->module));

            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = '發送確認失敗';
            }
        }
        else
        {
            //重新編寫訊息概要
            $Dao->vSummary = '<h5>'.$vSummary.'</h5>';
            //$Dao->vSummary .= $vSummary;// . $this->Permission['20'];
            $Dao->iCheck -= 10; //有確認的目標權限人員
            $Dao->iHead -= 10;  //目標人員權限再加10
            $Dao->iStartTime = time();
            if ($Dao->save()) {
                //Logs
                $this->_saveLogAction($Dao->getTable(), $Dao->iId, 'edit', json_encode($Dao , JSON_UNESCAPED_UNICODE) );

                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = $message;
                $this->rtndata ['rtnurl'] = url('web/' . implode('/', $this->module));

            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = '發送退回失敗';
            }
        }
        //**********************************************************************

        return response()->json( $this->rtndata );
    }


    /*
     * on 審查人員修改內容
     */
    public function doSave2 ( Request $request )
    {
        //************************************************************************
        $id = $request->input( 'iId', 0 );      //trace_id
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $Dao = ModTraceCheck::query()->where( 'iSource', '<>', 0)->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        $this->_init();
        $reservoir_name = ($request->exists('reservoir')) ? $request->input('reservoir') : '';

        //************************************************************************
        //重新編寫審查表
        $Dao->vDetail = $request->input('vDetail') ? $request->input('vDetail') : '';
        $Dao->iUpdateTime = time();

        if ($Dao->save()) {

            $DaoMessage = ModMessage::query()->where('bDel','=',0)->find($Dao->iSource);
            //************************************************************************
                $message = '發送給 ' . $this->Permission['20'];
                $vSummary = '<h5>待'.$this->Permission['20'].'確認</h5>';


    //            $DaoMessage = new ModMessage();
                $DaoMessage->iType = 89;     // type:89 蓄水庫與引水建造物安全檢查彙整表
                $DaoMessage->iSource = 10;
                $DaoMessage->iHead = 30;    //目標人員權限小於20
                $DaoMessage->vTitle = date('Y',time()).'年'.$reservoir_name.'上半年度安全檢查表';//蓄水庫與引水建造物安全檢查彙整表';
                $DaoMessage->vSummary = '<h5>'.$vSummary.'</h5>';
                //$DaoMessage->vSummary .= $vSummary;// . $this->Permission['20'];
                $DaoMessage->vDetail = ''.url('web/record/trace/attributes'). '/'. $Dao->iId;
                $DaoMessage->vImages = env('APP_URL') . '/images/favicon.png';
                $DaoMessage->vNumber = 'TRACE'.date('ymd',time()).rand(000, 999);
                $DaoMessage->vReadman = session('member.iId') . ';';     //紀錄哪些使用者讀過
                //                $DaoMessage->iStartTime = time();
                //                $DaoMessage->iEndTime = time() + (60 * 30);   //30分鐘後
                $DaoMessage->iCheck = 10;    //目標人員是否確認
                $DaoMessage->iCreateTime = time();
                $DaoMessage->iUpdateTime = time();
                $DaoMessage->iStatus = 1;
                $DaoMessage->bDel = 0;
                $DaoMessage->save();

    //            $Dao->iSource = $DaoMessage->iId;
    //            $Dao->save();
            //************************************************************************


            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = trans( '_web_message.save_success' );
            $this->rtndata ['rtnurl'] = url('web/' . implode('/', $this->module));
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );

        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }
        //**********************************************************************

        return response()->json( $this->rtndata );
    }

    /*
     * on
     */
    public function doDel ( Request $request )
    {
        $id = $request->input( 'iId', 0 );
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        $map['bDel'] = 0;
        $Dao = ModTraceCheck::query()->where( $map )->find( $id );
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
     * on
     */
    public function attributes (Request $request , $id)
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
        $this->view->with( 'vTitle', $this->vTitle );
        $this->view->with( 'vSummary', '審核檢查表' );


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


        //
//        $mapMessage['iStatus'] = 1;
        $map['bDel'] = 0;
        $Dao = ModTraceCheck::query()->where($map)->find($id);
        if ($Dao){
            //
            $Dao->iCheck_message = 10; //預設值: 只有第一線(權限:10)確認過訊息
            $Dao->message = ModMessage::query()->find($Dao->iSource);       //用來源去找是哪個訊息存進來
            if($Dao->message) {
                $Dao->message->iCreateTime = date('Y/m/d H:i:s', $Dao->message->iCreateTime);
                $Dao->message->iUpdateTime = date('Y/m/d H:i:s', $Dao->message->iUpdateTime);
                $Dao->iCheck_message = $Dao->message->iCheck;
            }
            //
            $this->view->with( 'info', $Dao );
        }



        //使用者對水庫的喜好設定
        $mapSysMemAccess['bOpen'] = 1;
        $mapSysMemAccess['iMemberId'] = session('member.iId');
        $mapSysMemAccess['iTargetKey'] = ($Dao && $Dao->iHead)? $Dao->iHead : 0;       //水庫id
        $DaoSysMemAccess = SysMemberAccess::query()->where($mapSysMemAccess)->first();
        if ($DaoSysMemAccess)
        {
            //顯示水庫對應的檢查表大項目
            $this->view->with( 'TraceTable', json_encode($this->TraceTable) );
            $this->view->with( 'memberAccess', $DaoSysMemAccess );

            $Dao = ModReservoir::query()->find($mapSysMemAccess['iTargetKey']);
            $this->view->with( 'reservoir_name', $Dao? $Dao->vName : '' );
            $this->view->with( 'reservoir_id', $id );
        }

        return $this->view;
    }


    /*
     * on Super Do
     */
    public function doDelAll ( Request $request )
    {
        if ( session('member.iAcType' , 0) != 1) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        $mapMessage['bDel'] = 0;
        $Dao = ModTraceCheck::query()->where($mapMessage)->update(array('bDel'=>1,'iUpdateTime'=>time()));
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        //Logs
        $this->_saveLogAction( 'mod_tracecheck', 9999999999, 'delete', json_encode( $Dao ) );

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.delete_success' );

        return response()->json( $this->rtndata );
    }
}
