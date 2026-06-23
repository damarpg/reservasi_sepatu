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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengeluaran'); // Contoh: Beli Sabun, Bayar Listrik
            $table->integer('jumlah');          // Nominal uang
            $table->date('tanggal')->useCurrent(); // Kapan pengeluaran terjadi (otomatis tanggal hari ini jika tidak diisi)
            $table->text('keterangan')->nullable();
            $table->string('foto_nota')->nullable(); // Menyimpan path file foto nota yang diunggah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses');
    }
};