<?php

namespace App\Http\Controllers\_Web;

use App\Http\Controllers\_Web\_WebController;
use Maatwebsite\Excel\Facades\Excel;
use App\ModReservoir;
use App\ModReservoirInfo;

class IndexController extends _WebController
{
    public $module = [ 'index' ];

    /*
     *
     */
    public function index ()
    {
        //$this->__initial();
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) );

        return $this->view;
    }

    /*
     *
     */
    public function add ()
    {
        //$this->__initial();
        $this->view = View()->make( '_web.' . implode( '.' , $this->module ) . '_add' );

        return $this->view;
    }
}
