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
        $this->_init();
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
