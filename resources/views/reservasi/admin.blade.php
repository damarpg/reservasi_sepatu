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
            --primary: #5D4037; 
            --accent: #8D6E63;
            --bg-body: #F5EBE0; 
            --card-border: #E3D5CA;
            --text-main: #3E2723;
            --glass: rgba(245, 235, 224, 0.9);
            --soft-shadow: 0 10px 30px rgba(93, 64, 55, 0.1);
        }
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-body); 
            color: var(--text-main);
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        h1, h2, h3, h4, h5, h6, .navbar-brand, .btn, label, th, .fw-bold { font-weight: 800 !important; }
        p, .text-muted, .small, input, select, td { font-weight: 700; }

        .navbar { 
            background: var(--glass);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid var(--card-border);
            padding: 10px 0;
        }

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
            background: #F5EBE0; color: var(--accent);
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 10px 15px;
            border: 2px solid #eee;
            background: #fcfcfc;
            font-weight: 700;
        }

        .btn-premium { 
            background: var(--primary);
            color: white; border: none; border-radius: 50px; 
            padding: 10px 24px; font-weight: 800;
            transition: all 0.3s;
        }
        .btn-premium:hover { background: #3E2723; transform: scale(1.03); color: white; }

        .table thead th {
            background-color: #F5EBE0;
            padding: 12px 15px; color: var(--primary);
            text-transform: uppercase; font-size: 0.7rem; letter-spacing: 1px;
            border-bottom: 2px solid var(--card-border);
        }
        .table tbody td { padding: 12px 15px; vertical-align: middle; border-bottom: 1px solid #eee; }

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

        .badge-status {
            padding: 5px 10px; border-radius: 8px; font-weight: 800; font-size: 0.65rem; text-transform: uppercase;
        }
        
        .pay-lunas { background: #ecfdf5 !important; color: #059669 !important; border: 1px solid #10b981 !important; }
        .pay-belum { background: #fef2f2 !important; color: #dc2626 !important; border: 1px solid #ef4444 !important; }

        .img-preview-mini { width: 100%; height: 80px; border-radius: 10px; object-fit: cover; border: 2px solid white; box-shadow: var(--soft-shadow); }
        
        .extra-small { font-size: 0.7rem; }
        .address-text { font-size: 0.75rem; color: #6d4c41; line-height: 1.2; max-width: 200px; display: block; margin-top: 4px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top mb-4">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="fas fa-leaf me-2" style="color: var(--accent);"></i>
            <span class="fs-4" style="color: var(--primary);">NATURE<span style="color: var(--accent);">CLEAN</span></span>
            <span class="ms-3 fw-semibold text-muted fs-6">| Admin Panel</span>
        </a>
        <div class="ms-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container pb-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 fw-bold mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show rounded-4 fw-bold mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> Ada kesalahan input:
            <ul class="mb-0 mt-1 small">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card p-3 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon"><i class="fas fa-clipboard-list"></i></div>
                    <div>
                        <p class="text-muted small mb-0">Total Order</p>
                        <h3 class="mb-0">{{ $reservations->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: #ecfdf5; color: #10b981;"><i class="fas fa-check-circle"></i></div>
                    <div>
                        <p class="text-muted small mb-0">Selesai</p>
                        <h3 class="mb-0">{{ $reservations->where('status', 'selesai')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 border-0">
                <div class="d-flex align-items-center gap-3">
                    <div class="stat-icon" style="background: #fff4e5; color: #b07000;"><i class="fas fa-spinner fa-spin"></i></div>
                    <div>
                        <p class="text-muted small mb-0">Proses</p>
                        <h3 class="mb-0">{{ $reservations->where('status', 'proses')->count() }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <a href="{{ route('reservasi.index') }}" target="_blank" class="btn btn-premium w-100 h-100 d-flex align-items-center justify-content-center gap-2 rounded-4">
                <i class="fas fa-external-link-alt"></i> Preview Web
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white p-3 border-0">
                    <h5 class="mb-0"><i class="fas fa-concierge-bell me-2 text-accent"></i>Manajemen Layanan</h5>
                </div>
                <div class="card-body p-3 pt-0">
                    <form action="{{ route('admin.services.store') }}" method="POST" class="row g-2 mb-3 bg-light p-3 rounded-4">
                        @csrf
                        <div class="col-md-4"><input type="text" name="nama_layanan" class="form-control form-control-sm" placeholder="Nama Layanan" required></div>
                        <div class="col-md-3"><input type="number" name="harga" class="form-control form-control-sm" placeholder="Harga" required></div>
                        <div class="col-md-2"><input type="number" name="kuota" class="form-control form-control-sm" placeholder="Kuota" required></div>
                        <div class="col-md-3"><button type="submit" class="btn btn-premium btn-sm w-100">Tambah</button></div>
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
                                        <td><input type="number" name="harga" class="form-control form-control-sm bg-transparent border-0 p-0" value="{{ $s->harga }}"></td>
                                        <td><input type="number" name="kuota" class="form-control form-control-sm bg-transparent border-0 p-0" value="{{ $s->kuota }}"></td>
                                        <td class="text-end">
                                            <button type="submit" class="btn btn-link btn-sm text-primary p-0 me-2"><i class="fas fa-save"></i></button>
                                            <button type="button" class="btn btn-link btn-sm text-danger p-0" onclick="if(confirm('Hapus layanan?')) document.getElementById('del-svc-{{ $s->id }}').submit();"><i class="fas fa-trash"></i></button>
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

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header bg-white p-3 border-0">
                    <h5 class="mb-0"><i class="fas fa-wallet me-2 text-accent"></i>Pencatatan Biaya (Operasional)</h5>
                </div>
                <div class="card-body p-3 pt-0">
                    <form action="{{ route('admin.expenses.store') }}" method="POST" enctype="multipart/form-data" class="row g-2 mb-3 bg-light p-3 rounded-4">
                        @csrf
                        <input type="hidden" name="tanggal" value="{{ date('Y-m-d') }}">
                        <div class="col-md-4">
                            <input type="text" name="nama_pengeluaran" class="form-control form-control-sm" placeholder="Keterangan Biaya" required>
                        </div>
                        <div class="col-md-3">
                            <input type="number" name="jumlah" class="form-control form-control-sm" placeholder="Nominal (Rp)" required>
                        </div>
                        <div class="col-md-5">
                            <div class="d-flex gap-1">
                                <input type="file" name="foto_nota" class="form-control form-control-sm" accept="image/*" required>
                                <button type="submit" class="btn btn-premium btn-sm whitespace-nowrap">Simpan</button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="table-responsive" style="max-height: 200px; overflow-y: auto;">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Keterangan</th>
                                    <th>Nominal</th>
                                    <th>Nota</th>
                                    <th class="text-end">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($expenses) && $expenses->count() > 0)
                                    @foreach($expenses as $e)
                                    <tr>
                                        <td><span class="small">{{ $e->nama_pengeluaran }}</span></td>
                                        <td><span class="small">Rp {{ number_format($e->jumlah, 0, ',', '.') }}</span></td>
                                        <td>
                                            @if($e->foto_nota)
                                                <a href="{{ asset('storage/' . $e->foto_nota) }}" target="_blank" class="btn btn-link btn-sm p-0 text-accent">
                                                    <i class="fas fa-file-invoice fa-lg"></i> Lihat Nota
                                                </a>
                                            @else
                                                <span class="text-muted small">-</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <button type="button" class="btn btn-link btn-sm text-danger p-0" onclick="if(confirm('Hapus biaya ini?')) document.getElementById('del-exp-{{ $e->id }}').submit();"><i class="fas fa-trash"></i></button>
                                            <form id="del-exp-{{ $e->id }}" action="{{ route('admin.expenses.destroy', $e->id) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="4" class="text-center py-3 text-muted small">Belum ada catatan biaya operasional.</td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-lg-4">
            <div class="card h-100">
                <div class="card-header bg-white p-3 border-0">
                    <h5 class="mb-0"><i class="fas fa-images me-2 text-accent"></i>Portfolio</h5>
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
                            <div class="portfolio-item">
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
                <div class="card-header bg-white p-3 border-0">
                    <h5 class="mb-0"><i class="fas fa-tasks me-2 text-accent"></i>Monitor Antrean</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Pelanggan & Alamat</th>
                                    <th>Layanan</th>
                                    <th>Pembayaran</th>
                                    <th>Status Kerja</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($reservations as $res)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $res->nama_pelanggan }}</div>
                                        <div class="text-muted extra-small"><i class="fab fa-whatsapp text-success me-1"></i>{{ $res->nomor_wa }}</div>
                                        <div class="address-text">
                                            <i class="fas fa-map-marker-alt me-1 text-danger"></i> {{ $res->alamat ?? 'Alamat tidak tersedia' }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="small fw-bold text-accent">{{ strtoupper($res->jenis_layanan) }}</div>
                                        <div class="text-muted extra-small">{{ $res->jumlah_sepatu }} Pasang</div>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.update', $res->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            @php 
                                                $pembayaran = strtolower($res->status_pembayaran);
                                                $isPaid = in_array($pembayaran, ['lunas', 'paid', 'success', 'settlement']);
                                            @endphp
                                            <select name="status_pembayaran" class="form-select form-select-sm badge-status border-0 {{ $isPaid ? 'pay-lunas' : 'pay-belum' }}" onchange="this.form.submit()">
                                                <option value="belum_lunas" {{ !$isPaid ? 'selected' : '' }}>BELUM LUNAS</option>
                                                <option value="lunas" {{ $isPaid ? 'selected' : '' }}>LUNAS</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.update', $res->id) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <select name="status" class="form-select form-select-sm badge-status border-0 bg-light" onchange="this.form.submit()">
                                                <option value="pending" {{ $res->status == 'pending' ? 'selected' : '' }}>PENDING</option>
                                                <option value="proses" {{ $res->status == 'proses' ? 'selected' : '' }}>PROSES</option>
                                                <option value="selesai" {{ $res->status == 'selesai' ? 'selected' : '' }}>SELESAI</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <button class="btn btn-link btn-sm text-accent p-0" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $res->id }}">
                                                <i class="fas fa-camera-retro fa-lg"></i>
                                            </button>
                                            <form action="{{ route('admin.destroy', $res->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button class="btn btn-link btn-sm text-danger p-0" onclick="return confirm('Hapus Order?')"><i class="fas fa-trash-alt fa-lg"></i></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr><td colspan="5" class="text-center py-5 text-muted">Belum ada pesanan.</td></tr>
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
        <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
            <form action="{{ route('admin.update', $res->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PATCH')
                <div class="modal-body p-4">
                    <h6 class="fw-bold mb-3 text-center text-primary">Dokumentasi Progres</h6>
                    <div class="row g-2 mb-4">
                        <div class="col-6 text-center">
                            <small class="d-block mb-1 text-muted">Before</small>
                            <img id="prevB{{ $res->id }}" src="{{ $res->photo_before ? asset('storage/' . $res->photo_before) : 'https://placehold.co/150?text=Before' }}" class="img-preview-mini">
                            <input type="file" name="photo_before" class="form-control form-control-sm mt-2" onchange="preview(this, 'prevB{{ $res->id }}')">
                        </div>
                        <div class="col-6 text-center">
                            <small class="d-block mb-1 text-muted">After</small>
                            <img id="prevA{{ $res->id }}" src="{{ $res->photo_after ? asset('storage/' . $res->photo_after) : 'https://placehold.co/150?text=After' }}" class="img-preview-mini">
                            <input type="file" name="photo_after" class="form-control form-control-sm mt-2" onchange="preview(this, 'prevA{{ $res->id }}')">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-premium btn-sm w-100 py-2">Update Data</button>
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
        if (file) { 
            document.getElementById(targetId).src = URL.createObjectURL(file); 
        }
    }
</script>
</body>
</html>