<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation; 
use App\Models\User;        
use App\Models\Expense;     // Pastikan model Expense sudah ada
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    /**
     * Menampilkan halaman dashboard owner/laporan
     * File owner.blade.php berada di folder resources/views/reservasi/
     */
    public function index()
    {
        return view('reservasi.owner');
    }

    /**
     * Logic Cetak Laporan Otomatis
     */
    public function cetak(Request $request)
    {
        $kategori = $request->kategori; // pemasukan, pengeluaran, pelanggan
        $filter = $request->filter;     // harian, mingguan, bulanan, semua
        
        // 1. Tentukan Model dan Judul berdasarkan Kategori
        if ($kategori == 'pemasukan') {
            // Mengambil data reservasi (biasanya yang sudah lunas/paid)
            $query = Reservation::query();
            $judul = "Laporan Pemasukan (Omzet)";
            
        } elseif ($kategori == 'pelanggan') {
            /** * KHUSUS PELANGGAN: Karena tidak ada login, diambil data unik 
             * dari tabel reservations berdasarkan nama_pelanggan dan nomor_wa.
             */
            $query = Reservation::select('nama_pelanggan', 'nomor_wa', DB::raw('MAX(created_at) as created_at'))
                        ->groupBy('nama_pelanggan', 'nomor_wa');
            $judul = "Laporan Database Pelanggan";
            
        } else {
            // Kategori Pengeluaran
            $query = Expense::query();
            $judul = "Laporan Pengeluaran Operasional";
        }

        // 2. Terapkan Filter Waktu (Kecuali jika filter adalah 'semua')
        if ($filter !== 'semua') {
            $dateColumn = ($kategori == 'pengeluaran') ? 'tanggal' : 'created_at';

            if ($filter == 'harian') {
                $query->whereDate($dateColumn, Carbon::today());
            } elseif ($filter == 'mingguan') {
                $query->whereBetween($dateColumn, [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } elseif ($filter == 'bulanan') {
                $query->whereMonth($dateColumn, Carbon::now()->month)
                      ->whereYear($dateColumn, Carbon::now()->year);
            }
        }

        // 3. Eksekusi Query
        // Menggunakan kolom created_at untuk mengurutkan data terbaru
        $data = $query->orderBy('created_at', 'desc')->get();

        // 4. Kirim ke View (Folder: reservasi, File: pdf.blade.php)
        return view('reservasi.pdf', compact('data', 'judul', 'kategori', 'filter'));
    }
}