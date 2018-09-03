<?php

namespace App\Http\Controllers\_Portal\MemberCenter;

use App\Http\Controllers\FuncController;
use App\ModOrder;
use App\ModOrderAddressee;
use App\ModOrderMeta;
use App\ModPayServiceTrade;
use App\ModProduct;
use App\ModProductShipping;
use App\ModStore;
use Illuminate\Http\Request;

class OrderController extends _MemberCenterController
{
    public $member_active = 'order';

    /*
     *
     */
    public function getList ( Request $request )
    {
        //CheckOrderDisable
        FuncController::_checkOrderDisable();

        $map['iMemberId'] = session( 'shop_member.iId' );
        $data_arr = ModOrder::where( function( $query ) use ( $request ) {
            if ($request->exists( 'keyword' )) {
                $query->where( 'vOrderNum', 'like', '%' . $request->input( 'keyword' ) . '%' );
            }
            if ($request->exists( 'datetime' ) && $request->input( 'datetime' ) > 0) {
                $query->where( 'iCreateTime', '>', ( time() - ( 86400 * $request->input( 'datetime' ) ) ) );
            }
        } )->where( $map )->orderBy( 'iCreateTime', 'DESC' )->get();
        foreach ($data_arr as $key => $var) {
            $var->iCreateTime = date( 'Y/m/d ', $var->iCreateTime );
            $var->status = config( '_config.order_status.' . $var->iStatus );
            $var->pay_status = config( '_config.order_pay_status.' . $var->iPayStatus );
            $var->payment_type = $var->vPaymentType;
            $var->url = url( 'member_center/order/detail/' . $var->vOrderNum );
        }
        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }

    /*
     *
     */
    public function doCancel ( Request $request )
    {
        $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;
        if ( !$id) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $map['iMemberId'] = session( 'shop_member.iId' );
        $Dao = ModOrder::where( $map )->find( $id );
        if ( !$Dao) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.empty_id' );

            return response()->json( $this->rtndata );
        }
        $Dao->iStatus = 2;
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
