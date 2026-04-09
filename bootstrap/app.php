<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 1. Mendaftarkan alias middleware (Owner & Admin)
        $middleware->alias([
            'isOwner' => \App\Http\Middleware\EnsureUserIsOwner::class,
            'isAdmin' => \App\Http\Middleware\IsAdmin::class,
        ]);

        // 2. Mengecualikan route Midtrans dari pengecekan CSRF
        $middleware->validateCsrfTokens(except: [
            'midtrans/callback', 
        ]);

        // 3. LOGIKA REDIRECT SETELAH REFRESH/LOGIN
        // Ini yang mencegah Owner nyasar ke Dashboard Admin
        $middleware->redirectTo(
            guests: '/login',
            users: function () {
                $user = Auth::user();
                if ($user && $user->role === 'admin') {
                    return '/admin';
                } elseif ($user && $user->role === 'owner') {
                    return '/owner';
                }
                return '/'; // Default jika role tidak dikenal
            }
        );

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();