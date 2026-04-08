<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Admin | Nature Clean</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root { 
            --primary: #5D4037; /* Cokelat Tua Nature Clean */
            --accent: #8D6E63;
            --bg-body: #F5EBE0; /* Latar Belakang Cokelat Manis */
            --card-border: #E3D5CA;
            --text-main: #3E2723;
            --glass: rgba(245, 235, 224, 0.9);
            --soft-shadow: 0 10px 30px rgba(93, 64, 55, 0.1);
        }
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-body); 
            color: var(--text-main);
            font-weight: 700; /* Default font tebal */
            letter-spacing: -0.02em;
        }

        /* --- Typography Bold --- */
        h1, h2, h3, h4, h5, h6, .navbar-brand, .btn, label, th, .fw-bold { font-weight: 800 !important; }
        p, .text-muted, .small, input, select, td { font-weight: 700; }

        /* --- Glassmorphism Navbar --- */
        .navbar { 
            background: var(--glass);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--card-border);
            padding: 10px 0;
        }

        /* --- Compact Cards --- */
        .card { 
            border-radius: 20px; 
            border: 1px solid var(--card-border); 
            box-shadow: var(--soft-shadow); 
            background: #ffffff;
            transition: all 0.3s ease;
        }
        .card:hover { transform: translateY(-3px); box-shadow: 0 15px 40px rgba(93, 64, 55, 0.15); }

        .stat-icon {
            width: 45px; height: 45px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 14px; font-size: 1.3rem;
            background: var(--bg-sweet-brown); color: var(--accent);
        }

        /* --- Form & Buttons Bold --- */
        .form-control, .form-select {
            border-radius: 12px;
            padding: 10px 15px;
            border: 2px solid #eee;
            background: #fcfcfc;
            font-weight: 700;
        }
        .form-control:focus, .form-select:focus { border-color: var(--accent); box-shadow: 0 0 0 4px rgba(166, 123, 91, 0.15); }

        .btn-premium { 
            background: var(--primary);
            color: white; border: none; border-radius: 50px; 
            padding: 10px 24px; font-weight: 800;
            transition: all 0.3s;
        }
        .btn-premium:hover { background: #3E2723; transform: scale(1.03); color: white; }

        /* --- Compact Table --- */
        .table thead th {
            background-color: var(--bg-sweet-brown);
            padding: 12px 15px; color: var(--primary);
            text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px;
            border-bottom: 2px solid var(--card-border);
        }
        .table tbody td { padding: 15px; vertical-align: middle; border-bottom: 1px solid #eee; }

        /* --- Portfolio Grid Compact --- */
        .portfolio-item {
            position: relative; overflow: hidden; border-radius: 15px; aspect-ratio: 1/1;
            border: 4px solid white; box-shadow: var(--soft-shadow);
        }
        .portfolio-item img { width: 100%; height: 100%; object-fit: cover; }
        .portfolio-overlay {
            position: absolute; inset: 0; background: rgba(0,0,0,0.5); opacity: 0;
            display: flex; align-items: center; justify-content: center; transition: 0.3s;
        }
        .portfolio-item:hover .portfolio-overlay { opacity: 1; }

        /* --- Status Badges Bold --- */
        .badge-status {
            padding: 6px 12px; border-radius: 8px; font-weight: 800; font-size: 0.7rem; text-transform: uppercase;
        }
        .bg-pending { background: #fff4e5; color: #b07000; }
        .bg-proses { background: #eef2ff; color: #4338ca; }
        .bg-selesai { background: #ecfdf5; color: #059669; }

        .img-preview-mini { width: 100%; height: 100px; border-radius: 10px; object-fit: cover; border: 3px solid white; box-shadow: var(--soft-shadow); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top mb-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fas fa-leaf me-2 text-accent"></i>
            <span class="fs-4" style="color: var(--primary);">NATURE<span style="color: var(--accent);">CLEAN</span></span>
            <span class="ms-3 fw-semibold text-muted fs-6">| Admin</span>
        </a>
        <div class="ms-auto d-flex align-items-center gap-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
                    <div>
                        <p class="text-muted small mb-0">Total Antrean</p>
                        <h3 class="mb-0">{{ $reservations->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: #ecfdf5; color: #10b981;"><i class="fas fa-check-double"></i></div>
                    <div>
                        <p class="text-muted small mb-0">Selesai Hari Ini</p>
                        <h3 class="mb-0">{{ $reservations->where('status', 'selesai')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: #eef2ff; color: #3b82f6;"><i class="fas fa-tags"></i></div>
                    <div>
                        <p class="text-muted small mb-0">Layanan Aktif</p>
                        <h3 class="mb-0">{{ $services->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="{{ route('reservasi.index') }}" class="btn btn-premium w-100 h-100 d-flex align-items-center justify-content-center gap-2 rounded-4">
                <i class="fas fa-external-link-alt"></i> Lihat Website
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4 fw-bold">
            <i class="fas fa-sparkles me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="row g-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-white p-3 border-0">
                    <h5 class="mb-0"><i class="fas fa-sliders-h me-2 text-accent"></i>Master Layanan</h5>
                </div>
                <div class="card-body p-3 pt-0">
                    <form action="{{ route('admin.services.store') }}" method="POST" class="row g-2 mb-3 bg-light p-3 rounded-4">
                        @csrf
                        <div class="col-md-4">
                            <input type="text" name="nama_layanan" class="form-control form-control-sm" placeholder="Nama Layanan" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="harga" class="form-control form-control-sm" placeholder="Harga (Rp)" required>
                        </div>
                        <div class="col-md-2">
                            <input type="number" name="kuota" class="form-control form-control-sm" placeholder="Kuota" required>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-premium btn-sm w-100">+ Tambah</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Layanan</th>
                                    <th>Harga</th>
                                    <th>Kuota</th>
                                    <th class="text-end">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($services as $s)
                                <tr>
                                    <form action="{{ route('admin.services.update', $s->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <td><input type="text" name="nama_layanan" class="form-control form-control-sm bg-transparent border-0 p-0" value="{{ $s->nama_layanan }}"></td>
                                        <td style="width: 120px;"><input type="number" name="harga" class="form-control form-control-sm bg-transparent border-0 p-0" value="{{ $s->harga }}"></td>
                                        <td style="width: 80px;"><input type="number" name="kuota" class="form-control form-control-sm bg-transparent border-0 p-0" value="{{ $s->kuota }}"></td>
                                        <td class="text-end">
                                            <button type="submit" class="btn btn-link btn-sm text-primary p-0 me-2"><i class="fas fa-check"></i></button>
                                            <button type="button" class="btn btn-link btn-sm text-danger p-0" onclick="if(confirm('Hapus?')) document.getElementById('del-svc-{{ $s->id }}').submit();"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </form>
                                    <form id="del-svc-{{ $s->id }}" action="{{ route('admin.services.destroy', $s->id) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header bg-white p-3 border-0">
                    <h5 class="mb-0"><i class="fas fa-camera-retro me-2 text-accent"></i>Galeri Portfolio</h5>
                </div>
                <div class="card-body p-3 pt-0">
                    <form action="{{ route('admin.portfolio.store') }}" method="POST" enctype="multipart/form-data" class="mb-3 g-2 row">
                        @csrf
                        <div class="col-8"><input type="file" name="gambar" class="form-control form-control-sm" required></div>
                        <div class="col-4"><button type="submit" class="btn btn-premium btn-sm w-100">Upload</button></div>
                    </form>
                    
                    <div class="row g-2 row-cols-3">
                        @foreach($portfolios as $p)
                        <div class="col">
                            <div class="portfolio-item hover-rotate">
                                <img src="{{ asset('storage/' . $p->gambar) }}">
                                <div class="portfolio-overlay">
                                    <form action="{{ route('admin.portfolio.destroy', $p->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm rounded-circle" onclick="return confirm('Hapus?')"><i class="fas fa-times"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card h-100">
                <div class="card-header bg-white p-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-list-ul me-2 text-accent"></i>Monitor Antrean</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Pelanggan</th>
                                    <th>Layanan</th>
                                    <th>Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservations as $res)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $res->nama_pelanggan }}</div>
                                        <div class="text-muted small">{{ $res->nomor_wa }}</div>
                                    </td>
                                    <td>
                                        <div class="small fw-bold text-accent">{{ strtoupper($res->jenis_layanan) }}</div>
                                        <div class="text-muted extra-small">{{ $res->jumlah_sepatu }} Pasang</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.update', $res->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <select name="status" class="form-select form-select-sm badge-status border-0 bg-light p-1 px-2" style="width: auto;" onchange="this.form.submit()">
                                                <option value="pending" {{ $res->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                                <option value="proses" {{ $res->status == 'proses' ? 'selected' : '' }}>PROSES</option>
                                                <option value="selesai" {{ $res->status == 'selesai' ? 'selected' : '' }}>SELESAI</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-1">
                                            <button class="btn btn-link btn-sm text-accent p-0" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $res->id }}">
                                                <i class="fas fa-camera"></i>
                                            </button>
                                            <form action="{{ route('admin.destroy', $res->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-link btn-sm text-danger p-0" onclick="return confirm('Hapus?')"><i class="fas fa-times-circle"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="4" class="text-center py-4 text-muted extra-small">Belum ada aktivitas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($reservations as $res)
<div class="modal fade" id="modalFoto{{ $res->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 rounded-4 overflow-hidden">
            <form action="{{ route('admin.update', $res->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PATCH')
                <div class="modal-body p-3">
                    <h6 class="fw-bold mb-3 text-center">Progres {{ $res->nama_pelanggan }}</h6>
                    <div class="row g-2 mb-3">
                        <div class="col-6 text-center">
                            <small class="badge bg-dark rounded-pill mb-1">Before</small>
                            <img id="prevB{{ $res->id }}" src="{{ $res->photo_before ? asset('storage/' . $res->photo_before) : 'https://via.placeholder.com/150?text=None' }}" class="img-preview-mini">
                            <input type="file" name="photo_before" class="form-control form-control-sm mt-1" onchange="preview(this, 'prevB{{ $res->id }}')">
                        </div>
                        <div class="col-6 text-center">
                            <small class="badge bg-accent rounded-pill mb-1">After</small>
                            <img id="prevA{{ $res->id }}" src="{{ $res->photo_after ? asset('storage/' . $res->photo_after) : 'https://via.placeholder.com/150?text=None' }}" class="img-preview-mini">
                            <input type="file" name="photo_after" class="form-control form-control-sm mt-1" onchange="preview(this, 'prevA{{ $res->id }}')">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-premium btn-sm w-100 py-2">Simpan Progres</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function preview(input, targetId) {
        const [file] = input.files;
        if (file) { document.getElementById(targetId).src = URL.createObjectURL(file); }
    }
</script>
</body>
</html>