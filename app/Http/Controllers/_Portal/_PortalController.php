<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\Controller;
use App\LogAction;
use App\ModCart;
use App\ModProduct;
use App\ModProductSpec;
use App\ModUrl;
use App\SysConfig;
use App\Http\Controllers\FuncController;
use App\ModProductCategory;
use App\SysGroupMember;
use App\SysMember;
//use Jenssegers\Agent\Agent;
use App\ModOrder;
use App\ModOrderAddressee;
use App\ModOrderMeta;
use App\ModActivitySchedule;
use App\ModActivityScheduleInfo;
use App\ModActivityScheduleProduct;
use App\ModActivityScheduleGroup;


class _PortalController extends Controller
{

    protected $agent;
    protected $device;
    protected $module;
    public $view;
    public $rtndata;
    protected $order_limit_price = [];       //檔期限制金額
    protected $order_code = [];              //訂單碼頭英文，依照檔期



    public function _init ()
    {
        /*
         *  判斷裝置手機版或電腦版
         */
        $this->agent = new Agent();
        if ( $this->agent->isMobile() && !$this->agent->isTablet() ) {
            $this->view = View()->make( "_template_mobile." . implode( '.' , $this->module ) );
        } else {
            $this->view = View()->make( "_template_portal." . implode( '.' , $this->module ) );
        }

        //Config
        $mapConfig['iId'] = 3;
        $mapConfig['iStatus'] = 1;
        $logo_B = SysConfig::where( $mapConfig )->value( 'vValue' );
        $mapConfig['iId'] = 4;
        $mapConfig['iStatus'] = 1;
        $logo_S = SysConfig::where( $mapConfig )->value( 'vValue' );
        View()->share( 'logo_B' , $logo_B );             // 共享資料給所有視圖
        View()->share( 'logo_S' , $logo_S );

        $mapHeaderUrl['iMenuId'] = 60301;
        $mapHeaderUrl['iStatus'] = 1;
        $mapHeaderUrl['bDel'] = 0;
        $DaoHeaderUrl = ModUrl::where( $mapHeaderUrl )->get();
        foreach ($DaoHeaderUrl as $item){
            $item->vUrl = url($item->vUrl);
        }
        View()->share( '_header' , $DaoHeaderUrl );

        $mapFooterUrl['iMenuId'] = 60401;
        $mapFooterUrl['iStatus'] = 1;
        $mapFooterUrl['bDel'] = 0;
        $DaoFooterUrl = ModUrl::where( $mapFooterUrl )->get();
        View()->share( '_footer' , $DaoFooterUrl );


        //檔期功能:更新檔期內容
        $this->getActivitySchedule();
    }


    /*
     * $action : 1.add 2.edit 3.delete
     * $value : field->value
     */
    public function _saveLogAction ( $table_name , $table_id , $action , $value )
    {
        $DaoLogAction = new LogAction();
        $DaoLogAction->iMemberId = session( 'shop_member.iId' , 0 );
        $DaoLogAction->vTableName = $table_name;
        $DaoLogAction->iTableId = $table_id;
        $DaoLogAction->vAction = $action;
        $DaoLogAction->vValue = $value;
        $DaoLogAction->iDateTime = time();
        $DaoLogAction->save();
    }


    /*
     * $addChars : TTB 1494314960
     */
    public function _getOrderNum ( $addChars )//TTW7269736178288
    {
        $order_num = (
            Config()->get( 'config.str_arr' ) [intval(date( 'Y' )) - 2017] ) .
            strtoupper( dechex( date( 'm' ) ) ) .
            date( 'd' ) .
            substr( time(), -5 ) .
            substr( microtime(), 2 , 3 ) .
            sprintf( '%02d' , rand( 0, 99 ) );

        if ( $addChars && is_string( $addChars ) ) {
            $order_num = $addChars . $order_num;
        }

        return $order_num;
    }


