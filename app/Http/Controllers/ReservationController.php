<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Expense;
use App\Models\Portfolio; 
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http; 
use Midtrans\Config; 
use Midtrans\Snap;

class ReservationController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function callback(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                $orderParts = explode('-', $request->order_id);
                $reservationId = $orderParts[1] ?? null;

                $order = Reservation::find($reservationId);
                if ($order && $order->status_pembayaran !== 'Paid') {
                    $order->update(['status_pembayaran' => 'Paid']);
                }
                return response()->json(['status' => 'OK'], 200);
            }
        }
        return response()->json(['status' => 'Signature Invalid'], 403);
    }

    public function index()
    {
        $services = Service::all();
        $portfolios = Portfolio::latest()->get(); 
        $latest_reservation = Reservation::whereNotNull('photo_before')->latest()->first();
        
        return view('reservasi.index', compact('services', 'latest_reservation', 'portfolios'));
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

        if ($service->kuota < $request->jumlah_sepatu) {
            return redirect()->back()->with('error', 'Maaf, kuota tidak mencukupi. Sisa: ' . $service->kuota)->withInput();
        }

        $biayaAntarJemput = ($request->tipe_pengiriman == 'antar_jemput') ? 5000 : 0;
        $totalHarga = ($request->jumlah_sepatu * $service->harga) + $biayaAntarJemput;

        try {
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

            $service->decrement('kuota', $request->jumlah_sepatu);

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

    public function adminIndex()
    {
        $reservations = Reservation::with('service')->orderBy('created_at', 'desc')->get();
        $services = Service::all(); 
        $portfolios = Portfolio::latest()->get(); 
        
        return view('reservasi.admin', compact('reservations', 'services', 'portfolios'));
    }

    public function updateStatus(Request $request, $id)
    {
        $res = Reservation::findOrFail($id);
        $oldStatus = $res->status;

        if ($request->has('status')) $res->status = $request->status;

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

        return redirect()->back()->with('success', 'Status & Foto diperbarui!');
    }

    public function storePortfolio(Request $request)
    {
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('portfolio', 'public');
            Portfolio::create([
                'judul' => $request->judul,
                'gambar' => $path,
            ]);
            return redirect()->back()->with('success', 'Foto portfolio keren berhasil ditambah!');
        }

        return redirect()->back()->with('error', 'Gagal mengunggah gambar.');
    }

    public function destroyPortfolio($id)
    {
        $item = Portfolio::findOrFail($id);
        if ($item->gambar) {
            Storage::disk('public')->delete($item->gambar);
        }
        $item->delete();

        return redirect()->back()->with('success', 'Foto portfolio telah dihapus.');
    }

    private function sendWhatsappFonnte($res)
    {
        $token = env('FONNTE_TOKEN');
        $target = preg_replace('/[^0-9]/', '', $res->nomor_wa);
        $message = "Halo *{$res->nama_pelanggan}*,\n\nSepatu Anda *#{$res->id}* telah *SELESAI* ✨\n\nSilakan diambil. Terima kasih!";

        try {
            Http::withHeaders(['Authorization' => $token])->post('https://api.fonnte.com/send', [
                'target' => $target,
                'message' => $message,
            ]);
        } catch (\Exception $e) {
            \Log::error('Fonnte Error: ' . $e->getMessage());
        }
    }

    public function storeReview(Request $request, $id)
    {
        $request->validate(['rating' => 'required|integer|min:1|max:5', 'testimoni' => 'required|string|max:500']);
        $res = Reservation::findOrFail($id);
        if ($res->status !== 'selesai' || $res->rating) return redirect()->back()->with('error', 'Gagal kirim ulasan.');
        $res->update(['rating' => $request->rating, 'testimoni' => $request->testimoni]);
        return redirect()->back()->with('success', 'Terima kasih!');
    }

    public function destroy($id)
    {
        $res = Reservation::findOrFail($id);
        if ($res->service) $res->service->increment('kuota', $res->jumlah_sepatu);
        if($res->photo_before) Storage::disk('public')->delete($res->photo_before);
        if($res->photo_after) Storage::disk('public')->delete($res->photo_after);
        $res->delete();
        return redirect()->back()->with('success', 'Data dihapus.');
    }

    public function storeService(Request $request) { Service::create($request->all()); return redirect()->back()->with('success', 'Layanan ditambah!'); }
    public function updateService(Request $request, $id) { Service::findOrFail($id)->update($request->all()); return redirect()->back()->with('success', 'Layanan diupdate!'); }
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
        $totalOmzet = $reservations->where('status', 'selesai')->sum('total_harga');
        $totalPengeluaran = Expense::sum('jumlah');
        $keuntunganBersih = $totalOmzet - $totalPengeluaran;

        $pdf = Pdf::loadView('reservasi.pdf', [
            'reservations' => $reservations,
            'total' => $totalOmzet,
            'totalPengeluaran' => $totalPengeluaran,
            'keuntunganBersih' => $keuntunganBersih,
            'date' => Carbon::now()->format('d/m/Y')
        ])->setOptions([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true 
        ]);

        return $pdf->download('Laporan-Nature-Clean-'.date('Y-m-d').'.pdf');
    }

    /**
     * PERBAIKAN FINAL SEARCH STATUS
     */
    public function searchStatus(Request $request)
    {
        // Gunakan 'search' karena di file Blade kamu name input-nya adalah "search"
        $keyword = $request->input('search');

        // Cari pesanan berdasarkan nomor WA, ambil yang paling baru
        $reservation = null;
        if ($keyword) {
            $reservation = Reservation::where('nomor_wa', $keyword)
                            ->with('service')
                            ->latest()
                            ->first();
        }
        
        // Kirim $reservation ke view (satuan, sesuai kebutuhan if($reservation) di Blade kamu)
        return view('reservasi.check-status', compact('reservation'));
    }
}