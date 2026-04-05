<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['nama_pengeluaran', 'jumlah', 'tanggal', 'keterangan'];
}
