<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pendapatan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid #333; }
        th, td { padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        .footer { margin-top: 30px; text-align: right; }
    </style>
</head>
<body>
    <div class="header">
        <h2>NATURE CLEAN SHOES SURABAYA</h2>
        <p>Laporan Rekapitulasi Reservasi Pelanggan</p>
        <p>Tanggal Cetak: {{ $date }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Layanan</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $key => $res)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $res->nama_pelanggan }}</td>
                <td>{{ $res->jenis_layanan }}</td>
                <td>{{ $res->tanggal_reservasi }}</td>
                <td>Rp {{ number_format($res->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" style="text-align: right;">GRAND TOTAL:</th>
                <th>Rp {{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak Secara Otomatis oleh Sistem Reservasi</p>
    </div>
</body>
</html>