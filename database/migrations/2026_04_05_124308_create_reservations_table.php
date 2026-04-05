<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan');
            $table->string('nomor_wa');
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('set null');
            $table->string('jenis_layanan');
            $table->integer('jumlah_sepatu');
            $table->date('tanggal_reservasi');
            $table->string('tipe_pengiriman'); 
            $table->text('alamat')->nullable();
            $table->integer('biaya_antar_jemput')->default(0);
            $table->integer('total_harga');
            $table->string('status')->default('pending'); // pending, proses, selesai, batal
            
            // --- Kolom Fitur Before & After ---
            $table->string('photo_before')->nullable();
            $table->string('photo_after')->nullable();

            // --- Kolom Tambahan Integrasi Midtrans ---
            $table->string('status_pembayaran')->default('unpaid'); // unpaid, paid, expired, failed
            $table->string('snap_token')->nullable(); // Menyimpan token dari Midtrans
            
            // --- Fitur Rating & Testimoni (Agar tidak error saat diakses di Controller) ---
            $table->integer('rating')->nullable();
            $table->text('testimoni')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};