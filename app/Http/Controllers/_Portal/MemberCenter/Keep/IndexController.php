<?php

namespace App\Http\Controllers\_Portal\MemberCenter\Keep;

use App\ModKeep;
use App\ModStore;

class IndexController extends _KeepController
{
    public $module = [ 'member_center', 'keep', 'index' ];
    public $member_active = "keep";

    /*
     *
     */
    public function index ()
    {
        $this->_init();
        $this->view->with( 'member_active', $this->member_active );

        $store_id_arr = ModKeep::where( function( $query ) {
            $query->where( 'iMemberId', session( 'shop_member.iId' ) )->orWhere( 'vSessionId', session()->getId() );
        } )->where( 'iStatus', 1 )->groupBy( 'iStoreId' )->pluck( 'iStoreId' );

        $DaoStore = ModStore::whereIn( 'iStoreId', $store_id_arr )->get();
        $this->view->with( 'store', $DaoStore );

        //
        $breadcrumb = [
            '商城首頁' => url( '' ),
            '會員中心' => url( 'member_center' ),
            '我的收藏' => 'active',

        ];
        $this->view->with( 'breadcrumb', $breadcrumb );

        return $this->view;
    }
}
