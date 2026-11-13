@extends('layouts.admin')

@section('title', 'Laporan & Rekap Penjualan — Admin King Vapezone')
@section('header', 'LAPORAN PENJUALAN TOKO')

@section('content')

    <div class="space-y-8">

        <!-- Header & Date Filter -->
        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                <div>
                    <h2 class="font-display text-3xl text-pitch dark:text-paper">FILTER PERIODE LAPORAN</h2>
                    <p class="text-xs font-mono text-gray-400">Pilih rentang tanggal untuk menganalisis performa toko</p>
                </div>

                <!-- Export PDF button -->
                <a href="{{ route('admin.reports.export-pdf', ['start_date' => $startDate->format('Y-m-d'), 'end_date' => $endDate->format('Y-m-d')]) }}" target="_blank" class="px-6 py-3 bg-red-600 text-white font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-red-500 transition inline-flex items-center gap-2">
                    <span>📄</span>
                    <span>Download / Export PDF</span>
                </a>
            </div>

            <form action="{{ route('admin.reports.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Tanggal Mulai</label>
                    <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="w-full px-3 py-2 text-xs border border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                </div>
                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Tanggal Akhir</label>
                    <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="w-full px-3 py-2 text-xs border border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                </div>
                <div class="flex items-end">
                    <button type="submit" class="w-full py-2.5 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[2px_2px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                        Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- 3 Summary Metrics -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            <div class="border-2 border-pitch dark:border-paper/20 bg-lime-accent text-pitch p-6 shadow-[4px_4px_0px_#111]">
                <span class="text-xs font-mono font-bold uppercase opacity-80 block">TOTAL OMSET PERIODE INI</span>
                <span class="font-display text-4xl leading-tight">Rp {{ number_format($salesData['total_revenue'], 0, ',', '.') }}</span>
                <span class="text-[11px] font-mono block mt-1">Dari {{ $salesData['total_orders'] }} transaksi non-batal</span>
            </div>

            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                <span class="text-xs font-mono font-bold uppercase text-gray-400 block">TOTAL PESANAN SELESAI/PROSES</span>
                <span class="font-display text-4xl text-pitch dark:text-paper leading-tight">{{ $salesData['total_orders'] }}</span>
                <span class="text-[11px] font-mono text-gray-400 block mt-1">Rata-rata order: Rp {{ number_format($salesData['average_order_value'], 0, ',', '.') }}</span>
            </div>

            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                <span class="text-xs font-mono font-bold uppercase text-gray-400 block">PRODUK TERLARIS</span>
                <span class="font-display text-2xl text-pitch dark:text-lime-accent leading-tight line-clamp-1">
                    {{ $topProducts->first()->name ?? 'Belum ada' }}
                </span>
                <span class="text-[11px] font-mono text-gray-400 block mt-1">Terjual: {{ $topProducts->first()->total_sold ?? 0 }} unit</span>
            </div>
        </div>

        <!-- Orders Detailed List in Period -->
        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
            <h3 class="font-display text-2xl mb-4 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                RINCIAN TRANSAKSI DALAM PERIODE
            </h3>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs font-mono">
                    <thead class="border-b uppercase bg-paper dark:bg-surface-dark">
                        <tr>
                            <th class="p-2">No. Order</th>
                            <th class="p-2">Tanggal</th>
                            <th class="p-2">Nama Pembeli</th>
                            <th class="p-2">Items</th>
                            <th class="p-2">Total Nilai</th>
                            <th class="p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                        @forelse($orders as $ord)
                            <tr>
                                <td class="p-2 font-bold">{{ $ord->order_number }}</td>
                                <td class="p-2 text-gray-400">{{ $ord->created_at->format('d/m/Y') }}</td>
                                <td class="p-2">{{ $ord->name }}</td>
                                <td class="p-2">{{ $ord->items->sum('quantity') }} pcs</td>
                                <td class="p-2 font-bold text-lime-accent">Rp {{ number_format($ord->total, 0, ',', '.') }}</td>
                                <td class="p-2">
                                    <span class="px-2 py-0.5 text-[9px] uppercase font-bold border {{ $ord->status_color }}">
                                        {{ $ord->status_label }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="p-8 text-center text-gray-400">
                                    Tidak ada transaksi pada rentang tanggal yang dipilih.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </div>

    </div>

@endsection
