<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature Clean | Premium Shoe Treatment</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root { --primary-brown: #6F4E37; --secondary-brown: #A67B5B; --bg-light: #F8F5F2; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-light); color: #444; scroll-behavior: smooth; }
        
        /* --- HERO & HEADER STYLING --- */
        .navbar { 
            background: rgba(255, 255, 255, 0.9) !important; 
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(111, 78, 55, 0.1); 
            padding: 15px 0; 
        }
        .text-brown { color: var(--primary-brown); }
        .btn-brown { background-color: var(--primary-brown); color: white; border: none; transition: 0.3s; }
        .btn-brown:hover { background-color: var(--secondary-brown); color: white; transform: translateY(-2px); }
        
        .hero-section {
            background: linear-gradient(135deg, #fdfaf8 0%, #ede0d4 100%);
            padding: 120px 0 80px 0;
            border-radius: 0 0 50px 50px;
            position: relative;
            overflow: hidden;
        }
        .hero-section::after {
            content: ''; position: absolute; top: -10%; right: -5%; width: 300px; height: 300px;
            background: rgba(111, 78, 55, 0.05); border-radius: 50%; z-index: 0;
        }
        .hero-title { font-size: 3.8rem; font-weight: 800; line-height: 1.1; color: #3d2b1f; margin-bottom: 20px; }
        .hero-subtitle { font-size: 1.1rem; color: #6c757d; max-width: 500px; margin-bottom: 35px; }
        .badge-premium { 
            background: var(--secondary-brown); color: white; padding: 6px 16px; 
            border-radius: 50px; font-size: 0.75rem; font-weight: 600; letter-spacing: 1px;
            display: inline-block; margin-bottom: 20px; 
        }
        .floating-img { 
            animation: floating 4s ease-in-out infinite; 
            border: 12px solid #fff; box-shadow: 0 30px 60px rgba(0,0,0,0.1);
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Slider Fix */
        .ba-wrapper {
            position: relative; width: 100%; max-width: 700px; height: 450px;
            margin: 0 auto; border-radius: 25px; overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15); border: 8px solid #fff; user-select: none;
        }
        .ba-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; display: block; pointer-events: none; }
        .ba-before { width: 50%; z-index: 2; border-right: 3px solid #fff; overflow: hidden; }
        .ba-before img { height: 450px; object-fit: cover; max-width: none; }
        .ba-after { z-index: 1; }
        .ba-input {
            position: absolute; -webkit-appearance: none; appearance: none; width: 100%; height: 100%;
            background: transparent; outline: none; margin: 0; z-index: 10; cursor: ew-resize; top: 0; left: 0;
        }
        .ba-input::-webkit-slider-thumb {
            -webkit-appearance: none; width: 40px; height: 40px; background: var(--primary-brown);
            border: 4px solid #fff; border-radius: 50%; cursor: ew-resize; box-shadow: 0 0 15px rgba(0,0,0,0.4);
        }
        .label-float {
            position: absolute; top: 20px; padding: 5px 15px; border-radius: 50px;
            font-size: 0.75rem; font-weight: 600; color: white; z-index: 5; text-transform: uppercase; pointer-events: none;
        }
        .l-before { left: 20px; background: rgba(111, 78, 55, 0.8); }
        .l-after { right: 20px; background: rgba(25, 135, 84, 0.8); }

        /* Portfolio Gallery */
        .portfolio-item { position: relative; overflow: hidden; border-radius: 20px; height: 300px; cursor: pointer; border: 4px solid #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.05); background: #eee; }
        .portfolio-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease; filter: sepia(20%) contrast(110%); }
        .portfolio-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(111, 78, 55, 0.7); display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.4s ease; color: #fff; }
        .portfolio-item:hover img { transform: scale(1.1); filter: sepia(0%) contrast(100%); }
        .portfolio-item:hover .portfolio-overlay { opacity: 1; }

        /* Review & Cards */
        .price-card { background: #fff; border-radius: 20px; transition: 0.3s; border: none; }
        .price-card:hover { transform: translateY(-8px); }
        .card-form { border: none; border-radius: 25px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); }
        .delivery-option { cursor: pointer; border: 2px solid #e0e0e0; border-radius: 15px; padding: 15px; transition: 0.3s; display: block; }
        .form-check-input:checked + .delivery-option { border-color: var(--primary-brown); background: #fdfaf8; }
        .review-card { background: #fff; border-radius: 15px; border: none; transition: 0.3s; }
        .review-card:hover { box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }

        /* Calculator Styling */
        .calc-card { background: #fff; border-radius: 25px; border: 2px dashed var(--secondary-brown); }
        .total-box { background: var(--primary-brown); color: #fff; border-radius: 15px; padding: 15px; }

        /* Care Tips Section */
        .tip-card { background: #fff; border-radius: 20px; border: none; transition: 0.3s; height: 100%; }
        .tip-card:hover { background: var(--primary-brown); color: #fff; }
        .tip-card:hover .text-muted { color: rgba(255,255,255,0.8) !important; }
        .tip-card:hover i { color: #fff !important; }

        /* FAQ Styling */
        .accordion-item { border: none; margin-bottom: 10px; border-radius: 15px !important; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.03); }
        .accordion-button:not(.collapsed) { background-color: #fdfaf8; color: var(--primary-brown); box-shadow: none; }
        .accordion-button:focus { box-shadow: none; }

        /* Maps Styling */
        .map-container { border-radius: 25px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); border: 5px solid #fff; }

        /* Floating WA Button */
        .floating-wa {
            position: fixed; width: 60px; height: 60px; bottom: 30px; right: 30px;
            background-color: #25d366; color: #FFF; border-radius: 50px; text-align: center;
            font-size: 30px; box-shadow: 0px 5px 15px rgba(0,0,0,0.3); z-index: 1000;
            display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; text-decoration: none;
        }
        .floating-wa:hover { transform: scale(1.1); color: #fff; background-color: #128c7e; }
        .wa-tooltip {
            position: fixed; bottom: 45px; right: 100px; background: #fff; padding: 5px 15px;
            border-radius: 20px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); font-size: 0.8rem;
            font-weight: 600; color: #444; pointer-events: none; z-index: 999;
        }

        @media (max-width: 768px) { 
            .hero-title { font-size: 2.8rem; }
            .hero-section { padding: 100px 0 60px 0; text-align: center; }
            .hero-subtitle { margin: 0 auto 30px auto; }
            .ba-wrapper, .ba-before img { height: 300px; } 
            .wa-tooltip { display: none; }
            .portfolio-item { height: 200px; }
        }
    </style>
</head>
<body>

<nav class="navbar sticky-top shadow-none">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold text-brown fs-4" href="/">
            <i class="fas fa-leaf me-2"></i>NATURE<span class="fw-light">CLEAN.</span>
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('reservasi.status') }}" class="btn btn-outline-dark btn-sm rounded-pill px-3 fw-bold d-none d-md-inline-block">
                <i class="fas fa-search me-1"></i> Lacak Sepatu
            </a>
            <div class="dropdown">
                <button class="btn btn-brown btn-sm dropdown-toggle rounded-pill px-4" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i> Staff
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3">
                    <li><a class="dropdown-item small fw-bold" href="{{ route('login') }}?role=admin">Login Admin</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item small fw-bold text-brown" href="{{ route('login') }}?role=owner">Login Owner</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<header class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge-premium">PROFESSIONAL SHOE CARE</span>
                <h1 class="hero-title">Step into <br><span class="text-brown">Perfection.</span></h1>
                <p class="hero-subtitle">
                    Berikan perawatan terbaik untuk setiap langkah Anda. Kami hadir dengan teknik Deep Cleaning premium untuk mengembalikan kilau sepatu kesayangan.
                </p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                    <a href="#booking" class="btn btn-brown btn-lg px-4 rounded-pill shadow">Cuci Sekarang</a>
                    <a href="#layanan" class="btn btn-outline-dark btn-lg px-4 rounded-pill">Daftar Harga</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <img src="https://images.pexels.com/photos/1598505/pexels-photo-1598505.jpeg?auto=compress&cs=tinysrgb&w=800" 
                     alt="Nature Clean Hero" class="img-fluid rounded-4 floating-img">
            </div>
        </div>
    </div>
</header>

<div class="container mt-5">
    
    @if(isset($latest_reservation) && $latest_reservation->photo_before && $latest_reservation->photo_after)
    <div class="row text-center mb-5">
        <div class="col-12">
            <h2 class="fw-bold">Hasil Perawatan Kami</h2>
            <div class="ba-wrapper shadow mt-4">
                <span class="label-float l-before">Before</span>
                <span class="label-float l-after">After</span>
                <img src="{{ asset('storage/' . $latest_reservation->photo_after) }}" class="ba-img ba-after">
                <div class="ba-img ba-before" id="before-container">
                    <img src="{{ asset('storage/' . $latest_reservation->photo_before) }}" id="before-img">
                </div>
                <input type="range" min="0" max="100" value="50" class="ba-input" id="ba-slider">
            </div>
            <p class="mt-3 small text-brown fw-bold"><i class="fas fa-magic me-2"></i>Unit: {{ $latest_reservation->nama_pelanggan }}</p>
        </div>
    </div>
    @endif

    <div class="row text-center mb-4 mt-5">
        <div class="col-12">
            <h2 class="fw-bold">Our Portfolio</h2>
            <p class="text-muted small">Koleksi sepatu premium yang telah kami tangani.</p>
        </div>
    </div>
    <div class="row g-4 mb-5">
        <div class="col-md-4 col-6">
            <div class="portfolio-item">
                <img src="https://images.pexels.com/photos/1478442/pexels-photo-1478442.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Nike Clean">
                <div class="portfolio-overlay">
                    <i class="fas fa-soap fa-2x mb-2"></i>
                    <span class="fw-bold">Deep Cleaning</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="portfolio-item">
                <img src="https://images.pexels.com/photos/2529148/pexels-photo-2529148.jpeg?auto=compress&cs=tinysrgb&w=600" alt="White Sneakers">
                <div class="portfolio-overlay">
                    <i class="fas fa-sun fa-2x mb-2"></i>
                    <span class="fw-bold">Un-yellowing</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-6">
            <div class="portfolio-item">
                <img src="https://images.pexels.com/photos/1240892/pexels-photo-1240892.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Suede Shoes">
                <div class="portfolio-overlay">
                    <i class="fas fa-brush fa-2x mb-2"></i>
                    <span class="fw-bold">Suede Specialty</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-6 d-none d-md-block">
            <div class="portfolio-item">
                <img src="https://images.pexels.com/photos/1598505/pexels-photo-1598505.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Converse">
                <div class="portfolio-overlay">
                    <i class="fas fa-water fa-2x mb-2"></i>
                    <span class="fw-bold">Canvas Care</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-6 d-none d-md-block">
            <div class="portfolio-item">
                <img src="https://images.pexels.com/photos/298863/pexels-photo-298863.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Leather Boots">
                <div class="portfolio-overlay">
                    <i class="fas fa-sparkles fa-2x mb-2"></i>
                    <span class="fw-bold">Leather Wax</span>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-6 d-none d-md-block">
            <div class="portfolio-item">
                <img src="https://images.pexels.com/photos/1598508/pexels-photo-1598508.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Running Shoes">
                <div class="portfolio-overlay">
                    <i class="fas fa-hammer fa-2x mb-2"></i>
                    <span class="fw-bold">Reglue Service</span>
                </div>
            </div>
        </div>
    </div>

    <div id="layanan" class="row text-center mb-4 mt-5 pt-4">
        <div class="col-12">
            <h2 class="fw-bold">Daftar Harga Layanan</h2>
            <div style="width: 60px; height: 3px; background: var(--primary-brown); margin: 10px auto;"></div>
        </div>
    </div>

    <div class="row mb-4 justify-content-center">
        @foreach($services as $s)
        <div class="col-md-4 mb-4">
            <div class="card price-card p-4 text-center shadow-sm {{ $s->kuota <= 0 ? 'opacity-50' : '' }}">
                <h4 class="fw-bold">{{ $s->nama_layanan }}</h4>
                <div class="h5 fw-bold text-brown">Rp {{ number_format($s->harga, 0, ',', '.') }}</div>
                @if($s->kuota > 0)
                    <p class="text-muted small">Kuota Tersisa: <strong>{{ $s->kuota }}</strong></p>
                @else
                    <p class="text-danger small fw-bold">Kuota Habis Hari Ini</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card calc-card p-4 shadow-sm">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <h5 class="fw-bold"><i class="fas fa-calculator me-2"></i>Simulasi Biaya</h5>
                        <div class="mb-3">
                            <label class="small fw-bold">Pilih Layanan</label>
                            <select id="calc-service" class="form-select form-select-sm shadow-none border-secondary">
                                @foreach($services as $s)
                                    @if($s->kuota > 0)
                                        <option value="{{ $s->harga }}">{{ $s->nama_layanan }} - Rp {{ number_format($s->harga, 0, ',', '.') }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-2">
                            <label class="small fw-bold">Jumlah Sepatu</label>
                            <input type="number" id="calc-qty" class="form-control form-control-sm shadow-none border-secondary" value="1" min="1">
                        </div>
                    </div>
                    <div class="col-md-5 text-center mt-3 mt-md-0">
                        <div class="total-box">
                            <small class="d-block opacity-75">Estimasi Total</small>
                            <h3 class="fw-bold mb-0" id="calc-total">Rp 0</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="booking" class="row justify-content-center mb-5 pt-5">
        <div class="col-lg-7">

            @if ($errors->any())
                <div class="alert alert-danger shadow-sm border-0 mb-4" style="border-radius: 15px;">
                    <ul class="mb-0 small fw-bold">
                        @foreach ($errors->all() as $error)
                            <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger shadow-sm border-0 mb-4" style="border-radius: 15px;">
                    <p class="mb-0 small fw-bold"><i class="fas fa-exclamation-triangle me-2"></i>{{ session('error') }}</p>
                </div>
            @endif
            <div class="card card-form">
                <div class="p-4 text-center bg-dark text-white" style="border-radius: 25px 25px 0 0;">
                    <h4 class="mb-0 fw-bold">Booking Reservasi</h4>
                </div>
                <div class="card-body p-4 p-md-5">
                    @if(session('success')) 
                        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 15px;">
                            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                        </div> 
                    @endif
                    
                    <form action="{{ route('reservasi.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Nama Lengkap</label>
                            <input type="text" name="nama_pelanggan" class="form-control" value="{{ old('nama_pelanggan') }}" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">WhatsApp (Gunakan format 08/62)</label>
                            <input type="text" name="nomor_wa" class="form-control" value="{{ old('nomor_wa') }}" placeholder="Contoh: 0812..." required>
                        </div>
                        <div class="row">
                            <div class="col-md-7 mb-3">
                                <label class="form-label fw-bold small">Paket Layanan</label>
                                <select name="service_id" class="form-select" required>
                                    @foreach($services as $s)
                                        <option value="{{ $s->id }}" {{ old('service_id') == $s->id ? 'selected' : '' }} {{ $s->kuota <= 0 ? 'disabled' : '' }}>
                                            {{ $s->nama_layanan }} {{ $s->kuota <= 0 ? '(PENUH)' : '' }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label class="form-label fw-bold small">Jumlah (Pasang)</label>
                                <input type="number" name="jumlah_sepatu" class="form-control" min="1" value="{{ old('jumlah_sepatu', 1) }}">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Metode Penyerahan</label>
                            <div class="row g-2">
                                <div class="col-6">
                                    <input type="radio" class="form-check-input d-none" name="tipe_pengiriman" id="d1" value="antar_sendiri" {{ old('tipe_pengiriman', 'antar_sendiri') == 'antar_sendiri' ? 'checked' : '' }} onclick="toggleMetode('toko')">
                                    <label class="delivery-option text-center" for="d1"><i class="fas fa-store d-block mb-1"></i> <span class="small">Drop ke Toko</span></label>
                                </div>
                                <div class="col-6">
                                    <input type="radio" class="form-check-input d-none" name="tipe_pengiriman" id="d2" value="antar_jemput" {{ old('tipe_pengiriman') == 'antar_jemput' ? 'checked' : '' }} onclick="toggleMetode('jemput')">
                                    <label class="delivery-option text-center" for="d2"><i class="fas fa-truck d-block mb-1"></i> <span class="small">Antar Jemput</span></label>
                                </div>
                            </div>
                        </div>
                        <div id="info-toko-box" class="p-3 mb-4 {{ old('tipe_pengiriman') == 'antar_jemput' ? 'd-none' : '' }}">
                            <p class="mb-0 small text-muted text-center">Dukuh Kupang 17 Nomor 35, Surabaya</p>
                        </div>
                        <div id="alamat-section" class="mb-4 {{ old('tipe_pengiriman') == 'antar_jemput' ? '' : 'd-none' }}">
                            <textarea id="textarea-alamat" name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap penjemputan...">{{ old('alamat') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 py-3 fw-bold rounded-pill">KIRIM PESANAN <i class="fas fa-paper-plane ms-2"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row text-center mb-4 mt-5">
        <div class="col-12">
            <h2 class="fw-bold">Testimoni Pelanggan</h2>
            <div style="width: 60px; height: 3px; background: var(--primary-brown); margin: 10px auto;"></div>
        </div>
    </div>

    <div class="row justify-content-center g-4 mb-5">
        @php $reviews = \App\Models\Reservation::whereNotNull('rating')->latest()->take(3)->get(); @endphp
        @forelse($reviews as $rev)
            <div class="col-md-4">
                <div class="card review-card h-100 p-4 shadow-sm">
                    <div class="mb-2">
                        @for($i=1; $i<=5; $i++) <i class="fas fa-star {{ $i <= $rev->rating ? 'text-warning' : 'text-muted' }} small"></i> @endfor
                    </div>
                    <p class="small text-muted mb-3 fst-italic">"{{ $rev->testimoni }}"</p>
                    <hr class="my-2 opacity-25">
                    <div class="d-flex align-items-center">
                        <div class="text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 30px; height: 30px; background-color: var(--primary-brown);">
                            <span class="small fw-bold">{{ strtoupper(substr($rev->nama_pelanggan, 0, 1)) }}</span>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold small text-dark">{{ $rev->nama_pelanggan }}</h6>
                            <small class="text-muted" style="font-size: 0.65rem;">Verified Customer</small>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center"><p class="text-muted small">Belum ada ulasan terbaru.</p></div>
        @endforelse
    </div>

    <div class="row text-center mb-4 mt-5"><div class="col-12"><h2 class="fw-bold">Tips Perawatan Sepatu</h2></div></div>
    <div class="row g-4 mb-5 text-center">
        <div class="col-md-3 col-6">
            <div class="card tip-card p-4 shadow-sm">
                <i class="fas fa-sun fa-2x text-brown mb-3"></i>
                <h6 class="fw-bold small">No Sunburn</h6>
                <p class="text-muted mb-0" style="font-size: 0.7rem;">Jangan jemur langsung di terik matahari.</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card tip-card p-4 shadow-sm">
                <i class="fas fa-wind fa-2x text-brown mb-3"></i>
                <h6 class="fw-bold small">Air Flow</h6>
                <p class="text-muted mb-0" style="font-size: 0.7rem;">Simpan di tempat terbuka agar tidak lembap.</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card tip-card p-4 shadow-sm">
                <i class="fas fa-box fa-2x text-brown mb-3"></i>
                <h6 class="fw-bold small">Silica Gel</h6>
                <p class="text-muted mb-0" style="font-size: 0.7rem;">Gunakan silica gel untuk cegah jamur.</p>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card tip-card p-4 shadow-sm">
                <i class="fas fa-soap fa-2x text-brown mb-3"></i>
                <h6 class="fw-bold small">Routine Clean</h6>
                <p class="text-muted mb-0" style="font-size: 0.7rem;">Deep Clean teratur 1-2 bulan sekali.</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <h4 class="text-center fw-bold mb-4">FAQ</h4>
            <div class="accordion accordion-flush shadow-sm rounded-4 overflow-hidden" id="faqAccordion">
                <div class="accordion-item border-bottom">
                    <h2 class="accordion-header"><button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">Berapa lama proses pengerjaan?</button></h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body small text-muted">Proses Deep Clean standar memakan waktu 2-3 hari kerja.</div></div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header"><button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">Aman untuk bahan premium?</button></h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body small text-muted">Sangat aman. Kami menggunakan teknik khusus untuk Suede dan Leather.</div></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-center mb-4 mt-5">
        <div class="col-12">
            <h2 class="fw-bold">Lokasi Workshop</h2>
            <div class="map-container mt-4"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.514681657095!2d112.71618347570498!3d-7.295914692711585!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb9036c84147%3A0x6e9a8f276228399e!2sNature%20Clean%20Premium%20Treatment!5e0!3m2!1sen!2sid!4v1700000000000" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe></div>
        </div>
    </div>
</div>

<div class="wa-tooltip">Tanya Admin?</div>
<a href="https://wa.me/6281236016773?text=Halo%20Nature%20Clean" class="floating-wa" target="_blank"><i class="fab fa-whatsapp"></i></a>

<footer class="text-center py-4 mt-5 bg-white border-top">
    <p class="text-muted small">© {{ date('Y') }} Nature Clean Premium Treatment.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleMetode(tipe) {
        const infoToko = document.getElementById('info-toko-box');
        const inputJemput = document.getElementById('alamat-section');
        const textarea = document.getElementById('textarea-alamat');
        if(tipe === 'jemput') {
            infoToko.classList.add('d-none');
            inputJemput.classList.remove('d-none');
            textarea.setAttribute('required', 'required');
        } else {
            infoToko.classList.remove('d-none');
            inputJemput.classList.add('d-none');
            textarea.removeAttribute('required');
        }
    }

    const calcService = document.getElementById('calc-service');
    const calcQty = document.getElementById('calc-qty');
    const calcTotalDisplay = document.getElementById('calc-total');
    function calculate() {
        const price = parseInt(calcService.value) || 0;
        const qty = parseInt(calcQty.value) || 0;
        calcTotalDisplay.innerText = 'Rp ' + (price * qty).toLocaleString('id-ID');
    }
    if(calcService) calcService.addEventListener('change', calculate);
    if(calcQty) calcQty.addEventListener('input', calculate);
    window.addEventListener('load', calculate);

    const slider = document.getElementById('ba-slider');
    const beforeContainer = document.getElementById('before-container');
    const beforeImg = document.getElementById('before-img');
    const wrapper = document.querySelector('.ba-wrapper');
    function syncWidth() { if (wrapper && beforeImg) beforeImg.style.width = wrapper.offsetWidth + 'px'; }
    if(slider) {
        window.addEventListener('load', syncWidth);
        window.addEventListener('resize', syncWidth);
        slider.addEventListener('input', (e) => {
            beforeContainer.style.width = e.target.value + '%';
            syncWidth();
        });
    }
</script>
</body>
</html>