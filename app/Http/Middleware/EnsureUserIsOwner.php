<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsOwner
{
    public function handle(Request $request, Closure $next)
    {
        // Jika sudah login DAN role-nya adalah owner, izinkan lewat
        if (Auth::check() && Auth::user()->role === 'owner') {
            return $next($request);
        }

        // Jika bukan owner, arahkan kembali ke dashboard admin dengan pesan error
        return redirect()->route('admin.index')->with('error', 'Akses Ditolak! Anda bukan Owner.');
    }
}