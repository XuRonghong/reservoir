<?php

namespace App\Http\Controllers\_Web;

use Illuminate\Http\Request;


class IndexController extends _WebController
{
    public $module = [  ];


    /*
     *
     */
    public function index ()
    {
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . 'index' );
        //
        $breadcrumb = [
            '後臺首頁' => url( '' ),
        ];
        $this->view->with( 'breadcrumb', $breadcrumb );
        $this->view->with( 'module', $this->module );
        session()->put( 'SEO.vTitle' , '水庫管理系統' );

        return $this->view;
    }
}
