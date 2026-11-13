@extends('layouts.app')

@section('title', 'Pesanan #' . $order->order_number . ' — King Vapezone')

@section('content')

    <div class="border-b-4 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <a href="{{ route('orders.index') }}" class="text-xs font-mono font-bold uppercase text-gray-500 hover:text-lime-accent">← Kembali ke Riwayat Pesanan</a>
                <h1 class="font-display text-4xl sm:text-5xl text-pitch dark:text-paper leading-none mt-1">
                    DETAIL PESANAN: {{ $order->order_number }}
                </h1>
            </div>

            <div>
                <span class="px-4 py-2 font-mono font-bold text-sm uppercase border-2 {{ $order->status_color }} shadow-[3px_3px_0px_#111]">
                    {{ $order->status_label }}
                </span>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Left: Order items & Customer data (8 cols) -->
            <div class="lg:col-span-8 space-y-8">

                <!-- Products table -->
                <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                    <h2 class="font-display text-3xl mb-4 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                        DAFTAR PRODUK
                    </h2>

                    <div class="divide-y divide-gray-200 dark:divide-gray-800">
                        @foreach($order->items as $item)
                            <div class="py-4 flex items-center justify-between gap-4">
                                <div>
                                    <h4 class="font-bold text-base">{{ $item->product_name }}</h4>
                                    <p class="text-xs font-mono text-gray-400 mt-1">
                                        {{ $item->quantity }} x Rp {{ number_format($item->product_price, 0, ',', '.') }}
                                    </p>
                                </div>
                                <span class="font-display text-2xl text-pitch dark:text-lime-accent">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </span>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-t-2 border-pitch dark:border-paper/20 pt-4 mt-4 flex justify-between items-baseline">
                        <span class="font-bold uppercase text-base">TOTAL PESANAN:</span>
                        <span class="font-display text-4xl text-pitch dark:text-lime-accent">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- Shipping details -->
                <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                    <h2 class="font-display text-3xl mb-4 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                        INFORMASI PENGIRIMAN
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-xs font-mono uppercase text-gray-400 block">Nama Penerima:</span>
                            <span class="font-bold">{{ $order->name }}</span>
                        </div>
                        <div>
                            <span class="text-xs font-mono uppercase text-gray-400 block">Nomor WhatsApp:</span>
                            <span class="font-bold">{{ $order->phone }}</span>
                        </div>
                        <div class="sm:col-span-2">
                            <span class="text-xs font-mono uppercase text-gray-400 block">Alamat Tujuan:</span>
                            <span class="font-medium leading-relaxed">{{ $order->address }}</span>
                        </div>
                        @if($order->notes)
                            <div class="sm:col-span-2">
                                <span class="text-xs font-mono uppercase text-gray-400 block">Catatan Tambahan:</span>
                                <span class="font-medium italic">{{ $order->notes }}</span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Right: Payment & WhatsApp actions (4 cols) -->
            <div class="lg:col-span-4 space-y-6">

                <!-- WhatsApp Notification Card -->
                <div class="p-6 bg-lime-accent text-pitch border-2 border-pitch shadow-[5px_5px_0px_#111]">
                    <h3 class="font-display text-2xl mb-2">HUBUNGI VIA WHATSAPP</h3>
                    <p class="text-xs font-semibold mb-4 text-pitch/80">
                        Pesan Anda dapat langsung dikonfirmasi dengan tim admin/kasir kami di WhatsApp.
                    </p>
                    <a href="{{ $whatsappUrl }}" target="_blank" class="w-full text-center py-3 bg-pitch text-lime-accent font-bold text-xs uppercase tracking-wider border-2 border-pitch block shadow-[3px_3px_0px_#fff] hover:bg-paper hover:text-pitch transition">
                        💬 Chat WhatsApp Toko
                    </a>
                </div>

                <!-- Payment Status & Proof -->
                <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                    <h3 class="font-display text-2xl mb-4 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                        BUKTI PEMBAYARAN
                    </h3>

                    @if($order->payment)
                        <div class="space-y-3 text-xs font-mono mb-4">
                            <div>
                                <span class="text-gray-400 block">Bank & Pengirim:</span>
                                <span class="font-bold text-sm">{{ $order->payment->bank_name }} a.n {{ $order->payment->account_name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-400 block">Status Verifikasi:</span>
                                <span class="font-bold uppercase text-sm {{ $order->payment->status === 'verified' ? 'text-green-500' : ($order->payment->status === 'rejected' ? 'text-red-500' : 'text-yellow-500') }}">
                                    {{ $order->payment->status_label }}
                                </span>
                            </div>
                            @if($order->payment->notes)
                                <div class="p-2 bg-yellow-100 dark:bg-yellow-950/40 border border-yellow-400 text-yellow-800 dark:text-yellow-200">
                                    Catatan Admin: {{ $order->payment->notes }}
                                </div>
                            @endif
                        </div>

                        <!-- Payment Proof Preview -->
                        <div class="border-2 border-pitch p-2 bg-paper dark:bg-pitch">
                            <a href="{{ asset('storage/' . $order->payment->payment_proof) }}" target="_blank">
                                <img src="{{ asset('storage/' . $order->payment->payment_proof) }}" alt="Bukti Transfer" class="w-full h-48 object-cover hover:opacity-90 transition">
                            </a>
                            <p class="text-[10px] text-center text-gray-400 mt-1 font-mono">Klik untuk perbesar gambar</p>
                        </div>
                    @else
                        <p class="text-xs text-red-500 font-bold mb-4">Belum ada bukti pembayaran diunggah.</p>
                    @endif

                    <!-- Upload Form (if pending) -->
                    @if($order->status === 'pending')
                        <div class="mt-6 pt-4 border-t-2 border-dashed border-gray-300 dark:border-gray-700">
                            <h4 class="font-bold text-xs uppercase tracking-wider mb-2">Unggah Ulang Bukti Transfer:</h4>
                            <form action="{{ route('orders.payment', $order->order_number) }}" method="POST" enctype="multipart/form-data" class="space-y-3">
                                @csrf
                                <input type="text" name="bank_name" placeholder="Nama Bank Pengirim" required class="w-full p-2 text-xs border border-pitch dark:border-paper/40 bg-transparent">
                                <input type="text" name="account_name" placeholder="Nama Pemilik Rekening" required class="w-full p-2 text-xs border border-pitch dark:border-paper/40 bg-transparent">
                                <input type="file" name="payment_proof" accept="image/*" required class="w-full text-xs">
                                <button type="submit" class="w-full py-2 bg-lime-accent text-pitch font-bold text-xs uppercase border-2 border-pitch shadow-[2px_2px_0px_#111]">
                                    Kirim Bukti Pembayaran
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </div>

@endsection
