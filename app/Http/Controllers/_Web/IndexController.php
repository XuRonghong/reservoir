<?php

namespace App\Http\Controllers\_Web;

use Illuminate\Http\Request;
use App\SysMember;
use App\SysMemberInfo;
use App\SysGroupMember;
use Jenssegers\Agent\Agent;
use App\ModEvent;
use App\ModMessage;
use App\ModReservoirMeta;
use App\ModReservoir;
use App\Http\Controllers\FuncController;
use PHPUnit\Exception;


class IndexController extends _WebController
{

    /*
     *
     */
    function __construct ()
    {
        $this->module = [  ];
    }


    /*
     *
     */
    public function index ()
    {
        $this->module = [];
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . 'index' );
        //
        $this->breadcrumb = [
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        //
        $DaoMessage = $this->getDaoMessage();
        if ($DaoMessage){
            $this->view->with( 'message', $DaoMessage );
            $this->view->with( 'message_total', $this->message_total );
            $this->view->with( 'comment_total', $this->comment_total );
        }
        session()->put( 'SEO.vTitle' , $this->vTitle );

        return $this->view;
    }

    /*
     * ajax to upbar comment add
     * 有新的地震資訊，加入訊息通知
     */
    public function addMessage ()
    {
        //目前的最新地震事件
        $DaoEvent = ModEvent::query()
//            ->where('eventTime', '>=',date("Y-m-d H:i:s",time()-32400))   //北美中部時區的時差-8小時
            ->orderBy('eventTime', 'DESC')
            ->take(45)
            ->get();
        //所有的水庫管理員
//        $DaoMember = SysMember::query()->where('iAcType','=','10')->get();
        //
//        foreach ($DaoMember as $item) {
            foreach ($DaoEvent as $var) {
                //訊息已存在編號，不新增訊息
                $map['bDel'] = 0;
                $map['iSource'] = $var->keyValue;
                if (ModMessage::query()->where($map)->first()){
                    continue;
                }
                //有發生地震的水庫詳細資料
                $oneReservoirMeta = ModReservoirMeta::query()->where('vNumber','=', $var->id)->first();
                $oneReservoir = ModReservoir::query()->where('vName', 'LIKE', '%'.$oneReservoirMeta->vStructure.'%')->first();
                //新增對應人員通知訊息
                $DaoMessage = new ModMessage();
                $DaoMessage->iType = 0;     //已通知(15)、已回報(10)、未回報(5)
                $DaoMessage->iSource = $var->keyValue;
                $DaoMessage->iHead = 20;    //目標人員權限小於20
                $DaoMessage->vTitle = '有地震通知: ' . $oneReservoir->vName . '';
                $DaoMessage->vSummary = '<h5>發生時間: ' . date( 'Y/m/d H:i:s',(strtotime($var->eventTime) + 28800)) . '</h5>' ;
                $DaoMessage->vSummary .= '待確認後發送給水庫審查人員';
//            $DaoMessage->vDetail = '有地震通知';
//                $DaoMessage->vReadman = ';
                $DaoMessage->vImages = env('APP_URL') . '/images/favicon.png';
//                $DaoMessage->vNumber = 'ME' . rand(00000001, 99999999);
//                $DaoMessage->iStartTime = time();
//                $DaoMessage->iEndTime = time() + (60 * 30);   //30分鐘後
                $DaoMessage->iCheck = 0;    //目標人員是否確認
                $DaoMessage->iCreateTime = time();
                $DaoMessage->iUpdateTime = time();
                $DaoMessage->iStatus = 1;
                $DaoMessage->bDel = 0;
                $DaoMessage->save();
            }
//        }

        $this->rtndata ['status'] = 1;
        return $this->rtndata;
    }

