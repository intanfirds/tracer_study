<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CekLevel
{
    public function handle(Request $request, Closure $next, $level)
    {
        // Pastikan user sudah login dan level-nya sesuai
        if (!Session::has('id') || Session::get('level') !== $level) {
            return redirect('/login')->with('error', 'Akses ditolak!');
        }

        return $next($request);
    }
}
