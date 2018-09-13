<?php

namespace App\Http\Middleware;

use Closure;

class CheckAuthLogin
{
	public function __construct()
    {
	}

	public function handle($request, Closure $next)
    {
		if (! session ()->has ( 'member' )) {
			return redirect ()->guest ( 'web/login' );
		}
        if (session ()->get ( 'member.iAcType' ) > 9) {
            return redirect ()->guest ( 'web/login' );
        }
		return $next ( $request );
	}
}
