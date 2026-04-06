<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Expense;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http; // Untuk Fonnte
use Midtrans\Config; // Untuk Midtrans
use Midtrans\Snap;

class ReservationController extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans dari .env
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    /**
     * INTEGRASI MIDTRANS CALLBACK
     * Menangani notifikasi otomatis dari Midtrans saat pembayaran selesai
     */
    public function callback(Request $request)
    {
        // Ambil Server Key dari config atau .env
        $serverKey = env('MIDTRANS_SERVER_KEY');
        
        // Buat Signature Key untuk memverifikasi bahwa data asli dari Midtrans
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            // Jika status transaksi adalah settlement (berhasil) atau capture (kartu kredit)
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                
                // Cari data reservasi berdasarkan Order ID yang dikirim Midtrans
                // Contoh order_id: NC-5-1775435253, kita ambil ID aslinya (angka 5)
                $orderParts = explode('-', $request->order_id);
                $reservationId = $orderParts[1] ?? null;

                $order = Reservation::find($reservationId);
                
                if ($order) {
                    $order->update([
                        'status_pembayaran' => 'Paid' // Pastikan nama kolom di database Anda 'status_pembayaran'
                    ]);
                    return response()->json(['status' => 'OK'], 200);
                }
            }
        }

        return response()->json(['status' => 'Signature Invalid'], 403);
    }

    // --- HALAMAN PELANGGAN ---

    public function index()
    {
        $services = Service::all();
        $latest_reservation = Reservation::whereNotNull('photo_before')
                                        ->latest()
                                        ->first();

        return view('reservasi.index', compact('services', 'latest_reservation'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan'    => 'required|string|max:255',
            'nomor_wa'          => 'required|string|max:20',
            'service_id'        => 'required|exists:services,id',
            'jumlah_sepatu'     => 'required|integer|min:1',
            'tipe_pengiriman'   => 'required|in:antar_sendiri,antar_jemput',
            'alamat'            => 'required_if:tipe_pengiriman,antar_jemput',
        ]);

        $service = Service::findOrFail($request->service_id);
        $tanggal = $request->tanggal_reservasi ?? Carbon::today()->format('Y-m-d');

        // Cek Kuota
        $totalSepatuTerdaftar = Reservation::where('tanggal_reservasi', $tanggal)
                                            ->where('status', '!=', 'batal')
                                            ->sum('jumlah_sepatu');

        if (($totalSepatuTerdaftar + $request->jumlah_sepatu) > $service->kuota) {
            return redirect()->back()
                ->with('error', 'Maaf, kuota penuh. Sisa: ' . ($service->kuota - $totalSepatuTerdaftar))
                ->withInput();
        }

        $biayaAntarJemput = ($request->tipe_pengiriman == 'antar_jemput') ? 5000 : 0;
        $totalHarga = ($request->jumlah_sepatu * $service->harga) + $biayaAntarJemput;

        try {
            // Simpan Data
            $reservasi = Reservation::create([
                'nama_pelanggan'    => $request->nama_pelanggan,
                'nomor_wa'          => $request->nomor_wa,
                'service_id'        => $request->service_id,
                'jenis_layanan'     => $service->nama_layanan,
                'jumlah_sepatu'     => $request->jumlah_sepatu,
                'tanggal_reservasi' => $tanggal,
                'tipe_pengiriman'   => $request->tipe_pengiriman,
                'biaya_antar_jemput'=> $biayaAntarJemput,
                'alamat'            => $request->alamat,
                'total_harga'       => $totalHarga,
                'status'            => 'pending',
                'status_pembayaran' => 'unpaid',
            ]);

            // Integrasi Midtrans
            $params = [
                'transaction_details' => [
                    'order_id' => 'NC-' . $reservasi->id . '-' . time(),
                    'gross_amount' => (int)$totalHarga,
                ],
                'customer_details' => [
                    'first_name' => $request->nama_pelanggan,
                    'phone' => $request->nomor_wa,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            return view('pembayaran', compact('snapToken', 'reservasi'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal: ' . $e->getMessage())->withInput();
        }
    }

    // --- HALAMAN ADMIN ---

    public function updateStatus(Request $request, $id)
    {
        $res = Reservation::findOrFail($id);
        $oldStatus = $res->status;

        if ($request->has('status')) {
            $res->status = $request->status;
        }

        if ($request->hasFile('photo_before')) {
            if ($res->photo_before) Storage::disk('public')->delete($res->photo_before);
            $res->photo_before = $request->file('photo_before')->store('progress', 'public');
        }

        if ($request->hasFile('photo_after')) {
            if ($res->photo_after) Storage::disk('public')->delete($res->photo_after);
            $res->photo_after = $request->file('photo_after')->store('progress', 'public');
        }

        $res->save();

        if ($oldStatus !== 'selesai' && $res->status === 'selesai') {
            $this->sendWhatsappFonnte($res);
        }

        return redirect()->back()->with('success', 'Status & Foto berhasil diperbarui!');
    }

    private function sendWhatsappFonnte($res)
    {
        $token = env('FONNTE_TOKEN');
        $message = "Halo *{$res->nama_pelanggan}*,\n\nSepatu Anda dengan nomor antrian *#{$res->id}* telah *SELESAI* ✨\n\nSilakan diambil di workshop kami.\n\nTerima kasih!";

        Http::withHeaders([
            'Authorization' => $token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $res->nomor_wa,
            'message' => $message,
        ]);
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate(['rating' => 'required|integer|min:1|max:5', 'testimoni' => 'required|string|max:500']);
        $res = Reservation::findOrFail($id);
        if ($res->status !== 'selesai') return redirect()->back()->with('error', 'Belum selesai.');
        if ($res->rating) return redirect()->back()->with('error', 'Sudah memberi ulasan.');
        $res->update(['rating' => $request->rating, 'testimoni' => $request->testimoni]);
        return redirect()->back()->with('success', 'Terima kasih!');
    }

    public function adminIndex()
    {
        $reservations = Reservation::with('service')->orderBy('created_at', 'desc')->get();
        $services = Service::all(); 
        return view('reservasi.admin', compact('reservations', 'services'));
    }

    public function destroy($id)
    {
        $res = Reservation::findOrFail($id);
        if($res->photo_before) Storage::disk('public')->delete($res->photo_before);
        if($res->photo_after) Storage::disk('public')->delete($res->photo_after);
        $res->delete();
        return redirect()->back()->with('success', 'Data dihapus.');
    }

    public function storeService(Request $request) { Service::create($request->all()); return redirect()->back()->with('success', 'Layanan ditambah!'); }
    public function updateService(Request $request, $id) { $service = Service::findOrFail($id); $service->update($request->all()); return redirect()->back()->with('success', 'Layanan diupdate!'); }
    public function destroyService($id) { Service::destroy($id); return redirect()->back()->with('success', 'Layanan dihapus.'); }

    public function storeExpense(Request $request)
    {
        $request->validate(['nama_pengeluaran' => 'required', 'jumlah' => 'required|numeric', 'tanggal' => 'required']);
        Expense::create($request->all());
        return redirect()->back()->with('success', 'Pengeluaran dicatat!');
    }

    public function ownerDashboard()
    {
        $totalPendapatan = Reservation::where('status', 'selesai')->sum('total_harga');
        $totalPengeluaran = Expense::sum('jumlah');
        $keuntunganBersih = $totalPendapatan - $totalPengeluaran;
        $totalSepatu = Reservation::where('status', 'selesai')->sum('jumlah_sepatu');
        $statusPending = Reservation::where('status', 'pending')->count();
        $statusProses = Reservation::where('status', 'proses')->count();
        $statusSelesai = Reservation::where('status', 'selesai')->count();
        $latestTransactions = Reservation::with('service')->latest()->take(5)->get();
        $latestExpenses = Expense::latest()->take(5)->get();

        $chartData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::today()->subDays($i)->format('Y-m-d');
            $daily = Reservation::whereDate('created_at', $date)->where('status', 'selesai')->pluck('total_harga');
            $chartData[] = [
                'x' => $date,
                'y' => [$daily->first() ?? 0, $daily->max() ?? 0, $daily->min() ?? 0, $daily->last() ?? 0]
            ];
        }

        return view('reservasi.owner', compact('totalPendapatan', 'totalPengeluaran', 'keuntunganBersih', 'totalSepatu', 'statusPending', 'statusProses', 'statusSelesai', 'latestTransactions', 'latestExpenses', 'chartData'));
    }

    public function downloadPDF()
    {
        $reservations = Reservation::with('service')->get();
        $pdf = Pdf::loadView('reservasi.pdf', [
            'reservations' => $reservations,
            'totalOmzet' => $reservations->where('status', 'selesai')->sum('total_harga'),
            'totalPengeluaran' => Expense::sum('jumlah'),
            'keuntunganBersih' => $reservations->where('status', 'selesai')->sum('total_harga') - Expense::sum('jumlah'),
            'date' => Carbon::now()->format('d/m/Y')
        ]);
        return $pdf->download('Laporan-Nature-Clean.pdf');
    }

    public function searchStatus(Request $request)
    {
        $reservation = null;
        if ($request->filled('search')) {
            $reservation = Reservation::where('nomor_wa', $request->search)->orderBy('created_at', 'desc')->first();
        }
        return view('reservasi.check-status', compact('reservation'));
    }
}