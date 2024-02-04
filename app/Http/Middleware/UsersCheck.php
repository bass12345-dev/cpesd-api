<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;


class UsersCheck
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('isLoggedIn')) {
             return redirect('/dts/user/dashboard');
        }

        return $next($request);
    }
}
