<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Nature Clean</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root { --primary-brown: #6F4E37; --bg-light: #f4f1ee; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--bg-light); }
        .navbar { background-color: var(--primary-brown); color: white; }
        .card { border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
        .table thead { background-color: var(--primary-brown); color: white; }
        .btn-brown { background-color: var(--primary-brown); color: white; border-radius: 10px; border: none; }
        .btn-brown:hover { background-color: #533a29; color: white; }
        
        .text-address { 
            font-size: 0.8rem; 
            line-height: 1.4; 
            max-width: 150px; 
            display: block; 
            color: #666;
        }

        .img-upload-preview {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px dashed #ddd;
            margin-bottom: 10px;
        }

        .badge-qty {
            background-color: #e9ecef;
            color: var(--primary-brown);
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 8px;
            font-size: 0.85rem;
        }
        
        .text-price {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="#">
            <i class="fas fa-tools me-2"></i>ADMIN NATURE CLEAN
        </a>
        <div class="d-flex gap-2">
            <a href="{{ route('reservasi.index') }}" class="btn btn-sm btn-outline-light">
                <i class="fas fa-external-link-alt me-1"></i> Web Depan
            </a>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger fw-bold">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <h3 class="mb-4 fw-bold" style="color: var(--primary-brown);">Manajemen Operasional</h3>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card p-4 mb-5">
        <h5 class="fw-bold mb-3"><i class="fas fa-concierge-bell me-2"></i>Daftar Layanan & Harga</h5>
        <form action="{{ route('admin.services.store') }}" method="POST" class="row g-2 mb-4 border-bottom pb-4">
            @csrf
            <div class="col-md-4">
                <label class="small fw-bold text-muted">Nama Layanan</label>
                <input type="text" name="nama_layanan" class="form-control" placeholder="Contoh: Leather Care" required>
            </div>
            <div class="col-md-3">
                <label class="small fw-bold text-muted">Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" placeholder="Contoh: 50000" required>
            </div>
            <div class="col-md-2">
                <label class="small fw-bold text-muted">Kuota</label>
                <input type="number" name="kuota" class="form-control" placeholder="10" required>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-brown w-100 fw-bold">+ Layanan Baru</button>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead>
                    <tr>
                        <th>Layanan</th>
                        <th>Harga</th>
                        <th>Kuota</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $s)
                    <tr>
                        <form action="{{ route('admin.services.update', $s->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <td><input type="text" name="nama_layanan" class="form-control form-control-sm" value="{{ $s->nama_layanan }}"></td>
                            <td><input type="number" name="harga" class="form-control form-control-sm" value="{{ $s->harga }}"></td>
                            <td><input type="number" name="kuota" class="form-control form-control-sm" value="{{ $s->kuota }}"></td>
                            <td>
                                <div class="d-flex justify-content-center gap-1">
                                    <button type="submit" class="btn btn-sm btn-primary"><i class="fas fa-save"></i></button>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="if(confirm('Hapus layanan?')) document.getElementById('del-svc-{{ $s->id }}').submit();">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </form>
                        <form id="del-svc-{{ $s->id }}" action="{{ route('admin.services.destroy', $s->id) }}" method="POST" class="d-none">
                            @csrf @method('DELETE')
                        </form>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card p-3">
        <h5 class="fw-bold mb-3 px-2">Daftar Antrean Sepatu</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Pelanggan</th>
                        <th class="text-center">Layanan & Jml</th>
                        <th>Total Bayar</th>
                        <th>Pengiriman/Alamat</th>
                        <th>Pembayaran</th>
                        <th>Status Kerja</th>
                        <th class="text-center">Progress</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $res)
                    <tr>
                        <td>
                            <div class="fw-bold">{{ $res->nama_pelanggan }}</div>
                            <small class="text-muted"><i class="fab fa-whatsapp me-1"></i>{{ $res->nomor_wa }}</small>
                        </td>

                        <td class="text-center">
                            <span class="badge bg-light text-dark border d-block mb-1">{{ $res->jenis_layanan }}</span>
                            <span class="badge-qty">{{ $res->jumlah_sepatu }} Prs</span>
                        </td>

                        <td>
                            <div class="text-price">
                                @php
                                    // Mengambil harga dari relasi service atau kolom harga jika disimpan di reservasi
                                    $harga_satuan = $res->service->harga ?? 0;
                                    $total = $harga_satuan * $res->jumlah_sepatu;
                                @endphp
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </div>
                            <small class="text-muted" style="font-size: 0.7rem;">@ Rp {{ number_format($harga_satuan, 0, ',', '.') }}</small>
                        </td>

                        <td>
                            <span class="badge bg-info text-dark mb-1" style="font-size: 0.7rem;">{{ strtoupper(str_replace('_', ' ', $res->tipe_pengiriman)) }}</span>
                            <span class="text-address text-truncate" title="{{ $res->alamat }}">{{ $res->alamat ?? '-' }}</span>
                        </td>

                        <td>
                            <span class="badge bg-{{ $res->status_pembayaran == 'settlement' ? 'success' : 'warning' }}">
                                {{ strtoupper($res->status_pembayaran ?? 'unpaid') }}
                            </span>
                        </td>

                        <td>
                            <form action="{{ route('admin.update', $res->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()" style="width: 110px;">
                                    <option value="pending" {{ $res->status == 'pending' ? 'selected' : '' }}>🕒 Pending</option>
                                    <option value="proses" {{ $res->status == 'proses' ? 'selected' : '' }}>⚡ Proses</option>
                                    <option value="selesai" {{ $res->status == 'selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                    <option value="batal" {{ $res->status == 'batal' ? 'selected' : '' }}>❌ Batal</option>
                                </select>
                            </form>
                        </td>

                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-brown" data-bs-toggle="modal" data-bs-target="#modalFoto{{ $res->id }}">
                                <i class="fas fa-camera"></i> 
                                {!! ($res->photo_before || $res->photo_after) ? '<span class="badge bg-success ms-1"><i class="fas fa-check"></i></span>' : '' !!}
                            </button>
                        </td>

                        <td class="text-center">
                            <form action="{{ route('admin.destroy', $res->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm text-danger" onclick="return confirm('Hapus data antrean?')"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="text-center py-4 text-muted">Belum ada pesanan masuk.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($reservations as $res)
<div class="modal fade" id="modalFoto{{ $res->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('admin.update', $res->id) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PATCH')
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Update Progress: {{ $res->nama_pelanggan }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6 text-center">
                            <label class="small fw-bold d-block mb-2">Before</label>
                            <img id="prevB{{ $res->id }}" src="{{ $res->photo_before ? asset('storage/' . $res->photo_before) : 'https://via.placeholder.com/150?text=No+Photo' }}" class="img-upload-preview">
                            <input type="file" name="photo_before" class="form-control form-control-sm" accept="image/*" onchange="preview(this, 'prevB{{ $res->id }}')">
                        </div>
                        <div class="col-6 text-center">
                            <label class="small fw-bold d-block mb-2">After</label>
                            <img id="prevA{{ $res->id }}" src="{{ $res->photo_after ? asset('storage/' . $res->photo_after) : 'https://via.placeholder.com/150?text=No+Photo' }}" class="img-upload-preview">
                            <input type="file" name="photo_after" class="form-control form-control-sm" accept="image/*" onchange="preview(this, 'prevA{{ $res->id }}')">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" class="btn btn-brown w-100 fw-bold py-2">SIMPAN FOTO PROGRESS</button>
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