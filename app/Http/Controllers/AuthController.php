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
        // Jika sudah login, langsung arahkan ke dashboard masing-masing tanpa harus login lagi
        if (Auth::check()) {
            return $this->redirectUserByRole(Auth::user());
        }

        // Menangkap parameter role dari URL (misal: /login?role=admin)
        // Ini bisa digunakan di view login untuk memberikan teks sambutan yang berbeda
        $requestedRole = $request->query('role');

        return view('auth.login', compact('requestedRole'));
    }

    /**
     * Proses login dengan Deteksi Role (Admin/Owner)
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

        // Proses Otentikasi
        // 'remember' bisa ditambahkan jika kamu punya checkbox "Ingat Saya" di view
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            // Gunakan fungsi helper agar pengalihan konsisten
            return $this->redirectUserByRole($user);
        }

        // Jika login gagal, kembalikan dengan pesan error yang halus
        return back()->withErrors([
            'email' => 'Ups! Email atau password salah. Silakan periksa kembali.',
        ])->onlyInput('email');
    }

    /**
     * Fungsi Helper untuk Pengalihan Role (Centralized Logic)
     */
    private function redirectUserByRole($user)
    {
        if ($user->role === 'owner') {
            return redirect()->intended(route('owner.index'))
                ->with('success', 'Halo Owner! Laporan operasional Nature Clean sudah siap dipantau.');
        }

        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.index'))
                ->with('success', 'Selamat datang kembali! Mari selesaikan antrean sepatu hari ini.');
        }

        // Jika user tidak punya role yang sesuai, paksa logout demi keamanan
        Auth::logout();
        return redirect()->route('login')->withErrors([
            'email' => 'Maaf, akun Anda tidak memiliki izin akses ke area ini.'
        ]);
    }

    /**
     * Proses logout yang bersih
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Menghapus data sesi agar tidak bisa di-back oleh browser (keamanan ekstra)
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/')->with('success', 'Berhasil keluar. Terima kasih telah menjaga kualitas di Nature Clean!');
    }
}