<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function showLogin(Request $request)
    {
        // Jika sudah login, langsung arahkan ke dashboard masing-masing
        if (Auth::check()) {
            return $this->redirectUserByRole(Auth::user());
        }

        $requestedRole = $request->query('role');
        return view('auth.login', compact('requestedRole'));
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password tidak boleh kosong.',
        ]);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            // Menggunakan intended() agar jika user refresh halaman tertentu, 
            // mereka kembali ke halaman tersebut, bukan dipaksa ke dashboard awal.
            return $this->redirectUserByRole(Auth::user());
        }

        return back()->withErrors([
            'email' => 'Ups! Email atau password salah. Silakan periksa kembali.',
        ])->onlyInput('email');
    }

    /**
     * Fungsi Helper untuk Pengalihan Role
     */
    private function redirectUserByRole($user)
    {
        // Gunakan intended() sebagai prioritas utama, lalu fallback ke route dashboard
        if ($user->role === 'owner') {
            return redirect()->intended(route('owner.index'))
                ->with('success', 'Halo Owner! Laporan operasional Nature Clean sudah siap dipantau.');
        }

        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.index'))
                ->with('success', 'Selamat datang kembali! Mari selesaikan antrean sepatu hari ini.');
        }

        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email' => 'Maaf, akun Anda tidak memiliki izin akses.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Berhasil keluar!');
    }
}