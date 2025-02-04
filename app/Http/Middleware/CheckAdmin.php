<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
{
    public function __construct ()
    {
    }

    public function handle ( $request, Closure $next )
    {
        if ( !in_array( session()->get( 'member.iAcType' ), config( '_config.admin_access' ) )) {
            return abort( 503 );
        }

        return $next ( $request );
    }
}
