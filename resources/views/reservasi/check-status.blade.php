<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Status | Nature Clean</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f8f5f2; }
        .card-search { border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .btn-brown { background-color: #6F4E37; color: white; border-radius: 10px; border: none; }
        .btn-brown:hover { background-color: #533a29; color: white; }
        .status-box { padding: 25px; border-radius: 15px; background-color: white; border-left: 5px solid #6F4E37; }
        .review-section { background-color: #fffaf5; border-radius: 15px; padding: 20px; border: 1px dashed #6F4E37; }
        .text-brown { color: #6F4E37; }
    </style>
</head>
<body>

<div class="container mt-5 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="text-center mb-4">
                <h3 class="fw-bold" style="color: #6F4E37;">Tracking Pesanan</h3>
                <p class="text-muted">Masukkan nomor WhatsApp untuk cek status sepatu Anda</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm mb-4">{{ session('error') }}</div>
            @endif

            <div class="card card-search p-4 mb-4">
                <form action="{{ route('reservasi.status') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Contoh: 081234567xxx" value="{{ request('search') }}" required>
                        <button class="btn btn-brown px-4" type="submit">Cari</button>
                    </div>
                </form>
            </div>

            @if(request('search'))
                @if($reservation)
                    <div class="status-box shadow-sm mb-4 animate__animated animate__fadeIn">
                        <h5 class="fw-bold mb-3">Halo, {{ $reservation->nama_pelanggan }}!</h5>
                        
                        <div class="row small text-muted mb-2">
                            <div class="col-6">ID Pesanan:</div>
                            <div class="col-6 text-end fw-bold text-dark">#{{ $reservation->id }}</div>
                        </div>
                        <div class="row small text-muted mb-2">
                            <div class="col-6">Layanan:</div>
                            <div class="col-6 text-end fw-bold text-dark">{{ $reservation->jenis_layanan }} ({{ $reservation->jumlah_sepatu }} Pasang)</div>
                        </div>
                        <div class="row small text-muted mb-2">
                            <div class="col-6">Total Harga:</div>
                            <div class="col-6 text-end fw-bold text-success">Rp {{ number_format($reservation->total_harga, 0, ',', '.') }}</div>
                        </div>
                        
                        <hr>
                        
                        <div class="text-center py-2">
                            <p class="mb-1 small text-muted">Status Saat Ini:</p>
                            <h4 class="fw-bold text-uppercase" style="color: #6F4E37;">
                                @if($reservation->status == 'pending') 🕒 PENDING
                                @elseif($reservation->status == 'proses') ⚡ PROSES
                                @elseif($reservation->status == 'selesai') ✅ SELESAI
                                @else ❌ BATAL
                                @endif
                            </h4>
                            
                            @if($reservation->status == 'pending')
                                <p class="small text-muted mt-2"><i class="fas fa-info-circle me-1"></i> Mohon antar sepatu Anda ke workshop kami agar segera diproses.</p>
                            @elseif($reservation->status == 'proses')
                                <p class="small text-muted mt-2"><i class="fas fa-spinner fa-spin me-1"></i> Sepatu Anda sedang dikerjakan dengan hati-hati oleh tim kami.</p>
                            @elseif($reservation->status == 'selesai')
                                <p class="small text-success mt-2 fw-bold"><i class="fas fa-check-circle me-1"></i> Sepatu Anda sudah bersih mengkilap dan siap diambil!</p>
                            @endif
                        </div>
                    </div>

                    @if($reservation->status == 'selesai')
                        <div class="review-section shadow-sm animate__animated animate__fadeInUp">
                            <h6 class="fw-bold text-brown mb-3 text-center"><i class="fas fa-star me-2"></i>Berikan Ulasan Anda</h6>
                            
                            @if($reservation->rating)
                                <div class="text-center">
                                    <div class="mb-2">
                                        @for($i=1; $i<=5; $i++)
                                            <i class="fas fa-star {{ $i <= $reservation->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="small fst-italic text-muted">"{{ $reservation->testimoni }}"</p>
                                    <span class="badge bg-success small" style="font-size: 0.7rem;">Terima kasih atas ulasannya!</span>
                                </div>
                            @else
                                <form action="{{ route('reservasi.review', $reservation->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Seberapa puas Anda?</label>
                                        <select name="rating" class="form-select form-select-sm" required>
                                            <option value="5">⭐⭐⭐⭐⭐ Sangat Puas</option>
                                            <option value="4">⭐⭐⭐⭐ Puas</option>
                                            <option value="3">⭐⭐⭐ Cukup</option>
                                            <option value="2">⭐⭐ Kurang</option>
                                            <option value="1">⭐ Buruk</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold">Tulis Komentar</label>
                                        <textarea name="testimoni" class="form-control form-control-sm" rows="3" placeholder="Contoh: Sepatu jadi seperti baru lagi! Terima kasih Nature Clean..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-brown w-100 fw-bold btn-sm py-2">Kirim Ulasan</button>
                                </form>
                            @endif
                        </div>
                    @endif

                @else
                    <div class="alert alert-warning text-center border-0 shadow-sm">
                        <i class="fas fa-exclamation-triangle me-2"></i> Data tidak ditemukan. Pastikan nomor WhatsApp yang dimasukkan sudah benar.
                    </div>
                @endif
            @endif

            <div class="text-center mt-4">
                <a href="{{ route('reservasi.index') }}" class="text-decoration-none text-muted small"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>