<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

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
        // Agar Midtrans bisa mengirim data 'Paid' ke website kamu
        $middleware->validateCsrfTokens(except: [
            'midtrans/callback', 
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();