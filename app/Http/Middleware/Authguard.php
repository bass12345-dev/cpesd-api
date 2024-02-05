<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class Authguard
{
  
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('isLoggedIn')) {
            return redirect('/dts');
        }
        // if (session('user_type') != 'admin') {
        //     return redirect('/dts/user/dashboard');
        // }

        return $next($request);
    }
}
