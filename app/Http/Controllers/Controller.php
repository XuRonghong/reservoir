<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //
    protected $rtndata = [];

    /*
     *
     */
    public function __construct ()
    {
        $this->rtndata ['status'] = 0;
        $this->rtndata ['message'] = "";
        $this->rtndata ['meta'] = [];
    }

    /*
     *
     */
    protected function _get_https_url ()
    {
        $https = !empty ( $_SERVER ['HTTPS'] ) && strcasecmp( $_SERVER ['HTTPS'], 'on' ) === 0 || !empty ( $_SERVER ['HTTP_X_FORWARDED_PROTO'] ) && strcasecmp( $_SERVER ['HTTP_X_FORWARDED_PROTO'], 'https' ) === 0;

        return ( $https ? 'https://' : 'http://' );
    }

    /*
     *
     */
    protected function _get_full_url ()
    {
        $https = !empty ( $_SERVER ['HTTPS'] ) && strcasecmp( $_SERVER ['HTTPS'], 'on' ) === 0 || !empty ( $_SERVER ['HTTP_X_FORWARDED_PROTO'] ) && strcasecmp( $_SERVER ['HTTP_X_FORWARDED_PROTO'], 'https' ) === 0;

        return ( $https ? 'https://' : 'http://' ) . ( !empty ( $_SERVER ['REMOTE_USER'] ) ? $_SERVER ['REMOTE_USER'] . '@' : '' ) . ( isset ( $_SERVER ['HTTP_HOST'] ) ? $_SERVER ['HTTP_HOST'] : ( $_SERVER ['SERVER_NAME'] . ( $https && $_SERVER ['SERVER_PORT'] === 443 || $_SERVER ['SERVER_PORT'] === 80 ? '' : ':' . $_SERVER ['SERVER_PORT'] ) ) ) . substr( $_SERVER ['SCRIPT_NAME'], 0, strrpos( $_SERVER ['SCRIPT_NAME'], '/' ) );
    }
}
