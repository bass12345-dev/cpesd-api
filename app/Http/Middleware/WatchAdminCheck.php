<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;


class WatchAdminCheck
{
    public function handle(Request $request, Closure $next)
    {
         if (!Session::has('watch_id')) {
             return redirect('/');
        }

        return $next($request);
    }
}
