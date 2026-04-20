<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }} | Nature Clean</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 12px; color: #333; line-height: 1.5; padding: 20px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px double #444; padding-bottom: 10px; }
        .header h2 { margin: 0; color: #5D4037; text-transform: uppercase; }
        .header p { margin: 5px 0; font-weight: bold; }
        
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #333; }
        th { background-color: #f2f2f2; padding: 10px; text-align: center; font-weight: bold; text-transform: uppercase; }
        td { padding: 8px; vertical-align: middle; }
        
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .footer { margin-top: 30px; }
        .ttd-box { float: right; width: 200px; text-align: center; margin-top: 50px; }
        
        @media print { .no-print { display: none; } body { padding: 0; } }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #5D4037; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Cetak Laporan
        </button>
    </div>

    <div class="header">
        <h2>NATURE CLEAN SHOES SURABAYA</h2>
        <p>{{ strtoupper($judul) }}</p>
        <p>Periode: {{ ucfirst($filter) }} (Dicetak: {{ date('d M Y') }})</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                @if($kategori == 'pemasukan')
                    <th>Nama Pelanggan</th>
                    <th>Layanan</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                @elseif($kategori == 'pengeluaran')
                    <th>Kategori / Nama Barang</th>
                    <th>Tanggal</th>
                    <th>Nominal</th>
                @elseif($kategori == 'pelanggan')
                    <th>Nama Pelanggan</th>
                    <th>No. WhatsApp</th>
                    <th>Order Terakhir</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @php $totalDuit = 0; @endphp
            @forelse($data as $key => $item)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
                
                @if($kategori == 'pemasukan')
                    <td>{{ $item->nama_pelanggan }}</td>
                    <td>{{ $item->jenis_layanan }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') }}</td>
                    <td class="text-right">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    @php $totalDuit += $item->total_harga; @endphp

                @elseif($kategori == 'pengeluaran')
                    <td>{{ $item->nama_pengeluaran }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                    <td class="text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                    @php $totalDuit += $item->jumlah; @endphp

                @elseif($kategori == 'pelanggan')
                    <td>{{ $item->nama_pelanggan }}</td>
                    {{-- Diubah dari no_hp menjadi nomor_wa sesuai schema database --}}
                    <td class="text-center">{{ $item->nomor_wa ?? '-' }}</td>
                    <td class="text-center">
                        {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->format('d/m/Y') : '-' }}
                    </td>
                @endif
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Data tidak ditemukan untuk periode ini.</td>
            </tr>
            @endforelse
        </tbody>
        
        @if($kategori != 'pelanggan' && $data->count() > 0)
        <tfoot>
            <tr style="background: #f2f2f2; font-weight: bold;">
                <td colspan="{{ $kategori == 'pemasukan' ? '4' : '2' }}" class="text-right">GRAND TOTAL:</td>
                <td class="text-right">Rp {{ number_format($totalDuit, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
        @endif
    </table>

    <div class="footer">
        <div class="ttd-box">
            <p>Surabaya, {{ date('d M Y') }}</p>
            <p>Owner Nature Clean</p>
            <br><br><br><br>
            <p>( ____________________ )</p>
        </div>
        <div style="clear: both;"></div>
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        }
    </script>
</body>
</html>