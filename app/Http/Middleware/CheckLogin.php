<?php

namespace App\Http\Middleware;

use Closure;

class CheckLogin {
	public function __construct() {
	}
	public function handle($request, Closure $next) {
		if (! session ()->has ( 'member' )) {
		    session()->put( 'rtnurl' ,$request->url());
			return redirect ()->guest ( 'web/login' );
		}
		return $next ( $request );
	}
}
