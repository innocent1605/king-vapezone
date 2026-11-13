<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan King Vapezone</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #111;
            margin: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #111;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 22px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        .header p {
            margin: 4px 0 0 0;
            font-size: 10px;
            color: #555;
        }
        .meta-table, .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .meta-table td {
            padding: 4px;
        }
        .data-table th, .data-table td {
            border: 1px solid #333;
            padding: 6px 8px;
            text-align: left;
        }
        .data-table th {
            background-color: #f2f2f2;
            text-transform: uppercase;
            font-size: 10px;
        }
        .summary-box {
            background: #fafafa;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>KING VAPEZONE</h1>
        <p>LAPORAN REKAPITULASI PENJUALAN TOKO</p>
        <p>Periode: <strong>{{ $startDate }}</strong> s/d <strong>{{ $endDate }}</strong></p>
    </div>

    <!-- Summary Box -->
    <div class="summary-box">
        <table style="width: 100%;">
            <tr>
                <td><strong>Total Transaksi:</strong> {{ $salesData['total_orders'] }} Order</td>
                <td><strong>Total Omset:</strong> Rp {{ number_format($salesData['total_revenue'], 0, ',', '.') }}</td>
                <td><strong>Rata-rata Order:</strong> Rp {{ number_format($salesData['average_order_value'], 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <!-- Top Products -->
    <h3>PRODUK TERLARIS (TOP SALES)</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 40px;">No</th>
                <th>Nama Produk</th>
                <th style="width: 80px; text-align: center;">Qty Terjual</th>
                <th style="width: 120px; text-align: right;">Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            @forelse($topProducts as $idx => $prod)
                <tr>
                    <td style="text-align: center;">{{ $idx + 1 }}</td>
                    <td><strong>{{ $prod->name }}</strong></td>
                    <td style="text-align: center;">{{ $prod->total_sold }} pcs</td>
                    <td style="text-align: right;">Rp {{ number_format($prod->total_revenue, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data produk.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Detailed Orders -->
    <h3>RINCIAN TRANSAKSI</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th>No. Order</th>
                <th>Tanggal</th>
                <th>Pembeli</th>
                <th>No. HP</th>
                <th>Status</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $ord)
                <tr>
                    <td><strong>{{ $ord->order_number }}</strong></td>
                    <td>{{ $ord->created_at->format('d/m/Y') }}</td>
                    <td>{{ $ord->name }}</td>
                    <td>{{ $ord->phone }}</td>
                    <td style="text-transform: uppercase;">{{ $ord->status }}</td>
                    <td style="text-align: right;">Rp {{ number_format($ord->total, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Tidak ada transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Dicetak otomatis oleh Sistem King Vapezone pada: {{ $generatedAt }}
    </div>

</body>
</html>