    /*
     * Cart Dao
     */
    public function getDaoCart ( $cart_id = 0 , $mapCart = [] )
    {

        if ($cart_id) $mapCart['iId'] = $cart_id ;
        $mapCart['bDel'] = 0;
        $DaoCart = ModCart::query()->where( $mapCart )->where( 'iMemberId' , session( 'shop_member.iId' ) )->get();
        if ( !$DaoCart){ return false; }

        foreach ($DaoCart as $key => $var) {
            $DaoProduct = ModProduct::getProductById( $var->iProductId, $var->iSpecId );
            //Product存在時 且被開啟
            if ($DaoProduct &&
                $DaoProduct['info']['iCategoryId'] != 0 &&
                $DaoProduct['info']['bShow'] == 1 &&
                $DaoProduct['info']['bDel'] == 0 ) {
                //
                if ( $DaoProduct['spec']->bStockCheck && !$DaoProduct['spec']->iSpecStock) {
                    $this->rtndata ['message'] = "部分商品已無庫存，將刪除!";
                    //$var->delete();
                    //unset( $DaoCart[$key] );
                    $var->bDel = 1 ;
                    $var->save();
                    continue;
                } else if ( $DaoProduct['spec']->bStockCheck ){
                    $var->iCount = ( $var->iCount < $DaoProduct['spec']->iSpecStock ) ?
                        $var->iCount :
                        $DaoProduct['spec']->iSpecStock ;
                }
                //
                $image_arr = [];
                $tmp_arr = explode( ';', $DaoProduct['info']->vImages );
                $tmp_arr = array_filter( $tmp_arr );
                foreach ($tmp_arr as $item) {
                    $image_arr[] = FuncController::_getFilePathById($item);
                }
                if ($tmp_arr) {
                    $var->vImages = $image_arr[0];
                } else {
                    $var->vImages = null;
                }
                //
                $var->vProductCode = $DaoProduct['info']->vProductCode;
                $var->iSpecId = $DaoProduct['spec']->iId ;
                $var->vSpecTitle = $DaoProduct['spec']->vSpecTitle;
                $var->iSpecStock = $DaoProduct['spec']->iSpecStock;
                $var->vProductName = $DaoProduct['info']->vProductName;
                $var->vProductNum = $DaoProduct['info']->vProductNum;
                $var->iProductPromoPrice =  $DaoProduct['spec']->iSpecPrice;//$DaoProduct['info']->iProductPriceOS;
                $var->iProductPrepareDay = $DaoProduct['info']->iProductPrepareDay;
                $var->vProductUrl = url('product/' . $DaoProduct['info']->vProductCode);
                $var->iProductVolume = $DaoProduct['info']->iProductVolume;
                $var->iProductWeight = $DaoProduct['info']->iProductWeight;
                $var->iProductTotalPrice = $var->iCount * $var->iProductPromoPrice ;

                //存該商品的所有規格
                $mapSpec['iProductId'] = $var->iProductId ;
                $var->Specification = ModProductSpec::query()->where($mapSpec)->get();
            } else {
                //不合法商品
                //unset( $DaoCart[$key] );
                //ModCart::where( 'iId', '=', $var->iId )->delete();
                $var->bDel = 1 ;
                $var->save();
            }
        }

        return $DaoCart;
    }


