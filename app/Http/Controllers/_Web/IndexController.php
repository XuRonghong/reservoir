<?php

namespace App\Http\Controllers\_Web;

use Illuminate\Http\Request;


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
        session()->put( 'SEO.vTitle' , $this->vTitle );

        return $this->view;
    }
}
