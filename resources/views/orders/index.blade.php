@extends('layouts.app')

@section('title', 'Riwayat Pesanan Saya — King Vapezone')

@section('content')

    <div class="border-b-4 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">CUSTOMER DASHBOARD</span>
            <h1 class="font-display text-5xl text-pitch dark:text-paper leading-none mt-1">
                RIWAYAT PESANAN SAYA
            </h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Status Filter Tabs -->
        <div class="flex flex-wrap gap-2 mb-8">
            @php
                $statusTabs = [
                    'all' => 'Semua Pesanan',
                    'pending' => 'Menunggu Pembayaran',
                    'confirmed' => 'Dikonfirmasi',
                    'processing' => 'Diproses',
                    'shipped' => 'Dikirim',
                    'completed' => 'Selesai',
                ];
                $activeTab = request('status', 'all');
            @endphp

            @foreach($statusTabs as $statusKey => $statusName)
                <a href="{{ route('orders.index', ['status' => $statusKey]) }}" class="px-4 py-2 border-2 border-pitch dark:border-paper/40 font-bold text-xs uppercase tracking-wider transition {{ $activeTab === $statusKey ? 'bg-lime-accent text-pitch shadow-[3px_3px_0px_#111]' : 'bg-white dark:bg-charcoal text-pitch dark:text-paper hover:bg-lime-accent hover:text-pitch' }}">
                    {{ $statusName }}
                </a>
            @endforeach
        </div>

        @if($orders->count() > 0)
            <div class="space-y-6">
                @foreach($orders as $order)
                    <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-4 mb-4 gap-4">
                            <div>
                                <span class="font-mono text-xs text-gray-500 uppercase block">NO. PESANAN:</span>
                                <span class="font-mono text-lg font-black text-pitch dark:text-paper">{{ $order->order_number }}</span>
                                <span class="text-xs text-gray-400 block font-mono">{{ $order->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                            </div>

                            <div class="flex items-center gap-3">
                                <span class="px-3 py-1 font-mono font-bold text-xs uppercase border-2 {{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>

                                <a href="{{ route('orders.show', $order->order_number) }}" class="px-4 py-2 bg-pitch text-paper dark:bg-paper dark:text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch hover:bg-lime-accent hover:text-pitch transition">
                                    Detail Pesanan →
                                </a>
                            </div>
                        </div>

                        <!-- Item list preview -->
                        <div class="space-y-2 mb-4">
                            @foreach($order->items as $item)
                                <div class="flex justify-between items-center text-sm">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold">{{ $item->product_name }}</span>
                                        <span class="text-xs font-mono text-gray-400">x{{ $item->quantity }}</span>
                                    </div>
                                    <span class="font-mono font-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-dashed border-gray-300 dark:border-gray-700 pt-3 flex justify-between items-center text-sm">
                            <span class="text-xs text-gray-400 font-mono">Status Pembayaran: <strong class="text-pitch dark:text-paper">{{ $order->payment->status_label ?? 'Belum ada' }}</strong></span>
                            <div>
                                <span class="text-xs uppercase font-mono mr-2">Total:</span>
                                <span class="font-display text-2xl text-pitch dark:text-lime-accent">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-12 text-center shadow-[6px_6px_0px_#111]">
                <div class="text-5xl mb-3">📦</div>
                <h3 class="font-display text-3xl mb-2">BELUM ADA PESANAN</h3>
                <p class="text-sm text-gray-400 mb-6">Anda belum memiliki pesanan dengan filter status yang dipilih.</p>
                <a href="{{ route('products.index') }}" class="inline-block px-6 py-3 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111]">
                    Mulai Belanja Produk →
                </a>
            </div>
        @endif

    </div>

@endsection
