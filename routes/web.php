<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LaporanController; // Import Controller Laporan
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes - Nature Clean Shoes
|--------------------------------------------------------------------------
*/

// --- HALAMAN PELANGGAN (Akses Publik) ---
Route::get('/', [ReservationController::class, 'index'])->name('reservasi.index');
Route::post('/reservasi/store', [ReservationController::class, 'store'])->name('reservasi.store');

/**
 * FITUR TRACKING (CEK STATUS)
 */
Route::get('/cek-status', [ReservationController::class, 'searchStatus'])->name('reservasi.status');
Route::get('/lacak-pesanan', [ReservationController::class, 'searchStatus'])->name('reservasi.track');

/**
 * FITUR RATING & TESTIMONI
 */
Route::post('/reservasi/review/{id}', [ReservationController::class, 'storeReview'])->name('reservasi.review');


// --- INTEGRASI PEMBAYARAN (Midtrans Callback) ---
Route::post('/midtrans/callback', [ReservationController::class, 'callback'])->name('midtrans.callback');

// --- AUTENTIKASI (Login & Logout) ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// --- AREA TERPROTEKSI (Harus Login) ---
Route::middleware('auth')->group(function () {

    // --- HALAMAN ADMIN (Akses: Admin) ---
    // PERBAIKAN: Menambahkan ->name('admin.') agar semua route di dalam group otomatis berawalan 'admin.'
    Route::middleware('isAdmin')->prefix('admin')->name('admin.')->group(function () {
        
        // Dashboard Utama Admin
        Route::get('/dashboard', [ReservationController::class, 'adminIndex'])->name('index');
        
        /** * UPDATE STATUS & FOTO PROGRESS */
        Route::patch('/reservation/{id}', [ReservationController::class, 'updateStatus'])->name('update');
        
        // Hapus Data Reservasi (Database & File Storage)
        Route::delete('/reservation/{id}', [ReservationController::class, 'destroy'])->name('destroy');

        // CRUD Jenis Layanan & Kuota
        Route::post('/services', [ReservationController::class, 'storeService'])->name('services.store');
        Route::patch('/services/{id}', [ReservationController::class, 'updateService'])->name('services.update');
        Route::delete('/services/{id}', [ReservationController::class, 'destroyService'])->name('services.destroy');

        /** * MANAJEMEN PORTOFOLIO */
        Route::post('/portfolio', [ReservationController::class, 'storePortfolio'])->name('portfolio.store');
        Route::delete('/portfolio/{id}', [ReservationController::class, 'destroyPortfolio'])->name('portfolio.destroy');

        /** * MANAJEMEN PENGELUARAN/BIAYA */
        Route::post('/expenses', [ReservationController::class, 'storeExpense'])->name('expenses.store');
        Route::delete('/expenses/{id}', [ReservationController::class, 'destroyExpense'])->name('expenses.destroy');
    });

    // --- HALAMAN OWNER (Akses: Owner) ---
    Route::middleware('isOwner')->prefix('owner')->group(function () {
        
        // Dashboard Khusus Owner (Menampilkan Statistik & Grafik)
        Route::get('/dashboard', [ReservationController::class, 'ownerDashboard'])->name('owner.index');
        
        /** * FITUR LAPORAN OTOMATIS (Sesuai Permintaan Dosen) 
         * Menggunakan LaporanController
         */
        Route::get('/laporan', [LaporanController::class, 'index'])->name('owner.laporan.index');
        Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('owner.laporan.cetak');
        
        /**
         * LEGACY PDF (Tombol PDF Merah di dashboard tetap berfungsi)
         */
        Route::get('/download-pdf', [ReservationController::class, 'downloadPDF'])->name('owner.pdf');
    });

});

/**
 * FIX GAMBAR 404 DI SERVER (RAILWAY/HOSTING)
 */
Route::get('/fix-storage', function () {
    try {
        $publicStoragePath = public_path('storage');
        
        if (is_link($publicStoragePath)) {
            unlink($publicStoragePath);
        } elseif (file_exists($publicStoragePath)) {
            exec('rm -rf ' . escapeshellarg($publicStoragePath));
        }
        
        Artisan::call('storage:link');
        
        return "Berhasil! Storage link telah diperbarui. Silakan cek gambar kembali.";
    } catch (\Exception $e) {
        return "Gagal: " . $e->getMessage();
    }
});