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
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . 'index' );
        //
        $this->breadcrumb = [
            implode( '.', $this->module ) => url( 'web/' . implode( '/', $this->module ) )
        ];
        $this->view->with( 'breadcrumb', $this->breadcrumb );
        $this->view->with( 'module', $this->module );
        $DaoMessage = $this->getDaoMessage();
        if ($DaoMessage){
            $this->view->with( 'message', $DaoMessage );
            $this->view->with( 'message_total', $DaoMessage->count() );
        }
        session()->put( 'SEO.vTitle' , $this->vTitle );

        return $this->view;
    }

    /*
     *
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
                $DaoMessage->iSource = $var->keyValue;
                $DaoMessage->iHead = 20;    //目標人員權限小於20
                $DaoMessage->vTitle = '有地震通知: ' . $oneReservoir->vName . '';
                $DaoMessage->vSummary = '<h5>發生時間: ' . date( 'Y/m/d H:i:s',(strtotime($var->eventTime) + 28800)) . '</h5>' ;
                $DaoMessage->vSummary .= '待確認後發送給水庫審查人員';
//            $DaoMessage->vDetail = '有地震通知';
//                $DaoMessage->vUrl = url('web/message/attr') . '/' . (ModMessage::query()->max('iId') + 1);
//                $DaoMessage->vImages = env('APP_URL') . '/images/favicon.png';
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
     *
     */
    public function getMessageList ()
    {
        $DaoMessage = $this->getDaoMessage();
        if ($DaoMessage){
            foreach ($DaoMessage as $var){
                $var->url = url('web/message/attr') . '/' . $var->iId;
            }
            $this->rtndata ['status'] = 1;
            $this->rtndata ['aaData'] = $DaoMessage ? $DaoMessage : [];
            $this->rtndata ['total'] = $DaoMessage->count();
        }
        else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = 'message no get from 404';
        }

        return $this->rtndata;
    }


    /*
     *
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
     *
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
}
