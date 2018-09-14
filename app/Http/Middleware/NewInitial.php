<?php

namespace App\Http\Middleware;

use Closure;
use App\ModEvent;


class NewInitial
{
    public function __construct()
    {
    }

    public function handle($request, Closure $next)
    {
        $DaoEvent = ModEvent::query()
            ->where('eventTime', '>=',date("Y-m-d H:i:s",time()-32400))   //北美中部時區的時差-8小時
            ->orderBy('eventTime', 'DESC')
            ->take(45)
            ->get();
        // Event table
        session()->put( 'event', json_decode( json_encode( $DaoEvent ), true ) );

        return $next ($request);
    }
}
