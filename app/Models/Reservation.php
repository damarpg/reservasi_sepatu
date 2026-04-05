<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pelanggan',
        'nomor_wa',
        'service_id',
        'jenis_layanan',
        'jumlah_sepatu',
        'tanggal_reservasi',
        'tipe_pengiriman',
        'alamat',
        'biaya_antar_jemput',
        'total_harga',
        'status',
        'photo_before',
        'photo_after',
        'status_pembayaran',
        'snap_token', // <--- Tambahkan ini
        'rating',
        'testimoni',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}