    /*
     * Order Dao Module
     */
    public function getDaoOrder ($order_num=0, $mapOrder=[], $paginate=0, $orderby='iCreateTime', $sort='desc', $start=0, $end=9999999999 )
    {

        if ($order_num) $mapOrder['mod_order.vOrderNum'] = $order_num ;
        if (session()->get( 'shop_member.iId' )) {
            $mapOrder['iMemberId'] = session()->get('shop_member.iId');
        }else if (session()->getId()) {
            $mapOrder['vSessionId'] = session()->getId() ;
        }
        if ( $paginate ) {
            $DaoOrder = ModOrder::query()->where($mapOrder)
                ->join('mod_order_info', function ($join) {
                    $join->on('mod_order_info.vOrderNum', '=', 'mod_order.vOrderNum');
                })
                ->where('iCreateTime', '>', $start-1 )
                ->where('iCreateTime', '<', $end+86400 )
                ->orderBy($orderby, $sort)
                ->paginate($paginate);
        } else {
            $DaoOrder = ModOrder::query()->where($mapOrder)
                ->join('mod_order_info', function ($join) {
                    $join->on('mod_order_info.vOrderNum', '=', 'mod_order.vOrderNum');
                })
                ->get();
        }
        if ( !$DaoOrder){
            $DaoOrder->error = "No find order";
            return $DaoOrder;
        }

        if ($DaoOrder) {
            foreach ($DaoOrder as $item) {
                //訂單是否失效
                if ($item->iPayStatus == 0 && ($item->iCreateTime + config('_config.order_limit_time')) < time()) {
                    $item->iStatus = 2;
                    $item->iUpdateTime = time();
                    $item->save();
                }
                //
                $mapOrderMeta['vOrderNum'] = $item->vOrderNum;
                $item->meta = ModOrderMeta::query()->where($mapOrderMeta)
                    ->where('iStatus', '!=', 2)
                    ->get();
                if (!$item->meta) {
                    $DaoOrder->error = "No find order meta";
                    return $DaoOrder;
                }

                $money_total = 0;
                foreach ($item->meta as $key => $var) {
                    $DaoProduct = ModProduct::getProductById($var->iProductId, $var->iSpecId);
                    //
                    $var->vProductCode = $DaoProduct['info']->vProductCode;
                    $var->vProductName = $DaoProduct['info']->vProductName;
                    $var->vProductNum = $DaoProduct['info']->vProductNum;
                    $var->vSpecTitle = $DaoProduct['spec']->vSpecTitle;
                    $var->iProductPromoPrice =  $DaoProduct['spec']->iSpecPrice;
                    //$var->iProductPromoPrice = $DaoProduct['info']->iProductPromoPrice;
                    $var->iProductPrepareDay = $DaoProduct['info']->iProductPrepareDay;
                    $var->iTotal = $var->iProductPromoPrice * $var->iCount;
                    $money_total += $var->iTotal;
                    // image
                    $image_arr = [];
                    $tmp_arr = explode(';', $DaoProduct['info']->vImages);
                    $tmp_arr = array_filter($tmp_arr);
                    foreach ($tmp_arr as $item2) {
                        $image_arr[] = FuncController::_getFilePathById($item2);
                    }
                    if ($tmp_arr) {
                        $var->vImages = $image_arr[0];
                    } else {
                        $var->vImages = null;
                    }
                }
                $item->iMoneyTotal = $money_total + $item->iShipmentFee;
                $item->date = date('Y-m-d', $item->iCreateTime );

                //訂購人
                $mapOrderAddressee['vOrderNum'] = $item->vOrderNum ;
                $mapOrderAddressee['iAddresseeType'] = 1;
                $item->addressee1 = ModOrderAddressee::query()->where($mapOrderAddressee)->first();
                //收件人
                $mapOrderAddressee['iAddresseeType'] = 2;
                $item->addressee2 = ModOrderAddressee::query()->where($mapOrderAddressee)->first();
                //發票資訊
                $mapOrderAddressee['iAddresseeType'] = 3;
                $item->addressee3 = ModOrderAddressee::query()->where($mapOrderAddressee)->first();
            }
        }

        $DaoOrder->error = false;
        return $DaoOrder;
    }


