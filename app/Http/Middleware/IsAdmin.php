<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan sudah login DAN role-nya adalah admin atau owner
        if (Auth::check() && (Auth::user()->role === 'admin' || Auth::user()->role === 'owner')) {
            return $next($request);
        }

        // Jika dia adalah pelanggan (atau role lain), tendang!
        return redirect('/')->with('error', 'Akses Terlarang! Anda tidak memiliki izin.');
    }
}