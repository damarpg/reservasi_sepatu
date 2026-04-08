<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Pendapatan | Nature Clean</title>
    <style>
        body { 
            font-family: 'Helvetica', 'Arial', sans-serif; 
            font-size: 12px; 
            color: #333;
            line-height: 1.5;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 2px solid #444;
            padding-bottom: 10px;
        }
        .header h2 { margin: 0; color: #6F4E37; }
        .header p { margin: 5px 0; }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 20px;
        }
        table, th, td { 
            border: 1px solid #ccc; 
        }
        th { 
            background-color: #f8f5f2; 
            padding: 10px; 
            text-align: left;
            font-weight: bold;
        }
        td { 
            padding: 8px; 
            vertical-align: middle;
        }
        .text-right { text-align: right; }
        .fw-bold { font-weight: bold; }
        
        .footer { 
            margin-top: 50px; 
            text-align: right; 
            font-style: italic;
            font-size: 10px;
        }
        .summary-box {
            margin-top: 20px;
            width: 40%;
            float: right;
        }
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
                <th style="width: 5%;">No</th>
                <th>Nama Pelanggan</th>
                <th>Layanan</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $key => $res)
            <tr>
                <td style="text-align: center;">{{ $key + 1 }}</td>
                <td>{{ $res->nama_pelanggan }}</td>
                <td>{{ $res->jenis_layanan }}</td>
                <td>{{ \Carbon\Carbon::parse($res->tanggal_reservasi)->format('d M Y') }}</td>
                <td class="text-right">Rp {{ number_format($res->total_harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background-color: #eee;">
                <th colspan="4" class="text-right">GRAND TOTAL OMZET:</th>
                <th class="text-right">Rp {{ number_format($total, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak secara otomatis oleh Sistem Manajemen Nature Clean Shoes</p>
    </div>
</body>
</html>