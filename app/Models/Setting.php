<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    // Tambahkan baris di bawah ini agar kolom 'key' dan 'value' bisa diisi
    protected $fillable = ['key', 'value'];
}