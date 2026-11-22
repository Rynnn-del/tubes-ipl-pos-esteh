<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pembayaran - Es Teh</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f5f5f5;
            padding: 30px;
            color: #333;
        }

        .struk {
            width: 380px;
            margin: auto;
            background: white;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header {
            text-align: center;
            border-bottom: 1px dashed #999;
            padding-bottom: 15px;
            margin-bottom: 15px;
        }

        .header h2 {
            color: #d35400;
            margin-bottom: 5px;
        }

        .info {
            font-size: 13px;
            line-height: 1.8;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th, td {
            padding: 8px 3px;
            text-align: left;
        }

        th {
            border-bottom: 1px dashed #999;
        }

        .right {
            text-align: right;
        }

        .total {
            border-top: 1px dashed #999;
            margin-top: 12px;
            padding-top: 12px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
        }

        .footer {
            text-align: center;
            border-top: 1px dashed #999;
            margin-top: 20px;
            padding-top: 15px;
            font-size: 12px;
        }

        .actions {
            text-align: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            background: #d35400;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        @media print {
            body {
                background: white;
                padding: 0;
            }

            .struk {
                box-shadow: none;
                width: 100%;
            }

            .actions {
                display: none;
            }
        }
    </style>
</head>

<body>

<div class="struk">

    <div class="header">
        <h2>ES TEH</h2>
        <p>Terima kasih sudah berbelanja!</p>
    </div>

    <div class="info">
        <div>ID Transaksi: {{ $transaksi->id_transaksi }}</div>
        <div>Tanggal: {{ $transaksi->tanggal_transaksi }}</div>
        <div>Kasir: {{ $transaksi->user->nama ?? '-' }}</div>
        <div>Pelanggan: {{ $transaksi->pesanan->pelanggan->nama_pelanggan ?? '-' }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Menu</th>
                <th class="right">Qty</th>
                <th class="right">Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($transaksi->pesanan->detail_pesanan as $detail)
                <tr>
                    <td>{{ $detail->menu->nama_menu ?? '-' }}</td>
                    <td class="right">{{ $detail->jumlah }}</td>
                    <td class="right">
                        Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <span>Total Bayar</span>
        <span>Rp {{ number_format($transaksi->total_bayar, 0, ',', '.') }}</span>
    </div>

    <div class="info" style="margin-top: 12px;">
        <div>Metode: {{ $transaksi->pembayaran->metode_pembayaran ?? '-' }}</div>
        <div>Status: {{ $transaksi->status_transaksi }}</div>
    </div>

    <div class="footer">
        <p>Terima kasih atas kunjungan Anda.</p>
        <p>Selamat menikmati Es Teh!</p>
    </div>

    <div class="actions">
        <button onclick="window.print()">Cetak Struk</button>
    </div>

</div>

</body>
</html>
