@extends('layouts.admin')

@section('title', 'Manajemen Pesanan — Admin King Vapezone')
@section('header', 'SEMUA TRANSAKSI & PESANAN')

@section('content')

    <div class="space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-display text-3xl text-pitch dark:text-paper">DATA PESANAN MASUK</h2>
                <p class="text-xs font-mono text-gray-400">Total pesanan: {{ $orders->total() }} transaksi</p>
            </div>
        </div>

        <!-- Filter tabs & search -->
        <div class="space-y-4">
            <div class="flex flex-wrap gap-2">
                @php
                    $statusTabs = [
                        'all' => 'Semua',
                        'pending' => 'Pending',
                        'confirmed' => 'Dikonfirmasi',
                        'processing' => 'Diproses',
                        'shipped' => 'Dikirim',
                        'completed' => 'Selesai',
                        'cancelled' => 'Batal',
                    ];
                    $currentStatus = request('status', 'all');
                @endphp
                @foreach($statusTabs as $tabKey => $tabLabel)
                    <a href="{{ route('admin.orders.index', array_merge(request()->all(), ['status' => $tabKey])) }}" class="px-3 py-1.5 border-2 border-pitch dark:border-paper/30 text-xs font-bold uppercase transition {{ $currentStatus === $tabKey ? 'bg-lime-accent text-pitch shadow-[2px_2px_0px_#111]' : 'bg-white dark:bg-charcoal text-pitch dark:text-paper hover:bg-lime-accent hover:text-pitch' }}">
                        {{ $tabLabel }}
                    </a>
                @endforeach
            </div>

            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-4 shadow-[4px_4px_0px_#111]">
                <form action="{{ route('admin.orders.index') }}" method="GET" class="flex gap-3">
                    <input type="hidden" name="status" value="{{ request('status', 'all') }}">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor order / nama pemesan / no HP..." class="flex-1 px-3 py-2 text-xs border border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                    <button type="submit" class="px-4 py-2 bg-pitch text-paper dark:bg-paper dark:text-pitch font-bold text-xs uppercase">
                        Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Orders Table -->
        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00] overflow-x-auto">
            <table class="w-full text-left text-xs font-mono">
                <thead class="border-b-2 border-pitch dark:border-paper/20 uppercase bg-paper dark:bg-surface-dark">
                    <tr>
                        <th class="p-3">No. Order</th>
                        <th class="p-3">Pemesan</th>
                        <th class="p-3">Tanggal</th>
                        <th class="p-3">Total Belanja</th>
                        <th class="p-3">Status Order</th>
                        <th class="p-3">Pembayaran</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($orders as $order)
                        <tr class="hover:bg-lime-accent/10 transition">
                            <td class="p-3 font-bold text-sm">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="hover:text-lime-accent hover:underline">
                                    {{ $order->order_number }}
                                </a>
                            </td>
                            <td class="p-3">
                                <div class="font-bold text-sm">{{ $order->name }}</div>
                                <div class="text-[10px] text-gray-400">{{ $order->phone }}</div>
                            </td>
                            <td class="p-3 text-gray-400">
                                {{ $order->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="p-3 font-bold text-sm text-lime-accent dark:text-lime-accent">
                                Rp {{ number_format($order->total, 0, ',', '.') }}
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 text-[10px] font-bold uppercase border {{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="p-3">
                                @if($order->payment)
                                    <span class="px-2 py-0.5 font-bold uppercase text-[10px] {{ $order->payment->status === 'verified' ? 'text-green-500' : ($order->payment->status === 'rejected' ? 'text-red-500' : 'text-yellow-500') }}">
                                        {{ $order->payment->status_label }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-[10px]">Belum Bayar</span>
                                @endif
                            </td>
                            <td class="p-3 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="px-3 py-1.5 bg-lime-accent text-pitch font-bold uppercase border border-pitch shadow-[2px_2px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                                    Proses / Cek
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400 font-mono">
                                Tidak ada data pesanan yang sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $orders->links() }}
        </div>

    </div>

@endsection
