<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Sepatu | Nature Clean</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        :root {
            --deep-brown: #533a29;
            --primary-brown: #6F4E37;
            --soft-cream: #f8f5f2;
            --warm-white: #ffffff;
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: linear-gradient(135deg, #eaddcf 0%, #d2b48c 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 20px 0;
        }

        .status-container {
            max-width: 500px;
            margin: auto;
        }

        .card-status {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(15px);
            border-radius: 40px;
            border: 1px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 25px 50px rgba(83, 58, 41, 0.15);
            overflow: hidden;
        }

        .card-header-aesthetic {
            background-color: var(--deep-brown);
            padding: 40px 20px;
            text-align: center;
            color: white;
            border-radius: 0 0 50px 50px;
        }

        .status-badge-main {
            display: inline-block;
            padding: 10px 25px;
            border-radius: 100px;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .status-pending { background: #f39c12; color: white; }
        .status-proses { background: #3498db; color: white; }
        .status-selesai { background: #27ae60; color: white; }

        .info-group {
            padding: 30px;
        }

        .detail-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(111, 78, 55, 0.1);
        }

        .detail-item:last-child { border-bottom: none; }

        .label-text {
            color: var(--primary-brown);
            font-size: 0.85rem;
            font-weight: 600;
            opacity: 0.7;
        }

        .value-text {
            color: var(--deep-brown);
            font-weight: 700;
            font-size: 1rem;
        }

        .review-box {
            background: var(--primary-brown);
            margin: 20px;
            padding: 25px;
            border-radius: 30px;
            color: white;
            box-shadow: 0 10px 20px rgba(83, 58, 41, 0.2);
        }

        .btn-review {
            background: white;
            color: var(--deep-brown);
            border: none;
            font-weight: 700;
            font-size: 1rem;
            border-radius: 15px;
            padding: 12px;
            transition: all 0.3s;
        }

        .btn-review:hover {
            transform: translateY(-3px);
            background: var(--soft-cream);
        }

        .back-nav {
            margin-top: 30px;
            text-align: center;
        }

        .back-nav a {
            color: var(--deep-brown);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .pulse-icon {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.1); opacity: 0.8; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>

<div class="container">
    <div class="status-container">
        
        @if($reservation)
        <div class="card-status animate__animated animate__fadeInUp">
            <div class="card-header-aesthetic">
                <div class="mb-3">
                    @if($reservation->status == 'pending')
                        <i class="far fa-clock fa-3x pulse-icon"></i>
                    @elseif($reservation->status == 'proses')
                        <i class="fas fa-sync fa-3x fa-spin"></i>
                    @else
                        <i class="fas fa-check-double fa-3x"></i>
                    @endif
                </div>
                <h4 class="fw-bold mb-1">Halo, {{ explode(' ', $reservation->nama_pelanggan)[0] }}!</h4>
                <p class="small opacity-75 mb-3">Pesanan #{{ $reservation->id }}</p>
                
                <div class="status-badge-main 
                    @if($reservation->status == 'pending') status-pending 
                    @elseif($reservation->status == 'proses') status-proses 
                    @else status-selesai @endif">
                    {{ strtoupper($reservation->status) }}
                </div>
            </div>

            <div class="info-group">
                <div class="detail-item">
                    <span class="label-text">LAYANAN</span>
                    <span class="value-text">{{ $reservation->jenis_layanan }}</span>
                </div>
                <div class="detail-item">
                    <span class="label-text">JUMLAH</span>
                    <span class="value-text">{{ $reservation->jumlah_sepatu }} Pasang</span>
                </div>
                <div class="detail-item">
                    <span class="label-text">TOTAL TAGIHAN</span>
                    <span class="value-text text-success">Rp {{ number_format($reservation->total_harga, 0, ',', '.') }}</span>
                </div>
                
                {{-- PERBAIKAN LOGIKA STATUS PEMBAYARAN --}}
                <div class="detail-item">
                    <span class="label-text">STATUS PEMBAYARAN</span>
                    @php
                        // Menyeragamkan pengecekan (case-insensitive)
                        $isPaid = in_array(strtolower($reservation->status_pembayaran), ['paid', 'lunas', 'success']);
                    @endphp
                    <span class="badge rounded-pill {{ $isPaid ? 'bg-success' : 'bg-danger' }}">
                        {{ $isPaid ? 'LUNAS' : 'BELUM BAYAR' }}
                    </span>
                </div>
            </div>

            <div class="px-4 pb-4 text-center">
                @if($reservation->status == 'pending')
                    <p class="text-muted small italic">"Segera antar sepatu Anda ke workshop kami untuk mulai dibersihkan."</p>
                @elseif($reservation->status == 'proses')
                    <p class="text-muted small italic">"Sepatu Anda sedang diproses dengan teliti oleh tim ahli kami."</p>
                @elseif($reservation->status == 'selesai')
                    <p class="text-success small fw-bold">"Sepatu Anda sudah bersih mengkilap dan siap dijemput!"</p>
                @endif
            </div>

            {{-- FORM TESTIMONI --}}
            @if($reservation->status == 'selesai' && !$reservation->testimoni)
                <div class="review-box animate__animated animate__pulse animate__infinite">
                    <h6 class="fw-bold text-center mb-3 text-white">Bagaimana hasil cuci kami?</h6>
                    <form action="{{ route('reservasi.review', $reservation->id) }}" method="POST">
                        @csrf
                        <div class="mb-2">
                            <label class="small mb-1 fw-bold opacity-75">Rating Bintang:</label>
                            <select name="rating" class="form-select border-0 shadow-none mb-3" style="border-radius: 15px;">
                                <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                                <option value="4">⭐⭐⭐⭐ Puas</option>
                                <option value="3">⭐⭐⭐ Cukup</option>
                                <option value="2">⭐⭐ Kurang</option>
                                <option value="1">⭐ Buruk</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1 fw-bold opacity-75">Pesan / Kesan:</label>
                            <textarea name="testimoni" class="form-control border-0 shadow-none" 
                                      style="border-radius: 15px;" rows="3" 
                                      placeholder="Berikan ulasan Anda..." required></textarea>
                        </div>
                        <button type="submit" class="btn btn-review w-100">Kirim Testimoni</button>
                    </form>
                </div>
            @elseif($reservation->testimoni)
                <div class="px-4 pb-4 text-center">
                    <div class="p-3 bg-light rounded-4 border">
                        <p class="mb-1 small fw-bold" style="color: var(--primary-brown)">Testimoni Anda:</p>
                        <p class="small italic text-muted mb-0">"{{ $reservation->testimoni }}"</p>
                        <div class="mt-2">
                            @for($i=1; $i<=$reservation->rating; $i++) ⭐ @endfor
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @else
        <div class="card-status p-5 text-center">
            <i class="fas fa-search fa-4x mb-4 text-muted opacity-25"></i>
            <h5 class="fw-bold">Pesanan Tidak Ditemukan</h5>
            <p class="text-muted">Nomor WA atau ID tidak terdaftar.</p>
            <a href="{{ route('reservasi.index') }}" class="btn text-white mt-3" style="background: var(--primary-brown); border-radius: 15px;">Kembali</a>
        </div>
        @endif

        <div class="back-nav">
            <a href="{{ route('reservasi.index') }}">
                <i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>