    /*
     * 丟檔案id取得圖片檔路徑 get()
     */
    public function getPictureWithId ( $Dao )
    {
        if ( !isset($Dao) ) return "No data input";

        foreach ($Dao as $key => $var) {
            //圖片
            $image_arr = [];
            if ($var->vImages) {
                $tmp_arr = explode(';', $var->vImages);
                $tmp_arr = array_filter($tmp_arr);
                foreach ($tmp_arr as $item) {
                    $image_arr[] = FuncController::_getFilePathById($item);
                }
                if ($tmp_arr) {
                    $var->vImages = $image_arr;
                } else {
                    $var->vImages = [];
                }
            }
            //手機圖片
            $image_arr = [];
            if ($var->vImagesMobile) {
                $tmp_arr = explode(';', $var->vImagesMobile);
                $tmp_arr = array_filter($tmp_arr);
                foreach ($tmp_arr as $item) {
                    $image_arr[] = FuncController::_getFilePathById($item);
                }
                if ($tmp_arr) {
                    $var->vImagesMobile = $image_arr;
                } else {
                    $var->vImagesMobile = [];
                }
            }
        }

        return null;
    }

    /*
     * 丟檔案id取得圖片檔路徑 first()
     */
    public function firstPictureWithId ( $DaoFirst )
    {
        if ( !isset($DaoFirst) ) return "No data input only one";

        //圖片
        $image_arr = [];
        if ($DaoFirst->vImages) {
            $tmp_arr = explode(';', $DaoFirst->vImages);
            $tmp_arr = array_filter($tmp_arr);
            foreach ($tmp_arr as $item) {
                $image_arr[] = FuncController::_getFilePathById($item);
            }
        }
        if ($tmp_arr) {
            $DaoFirst->vImages = $image_arr;
        } else {
            $DaoFirst->vImages = [];
        }
        //手機圖片
        $image_arr = [];
        if ($DaoFirst->vImagesMobile) {
            $tmp_arr = explode(';', $DaoFirst->vImagesMobile);
            $tmp_arr = array_filter($tmp_arr);
            foreach ($tmp_arr as $item) {
                $image_arr[] = FuncController::_getFilePathById($item);
            }
        }
        if ($tmp_arr) {
            $DaoFirst->vImagesMobile = $image_arr;
        } else {
            $DaoFirst->vImagesMobile = [];
        }

        return null;
    }


    /*
     * 得到類別有關的所有類別
     */
    public function getCategoryRelated( $id )
    {
        if ( !$id) return false;

        $cate_parent_id = ModProductCategory::query()
            ->where( 'iId', '=', $id )
            ->first()->iParentId;
        //第一層類別
        $product_arrt = [] ;
        $mapCategory['iCategoryType'] = 10001;
        $mapCategory['iId'] = $cate_parent_id ;      //沒有父類別,表示根部類別
        $mapCategory['iStatus'] = 1;
        $mapCategory['bDel'] = 0;
        $DaoCategory = ModProductCategory::query()->where( $mapCategory )->get();
        foreach ( $DaoCategory as $key => $item ){
            array_push( $product_arrt , $item->iId);

            //第二層類別
            $mapCategoryChild['iCategoryType'] = 10001;
            $mapCategoryChild['iParentId'] = $item->iId;
            $mapCategoryChild['iStatus'] = 1;
            $mapCategoryChild['bDel'] = 0;
            $DaoCategoryChild = ModProductCategory::query()->where( $mapCategoryChild )->get();
            foreach ( $DaoCategoryChild as $itemChild ){
                array_push( $product_arrt , $itemChild->iId);
            }
        }

        return $product_arrt;
    }


