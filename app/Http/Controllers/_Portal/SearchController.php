<?php

namespace App\Http\Controllers\_Portal;

use App\ModMallProduct;
use App\ModProduct;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Input;

class SearchController extends _PortalController
{
    /*
     *
     */
    public function index ( Request $request )
    {
        $this->module = [ 'search' ];
        $this->_init();
        //
        $keyword = $request->exists( 'keyword' ) ? $request->input( 'keyword' ) : "";
        $this->view->with( 'keyword', $keyword );

        return $this->view;
    }
}
