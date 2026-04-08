<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        // Jika sudah login, langsung arahkan ke dashboard masing-masing
        if (Auth::check()) {
            return $this->redirectUserByRole(Auth::user());
        }
        return view('auth.login');
    }

    // Proses login dengan Deteksi Role (Admin/Owner)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Proses Otentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            // Gunakan fungsi helper agar kode lebih rapi
            return $this->redirectUserByRole($user);
        }

        // Jika login gagal
        return back()->withErrors([
            'email' => 'Email atau password tidak terdaftar di sistem kami.',
        ])->onlyInput('email');
    }

    // Fungsi Helper untuk Pengalihan Role
    private function redirectUserByRole($user)
    {
        if ($user->role === 'owner') {
            return redirect()->intended(route('owner.index'))
                ->with('success', 'Halo Owner! Laporan dan statistik sudah siap dipantau.');
        }

        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.index'))
                ->with('success', 'Selamat datang kembali, Admin!');
        }

        // Jika role tidak dikenal atau kosong
        Auth::logout();
        return redirect()->route('login')->withErrors(['email' => 'Akun Anda tidak memiliki role yang valid.']);
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