@extends('layouts.admin')

@section('title', 'Dashboard Admin — King Vapezone')
@section('header', 'DASHBOARD ADMIN UTAMA')

@section('content')

    <div class="space-y-8">

        <!-- 4 Stats Cards Grid (Neo-Brutalist) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Stat 1: Total Orders -->
            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-mono font-bold uppercase text-gray-400">TOTAL TRANSAKSI</span>
                    <span class="text-xl">🛒</span>
                </div>
                <div class="font-display text-4xl text-pitch dark:text-paper">{{ $stats['total_orders'] }}</div>
                <div class="text-[11px] font-mono text-gray-500 mt-2">Semua pesanan masuk</div>
            </div>

            <!-- Stat 2: Total Revenue -->
            <div class="border-2 border-pitch dark:border-paper/20 bg-lime-accent text-pitch p-6 shadow-[4px_4px_0px_#111]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-mono font-bold uppercase opacity-80">TOTAL PENDAPATAN</span>
                    <span class="text-xl">💰</span>
                </div>
                <div class="font-display text-3xl sm:text-4xl leading-tight">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
                <div class="text-[11px] font-mono opacity-80 mt-2">Hari ini: Rp {{ number_format($stats['today_revenue'], 0, ',', '.') }}</div>
            </div>

            <!-- Stat 3: Pending Orders -->
            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-mono font-bold uppercase text-yellow-500">PESANAN PENDING</span>
                    <span class="text-xl">⏳</span>
                </div>
                <div class="font-display text-4xl text-yellow-500">{{ $stats['pending_orders'] }}</div>
                <div class="text-[11px] font-mono text-gray-500 mt-2">Perlu verifikasi & proses</div>
            </div>

            <!-- Stat 4: Total Customers & Products -->
            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-mono font-bold uppercase text-gray-400">PELANGGAN / PRODUK</span>
                    <span class="text-xl">👥</span>
                </div>
                <div class="font-display text-4xl text-pitch dark:text-paper">
                    {{ $stats['total_customers'] }} <span class="text-xl font-normal text-gray-400">/ {{ $stats['total_products'] }}</span>
                </div>
                <div class="text-[11px] font-mono text-gray-500 mt-2">Pelanggan terdaftar & item produk</div>
            </div>

        </div>

        <!-- Sales Chart Section -->
        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-4 mb-6 gap-2">
                <div>
                    <h2 class="font-display text-3xl text-pitch dark:text-paper">GRAFIK TREN PENJUALAN</h2>
                    <p class="text-xs font-mono text-gray-400">Total omset pendapatan bulanan</p>
                </div>
                <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 bg-lime-accent text-pitch font-bold text-xs uppercase border border-pitch shadow-[2px_2px_0px_#111]">
                    Buka Laporan Penuh →
                </a>
            </div>

            <div class="h-72 w-full">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Grid 2 Columns: Top Products & Recent Orders -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Top Products (5 cols) -->
            <div class="lg:col-span-5 border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                <h3 class="font-display text-2xl mb-4 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                    PRODUK TERLARIS
                </h3>

                @if($topProducts->count() > 0)
                    <div class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($topProducts as $top)
                            <div class="py-3 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <span class="font-display text-2xl text-lime-accent">#{{ $loop->iteration }}</span>
                                    <div>
                                        <h4 class="font-bold text-sm line-clamp-1">{{ $top->name }}</h4>
                                        <span class="text-xs font-mono text-gray-400">Terjual: {{ $top->total_sold }} pcs</span>
                                    </div>
                                </div>
                                <span class="font-mono font-bold text-xs">
                                    Rp {{ number_format($top->total_revenue, 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-gray-400 py-6 text-center font-mono">Belum ada data penjualan produk.</p>
                @endif
            </div>

            <!-- Recent Orders (7 cols) -->
            <div class="lg:col-span-7 border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                <div class="flex items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-2 mb-4">
                    <h3 class="font-display text-2xl text-pitch dark:text-paper">PESANAN TERAKHIR</h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-mono font-bold hover:text-lime-accent">Lihat Semua →</a>
                </div>

                @if($recentOrders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs font-mono">
                            <thead class="border-b border-pitch dark:border-paper/20 uppercase bg-paper dark:bg-surface-dark">
                                <tr>
                                    <th class="p-2">No. Order</th>
                                    <th class="p-2">Pelanggan</th>
                                    <th class="p-2">Total</th>
                                    <th class="p-2">Status</th>
                                    <th class="p-2 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                                @foreach($recentOrders as $order)
                                    <tr>
                                        <td class="p-2 font-bold">{{ $order->order_number }}</td>
                                        <td class="p-2">{{ $order->name }}</td>
                                        <td class="p-2">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td class="p-2">
                                            <span class="px-2 py-0.5 text-[10px] font-bold uppercase border {{ $order->status_color }}">
                                                {{ $order->status_label }}
                                            </span>
                                        </td>
                                        <td class="p-2 text-right">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="px-2 py-1 bg-lime-accent text-pitch font-bold uppercase border border-pitch">
                                                Cek
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-xs text-gray-400 py-6 text-center font-mono">Belum ada pesanan masuk.</p>
                @endif
            </div>

        </div>

    </div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const labels = @json($monthlyChart['labels'] ?? []);
        const data = @json($monthlyChart['data'] ?? []);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: data,
                    backgroundColor: '#D4FF00',
                    borderColor: '#111111',
                    borderWidth: 2,
                    borderRadius: 0,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value / 1000).toLocaleString('id-ID') + 'k';
                            }
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
