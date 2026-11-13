@extends('layouts.admin')

@section('title', 'Detail Order #' . $order->order_number . ' — Kasir King Vapezone')
@section('header', 'PROSES PESANAN: ' . $order->order_number)

@section('content')

    <div class="space-y-6">

        <div class="flex items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-4">
            <div>
                <a href="{{ route('kasir.orders.index') }}" class="text-xs font-mono font-bold hover:text-lime-accent">← Kembali ke Antrean</a>
                <h2 class="font-display text-3xl text-pitch dark:text-paper mt-1">NO. PESANAN: {{ $order->order_number }}</h2>
            </div>
            <div>
                <span class="px-4 py-2 font-mono font-bold text-sm uppercase border-2 {{ $order->status_color }} shadow-[3px_3px_0px_#111]">
                    {{ $order->status_label }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Left: Order Details & Products (7 cols) -->
            <div class="lg:col-span-7 space-y-6">

                <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                    <h3 class="font-display text-2xl mb-4 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                        ITEM PESANAN
                    </h3>

                    <table class="w-full text-left text-xs font-mono">
                        <thead class="border-b uppercase text-gray-400">
                            <tr>
                                <th class="py-2">Produk</th>
                                <th class="py-2">Harga</th>
                                <th class="py-2 text-center">Qty</th>
                                <th class="py-2 text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                            @foreach($order->items as $item)
                                <tr>
                                    <td class="py-3 font-bold text-sm">{{ $item->product_name }}</td>
                                    <td class="py-3">Rp {{ number_format($item->product_price, 0, ',', '.') }}</td>
                                    <td class="py-3 text-center font-bold">{{ $item->quantity }}</td>
                                    <td class="py-3 text-right font-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="border-t-2 border-pitch dark:border-paper/20 font-bold text-sm">
                            <tr>
                                <td colspan="3" class="py-3 uppercase text-right">TOTAL:</td>
                                <td class="py-3 text-right font-display text-2xl text-lime-accent">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                    <h3 class="font-display text-2xl mb-4 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                        PENGIRIMAN & PEMBELI
                    </h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs font-mono">
                        <div>
                            <span class="text-gray-400 block">Nama Penerima:</span>
                            <span class="font-bold text-sm">{{ $order->name }}</span>
                        </div>
                        <div>
                            <span class="text-gray-400 block">WhatsApp:</span>
                            <span class="font-bold text-sm">
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $order->phone) }}" target="_blank" class="text-lime-accent underline font-bold">
                                    {{ $order->phone }} 💬 Hubungi Pelanggan
                                </a>
                            </span>
                        </div>
                        <div class="sm:col-span-2">
                            <span class="text-gray-400 block">Alamat Tujuan:</span>
                            <span class="font-medium text-sm">{{ $order->address }}</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right: Status & Payment Verification (5 cols) -->
            <div class="lg:col-span-5 space-y-6">

                <!-- Update Status Form -->
                <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                    <h3 class="font-display text-2xl mb-4 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                        UPDATE STATUS OLEH KASIR
                    </h3>

                    <form action="{{ route('kasir.orders.status', $order->id) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-xs font-mono font-bold uppercase mb-1">Status Baru</label>
                            <select name="status" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper font-bold">
                                <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status === 'confirmed' ? 'selected' : '' }}>Confirmed (Dikonfirmasi)</option>
                                <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing (Sedang Disiapkan)</option>
                                <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Shipped (Telah Dikirim)</option>
                                <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed (Selesai)</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-2.5 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>

                <!-- Verify Payment Box -->
                <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                    <h3 class="font-display text-2xl mb-4 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                        VERIFIKASI PEMBAYARAN
                    </h3>

                    @if($order->payment)
                        <div class="space-y-2 text-xs font-mono mb-4">
                            <div>Bank: <strong>{{ $order->payment->bank_name }} (a.n {{ $order->payment->account_name }})</strong></div>
                            <div>Nilai Transfer: <strong class="text-lime-accent">Rp {{ number_format($order->payment->amount, 0, ',', '.') }}</strong></div>
                        </div>

                        <div class="border-2 border-pitch p-2 bg-paper dark:bg-pitch mb-4">
                            <a href="{{ asset('storage/' . $order->payment->payment_proof) }}" target="_blank">
                                <img src="{{ asset('storage/' . $order->payment->payment_proof) }}" alt="Bukti Transfer" class="w-full h-48 object-cover">
                            </a>
                        </div>

                        @if($order->payment->status === 'pending')
                            <div class="grid grid-cols-2 gap-3">
                                <form action="{{ route('kasir.payments.verify', $order->payment->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="verified">
                                    <button type="submit" onclick="return confirm('Konfirmasi pembayaran valid?')" class="w-full py-2 bg-green-500 text-white font-bold text-xs uppercase border border-pitch shadow-[2px_2px_0px_#111]">
                                        ✓ Konfirmasi
                                    </button>
                                </form>

                                <form action="{{ route('kasir.payments.verify', $order->payment->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" onclick="return confirm('Tolak pembayaran?')" class="w-full py-2 bg-red-600 text-white font-bold text-xs uppercase border border-pitch shadow-[2px_2px_0px_#111]">
                                        ✕ Tolak
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="p-2 bg-paper dark:bg-pitch text-center text-xs font-mono font-bold uppercase border border-pitch">
                                Status: {{ $order->payment->status_label }}
                            </div>
                        @endif
                    @else
                        <p class="text-xs text-red-500 font-mono">Belum ada bukti pembayaran.</p>
                    @endif
                </div>

            </div>

        </div>

    </div>

@endsection
