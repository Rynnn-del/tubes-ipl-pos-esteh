<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Es Teh</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f6fa;
            color: #333;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: auto;
        }

        .header {
            margin-bottom: 25px;
        }

        .header h1 {
            color: #222;
            margin-bottom: 8px;
        }

        .header p {
            color: #777;
        }

        .summary {
            display: flex;
            gap: 20px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        .summary-card {
            background: white;
            padding: 22px;
            border-radius: 10px;
            flex: 1;
            min-width: 200px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .summary-card p {
            color: #777;
            margin-bottom: 10px;
        }

        .summary-card h2 {
            color: #d35400;
        }

        .table-container {
            background: white;
            padding: 22px;
            border-radius: 10px;
            overflow-x: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .table-container h2 {
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 850px;
        }

        th, td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }

        th {
            background: #fff3e0;
            color: #8a3b00;
        }

        .status {
            background: #d4edda;
            color: #155724;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
        }

        .empty {
            text-align: center;
            padding: 30px;
            color: #888;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #d35400;
            text-decoration: none;
        }
    </style>
</head>

<body>
<div class="container">

    <a href="/kasir" class="back">← Kembali ke Kasir</a>

    <div class="header">
        <h1>Riwayat Transaksi</h1>
        <p>Daftar seluruh transaksi penjualan Es Teh</p>
    </div>

    <div class="summary">
        <div class="summary-card">
            <p>Total Transaksi</p>
            <h2>{{ $transaksis->count() }}</h2>
        </div>

        <div class="summary-card">
            <p>Total Pendapatan</p>
            <h2>Rp {{ number_format($transaksis->sum('total_bayar'), 0, ',', '.') }}</h2>
        </div>
    </div>

    
<div class="table-container">
    <h2>Data Transaksi</h2>

    <form action="{{ url('/laporan/transaksi') }}" method="GET"
          style="display:flex; gap:12px; flex-wrap:wrap; margin-bottom:25px;">

        <input
            type="text"
            name="keyword"
            placeholder="Cari ID transaksi atau nama pelanggan..."
            value="{{ request('keyword') }}"
            style="padding:11px; border:1px solid #ddd; border-radius:6px; flex:2; min-width:200px;"
        >

        <input
            type="date"
            name="tanggal_awal"
            value="{{ request('tanggal_awal') }}"
            style="padding:11px; border:1px solid #ddd; border-radius:6px;"
        >

        <input
            type="date"
            name="tanggal_akhir"
            value="{{ request('tanggal_akhir') }}"
            style="padding:11px; border:1px solid #ddd; border-radius:6px;"
        >

        <button type="submit"
                style="padding:11px 18px; background:#d35400; color:white; border:0; border-radius:6px; cursor:pointer;">
            Cari
        </button>

        <a href="{{ url('/laporan/transaksi') }}"
           style="padding:11px 18px; background:#eee; color:#333; border-radius:6px; text-decoration:none;">
            Reset
        </a>
    </form>

        </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>ID Transaksi</th>
                <th>Tanggal</th>
                <th>Pelanggan</th>
                <th>Kasir</th>
                <th>Metode Pembayaran</th>
                <th>Total Bayar</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($transaksis as $index => $transaksi)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $transaksi->id_transaksi }}</td>
                    <td>{{ $transaksi->tanggal_transaksi }}</td>
                    <td>{{ $transaksi->pesanan->pelanggan->nama_pelanggan ?? '-' }}</td>
                    <td>{{ $transaksi->user->nama ?? '-' }}</td>
                    <td>{{ $transaksi->pembayaran->metode_pembayaran ?? '-' }}</td>
                    <td>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</td>
                    <td>{{ $transaksi->status_transaksi }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="empty">
                        Belum ada data transaksi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>
</body>
</html>