    /*
     * 後臺取得縣市地址相關資料
     */
    public function getDaoAddress ()
    {
        //預設假資料
//        $DaoAddr = [
//            trans('_portal.address.code_001') => trans('_portal.address.addr_001'),
//            trans('_portal.address.code_002') => trans('_portal.address.addr_002'),
//            trans('_portal.address.code_003') => trans('_portal.address.addr_003'),
//        ];
        $DaoAddr = [];

        //
        $mapSysMember['bActive'] = 1;
        $mapSysMember['iStatus'] = 1;
        $DaoSysMember = SysMember::query()->where( $mapSysMember )
            ->where( 'iId', '=', session( 'shop_member.iId', 0 ) )
            ->join( 'sys_member_info', 'iId', '=', 'iMemberId' )
            ->first();
        if ( $DaoSysMember && $DaoSysMember->vUserAddress!='' ){

            $DaoAddr[ $DaoSysMember->vUserAddress ] = $DaoSysMember->vUserAddress ;

            //根據該會員id找到群組資訊，該群組的所有地址都push array
//            $mapSysGroupMember['iStatus'] = 1;
//            $mapSysGroupMember['iMemberId'] = $DaoSysMember->iId ;
//            $DaoSysGroupMember = SysGroupMember::query()->where( $mapSysGroupMember )
//                ->join( 'sys_group_info', 'sys_group_member.iGroupId', '=', 'sys_group_info.iGroupId' )
//                ->get();
//            if ($DaoSysGroupMember){
//                foreach ($DaoSysGroupMember as $item){
//                    $DaoAddr[ $item->vGroupAddress ] = $item->vGroupAddress ;
//                }
//            }
        }
        return $DaoAddr;
    }


    /*
     * 存上一頁網址，來源
     */
    public function putPrevPageToSession ()
    {
        session()->put( 'prev_page' , session( 'current_page' , url('')) ); //上一頁網址
        $this->view->with( 'prev',  session( 'current_page' , url('')) );
        session()->put( 'current_page' , url( $_SERVER['REQUEST_URI']) );   //這頁網址
        return true;
    }



    /*
     * Use shop member id to get product in the activity schedule.
     */
    public function getActivitySchedule ()
    {

        // MemberGroup join ModActivitySchedule.
        $mapGroupMember[ 'iMemberId' ] = session('shop_member.iId','') ;
        $DaoGroupMember = SysGroupMember::query()->where($mapGroupMember)->first();
        if ( !$DaoGroupMember || !$DaoGroupMember->iGroupId) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = '會員無群組';
            return response()->json( $this->rtndata );
        }

        //use group id to get activity_schedule id array.
        $map['iStatus'] = 1 ;
        $map['bDel'] = 0 ;
        $arr_iActivityScheduleId = ModActivityScheduleGroup::query()->where($map)
            ->where('iGroupId', '=', $DaoGroupMember->iGroupId)
            ->pluck('iActivityScheduleId')
            ->all();
        session()->put('arr_activity_schedule_id', json_decode( json_encode( $arr_iActivityScheduleId ), true ) );

        // Set ActivitySchedule session
        $DaoActivitySchedule = ModActivitySchedule::query()->where($map)
            ->whereIn( 'iId', $arr_iActivityScheduleId )
            ->get();
        session()->put('shop_activity_schedule', json_decode( json_encode( $DaoActivitySchedule ), true ) );
        $DaoActivityScheduleInfo = ModActivityScheduleInfo::query()
            ->whereIn( 'iActivityScheduleId', $arr_iActivityScheduleId )
            ->get();
        session()->put('shop_activity_schedule_info', json_decode( json_encode( $DaoActivityScheduleInfo ), true ) );

        // Set each one order limit buy price of activity schedule.
        foreach ($DaoActivityScheduleInfo as $item){
            $this->order_limit_price[ $item->iActivityScheduleId ] =  $item->iOrderLimitPrice ;
            $this->order_code[ $item->iActivityScheduleId ] = $item->vOrderCode ;
        }


        //檔期內商品
        $mapAS['iStatus'] = 1;
        $mapAS['bDel'] = 0;
        $ASproductId = ModActivityScheduleProduct::query()->where($mapAS)
            ->whereIn( 'iActivityScheduleId' , $arr_iActivityScheduleId )
            ->pluck('iProductId');
        session()->put('arr_activity_schedule_product', json_decode( json_encode( $ASproductId ), true ) );

        return true;
    }
}
