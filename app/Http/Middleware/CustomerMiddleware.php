<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan dia login pakai guard biasa dan rolenya 'customer'
        if (Auth::check() && Auth::user()->role === 'customer') {
            return $next($request);
        }

        return redirect('/login')->withErrors(['email' => 'Access denied! Please login as a customer.']);
    }
}