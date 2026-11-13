@extends('layouts.app')

@section('title', 'Checkout Pembelian — King Vapezone')

@section('content')

    <div class="border-b-4 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">FINALISASI TRANSAKSI</span>
            <h1 class="font-display text-5xl text-pitch dark:text-paper leading-none mt-1">
                FORMULIR CHECKOUT & PEMBAYARAN
            </h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

                <!-- Left Column: Shipping & Payment Form (7 cols) -->
                <div class="lg:col-span-7 space-y-8">

                    <!-- Data Pengiriman -->
                    <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                        <h2 class="font-display text-3xl mb-6 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                            1. INFORMASI PENGIRIMAN
                        </h2>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Lengkap Penerima *</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-4 py-3 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-mono font-bold uppercase mb-1">Nomor WhatsApp Aktif *</label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required placeholder="Contoh: 081234567890" class="w-full px-4 py-3 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                                    <span class="text-[10px] text-gray-500 font-mono">Penting: untuk konfirmasi pesanan via WA</span>
                                </div>
                                <div>
                                    <label class="block text-xs font-mono font-bold uppercase mb-1">Email Pemesan</label>
                                    <input type="email" value="{{ $user->email }}" disabled class="w-full px-4 py-3 border-2 border-gray-300 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 text-gray-500 text-sm cursor-not-allowed">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-mono font-bold uppercase mb-1">Alamat Lengkap Pengiriman *</label>
                                <textarea name="address" rows="3" required placeholder="Nama jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kota/kabupaten, kode pos" class="w-full px-4 py-3 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">{{ old('address', $user->address) }}</textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-mono font-bold uppercase mb-1">Catatan Pesanan (Opsional)</label>
                                <input type="text" name="notes" value="{{ old('notes') }}" placeholder="Contoh: Titip di pos satpam, request bubble wrap tebal, dll." class="w-full px-4 py-3 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                            </div>
                        </div>
                    </div>

                    <!-- Metode Pembayaran & Transfer Manual -->
                    <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                        <h2 class="font-display text-3xl mb-6 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                            2. PEMBAYARAN TRANSFER MANUAL
                        </h2>

                        <!-- Info Rekening Toko (Highlight Box) -->
                        <div class="bg-lime-accent text-pitch border-2 border-pitch p-4 mb-6 shadow-[3px_3px_0px_#111]">
                            <div class="font-mono text-xs font-bold uppercase tracking-wider mb-2">REKENING PEMBAYARAN RESMI TOKO:</div>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-2 text-sm">
                                <div>
                                    <span class="text-xs uppercase font-mono block opacity-75">Bank:</span>
                                    <span class="font-bold text-base">{{ $bankInfo['name'] }}</span>
                                </div>
                                <div>
                                    <span class="text-xs uppercase font-mono block opacity-75">No. Rekening:</span>
                                    <span class="font-mono font-black text-lg select-all">{{ $bankInfo['account'] }}</span>
                                </div>
                                <div>
                                    <span class="text-xs uppercase font-mono block opacity-75">Atas Nama:</span>
                                    <span class="font-bold text-base">{{ $bankInfo['holder'] }}</span>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="payment_method" value="transfer">

                        <div class="space-y-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Bank Pengirim *</label>
                                    <input type="text" name="bank_name" value="{{ old('bank_name', 'BCA') }}" required placeholder="BCA / Mandiri / BNI / BRI / Jago" class="w-full px-4 py-3 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                                </div>
                                <div>
                                    <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Pemilik Rekening *</label>
                                    <input type="text" name="account_name" value="{{ old('account_name', $user->name) }}" required placeholder="Nama sesuai rekening bank Anda" class="w-full px-4 py-3 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-mono font-bold uppercase mb-1">Unggah Bukti Transfer *</label>
                                <input type="file" name="payment_proof" accept="image/*" required class="w-full p-2 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm file:mr-4 file:py-2 file:px-4 file:border-2 file:border-pitch file:text-xs file:font-bold file:uppercase file:bg-lime-accent file:text-pitch hover:file:bg-pitch hover:file:text-lime-accent">
                                <span class="text-[10px] text-gray-500 font-mono block mt-1">Format: JPG, JPEG, PNG, WEBP (Maks. 2MB)</span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Order Review & Total (5 cols) -->
                <div class="lg:col-span-5">
                    <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 sticky top-28 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">
                        <h2 class="font-display text-3xl mb-4 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                            PRODUK DIPESAN
                        </h2>

                        <!-- Items list -->
                        <div class="divide-y divide-gray-200 dark:divide-gray-800 max-h-64 overflow-y-auto mb-6">
                            @foreach($cart->items as $item)
                                <div class="py-3 flex justify-between items-center text-sm">
                                    <div>
                                        <p class="font-bold line-clamp-1">{{ $item->product->name }}</p>
                                        <p class="text-xs text-graphite dark:text-gray-400 font-mono">{{ $item->quantity }}x @ Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                                    </div>
                                    <span class="font-mono font-bold ml-4">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        <!-- Price calculation -->
                        <div class="border-t-2 border-pitch dark:border-paper/20 pt-4 space-y-2 text-sm font-semibold mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Total Item</span>
                                <span class="font-mono">{{ $cart->item_count }} pcs</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500 dark:text-gray-400">Subtotal Belanja</span>
                                <span class="font-mono">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t-2 border-dashed border-gray-300 dark:border-gray-700 pt-3 flex justify-between items-baseline">
                                <span class="font-bold uppercase text-lg">TOTAL BAYAR</span>
                                <span class="font-display text-4xl text-pitch dark:text-lime-accent">
                                    Rp {{ number_format($cart->total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 px-6 bg-lime-accent text-pitch border-2 border-pitch font-bold text-sm uppercase tracking-wider shadow-[4px_4px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                            BAYAR & BUAT PESANAN SEKARANG →
                        </button>

                        <p class="text-[11px] text-gray-500 text-center font-mono mt-3">
                            🔒 Transaksi terenkripsi aman. Setelah pesanan dibuat, sistem otomatis membuka WhatsApp konfirmasi.
                        </p>
                    </div>
                </div>

            </div>
        </form>
    </div>

@endsection
