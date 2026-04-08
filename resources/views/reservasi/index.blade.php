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
            padding: 100px 0 80px 0;
            border-radius: 0 0 60px 60px;
            position: relative;
        }
        .hero-img-wrapper img {
            border: 12px solid white;
            border-radius: 40px;
            box-shadow: var(--soft-shadow);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, 0.5);
            transition: 0.4s; padding: 30px;
        }
        .glass-card:hover { transform: translateY(-10px); background: white; box-shadow: var(--soft-shadow); }

        .section-title { position: relative; display: inline-block; margin-bottom: 40px; }
        .section-title::after {
            content: ''; width: 60%; height: 6px; background: var(--secondary-brown);
            position: absolute; bottom: -12px; left: 0; border-radius: 10px;
        }

        .portfolio-img { border-radius: 25px; transition: 0.5s; cursor: pointer; height: 300px; object-fit: cover; width: 100%; border: 5px solid white; }
        .portfolio-img:hover { transform: scale(1.03); box-shadow: var(--soft-shadow); }

        .ba-wrapper {
            position: relative; width: 100%; max-width: 700px; height: 400px;
            margin: 0 auto; border-radius: 25px; overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: 8px solid #fff;
        }
        .ba-img { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }
        .ba-before { z-index: 2; border-right: 3px solid #fff; overflow: hidden; }
        .ba-input {
            position: absolute; -webkit-appearance: none; appearance: none; width: 100%; height: 100%;
            background: transparent; outline: none; z-index: 10; cursor: ew-resize; top: 0;
        }

        .form-control, .form-select {
            border-radius: 15px; padding: 12px; border: 1px solid rgba(93, 64, 55, 0.1);
        }
        .accordion-item { border: none; margin-bottom: 15px; border-radius: 20px !important; overflow: hidden; box-shadow: var(--soft-shadow); }
        .accordion-button { font-weight: 800; background-color: white; }
        .accordion-button:not(.collapsed) { background-color: var(--accent-tan); color: var(--primary-brown); }

        .map-container { border-radius: 40px; overflow: hidden; border: 10px solid #fff; box-shadow: var(--soft-shadow); }

        .floating-wa {
            position: fixed; bottom: 30px; right: 30px; width: 65px; height: 65px;
            background: var(--primary-brown); color: var(--bg-sweet-brown); border: 4px solid white;
            border-radius: 50%; display: flex; align-items: center; justify-content: center; 
            font-size: 30px; z-index: 999; box-shadow: var(--soft-shadow); 
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); text-decoration: none;
        }
        .floating-wa:hover { transform: scale(1.1) rotate(10deg); background: var(--secondary-brown); color: white; }

        .hover-scale { transition: 0.3s; }
        .hover-scale:hover { transform: scale(1.2); color: var(--primary-brown) !important; }
    </style>
</head>
<body>

<nav class="navbar sticky-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand fs-3 text-brown" href="#">
            <i class="fas fa-leaf me-2"></i>NATURE<span style="color: var(--secondary-brown)">CLEAN.</span>
        </a>
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-outline-brown px-4 d-none d-md-block" data-bs-toggle="modal" data-bs-target="#modalLacak">
                <i class="fas fa-search me-2"></i>Lacak Pesanan
            </button>
            <div class="dropdown">
                <button class="btn btn-brown px-4" type="button" data-bs-toggle="dropdown">Access <i class="fas fa-chevron-down ms-1 small"></i></button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3 p-2 rounded-4">
                    <li><a class="dropdown-item py-2" href="{{ route('login') }}?role=admin">Admin Panel</a></li>
                    <li><a class="dropdown-item py-2 text-brown" href="{{ route('login') }}?role=owner">Owner Dashboard</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<header class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 text-center text-lg-start" data-aos="fade-right">
                <div class="d-inline-block bg-white shadow-sm border rounded-pill px-3 py-1 mb-3">
                    <small class="text-brown"><i class="fas fa-star me-2"></i>#1 Premium Shoe Care Surabaya</small>
                </div>
                <h1 class="display-3 mb-3">Kembalikan <span style="color: var(--primary-brown)">Kilau Mewah</span> Sepatu Anda.</h1>
                <p class="lead mb-4 opacity-75">Perawatan eksklusif menggunakan formula organik yang aman bagi material sepatu sensitif dan ramah lingkungan.</p>
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
        </div>
        <div class="ba-wrapper">
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
            <p>Koleksi transformasi sepatu pelanggan kami.</p>
        </div>
        <div class="row g-4">
            @forelse($portfolios ?? [] as $p)
                <div class="col-md-4" data-aos="zoom-in">
                    <img src="{{ asset('storage/' . $p->gambar) }}" class="portfolio-img shadow-sm" alt="Portfolio">
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="glass-card d-inline-block p-5 border-dashed">
                        <i class="fas fa-images fa-4x opacity-25 mb-3"></i>
                        <h5>Galeri Segera Hadir</h5>
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
                            @foreach($services as $s) @if($s->kuota > 0) <option value="{{ $s->harga }}">{{ $s->nama_layanan }}</option> @endif @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="small mb-2">Jumlah Sepatu</label>
                        <input type="number" id="calc-qty" class="form-control border-0 shadow-sm" value="1" min="1">
                    </div>
                    <div class="bg-white p-4 rounded-4 text-center">
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
                            <div class="col-12"><input type="text" name="nomor_wa" class="form-control" placeholder="Nomor WhatsApp" required></div>
                            <div class="col-md-8">
                                <select name="service_id" class="form-select">
                                    @foreach($services as $s) <option value="{{ $s->id }}" {{ $s->kuota <= 0 ? 'disabled' : '' }}>{{ $s->nama_layanan }}</option> @endforeach
                                </select>
                            </div>
                            <div class="col-md-4"><input type="number" name="jumlah_sepatu" class="form-control" value="1" min="1"></div>
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <input type="radio" class="btn-check" name="tipe_pengiriman" id="opt1" value="antar_sendiri" checked onclick="toggleMetode('toko')">
                                    <label class="btn btn-outline-dark w-50 py-3 rounded-4" for="opt1">Drop Toko</label>
                                    <input type="radio" class="btn-check" name="tipe_pengiriman" id="opt2" value="antar_jemput" onclick="toggleMetode('jemput')">
                                    <label class="btn btn-outline-dark w-50 py-3 rounded-4" for="opt2">Antar Jemput</label>
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
        <div class="text-center mb-5"><h2 class="section-title">Apa Kata Mereka?</h2></div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <div class="text-warning mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="fst-italic">"Sepatu putih saya yang sudah kuning balik jadi kayak baru lagi!"</p>
                    <h6 class="mb-0">- Andi S.</h6>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <div class="text-warning mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="fst-italic">"Suka banget sama konsep organiknya, aman buat suede."</p>
                    <h6 class="mb-0">- Rina M.</h6>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white p-4 rounded-4 shadow-sm">
                    <div class="text-warning mb-2"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="fst-italic">"Layanan antar jemputnya on-time banget. Recommended!"</p>
                    <h6 class="mb-0">- Budi K.</h6>
                </div>
            </div>
        </div>
    </section>

    <div class="row g-5 py-5">
        <div class="col-lg-6" data-aos="fade-right">
            <h3 class="mb-4">Tips Merawat Sepatu</h3>
            <div class="glass-card">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex"><i class="fas fa-check-circle text-brown me-3 mt-1"></i> Jangan jemur langsung di bawah matahari.</li>
                    <li class="mb-3 d-flex"><i class="fas fa-check-circle text-brown me-3 mt-1"></i> Gunakan silica gel di kotak sepatu.</li>
                    <li class="d-flex"><i class="fas fa-check-circle text-brown me-3 mt-1"></i> Deep cleaning minimal 1 bulan sekali.</li>
                </ul>
            </div>
        </div>
        <div class="col-lg-6" data-aos="fade-left">
            <h3 class="mb-4">FAQ</h3>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f1">Berapa lama pengerjaan?</button></h2>
                    <div id="f1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Rata-rata 2-4 hari tergantung jenis layanan.</div></div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#f2">Apakah ada garansi?</button></h2>
                    <div id="f2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body">Ya, garansi cuci ulang 1x24 jam setelah sepatu diterima.</div></div>
                </div>
            </div>
        </div>
    </div>

    <section class="py-5" data-aos="zoom-in">
        <div class="text-center mb-5"><h2 class="section-title">Kunjungi Workshop Kami</h2></div>
        <div class="map-container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5957384180864!2d112.71618687355018!3d-7.286701171614748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f9570951662d%3A0x6a053531b40285a8!2sJl.%20Dukuh%20Kupang%20XVII%20No.35%2C%20Dukuh%20Kupang%2C%20Kec.%20Dukuhpakis%2C%20Surabaya%2C%20Jawa%20Timur%2060225!5e0!3m2!1sid!2sid!4v1741490000000!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
                <p class="small opacity-75 mb-4">Masukkan Nomor WhatsApp yang Anda gunakan saat reservasi untuk melihat progres sepatu.</p>
                <form action="{{ route('reservasi.status') }}" method="GET">
                    <div class="input-group mb-3 bg-light rounded-4 p-1">
                        <span class="input-group-text border-0 bg-transparent text-brown"><i class="fab fa-whatsapp"></i></span>
                        <input type="text" name="search" class="form-control border-0 bg-transparent py-3" placeholder="Contoh: 081234567xxx" required>
                    </div>
                    <button type="submit" class="btn btn-brown w-100 py-3 rounded-4 shadow-sm">
                        Cek Status Sekarang <i class="fas fa-search ms-2"></i>
                    </button>
                </form>
            </div>
            <div class="modal-footer border-0 bg-light justify-content-center py-3">
                <span class="small">Butuh bantuan? <a href="https://wa.me/6281236016773" class="text-brown fw-bold text-decoration-none">Chat Admin</a></span>
            </div>
        </div>
    </div>
</div>

<footer class="bg-white border-top py-5 text-center">
    <div class="container">
        <h4 class="text-brown mb-3">NATURECLEAN.</h4>
        <p class="small opacity-75">Workshop: Dukuh Kupang 17 Nomor 35, Surabaya | WhatsApp: 0812-3601-6773</p>
        
        <div class="d-flex justify-content-center gap-4 mb-4">
            <a href="https://www.instagram.com/naturecleanshoes" target="_blank" class="text-brown fs-4 hover-scale"><i class="fab fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@naturecleanshoes" target="_blank" class="text-brown fs-4 hover-scale"><i class="fab fa-tiktok"></i></a>
            <a href="https://wa.me/6281236016773" target="_blank" class="text-brown fs-4 hover-scale"><i class="fab fa-whatsapp"></i></a>
        </div>
        
        <p class="small mb-0">© 2026 Nature Clean Premium. All rights reserved.</p>
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