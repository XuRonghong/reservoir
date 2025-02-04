<?php

namespace App\Http\Controllers\_Web\Message;

use Illuminate\Http\Request;
use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;
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
        $this->module = [ 'message' ];
        $this->vTitle = 'Index';
    }


    /*
     *
     */
    public function index ()
    {
        $this->_init();
//        $this->module = [ 'member'  ];
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.index');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        $this->view->with('vTitle', $this->vTitle);
        $this->view->with('vSummary', '訊息' );
        $this->view->with( 'permission', $this->Permission );

        //
        $DaoMessage = $this->getDaoMessage( false);
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
        $this->view->with( 'info', $Dao ? $Dao : [] );
        $this->view->with( 'total',$this->comment_total );

        return $this->view;
    }


    /*
     * 發送地震通知後，相關人員確認後傳送下一位
     */
    public function doSave ( Request $request )
    {
        $this->_init();
        $id = $request->input( 'iId', 0 );
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        $Dao = ModMessage::query()->join('event', 'iSource', '=', 'keyValue')->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        switch (session('member.iAcType')){
            case 10:
                $message = '發送給 ' . $this->Permission['20'];
                break;
            case 20:
                $message = '發送給 ' . $this->Permission['30'];
                break;
            case 30:
                $message = '發送給 ' . $this->Permission['40'];
                break;
            case 40:
                $message = '發送給 ' . $this->Permission['50'];
                break;
            case 50:
                $message = '發送給 ' . $this->Permission['60'];
                break;
            case 60:
//                $message = '發送給 ' . $this->Permission['70'];
                $message = '全部已確認';
                break;
        }

        //重新編寫訊息概要
        $Dao->vSummary = '<h5>發生時間: ' . date( 'Y/m/d H:i:s',(strtotime($Dao->eventTime) + 28800)) . '</h5>' ;
//        $Dao->vSummary .= '待確認後' . $message;
        $Dao->iCheck += 10; //有確認的目標權限人員
        $Dao->iHead += 10;  //目標人員權限再加10
        $Dao->iStartTime = time();
        if ($Dao->save()) {
            //Logs
            $this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode($Dao , JSON_UNESCAPED_UNICODE)  );

            //所有的水庫審查員
//            $DaoMember = SysMember::query()->where('iAcType','=','20')->get();

            $this->rtndata ['status'] = 1;
            $this->rtndata ['message'] = $message;
//            $this->rtndata ['rtnurl'] = url( 'web/' . implode( '/', $this->module ) );
        } else {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = '發送確認失敗';
        }

        return response()->json( $this->rtndata );
    }


    /*
     * 詳情資料
     */
    public function attr (Request $request , $id)
    {
        $this->_init();
        $this->view = View()->make('_web.' . implode('.', $this->module) . '.attr');
        $this->breadcrumb = [
            $this->vTitle => url( 'web' ),
            implode('.', $this->module) => url('web/' . implode('/', $this->module)),
            implode('.', $this->module ) . '.attributes' => url( 'web/' . implode( '/', $this->module ) . '/attr/' . $id )
        ];
        $this->view->with('breadcrumb', $this->breadcrumb);
        $this->view->with('module', $this->module);
        $this->view->with('vTitle', $this->vTitle);
        $this->view->with('vSummary', '訊息詳情' );
        $this->view->with( 'permission', $this->Permission );

        //
//        $mapMessage['iStatus'] = 1;
        $mapMessage['bDel'] = 0;
        $DaoMessage = ModMessage::query()->where($mapMessage)
            ->where('iHead' , '>', session('member.iAcType'))
            ->join('event', 'keyValue', '=', 'iSource')
            ->find($id);
        if ($DaoMessage){
            //
            $DaoMessage->ReservoirMeta = ModReservoirMeta::query()->where('vNumber','=', $DaoMessage->id)->first();
            $DaoMessage->Reservoir = ModReservoir::query()->where('vName', 'LIKE', '%'.$DaoMessage->ReservoirMeta->vStructure.'%')->first();
            $DaoMessage->iCreateTime = date( 'Y/m/d H:i:s', $DaoMessage->iCreateTime );
            $DaoMessage->iUpdateTime = date( 'Y/m/d H:i:s', $DaoMessage->iUpdateTime );
            //
            if($DaoMessage->PGA<=0.8){
                $DaoMessage->shake="O 級地震";
            }else if($DaoMessage->PGA<=2.5){
                $DaoMessage->shake="一級地震";
            }else if($DaoMessage->PGA<=8.0){
                $DaoMessage->shake="二級地震";
            }else if($DaoMessage->PGA<=25){
                $DaoMessage->shake="三級地震";
            }else if($DaoMessage->PGA<=80){
                $DaoMessage->shake="四級地震";
            }else if($DaoMessage->PGA<=250){
                $DaoMessage->shake="五級地震";
            }else if($DaoMessage->PGA<=400){
                $DaoMessage->shake="六級地震";
            }else{
                $DaoMessage->shake="七級地震";
            }
            //
//            $DaoShakemap = ModShakemap::query()
//                ->leftJoin( 'mod_reservoir_meta', function ($join) {
//                    $join->on('shakemap.id', '=', 'mod_reservoir_meta.vNumber');
//                })
//                ->where('id', 'LIKE', 'SD%')
//                ->orWhere('id', 'LIKE', 'MD%')
//                ->orderBy('id', 'ASC')
//                ->get();
        }
        $this->view->with( 'info', $DaoMessage );

        return $this->view;
    }


    /*
     * 隱藏的內建功能:刪除全部
     */
    public function doDelAll ( Request $request )
    {
        // check sudo
        if ( session('member.iAcType' , 0) != 1) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );
            return response()->json( $this->rtndata );
        }
        //
        $mapMessage['bDel'] = 0;
        $Dao = ModMessage::query()->where($mapMessage)
            ->where('iType', '<', 50)
            ->update( array('bDel'=>1, 'iUpdateTime'=>time()) );
        //Logs
        $this->_saveLogAction('mod_message', 9999999999, 'delete', json_encode($Dao , JSON_UNESCAPED_UNICODE) );

        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans('_web_message.delete_success');
        return response()->json( $this->rtndata );
    }
}
