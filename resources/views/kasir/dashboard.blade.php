@extends('layouts.admin')

@section('title', 'Dashboard Kasir — King Vapezone')
@section('header', 'PANEL KASIR & OPERASIONAL')

@section('content')

    <div class="space-y-8">

        <!-- 3 Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">

            <!-- Stat 1 -->
            <div class="border-2 border-pitch dark:border-paper/20 bg-lime-accent text-pitch p-6 shadow-[4px_4px_0px_#111]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-mono font-bold uppercase opacity-80">PENDAPATAN HARI INI</span>
                    <span class="text-xl">💰</span>
                </div>
                <div class="font-display text-4xl">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</div>
                <div class="text-[11px] font-mono opacity-80 mt-2">Total penjualan hari ini</div>
            </div>

            <!-- Stat 2 -->
            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-mono font-bold uppercase text-gray-400">TRANSAKSI HARI INI</span>
                    <span class="text-xl">🧾</span>
                </div>
                <div class="font-display text-4xl text-pitch dark:text-paper">{{ $todayOrders }}</div>
                <div class="text-[11px] font-mono text-gray-400 mt-2">Pesanan masuk hari ini</div>
            </div>

            <!-- Stat 3 -->
            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-xs font-mono font-bold uppercase text-yellow-500">MENUNGGU VERIFIKASI</span>
                    <span class="text-xl">⏳</span>
                </div>
                <div class="font-display text-4xl text-yellow-500">{{ $pendingOrders }}</div>
                <div class="text-[11px] font-mono text-gray-400 mt-2">Segera cek bukti transfer</div>
            </div>

        </div>

        <!-- Pending Orders Priority List -->
        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">
            <div class="flex items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-4 mb-4">
                <div>
                    <h2 class="font-display text-3xl text-pitch dark:text-paper">ANTREAN PESANAN PENDING</h2>
                    <p class="text-xs font-mono text-gray-400">Verifikasi bukti transfer pelanggan untuk mempercepat pengiriman</p>
                </div>
                <a href="{{ route('kasir.orders.index', ['status' => 'pending']) }}" class="px-4 py-2 bg-lime-accent text-pitch font-bold text-xs uppercase border border-pitch shadow-[2px_2px_0px_#111]">
                    Semua Pending →
                </a>
            </div>

            @if($recentPending->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-xs font-mono">
                        <thead class="border-b uppercase bg-paper dark:bg-surface-dark">
                            <tr>
                                <th class="p-3">No. Order</th>
                                <th class="p-3">Pembeli</th>
                                <th class="p-3">No. WhatsApp</th>
                                <th class="p-3">Total Belanja</th>
                                <th class="p-3">Waktu Order</th>
                                <th class="p-3 text-right">Aksi Kasir</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                            @foreach($recentPending as $ord)
                                <tr>
                                    <td class="p-3 font-bold text-sm">{{ $ord->order_number }}</td>
                                    <td class="p-3 font-bold">{{ $ord->name }}</td>
                                    <td class="p-3">
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ord->phone) }}" target="_blank" class="text-lime-accent underline font-bold">
                                            {{ $ord->phone }} 💬
                                        </a>
                                    </td>
                                    <td class="p-3 font-bold text-lime-accent">Rp {{ number_format($ord->total, 0, ',', '.') }}</td>
                                    <td class="p-3 text-gray-400">{{ $ord->created_at->diffForHumans() }}</td>
                                    <td class="p-3 text-right">
                                        <a href="{{ route('kasir.orders.show', $ord->id) }}" class="px-3 py-1.5 bg-lime-accent text-pitch font-bold uppercase border border-pitch shadow-[2px_2px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                                            Verifikasi & Proses
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="p-8 text-center text-gray-400 font-mono">
                    🎉 Luar biasa! Tidak ada antrean pesanan pending saat ini.
                </div>
            @endif
        </div>

        <!-- Quick actions -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <a href="{{ route('kasir.orders.index') }}" class="p-5 border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal shadow-[4px_4px_0px_#111] hover:bg-lime-accent hover:text-pitch transition">
                <span class="font-display text-2xl block">LIHAT SEMUA PESANAN →</span>
                <span class="text-xs font-mono opacity-80">Pantau seluruh riwayat transaksi toko</span>
            </a>
            <a href="{{ route('kasir.products.index') }}" class="p-5 border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal shadow-[4px_4px_0px_#111] hover:bg-lime-accent hover:text-pitch transition">
                <span class="font-display text-2xl block">UPDATE STOK PRODUK →</span>
                <span class="text-xs font-mono opacity-80">Perbarui ketersediaan unit dan harga saat admin sibuk</span>
            </a>
        </div>

    </div>

@endsection