    /*
     * ajax to upbar message add
     * 觸發click後 標示訊息已讀 創立該訊息已讀紀錄
     */
    public function doSaveMessage ()
    {
        //系統的訊息通知
        $DaoMessage = ModMessage::query()->where('iType', '=', 99)->get();

        foreach ($DaoMessage as $var) {
            //訊息已讀過存入使用者id，現在解析該欄位的已讀使用者
            $tmp_arr = explode( ';', $var->vReadman );      // Array <-- String
            //存在陣列裡標示有讀訊息了
            if ( in_array( session('member.iId'), $tmp_arr )) {
                continue;
            }
            //新增對應員通知訊息
            $var->vReadman .= session('member.iId') . ';';
            $var->save();
        }
        $this->rtndata ['status'] = 1;
        return $this->rtndata;
    }

    /*
     * ajax to upbar comment get
     * 主要是針對地震資料表所顯示的地震通知
     */
    public function getCommentList ()
    {
        //撈取訊息資料表
        $DaoMessage = $this->getDaoMessage();
        if ($DaoMessage){
            //
            $Dao = [];
            foreach ($DaoMessage as $var){
                //訊息連結
                $var->url = url('web/message/attr') . '/' . $var->iId;
                //主要分 系統訊息 與 地震通知 種類
                if ($var->iType < 50){
                    $Dao[] = $var;      //物件的重新組合
                }
                //圖片處理,假如NULL給他個預設值
                if ( !$var->vImages){
                    $var->vImages = env('APP_URL') . '/images/favicon.png';
                }
            }
            //
            $this->rtndata ['status'] = 1;
            $this->rtndata ['aaData'] = $Dao ? $Dao : [];
            $this->rtndata ['total'] = $this->comment_total;    //通知的數量
        }
        else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'message no get from 404';
        }

        return $this->rtndata;
    }

    /*
     * ajax to upbar message get
     * 主要是網站管理員或是系統新增的訊息通知
     */
    public function getMessageList ()
    {
        $DaoMessage = $this->getDaoMessage();
        if ($DaoMessage){
            //
            $Dao = [];
            $message_total = 0;         //重新計算訊息數量
            foreach ($DaoMessage as $var){
                //
                $var->url = url('web/message/center/attr') . '/' . $var->iId;
                //主要分 系統訊息 與 地震通知 種類
                if ($var->iType < 50){

                } else {
                    //若該使用者有點擊訊息，則紀錄為已讀訊息
                    $tmp_arr = explode( ';', $var->vReadman );
                    if ( !in_array( session('member.iId'), $tmp_arr )) {
                        $message_total ++;
                    }
                    $Dao[] = $var;      //物件的重新組合
                }
                //圖片處理,假如NULL給他個預設值
                if ( !$var->vImages){
                    $var->vImages = env('APP_URL') . '/images/favicon.png';
                }
            }
            //
            $this->rtndata ['status'] = 1;
            $this->rtndata ['aaData'] = $Dao ? $Dao : [];
            $this->rtndata ['total_see'] = $message_total;      //未讀訊息的數量
            $this->rtndata ['total'] = $this->message_total;    //訊息的數量
        }
        else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'message no get from 404';
        }

        return $this->rtndata;
    }


    /*
     * 新建 Source code
     */
    public function shakemap2 ()
    {
        $this->module = [ 'shakemap2' ];
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '' );
        //
        $this->breadcrumb = [
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $info['id'] = 'xxxxxxxx';
        $info['date'] = date('Y') . '年' . date('m') . '月' . date('d') . '日';
        $info['time'] = date('H') . '時' . date('m') . '分' . date('s') . '秒';
        $this->view->with( 'info', $info );
        session()->put( 'SEO.vTitle' , $this->vTitle );

        return $this->view;
    }

    /*
     * 柏源 Source code
     */
    public function shakemap ()
    {
        $this->module = [ 'shakemap' ];
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '' );
        //
        $this->breadcrumb = [
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        session()->put( 'SEO.vTitle' , $this->vTitle );

        return $this->view;
    }


    /***********************************************************
     * @return \Illuminate\Contracts\View\View
     *  地震Event的相關功能代碼
     *
     ************************************************************/

    /*
     * Event View
     */
    public function eventView ()
    {
        $this->module = [ 'event' ];
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.index' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        session()->put( 'SEO.vTitle' , '地震Event' );

        return $this->view;
    }

    /*
     * 所有Event ajax
     */
    public function getEventList ( Request $request )
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


