<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | Nature Clean</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #F8F5F2; color: #444; }
        .pay-card { border: none; border-radius: 25px; box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
        .btn-pay { background-color: #6F4E37; color: white; border-radius: 50px; padding: 12px 30px; font-weight: 600; transition: 0.3s; border: none; width: 100%; }
        .btn-pay:hover { background-color: #A67B5B; color: white; transform: translateY(-3px); }
        .item-detail { background: #fff; border-radius: 15px; padding: 20px; border: 1px dashed #A67B5B; }
        .text-brown { color: #6F4E37; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <h3 class="fw-bold text-brown">Satu Langkah Lagi!</h3>
                <p class="text-muted">Selesaikan pembayaran untuk mengonfirmasi pesanan Anda.</p>
            </div>

            <div class="card pay-card p-4">
                <div class="item-detail mb-4">
                    <h6 class="fw-bold mb-3 border-bottom pb-2">Ringkasan Pesanan</h6>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Pelanggan:</span>
                        <span class="fw-bold">{{ $reservasi->nama_pelanggan }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Layanan:</span>
                        <span class="fw-bold">{{ $reservasi->service->nama_layanan ?? $reservasi->jenis_layanan }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Jumlah:</span>
                        <span class="fw-bold">{{ $reservasi->jumlah_sepatu }} Pasang</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">Total Bayar:</span>
                        <h4 class="fw-bold text-brown mb-0">Rp {{ number_format($reservasi->total_harga, 0, ',', '.') }}</h4>
                    </div>
                </div>

                <button id="pay-button" class="btn-pay shadow">
                    BAYAR SEKARANG
                </button>
                
                <p class="text-center mt-3 small text-muted">
                    <i class="fas fa-lock me-1"></i> Pembayaran Aman via Midtrans
                </p>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ url('/') }}" class="text-decoration-none text-muted small">← Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        // SnapToken dikirim dari Controller
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("Pembayaran berhasil!"); 
                console.log(result);
                // Menggunakan url('/') agar Laravel mengarahkan ke halaman depan project dengan benar
                window.location.href = "{{ url('/') }}"; 
            },
            onPending: function(result){
                alert("Menunggu pembayaran Anda!"); 
                console.log(result);
                window.location.href = "{{ url('/') }}";
            },
            onError: function(result){
                alert("Pembayaran gagal!"); 
                console.log(result);
                window.location.href = "{{ url('/') }}";
            },
            onClose: function(){
                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
            }
        });
    });
</script>

</body>
</html>