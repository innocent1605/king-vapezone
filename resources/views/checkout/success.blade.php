@extends('layouts.app')

@section('title', 'Pesanan Berhasil — King Vapezone')

@section('content')

    <div class="max-w-3xl mx-auto px-4 py-16">
        <div class="border-4 border-pitch dark:border-lime-accent bg-white dark:bg-charcoal p-8 sm:p-12 text-center shadow-[8px_8px_0px_#111] dark:shadow-[8px_8px_0px_#D4FF00]">

            <div class="w-20 h-20 bg-lime-accent border-4 border-pitch flex items-center justify-center mx-auto mb-6 text-3xl shadow-[4px_4px_0px_#111]">
                ✓
            </div>

            <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">STATUS TRANSAKSI</span>
            <h1 class="font-display text-5xl sm:text-6xl text-pitch dark:text-paper leading-none mt-1 mb-3">
                PESANAN BERHASIL DIBUAT!
            </h1>
            <p class="text-sm text-graphite dark:text-gray-300 max-w-md mx-auto mb-6">
                Terima kasih! Pesanan Anda telah tercatat dalam sistem kami dan stok produk otomatis diperbarui.
            </p>

            <!-- Order Number Badge -->
            <div class="inline-block p-4 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch mb-8">
                <span class="text-xs font-mono uppercase text-gray-400 block">NOMOR PESANAN RESMI:</span>
                <span class="font-mono text-2xl font-black text-pitch dark:text-lime-accent tracking-wider select-all">
                    {{ $order->order_number }}
                </span>
            </div>

            <!-- WhatsApp Call To Action (Crucial feature) -->
            <div class="p-6 bg-lime-accent text-pitch border-2 border-pitch mb-8 shadow-[4px_4px_0px_#111]">
                <h3 class="font-display text-2xl tracking-wide mb-2">KIRIM KONFIRMASI KE WHATSAPP TOKO</h3>
                <p class="text-xs font-semibold mb-4 text-pitch/80">
                    Klik tombol di bawah untuk membuka WhatsApp resmi King Vapezone dengan pesan pesanan otomatis:
                </p>
                <a href="{{ $whatsappUrl }}" target="_blank" class="inline-flex items-center gap-2 px-8 py-4 bg-pitch text-lime-accent font-bold text-sm uppercase tracking-wider border-2 border-pitch hover:bg-paper hover:text-pitch transition shadow-[4px_4px_0px_#fff]">
                    <span>💬</span>
                    <span>Buka WhatsApp Sekarang →</span>
                </a>
            </div>

            <!-- Order Summary Table -->
            <div class="border-2 border-pitch dark:border-paper/20 p-5 text-left mb-8 bg-paper dark:bg-pitch/60">
                <h4 class="font-display text-xl mb-3 text-pitch dark:text-paper">RINCIAN PESANAN:</h4>
                <div class="space-y-2 text-xs font-mono">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Penerima:</span>
                        <span class="font-bold">{{ $order->name }} ({{ $order->phone }})</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Alamat:</span>
                        <span class="font-bold text-right max-w-xs">{{ $order->address }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Status Pembayaran:</span>
                        <span class="font-bold text-yellow-500 uppercase">{{ $order->payment->status_label ?? 'Menunggu Verifikasi' }}</span>
                    </div>
                    <div class="border-t border-gray-300 dark:border-gray-700 pt-2 flex justify-between text-sm">
                        <span class="font-bold">Total Pembayaran:</span>
                        <span class="font-bold text-lime-accent">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-center gap-4">
                <a href="{{ route('orders.show', $order->order_number) }}" class="px-6 py-3 border-2 border-pitch dark:border-paper bg-white dark:bg-charcoal text-pitch dark:text-paper font-bold text-xs uppercase tracking-wider shadow-[3px_3px_0px_#111] hover:bg-lime-accent hover:text-pitch transition">
                    Lihat Status Pesanan Saya
                </a>
                <a href="{{ route('products.index') }}" class="px-6 py-3 bg-lime-accent text-pitch border-2 border-pitch font-bold text-xs uppercase tracking-wider shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                    Lanjut Belanja →
                </a>
            </div>

        </div>
    </div>

@endsection
