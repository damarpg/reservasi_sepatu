<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // Proses login dengan Deteksi Role (Admin/Owner)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Ambil data user yang sedang login
            $user = Auth::user();

            // Logika Pengalihan Berdasarkan Role
            if ($user->role === 'owner') {
                return redirect()->intended(route('owner.index'))
                    ->with('success', 'Halo Owner! Laporan dan statistik sudah siap dipantau.');
            }

            // Default pengalihan untuk Admin
            return redirect()->intended(route('admin.index'))
                ->with('success', 'Selamat datang kembali, Admin!');
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password tidak terdaftar di sistem kami.',
        ])->onlyInput('email');
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Anda telah berhasil keluar dari sistem.');
    }
}