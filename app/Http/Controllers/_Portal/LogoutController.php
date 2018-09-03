<?php

namespace App\Http\Controllers\_Portal;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /*
     *
     */
    public function index ()
    {
        //session()->flush();
        session()->forget( 'shop_member' );
        session()->forget( 'shop_member.iId' );
        session()->forget( 'rtnurl' );
        return redirect()->guest( 'login' );
    }

    /*
     *
     */
    public function doLogout ()
    {
        //session()->flush();
        session()->forget( 'shop_member' );
        session()->forget( 'shop_member.iId' );
        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = trans( '_web_message.logout.success' );
        return response()->json( $this->rtndata );
    }
}
