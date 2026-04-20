<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard | Nature Clean</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        :root { 
            --primary: #5D4037; 
            --accent: #8D6E63;
            --bg-body: #F5EBE0; 
            --sidebar-dark: #3E2723;
            --card-border: #E3D5CA;
            --text-main: #3E2723;
            --soft-shadow: 0 10px 30px rgba(93, 64, 55, 0.1);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background-color: var(--bg-body); 
            color: var(--text-main);
            font-weight: 700;
            letter-spacing: -0.02em;
        }

        h1, h2, h3, h4, h5, h6, .fw-bold, .btn, th { font-weight: 800 !important; }
        p, .text-muted, td, label, input, select { font-weight: 700; }

        .sidebar { 
            background-color: var(--sidebar-dark); 
            color: white; 
            min-height: 100vh; 
            padding: 25px 15px; 
            position: sticky; 
            top: 0;
            border-right: 1px solid rgba(255,255,255,0.05);
        }
        .sidebar .profile-section { 
            background: rgba(255,255,255,0.05); 
            border-radius: 20px; 
            padding: 15px; 
            margin-bottom: 25px; 
            border: 1px solid rgba(255,255,255,0.1);
        }
        .sidebar .profile-img { 
            width: 55px; height: 55px; 
            border-radius: 15px; 
            border: 2px solid var(--accent); 
            margin-bottom: 10px; 
            object-fit: cover;
        }
        
        .nav-link-custom { 
            color: rgba(255,255,255,0.6); 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            padding: 12px 15px; 
            border-radius: 12px; 
            margin-bottom: 6px; 
            transition: 0.3s;
            font-size: 0.9rem;
        }
        .nav-link-custom:hover, .nav-link-custom.active { 
            background: var(--accent); 
            color: white; 
            transform: scale(1.02);
        }

        .stat-card { 
            border: 1px solid var(--card-border); 
            border-radius: 20px; 
            background: white;
            transition: 0.3s;
            box-shadow: var(--soft-shadow);
        }
        
        .icon-box { 
            width: 45px; height: 45px; 
            border-radius: 12px; 
            display: flex; align-items: center; justify-content: center; 
            font-size: 1.1rem; 
        }
        
        .bg-income { background: #ecfdf5; color: #059669; }
        .bg-expense { background: #fef2f2; color: #dc2626; }
        .bg-profit { background: #eff6ff; color: #2563eb; }

        .card-main {
            border-radius: 24px;
            border: 1px solid var(--card-border);
            background: white;
            box-shadow: var(--soft-shadow);
            overflow: hidden;
        }
        
        .btn-brown-bold {
            background: var(--primary);
            color: white;
            border-radius: 50px;
            padding: 10px 20px;
            font-size: 0.85rem;
            border: none;
            transition: 0.3s;
        }
        .btn-brown-bold:hover { background: #3E2723; transform: scale(1.05); color: white; }

        .badge-custom {
            padding: 6px 12px;
            border-radius: 8px;
            font-weight: 800;
            font-size: 0.7rem;
            text-transform: uppercase;
        }

        .form-control, .form-select {
            border-radius: 12px;
            border: 2px solid #F1F1F1;
            padding: 10px 15px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar d-none d-md-block shadow">
            <div class="profile-section">
                <img src="https://ui-avatars.com/api/?name=Owner+Nature&background=8D6E63&color=fff" alt="Profile" class="profile-img">
                <h6 class="mb-0 text-white">OWNER NATURE</h6>
                <small class="opacity-50 text-white" style="font-size: 0.7rem; letter-spacing: 1px;">EXECUTIVE</small>
            </div>
            
            <p class="small opacity-50 px-2 mb-2 text-white" style="font-size: 0.65rem; font-weight: 800;">MENU UTAMA</p>
            <a href="{{ route('owner.index') }}" class="nav-link-custom active"><i class="fas fa-chart-pie me-2"></i> Dashboard</a>
            <a href="{{ route('admin.index') }}" class="nav-link-custom"><i class="fas fa-clipboard-list me-2"></i> Kelola Order</a>
            
            <p class="small opacity-50 px-2 mt-4 mb-2 text-white" style="font-size: 0.65rem; font-weight: 800;">AKSES</p>
            <a href="{{ route('reservasi.index') }}" class="nav-link-custom"><i class="fas fa-home me-2"></i> Landing Page</a>
            
            <div class="mt-5 pt-5">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline-light w-100 fw-bold border-2" style="border-radius: 12px; font-size: 0.8rem;">
                        <i class="fas fa-power-off me-2"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-0" style="color: var(--primary);">Laporan Keuangan</h2>
                    <p class="text-muted small">Ringkasan performa bisnis Nature Clean hari ini.</p>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-brown-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#modalExpense">
                        <i class="fas fa-plus-circle me-1"></i> Catat Biaya
                    </button>
                </div>
            </div>

            <div class="card card-main p-4 mb-4 border-0" style="background: var(--accent); color: white;">
                <h5 class="mb-3 text-white"><i class="fas fa-print me-2"></i> Cetak Laporan Otomatis</h5>
                <form action="{{ route('owner.laporan.cetak') }}" method="GET" target="_blank" class="row g-3">
                    <div class="col-md-4">
                        <label class="small fw-bold mb-1">Pilih Kategori Laporan</label>
                        <select name="kategori" class="form-select border-0 shadow-sm">
                            <option value="pemasukan">Laporan Pemasukan</option>
                            <option value="pengeluaran">Laporan Pengeluaran</option>
                            <option value="pelanggan">Laporan Data Pelanggan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="small fw-bold mb-1">Periode Waktu</label>
                        <select name="filter" class="form-select border-0 shadow-sm">
                            <option value="semua">Semua Data</option>
                            <option value="harian">Hari Ini</option>
                            <option value="mingguan">Minggu Ini</option>
                            <option value="bulanan">Bulan Ini</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-white bg-white text-dark fw-bold w-100 rounded-pill border-0 shadow py-2">
                            <i class="fas fa-file-pdf text-danger me-2"></i> Generate & Print Laporan
                        </button>
                    </div>
                </form>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card stat-card p-3 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-0 small" style="font-size: 0.7rem; letter-spacing: 1px;">OMZET KOTOR</p>
                                <h3 class="mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                            </div>
                            <div class="icon-box bg-income"><i class="fas fa-wallet"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card p-3 border-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-muted mb-0 small" style="font-size: 0.7rem; letter-spacing: 1px;">PENGELUARAN</p>
                                <h3 class="mb-0 text-danger">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                            </div>
                            <div class="icon-box bg-expense"><i class="fas fa-shopping-bag"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card p-3 border-0" style="background: linear-gradient(135deg, #ffffff, #f0fdf4);">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-success mb-0 small" style="font-size: 0.7rem; letter-spacing: 1px;">LABA BERSIH</p>
                                <h3 class="mb-0 text-success">Rp {{ number_format($keuntunganBersih, 0, ',', '.') }}</h3>
                            </div>
                            <div class="icon-box bg-profit" style="background: #dcfce7; color: #15803d;"><i class="fas fa-chart-line"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-main p-4 mb-4">
                <h5 class="mb-4"><i class="fas fa-chart-bar me-2 text-accent"></i>Performa Mingguan</h5>
                <div id="chart-omzet"></div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card card-main h-100">
                        <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-light">
                            <h6 class="mb-0 fw-bold text-brown">Pengeluaran Terbaru</h6>
                            <i class="fas fa-arrow-down text-danger"></i>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Barang</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestExpenses as $expense)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $expense->nama_pengeluaran }}</div>
                                            <small class="text-muted" style="font-size: 0.7rem;">{{ \Carbon\Carbon::parse($expense->tanggal)->format('d M Y') }}</small>
                                        </td>
                                        <td class="text-danger fw-bold">-Rp {{ number_format($expense->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="2" class="text-center py-4 opacity-50">Tidak ada data.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-main h-100">
                        <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-light">
                            <h6 class="mb-0 fw-bold text-brown">Pemasukan Terbaru</h6>
                            <i class="fas fa-arrow-up text-success"></i>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestTransactions as $lt)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $lt->nama_pelanggan }}</div>
                                            <span class="badge badge-custom {{ $lt->status == 'selesai' ? 'bg-success' : 'bg-warning text-dark' }}">{{ $lt->status }}</span>
                                        </td>
                                        <td class="text-success fw-bold">Rp {{ number_format($lt->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalExpense" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content border-0 shadow" style="border-radius: 24px;">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold text-brown">Input Biaya</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('owner.storeExpense') }}" method="POST">
                @csrf
                <div class="modal-body p-4 pt-2">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Kategori/Nama</label>
                        <input type="text" name="nama_pengeluaran" class="form-control" placeholder="Sabun, Listrik, dsb" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nominal (Rp)</label>
                        <input type="number" name="jumlah" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Tanggal</label>
                        <input type="date" name="tanggal" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <button type="submit" class="btn btn-brown-bold w-100 py-2 mt-2">Simpan Laporan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var options = {
        series: [{ name: 'Omzet', data: {!! json_encode($chartData) !!} }],
        chart: { 
            type: 'area', 
            height: 300, 
            fontFamily: 'Plus Jakarta Sans', 
            toolbar: { show: false },
            zoom: { enabled: false }
        },
        colors: ['#5D4037'],
        fill: {
            type: 'gradient',
            gradient: { shadeIntensity: 1, opacityFrom: 0.4, opacityTo: 0.1, stops: [0, 90, 100] }
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 4 },
        xaxis: { type: 'datetime' },
        yaxis: { labels: { formatter: (v) => "Rp" + v.toLocaleString('id-ID') } },
        grid: { borderColor: '#F1F1F1', strokeDashArray: 4 }
    };
    new ApexCharts(document.querySelector("#chart-omzet"), options).render();
</script>
</body>
</html>