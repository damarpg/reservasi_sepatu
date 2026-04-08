<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'portfolios';

    /**
     * Kolom yang boleh diisi secara massal.
     * UPDATE: Mengganti 'foto' menjadi 'gambar' sesuai dengan struktur database kamu.
     */
    protected $fillable = [
        'gambar', 
        'judul', 
        'deskripsi'
    ];
}