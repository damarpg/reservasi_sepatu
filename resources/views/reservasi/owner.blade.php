<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Owner Dashboard | Nature Clean</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        :root { --primary-brown: #6F4E37; --dark-brown: #4b3621; --light-bg: #f8f5f2; }
        body { font-family: 'Poppins', sans-serif; background-color: var(--light-bg); }
        
        .sidebar { background-color: var(--dark-brown); color: white; min-height: 100vh; padding: 25px 20px; position: sticky; top: 0; transition: all 0.3s; }
        .sidebar .profile-section { background: rgba(255,255,255,0.1); border-radius: 15px; padding: 15px; margin-bottom: 25px; text-align: center; }
        .sidebar .profile-img { width: 60px; height: 60px; border-radius: 50%; border: 2px solid var(--primary-brown); margin-bottom: 10px; }
        
        .nav-link-custom { color: rgba(255,255,255,0.7); text-decoration: none; display: flex; align-items: center; padding: 12px 15px; border-radius: 10px; margin-bottom: 8px; transition: 0.3s; }
        .nav-link-custom:hover, .nav-link-custom.active { background: var(--primary-brown); color: white; transform: translateX(5px); }
        
        .stat-card { border: none; border-radius: 20px; transition: 0.4s; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.05) !important; }
        .icon-box { width: 50px; height: 50px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        
        .bg-income { background: #e8f5e9; color: #2e7d32; }
        .bg-expense { background: #ffebee; color: #c62828; }
        .bg-profit { background: #e3f2fd; color: #1565c0; }
        .text-brown { color: var(--dark-brown); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar d-none d-md-block shadow">
            <div class="profile-section">
                <img src="https://ui-avatars.com/api/?name=Owner+Nature+Clean&background=6F4E37&color=fff" alt="Profile" class="profile-img">
                <h6 class="mb-0 fw-bold">Owner Nature</h6>
                <small class="opacity-50">Administrator</small>
            </div>
            <p class="small opacity-50 px-2 mb-2">MENU UTAMA</p>
            <a href="{{ route('owner.index') }}" class="nav-link-custom active"><i class="fas fa-chart-pie me-2"></i> Dashboard</a>
            <a href="{{ route('admin.index') }}" class="nav-link-custom"><i class="fas fa-clipboard-list me-2"></i> Kelola Order</a>
            <p class="small opacity-50 px-2 mt-4 mb-2">PENGATURAN</p>
            <a href="{{ route('reservasi.index') }}" class="nav-link-custom"><i class="fas fa-home me-2"></i> Ke Landing Page</a>
            <div class="mt-5 pt-5">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 fw-bold border-0" style="border-radius: 10px;">
                        <i class="fas fa-power-off me-2"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
                <div>
                    <h3 class="text-brown fw-bold m-0">Laporan Keuangan</h3>
                    <p class="text-muted small mb-0">Pantau arus kas dan keuntungan bersih tokomu.</p>
                </div>
                <div class="d-flex">
                    <button class="btn btn-brown shadow-sm px-3 rounded-pill me-2 text-white" style="background: var(--primary-brown);" data-bs-toggle="modal" data-bs-target="#modalExpense">
                        <i class="fas fa-plus me-2"></i> Catat Pengeluaran
                    </button>
                    <a href="{{ route('owner.pdf') }}" class="btn btn-outline-danger btn-sm shadow-sm px-3 rounded-pill d-flex align-items-center">
                        <i class="fas fa-file-pdf me-2"></i> Cetak PDF
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card stat-card p-4 shadow-sm border-0">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small fw-bold">OMZET (KOTOR)</p>
                                <h3 class="fw-bold mb-0 text-dark">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                            </div>
                            <div class="icon-box bg-income"><i class="fas fa-wallet"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card p-4 shadow-sm border-0">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-muted mb-1 small fw-bold">TOTAL PENGELUARAN</p>
                                <h3 class="fw-bold mb-0 text-danger">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</h3>
                            </div>
                            <div class="icon-box bg-expense"><i class="fas fa-shopping-cart"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card stat-card p-4 shadow-sm border-0" style="background: #e6fffa;">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-success mb-1 small fw-bold">KEUNTUNGAN BERSIH</p>
                                <h3 class="fw-bold mb-0 text-success">Rp {{ number_format($keuntunganBersih, 0, ',', '.') }}</h3>
                            </div>
                            <div class="icon-box bg-success text-white"><i class="fas fa-chart-line"></i></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card p-4 shadow-sm border-0 mb-4" style="border-radius: 20px;">
                <div id="chart-omzet"></div>
            </div>

            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card p-4 shadow-sm border-0 h-100" style="border-radius: 20px;">
                        <h5 class="fw-bold mb-4 text-brown">Pengeluaran Terbaru</h5>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr class="small text-muted">
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($latestExpenses as $expense)
                                    <tr>
                                        <td class="small">{{ \Carbon\Carbon::parse($expense->tanggal)->format('d M Y') }}</td>
                                        <td class="fw-bold">{{ $expense->nama_pengeluaran }}</td>
                                        <td class="text-danger fw-bold">-Rp {{ number_format($expense->jumlah, 0, ',', '.') }}</td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="3" class="text-center py-4 opacity-50">Belum ada pengeluaran</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card p-4 shadow-sm border-0 h-100" style="border-radius: 20px;">
                        <h5 class="fw-bold mb-4 text-brown">Pemasukan Terbaru</h5>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr class="small text-muted">
                                        <th>Pelanggan</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestTransactions as $lt)
                                    <tr>
                                        <td>
                                            <div class="fw-bold">{{ $lt->nama_pelanggan }}</div>
                                            <small class="text-muted">{{ $lt->created_at->diffForHumans() }}</small>
                                        </td>
                                        <td><span class="badge bg-{{ $lt->status == 'selesai' ? 'success' : 'warning' }} rounded-pill">{{ $lt->status }}</span></td>
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
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 20px;">
            <div class="modal-header border-0 p-4 pb-0">
                <h5 class="fw-bold text-brown">Tambah Pengeluaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('owner.storeExpense') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Pengeluaran</label>
                        <input type="text" name="nama_pengeluaran" class="form-control rounded-3" placeholder="Contoh: Beli Sabun / Listrik" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Jumlah (Rp)</label>
                            <input type="number" name="jumlah" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small fw-bold">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Keterangan (Opsional)</label>
                        <textarea name="keterangan" class="form-control rounded-3" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-brown text-white rounded-pill px-4" style="background: var(--primary-brown);">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    var options = {
        series: [{ data: {!! json_encode($chartData) !!} }],
        chart: { type: 'candlestick', height: 350, fontFamily: 'Poppins', toolbar: { show: false } },
        title: { text: 'Performa Pemasukan (Candlestick)', align: 'left', style: { color: '#6F4E37' } },
        xaxis: { type: 'datetime' },
        yaxis: { labels: { formatter: (v) => "Rp " + v.toLocaleString('id-ID') } },
        plotOptions: { candlestick: { colors: { upward: '#198754', downward: '#dc3545' } } }
    };
    new ApexCharts(document.querySelector("#chart-omzet"), options).render();
</script>
</body>
</html>