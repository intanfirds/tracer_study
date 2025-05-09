<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CekLevel
{
    public function handle(Request $request, Closure $next, $level)
    {
        if (Session::get('level') != $level) {
            return redirect('/login')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
