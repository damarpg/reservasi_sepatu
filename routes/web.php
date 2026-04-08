<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes - Nature Clean Shoes
|--------------------------------------------------------------------------
*/

// --- HALAMAN PELANGGAN (Akses Publik) ---
Route::get('/', [ReservationController::class, 'index'])->name('reservasi.index');
Route::post('/reservasi/store', [ReservationController::class, 'store'])->name('reservasi.store');

/** * FITUR TRACKING (CEK STATUS)
 * Menggunakan nama 'reservasi.status' agar sinkron dengan form di index.blade.php
 */
Route::get('/cek-status', [ReservationController::class, 'searchStatus'])->name('reservasi.status');
// Alias 'reservasi.track' tetap disediakan jika ada bagian kode lain yang memanggilnya
Route::get('/lacak-pesanan', [ReservationController::class, 'searchStatus'])->name('reservasi.track');

/** * FITUR RATING & TESTIMONI
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

    // --- HALAMAN ADMIN (Akses: Admin & Owner) ---
    Route::middleware('isAdmin')->prefix('admin')->group(function () {
        
        // Dashboard Utama Admin
        Route::get('/dashboard', [ReservationController::class, 'adminIndex'])->name('admin.index');
        
        /** * UPDATE STATUS & FOTO PROGRESS  */
        Route::patch('/reservation/{id}', [ReservationController::class, 'updateStatus'])->name('admin.update');
        
        // Hapus Data Reservasi (Database & File Storage)
        Route::delete('/reservation/{id}', [ReservationController::class, 'destroy'])->name('admin.destroy');

        // CRUD Jenis Layanan & Kuota
        Route::post('/services', [ReservationController::class, 'storeService'])->name('admin.services.store');
        Route::patch('/services/{id}', [ReservationController::class, 'updateService'])->name('admin.services.update');
        Route::delete('/services/{id}', [ReservationController::class, 'destroyService'])->name('admin.services.destroy');

        /** * MANAJEMEN PORTOFOLIO */
        Route::post('/portfolio', [ReservationController::class, 'storePortfolio'])->name('admin.portfolio.store');
        Route::delete('/portfolio/{id}', [ReservationController::class, 'destroyPortfolio'])->name('admin.portfolio.destroy');
    });

    // --- HALAMAN OWNER (Akses Khusus: Owner Saja) ---
    Route::middleware('isOwner')->prefix('owner')->group(function () {
        
        // Dashboard Khusus Owner (Laporan Keuangan & Grafik)
        Route::get('/dashboard', [ReservationController::class, 'ownerDashboard'])->name('owner.index');
        
        /** * MANAJEMEN PENGELUARAN */
        Route::post('/expense', [ReservationController::class, 'storeExpense'])->name('owner.storeExpense');
        
        // Fitur ekspor laporan ke PDF (Mencakup Omzet & Pengeluaran)
        Route::get('/download-pdf', [ReservationController::class, 'downloadPDF'])->name('owner.pdf');
    });

});