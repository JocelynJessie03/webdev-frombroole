<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;                  // <-- TAMBAHAN IMPORT UNTUK REDIRECT
use Illuminate\Support\Facades\Auth;          // <-- TAMBAHAN IMPORT UNTUK CEK LOGIN

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Alias middleware milik kamu tetap di sini
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'customer' => \App\Http\Middleware\CustomerMiddleware::class,
        ]);

        // Eksklusi CSRF milik kamu tetap di sini
        $middleware->validateCsrfTokens(except: [
            'login',
        ]);

        // ==========================================
        // SAKTI: ATUR REDIRECT MULTI-AUTH UNTUK ROUTE 'GUEST'
        // ==========================================
        $middleware->redirectUsersTo(function (Request $request) {
            // Jika yang terdeteksi login adalah Admin, arahkan ke dashboard
            if (Auth::guard('admin')->check()) {
                return '/dashboard';
            }
            
            // Jika selain admin (Customer), arahkan ke home
            return '/home';
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();