//        $map['event.bDel'] = 0;
        $total_count = ModEvent::query()//->where( $map )
            ->join( 'mod_reservoir_meta', function ($join) {
                $join->on('event.id', '=', 'mod_reservoir_meta.vNumber');
            })
            ->where(function( $query ) use ( $sort_arr, $search_word ) {
                foreach ($sort_arr as $item) {
                    $query->orWhere( $item, 'like', '%' . $search_word . '%' );
                }
            })
            ->count();

        $data_arr = ModEvent::query()//->where( $map )
            ->join( 'mod_reservoir_meta', function ($join) {
                $join->on('event.id', '=', 'mod_reservoir_meta.vNumber');
            })
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
            $var->eventTime = date( 'Y/m/d H:i:s', (strtotime($var->eventTime) + 28800) );
            $var->reservoir = ModReservoir::query()->where('vName', 'LIKE', '%'.$var->vStructure.'%')->first()['vName'];

            //圖片
//            $image_arr = [];
//            $tmp_arr = explode( ';', $var->vImages );
//            $tmp_arr = array_filter( $tmp_arr );
//            foreach ($tmp_arr as $item) {
//                $image_arr[] = FuncController::_getFilePathById( $item );
//            }
//            if ($tmp_arr){
//                $var->vImages = $image_arr;
//            } else {
//                $var->vImages = [];
//            }
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['sEcho'] = $sEcho;
        $this->rtndata ['iTotalDisplayRecords'] = $total_count;
        $this->rtndata ['iTotalRecords'] = $total_count;
        $this->rtndata ['aaData'] = $total_count ? $data_arr : [];

        return response()->json( $this->rtndata );
    }

    /*
     * Event add
     */
    public function addEvent ()
    {
        $this->module = [ 'event' ];
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.add' );
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.add' => url( 'web/' . implode( '/', $this->module ) . "/add" )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        session()->put( 'SEO.vTitle' , 'Event add' );

        return $this->view;
    }

    /*
     *
     */
    public function doAddEvent ( Request $request )
    {
        $Dao = new ModEvent();
//        $Dao->iCreateTime = $Dao->iUpdateTime = time();
//        $Dao->iStatus = ( $request->input( 'iStatus' ) ) ? $request->input( 'iStatus' ) : 1;
//        $Dao->bDel = 0;
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
    public function editEvent ( $id )
    {
        $this->module = [ 'event' ];
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.add');

        $this->breadcrumb = [
            $this->module[0] => "#",
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode('.', $this->module) . '.edit' => url('web/' . implode('/', $this->module) . "/edit")
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);



        $map['mod_reservoir_meta.bDel'] = 0;
        $Dao = ModEvent::query()->where($map)
            ->Join( 'mod_reservoir_meta', function ($join) {
                $join->on('event.id', '=', 'mod_reservoir_meta.vNumber');
            })
            ->find( $id );
        if ($Dao) {
            //圖片
//            $image_arr = [];
//            $tmp_arr = explode( ';', $Dao->vImages );
//            $tmp_arr = array_filter( $tmp_arr );
//            foreach ($tmp_arr as $item) {
//                $image_arr[$item] = FuncController::_getFilePathById( $item );
//            }
//            if ($tmp_arr){
//                $Dao->vImages = $image_arr;
//            } else {
//                $Dao->vImages = [];
//            }
        }
        //
        $this->view->with( 'info', $Dao );

        return $this->view;
    }

    /*
     *
     */
    public function doSaveEvent ( Request $request )
    {
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $map['mod_reservoir_meta.bDel'] = 0;
        $Dao = ModEvent::query()->where($map)
            ->Join( 'mod_reservoir_meta', function ($join) {
                $join->on('event.id', '=', 'mod_reservoir_meta.vNumber');
            })
            ->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

//        if ($request->input( 'iStatus' )) {
//            $Dao->iStatus = ( $request->input( 'iStatus' ) == "change" ) ? !$Dao->iStatus : $request->input( 'iStatus' );
//        }
        $Dao->iUpdateTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );

            //有發生地震的水庫詳細資料
            $Dao->reservoir = ModReservoir::query()->where('vName', 'LIKE', '%'.$Dao->vStructure.'%')->first();

        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.save_fail' );
        }

        return response()->json( $this->rtndata );
    }

    /*
    *
    */
    public function doSaveShowEvent ( Request $request )
    {
        $id = $request->input( 'iId', 0 );
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $map['mod_reservoir_meta.bDel'] = 0;
        $Dao = ModEvent::query()->where($map)
            ->Join( 'mod_reservoir_meta', function ($join) {
                $join->on('event.id', '=', 'mod_reservoir_meta.vNumber');
            })
            ->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
//        if ($request->exists( 'iStatus' )) {
//            $Dao->iStatus = ( $request->input( 'iStatus' ) == "change" ) ? !$Dao->iStatus : $request->input( 'iStatus' );
//        }
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
    public function doDelEvent ( Request $request )
    {
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $map['mod_reservoir_meta.bDel'] = 0;
        $Dao = ModEvent::query()->where($map)
            ->Join( 'mod_reservoir_meta', function ($join) {
                $join->on('event.id', '=', 'mod_reservoir_meta.vNumber');
            })
            ->find( $id );
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
    function attrEvent ( $id )
    {
        $this->module = [ 'event' ];
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '.attr' );

        $this->breadcrumb = [
            $this->module[0] => "#",
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) ),
            implode( '.', $this->module ) . '.attributes' => url( 'web/' . implode( '/', $this->module ) . '/attributes' )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );


        $map['bDel'] = 0;
        $Dao = ModEvent::query()->where($map)
            ->Join( 'mod_reservoir_meta', function ($join) {
                $join->on('event.id', '=', 'mod_reservoir_meta.vNumber');
            })
            ->find( $id );
        if ($Dao) {
            //PGA轉換震度
            if($Dao->PGA<=0.8){
                $Dao->shake="O 級地震";
            }else if($Dao->PGA<=2.5){
                $Dao->shake="一級地震";
            }else if($Dao->PGA<=8.0){
                $Dao->shake="二級地震";
            }else if($Dao->PGA<=25){
                $Dao->shake="三級地震";
            }else if($Dao->PGA<=80){
                $Dao->shake="四級地震";
            }else if($Dao->PGA<=250){
                $Dao->shake="五級地震";
            }else if($Dao->PGA<=400){
                $Dao->shake="六級地震";
            }else{
                $Dao->shake="七級地震";
            }
            //
            $this->view->with( 'info', $Dao );

            $map['bDel'] = 0;
            $oneReservoir = ModReservoir::query()->where($map)->where('vName', 'LIKE', '%'.$Dao->vStructure.'%')->first();
            $this->view->with( 'attributes', $oneReservoir );
        }

        return $this->view;
    }

    /*
     *
     */
    function doSaveAttributes ( Request $request )
    {
        $id = $request->input( 'iId', 0 );
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }

        $map['mod_reservoir_meta.bDel'] = 0;
        $Dao = ModEvent::query()->where($map)
            ->Join( 'mod_reservoir_meta', function ($join) {
                $join->on('event.id', '=', 'mod_reservoir_meta.vNumber');
            })
            ->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $tmp_arr = $request->input( 'attr', [] );
        foreach ($tmp_arr as $key => $var) {
            $map['bDel'] = 0;
            $oneReservoir = ModReservoir::query()->where($map)->where('vName', 'LIKE', '%'.$Dao->vStructure.'%')->first();
            $oneReservoir->iUpdateTime = time();
            if ( $oneReservoir->save() ) {
                //Logs
                $this->_saveLogAction( $oneReservoir->getTable(), $oneReservoir->iId, 'edit', json_encode( $oneReservoir ) );
            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.save_fail' );
                return response()->json( $this->rtndata );
            }
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.save_success' );
        $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );

        return response()->json( $this->rtndata );
    }
}
