<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek 1: Apakah login menggunakan guard 'admin' (Manual Login)
        // Cek 2: ATAU login menggunakan guard biasa ('web') TAPI rolenya 'admin' (Google / OTP)
        if (Auth::guard('admin')->check() || (Auth::check() && Auth::user()->role === 'admin')) {
            return $next($request);
        }

        // Jika bukan admin, tendang ke login
        return redirect('/login')->withErrors(['email' => 'Access denied! You must be an admin to enter.']);
    }
}