<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nature Clean | Premium Shoe Treatment</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root { 
            --primary-brown: #5D4037; 
            --secondary-brown: #8D6E63; 
            --accent-tan: #D7CCC8;
            --bg-sweet-brown: #F5EBE0; 
            --soft-shadow: 0 10px 30px rgba(93, 64, 55, 0.12);
        }
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-sweet-brown); 
            color: #3E2723; 
            font-weight: 600; 
            scroll-behavior: smooth;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand, .nav-link, .btn, label { font-weight: 800 !important; }
        p, .accordion-body, .list-unstyled li { font-weight: 600; }

        .navbar { 
            background: rgba(245, 235, 224, 0.9) !important; 
            backdrop-filter: blur(15px);
            padding: 12px 0; 
            border-bottom: 1px solid rgba(93, 64, 55, 0.05);
        }

        .btn-brown { 
            background: var(--primary-brown); color: white; border: none; 
            border-radius: 50px; padding: 12px 28px; transition: 0.4s ease; 
        }
        .btn-brown:hover { background: #3E2723; transform: translateY(-3px); color: white; box-shadow: 0 8px 20px rgba(0,0,0,0.15); }

        .btn-outline-brown {
            border: 2px solid var(--primary-brown); color: var(--primary-brown);
            border-radius: 50px; padding: 12px 28px; transition: 0.4s ease;
            background: transparent;
        }
        .btn-outline-brown:hover { background: var(--primary-brown); color: white; }

        .hero-section {
            background: linear-gradient(135deg, #F5EBE0 0%, #E3D5CA 100%);
            padding: 120px 0 80px 0;
            border-radius: 0 0 60px 60px;
            position: relative;
        }
        .hero-img-wrapper img {
            border: 12px solid white;
            border-radius: 40px;
            box-shadow: var(--soft-shadow);
            max-height: 500px;
            object-fit: cover;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: 0.4s; padding: 30px;
            height: 100%;
        }
        .glass-card:hover { transform: translateY(-10px); background: white; box-shadow: var(--soft-shadow); }

        .section-title { position: relative; display: inline-block; margin-bottom: 40px; }
        .section-title::after {
            content: ''; width: 60%; height: 6px; background: var(--secondary-brown);
            position: absolute; bottom: -12px; left: 0; border-radius: 10px;
        }

        .portfolio-item { position: relative; overflow: hidden; border-radius: 25px; border: 5px solid white; box-shadow: var(--soft-shadow); }
        .portfolio-img { transition: 0.5s; cursor: pointer; height: 320px; object-fit: cover; width: 100%; }
        .portfolio-overlay { 
            position: absolute; bottom: 0; left: 0; right: 0; 
            background: linear-gradient(transparent, rgba(62, 39, 35, 0.8)); 
            padding: 20px; opacity: 0; transition: 0.4s; 
        }
        .portfolio-item:hover .portfolio-overlay { opacity: 1; }
        .portfolio-item:hover .portfolio-img { transform: scale(1.1); }

        .ba-wrapper {
            position: relative; width: 100%; max-width: 700px; height: 450px;
            margin: 0 auto; border-radius: 30px; overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: 10px solid #fff;
        }
        .ba-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }
        .ba-before { z-index: 2; border-right: 4px solid #fff; overflow: hidden; width: 50%; }
        .ba-input {
            position: absolute; -webkit-appearance: none; appearance: none; width: 100%; height: 100%;
            background: transparent; outline: none; z-index: 10; cursor: ew-resize; top: 0;
        }

        .form-control, .form-select {
            border-radius: 15px; padding: 14px; border: 1px solid rgba(93, 64, 55, 0.1);
            background-color: #fcfaf8;
        }

        .accordion-item { border: none; margin-bottom: 15px; border-radius: 20px !important; overflow: hidden; box-shadow: var(--soft-shadow); }
        .accordion-button { font-weight: 800; background-color: white; padding: 20px; }
        .accordion-button:not(.collapsed) { background-color: var(--accent-tan); color: var(--primary-brown); }

        .map-container { border-radius: 40px; overflow: hidden; border: 12px solid #fff; box-shadow: var(--soft-shadow); }

        .floating-wa {
            position: fixed; bottom: 30px; right: 30px; width: 65px; height: 65px;
            background: var(--primary-brown); color: var(--bg-sweet-brown); border: 4px solid white;
            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
            font-size: 30px; z-index: 999; box-shadow: var(--soft-shadow); 
            transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); text-decoration: none;
        }
        .floating-wa:hover { transform: scale(1.1) rotate(10deg); background: #25D366; color: white; }
    </style>
</head>
<body>

<nav class="navbar sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand fs-3 text-brown" href="#">
            <i class="fas fa-leaf me-2" style="color: var(--primary-brown)"></i>NATURE<span style="color: var(--secondary-brown)">CLEAN.</span>
        </a>
        
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-outline-brown px-4 d-none d-md-block" data-bs-toggle="modal" data-bs-target="#modalLacak">
                <i class="fas fa-search me-2"></i>Lacak Pesanan
            </button>
            
            <div class="dropdown">
                <button class="btn btn-brown px-4" type="button" id="dropdownAccess" data-bs-toggle="dropdown" aria-expanded="false">
                    Access <i class="fas fa-chevron-down ms-1 small"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 p-2 rounded-4" aria-labelledby="dropdownAccess">
                    @auth
                        @if(Auth::user()->role == 'admin')
                            <li><a class="dropdown-item py-2 rounded-3 fw-bold text-primary" href="{{ route('admin.index') }}"><i class="fas fa-tachometer-alt me-2"></i>Dashboard Admin</a></li>
                        @elseif(Auth::user()->role == 'owner')
                            <li><a class="dropdown-item py-2 rounded-3 fw-bold text-success" href="{{ route('owner.index') }}"><i class="fas fa-chart-line me-2"></i>Dashboard Owner</a></li>
                        @endif
                        
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 rounded-3 text-danger fw-bold"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
                            </form>
                        </li>
                    @else
                        <li><a class="dropdown-item py-2 rounded-3 fw-bold" href="{{ route('login') }}?role=admin"><i class="fas fa-user-shield me-2 text-primary"></i>Login Admin</a></li>
                        <li><a class="dropdown-item py-2 rounded-3 fw-bold" href="{{ route('login') }}?role=owner"><i class="fas fa-store me-2 text-success"></i>Login Owner</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </div>
</nav>

@if(session('error'))
<div class="container mt-3">
    <div class="alert alert-danger alert-dismissible fade show rounded-4 shadow-sm border-0" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

@if(session('success'))
<div class="container mt-3">
    <div class="alert alert-success alert-dismissible fade show rounded-4 shadow-sm border-0" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif

<header class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start" data-aos="fade-right">
                <div class="d-inline-block bg-white shadow-sm border rounded-pill px-3 py-1 mb-3">
                    <small class="text-brown"><i class="fas fa-star me-2 text-warning"></i>Muhammad Nur Pua Geno 22120048</small>
                </div>
                <h1 class="display-3 mb-3">Kembalikan <span style="color: var(--primary-brown)">Kilau Mewah</span> Sepatu Anda.</h1>
                <p class="lead mb-4 opacity-75">Perawatan eksklusif menggunakan formula organik yang aman bagi material sensitif dan ramah lingkungan.</p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                    <a href="#booking" class="btn btn-brown btn-lg px-4 shadow-lg">Booking Sekarang</a>
                    <a href="#portfolio" class="btn btn-outline-brown btn-lg px-4">Lihat Hasil <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
            </div>
            <div class="col-lg-6 mt-5 mt-lg-0" data-aos="zoom-in">
                <div class="hero-img-wrapper text-center">
                    <img src="https://images.pexels.com/photos/1598505/pexels-photo-1598505.jpeg?auto=compress&cs=tinysrgb&w=800" class="img-fluid" alt="Premium Shoes">
                </div>
            </div>
        </div>
    </div>
</header>

<main class="container py-5">
    
    @if(isset($latest_reservation) && $latest_reservation->photo_before && $latest_reservation->photo_after)
    <section class="py-5" data-aos="fade-up">
        <div class="text-center mb-5">
            <h2 class="section-title">Bukti Nyata Perawatan</h2>
            <p>Geser slider untuk melihat hasil sebelum dan sesudah.</p>
        </div>
        <div class="ba-wrapper shadow-lg">
            <img src="{{ asset('storage/' . $latest_reservation->photo_after) }}" class="ba-img">
            <div class="ba-img ba-before" id="before-container">
                <img src="{{ asset('storage/' . $latest_reservation->photo_before) }}" id="before-img">
            </div>
            <input type="range" min="0" max="100" value="50" class="ba-input" id="ba-slider">
        </div>
    </section>
    @endif

    <section id="layanan" class="py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Layanan Kami</h2>
        </div>
        <div class="row g-4">
            @foreach($services as $s)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="glass-card text-center">
                    <div class="mb-3" style="color: var(--primary-brown)"><i class="fas fa-soap fa-3x"></i></div>
                    <h4>{{ $s->nama_layanan }}</h4>
                    <h3 class="my-3" style="color: var(--primary-brown)">Rp {{ number_format($s->harga, 0, ',', '.') }}</h3>
                    <span class="badge rounded-pill {{ $s->kuota > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-3 py-2">
                        {{ $s->kuota > 0 ? 'Tersisa ' . $s->kuota . ' Kuota' : 'Kuota Penuh' }}
                    </span>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <section id="portfolio" class="py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Portfolio Kami</h2>
            <p>Koleksi transformasi terbaik dari tangan ahli kami.</p>
        </div>
        <div class="row g-4">
            @forelse($portfolios ?? [] as $p)
                @php 
                    $imgPath = str_contains($p->gambar, 'portfolio/') ? $p->gambar : 'portfolio/' . $p->gambar;
                @endphp
                <div class="col-md-4" data-aos="zoom-in">
                    <div class="portfolio-item">
                        <img src="{{ asset('storage/' . $imgPath) }}" 
                             class="portfolio-img" 
                             alt="Portfolio"
                             onerror="this.onerror=null;this.src='https://placehold.co/600x400?text=Nature+Clean';">
                        <div class="portfolio-overlay">
                            <h5 class="text-white mb-0">{{ $p->judul ?? 'Transformasi Sepatu' }}</h5>
                            <small class="text-white-50">Deep Cleaning Premium</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="glass-card d-inline-block p-5" style="border: 2px dashed var(--accent-tan);">
                        <i class="fas fa-images fa-4x opacity-25 mb-3"></i>
                        <h5>Galeri Segera Diperbarui</h5>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <section id="booking" class="py-5">
        <div class="row g-5">
            <div class="col-lg-5" data-aos="fade-right">
                <div class="glass-card sticky-lg-top" style="top: 100px;">
                    <h3 class="mb-4">Simulasi Biaya</h3>
                    <div class="mb-3">
                        <label class="small mb-2">Pilih Layanan</label>
                        <select id="calc-service" class="form-select border-0 shadow-sm">
                            <option value="0" selected disabled>-- Pilih Layanan --</option>
                            @foreach($services as $s) 
                                @if($s->kuota > 0) <option value="{{ $s->harga }}">{{ $s->nama_layanan }}</option> @endif 
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="small mb-2">Jumlah Sepatu</label>
                        <input type="number" id="calc-qty" class="form-control border-0 shadow-sm" value="1" min="1">
                    </div>
                    <div class="bg-white p-4 rounded-4 text-center shadow-sm">
                        <p class="small text-muted mb-1">Total Estimasi</p>
                        <h2 class="text-brown mb-0" id="calc-total">Rp 0</h2>
                    </div>
                </div>
            </div>
            <div class="col-lg-7" data-aos="fade-left">
                <div class="bg-white p-5 rounded-5 shadow-sm border">
                    <h3 class="mb-4">Form Reservasi</h3>
                    <form action="{{ route('reservasi.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-12"><input type="text" name="nama_pelanggan" class="form-control" placeholder="Nama Lengkap" required></div>
                            <div class="col-12"><input type="text" name="nomor_wa" class="form-control" placeholder="Nomor WhatsApp (Contoh: 0812...)" required></div>
                            <div class="col-md-8">
                                <select name="service_id" class="form-select">
                                    @foreach($services as $s) 
                                        <option value="{{ $s->id }}" {{ $s->kuota <= 0 ? 'disabled' : '' }}>{{ $s->nama_layanan }}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4"><input type="number" name="jumlah_sepatu" class="form-control" value="1" min="1"></div>
                            <div class="col-12">
                                <label class="small mb-2 d-block">Metode Pengiriman</label>
                                <div class="d-flex gap-2">
                                    <input type="radio" class="btn-check" name="tipe_pengiriman" id="opt1" value="antar_sendiri" checked onclick="toggleMetode('toko')">
                                    <label class="btn btn-outline-dark w-50 py-3 rounded-4" for="opt1"><i class="fas fa-store me-2"></i>Drop Toko</label>
                                    <input type="radio" class="btn-check" name="tipe_pengiriman" id="opt2" value="antar_jemput" onclick="toggleMetode('jemput')">
                                    <label class="btn btn-outline-dark w-50 py-3 rounded-4" for="opt2"><i class="fas fa-truck me-2"></i>Antar Jemput</label>
                                </div>
                            </div>
                            <div id="alamat-section" class="col-12 d-none">
                                <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap penjemputan..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-brown w-100 py-3 mt-4 shadow">Kirim Pesanan <i class="fas fa-paper-plane ms-2"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Apa Kata Mereka?</h2>
        </div>
        <div class="row g-4">
            @forelse($testimonials ?? [] as $t)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="bg-white p-4 rounded-4 shadow-sm border-bottom border-4 border-brown h-100">
                        <div class="text-warning mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $t->rating ? '' : 'opacity-25' }}"></i>
                            @endfor
                        </div>
                        <p class="fst-italic opacity-75">"{{ $t->testimoni }}"</p>
                        <h6 class="mb-0 text-brown">- {{ $t->nama_pelanggan }}</h6>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="glass-card d-inline-block p-4" style="border: 1px dashed var(--accent-tan);">
                        <p class="mb-0 text-muted">Belum ada testimoni dari pelanggan.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <section class="py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Sering Ditanyakan</h2>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8" data-aos="fade-up">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#f1">
                                Berapa lama proses pencucian?
                            </button>
                        </h2>
                        <div id="f1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body opacity-75">
                                Umumnya memakan waktu 2-4 hari kerja tergantung tingkat kesulitan dan jenis layanan yang dipilih.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f2">
                                Apakah melayani antar jemput?
                            </button>
                        </h2>
                        <div id="f2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body opacity-75">
                                Ya! Kami menyediakan layanan antar jemput khusus area Surabaya dengan biaya yang disesuaikan jarak.
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f3">
                                Apakah aman untuk sepatu branded?
                            </button>
                        </h2>
                        <div id="f3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body opacity-75">
                                Sangat aman. Kami menggunakan cairan pembersih organik premium dan teknik khusus untuk setiap jenis material (Suede, Leather, Canvas, dsb).
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5" data-aos="zoom-in">
        <div class="text-center mb-5"><h2 class="section-title">Kunjungi Workshop Kami</h2></div>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5684666991953!2d112.71618057588321!3d-7.289785871644788!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fb905470d979%3A0x6b6d51d5208f24b2!2sDukuh%20Kupang%20XVII%20No.35%2C%20Dukuh%20Pakis%2C%20Kec.%20Dukuhpakis%2C%20Surabaya%2C%20Jawa%20Timur%2060225!5e0!3m2!1sid!2sid!4v1705663189012!5m2!1sid!2sid" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </section>

</main>

<div class="modal fade" id="modalLacak" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-5 overflow-hidden shadow-lg">
            <div class="modal-header border-0 bg-white pt-4 px-4">
                <h4 class="modal-title text-brown">Lacak Status Pesanan</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 bg-white">
                <p class="small opacity-75 mb-4">Masukkan Nomor WhatsApp yang terdaftar.</p>
                <form action="{{ route('reservasi.status') }}" method="GET">
                    <div class="input-group mb-3 bg-light rounded-4 p-1">
                        <span class="input-group-text border-0 bg-transparent text-brown"><i class="fab fa-whatsapp"></i></span>
                        <input type="text" name="search" class="form-control border-0 bg-transparent py-3" placeholder="Contoh: 0812..." required>
                    </div>
                    <button type="submit" class="btn btn-brown w-100 py-3 rounded-4 shadow-sm">
                        Cek Status Sekarang <i class="fas fa-search ms-2"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<footer class="bg-white border-top py-5 text-center mt-5">
    <div class="container">
        <h4 class="text-brown mb-3">NATURECLEAN.</h4>
        <p class="small opacity-75 mb-4">Workshop: Dukuh Kupang 17 Nomor 35, Surabaya<br>
        WhatsApp: 0812-3601-6773 | Email: hello@natureclean.id</p>
        <p class="small mb-0 text-muted">© 2026 Nature Clean Premium Shoe Care.</p>
    </div>
</footer>

<a href="https://wa.me/6281236016773" class="floating-wa" target="_blank"><i class="fab fa-whatsapp"></i></a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });

    function toggleMetode(tipe) {
        document.getElementById('alamat-section').classList.toggle('d-none', tipe === 'toko');
    }

    // Simulasi Biaya Logic
    const calcService = document.getElementById('calc-service');
    const calcQty = document.getElementById('calc-qty');
    const calcTotalDisplay = document.getElementById('calc-total');

    function calculate() {
        if(!calcService || !calcQty) return;
        const price = parseInt(calcService.value) || 0;
        const qty = parseInt(calcQty.value) || 0;
        calcTotalDisplay.innerText = 'Rp ' + (price * qty).toLocaleString('id-ID');
    }

    if(calcService) calcService.addEventListener('change', calculate);
    if(calcQty) calcQty.addEventListener('input', calculate);

    // Before After Slider Logic
    const slider = document.getElementById('ba-slider');
    const beforeContainer = document.getElementById('before-container');
    const beforeImg = document.getElementById('before-img');
    const wrapper = document.querySelector('.ba-wrapper');

    function syncWidth() { 
        if (wrapper && beforeImg) {
            beforeImg.style.width = wrapper.offsetWidth + 'px'; 
        }
    }

    window.addEventListener('load', () => { 
        syncWidth(); 
        calculate(); 
    });
    window.addEventListener('resize', syncWidth);
    
    if(slider) {
        slider.addEventListener('input', (e) => {
            beforeContainer.style.width = e.target.value + '%';
        });
    }
</script>
</body>
</html>