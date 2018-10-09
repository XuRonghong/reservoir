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




        return $next ($request);
    }
}
