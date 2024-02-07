<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;


class WatchAdminCheck
{
    public function handle(Request $request, Closure $next)
    {
         if (Session::has('isLoggedInWatch')) {
             return redirect('/watchlisted/admin/dashboard');
        }

        return $next($request);
    }
}
