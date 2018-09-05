<?php

namespace App\Http\Controllers\_Portal\MemberCenter\Keep;

use App\Http\Controllers\_Portal\MemberCenter\_MemberCenterController;
use App\ModKeep;
use App\ModProduct;
use Illuminate\Http\Request;

class _KeepController extends _MemberCenterController
{
    /*
     *
     */
    public function getList ( Request $request )
    {
        $map['iStoreId'] = $request->input( 'iStoreId' );
        $map['iStatus'] = 1;
        $map['bDel'] = 0;
        $data_arr = ModKeep::where( $map )->where( function( $query ) {
            $query->where( 'iMemberId', session( 'shop_member.iId' ) )->orWhere( 'vSessionId', session()->getId() );
        } )->get();
        foreach ($data_arr as $key => $var) {
            $DaoProduct = ModProduct::getProductById( $var->iProductId, $var->iSpecId );
            //Product存在時 且被開啟
            if ($DaoProduct && $DaoProduct['meta']['iCategoryId'] != 0 && $DaoProduct['meta']['bShow'] == 1 && $DaoProduct['meta']['bDel'] == 0) {
                $var->vProductCode = $DaoProduct['meta']->vProductCode;
                $tmp_arr = explode( ';', $DaoProduct['meta']->vImages );
                $tmp_arr = array_filter( $tmp_arr );
                if ($tmp_arr) {
                    $var->vImages = $tmp_arr[0];
                }
                $var->vProductName = $DaoProduct['meta']->vProductName;
                $var->vProductNum = $DaoProduct['meta']->vProductNum;
                $var->vSpecTitle = $DaoProduct['spec']->vSpecTitle;
                $var->iSpecStock = $DaoProduct['spec']->iSpecStock;
                $var->iCount = ( $var->iCount > $var->iSpecStock ) ? $var->iSpecStock : $var->iCount;
                $var->iProductPromoPrice = $DaoProduct['meta']->iProductPromoPrice;
                $var->iProductPrepareDay = $DaoProduct['meta']->iProductPrepareDay;
                $var->vProductUrl = url( 'product/detail/' . $var->vProductCode );
                $var->iProductVolume = $DaoProduct['meta']->iProductVolume;
                $var->iProductWeight = $DaoProduct['meta']->iProductWeight;
            } else {
                //不合法商品
                unset( $data_arr[$key] );
                ModKeep::where( 'iId', '=', $var->iId )->delete();
            }
        }
        if (count( $data_arr )) {
            $this->rtndata ['status'] = 1;
            $this->rtndata ['aaData'] = $data_arr;
        } else {
            $this->rtndata ['status'] = 0;
        }

        return response()->json( $this->rtndata );
    }

    public function doAdd ( Request $request )
    {
        $product_code = ( $request->exists( 'vProductCode' ) ) ? $request->input( 'vProductCode' ) : 0;
        $mapProduct['vProductCode'] = $product_code;
        $mapProduct['bShow'] = 1;
        //$mapProduct['bOpen'] = 1;
        $mapProduct['bDel'] = 0;
        $DaoProduct = ModProduct::where( $mapProduct )->first();
        if ( !$DaoProduct) {
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = trans( '_web_message.add_fail' );

            return response()->json( $this->rtndata );
        }
        $map['iMemberId'] = session()->get( 'shop_member.iId' );
        $map['iProductId'] = $DaoProduct->iId;
        $map['vStoreType'] = $this->vStoreType;
        $Dao = ModKeep::where( $map )->first();
        if ($Dao) {
            if ($Dao->iStatus == 1) {
                $Dao->iStatus = 2; //取消
                $Dao->iUpdateTime = time();
                if ($Dao->save()) {
                    $this->rtndata ['status'] = 2;
                    $this->rtndata ['message'] = trans( '_web_message.keep_remove' );
                } else {
                    $this->rtndata ['status'] = 0;
                    $this->rtndata ['message'] = trans( '_web_message.keep_remove_fail' );
                }
            } else {
                $Dao->iStatus = 1;
                $Dao->iUpdateTime = time();
                if ($Dao->save()) {
                    $this->rtndata ['status'] = 1;
                    $this->rtndata ['message'] = trans( '_web_message.add_success' );
                } else {
                    $this->rtndata ['status'] = 0;
                    $this->rtndata ['message'] = trans( '_web_message.add_fail' );
                }
            }
        } else {
            $Dao = new ModKeep ();
            $Dao->vSessionId = session()->getId();
            $Dao->iMemberId = session()->get( 'shop_member.iId' );
            $Dao->vStoreType = $this->vStoreType;
            $Dao->iProductId = $DaoProduct->iId;
            $Dao->iStatus = 1;
            $Dao->iCreateTime = $Dao->iUpdateTime = time();
            if ($Dao->save()) {
                $this->rtndata ['status'] = 1;
                $this->rtndata ['message'] = trans( '_web_message.add_success' );
            } else {
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = trans( '_web_message.add_fail' );
            }
        }

        return response()->json( $this->rtndata );
    }
}
