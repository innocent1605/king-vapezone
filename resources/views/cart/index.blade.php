@extends('layouts.app')

@section('title', 'Keranjang Belanja — King Vapezone')

@section('content')

    <div class="border-b-4 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">ORDER CHECK</span>
            <h1 class="font-display text-5xl text-pitch dark:text-paper leading-none mt-1">
                KERANJANG BELANJA
            </h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($cart->items->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                <!-- Items Table / List (8 cols) -->
                <div class="lg:col-span-8 space-y-4">
                    @foreach($cart->items as $item)
                        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-4 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">

                            <!-- Product Info -->
                            <div class="flex items-center gap-4 w-full sm:w-auto">
                                <div class="w-20 h-20 bg-paper dark:bg-surface-dark border-2 border-pitch flex-shrink-0 flex items-center justify-center p-2">
                                    @if($item->product->image)
                                        <img src="{{ Str::startsWith($item->product->image, 'images/') ? asset($item->product->image) : asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-contain">
                                    @else
                                        <span class="font-mono text-xs font-bold">VAPE</span>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-[10px] font-mono font-bold uppercase bg-lime-accent text-pitch px-1.5 py-0.5 border border-pitch">
                                        {{ $item->product->category->name }}
                                    </span>
                                    <h3 class="font-bold text-base mt-1 line-clamp-1">
                                        <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-lime-accent">
                                            {{ $item->product->name }}
                                        </a>
                                    </h3>
                                    <p class="text-sm font-mono text-graphite dark:text-gray-400 mt-0.5">
                                        Rp {{ number_format($item->product->price, 0, ',', '.') }} / item
                                    </p>
                                </div>
                            </div>

                            <!-- Quantity Form & Subtotal -->
                            <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto border-t sm:border-t-0 pt-3 sm:pt-0 border-gray-200 dark:border-gray-800">

                                <!-- Update Qty Form -->
                                <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PUT')
                                    <div class="flex items-center border-2 border-pitch bg-white dark:bg-pitch">
                                        <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-14 text-center font-mono font-bold py-1 bg-transparent text-sm focus:outline-none">
                                        <button type="submit" class="px-2 py-1 bg-lime-accent text-pitch border-l-2 border-pitch font-bold text-xs" title="Perbarui Jumlah">
                                            ✓
                                        </button>
                                    </div>
                                </form>

                                <!-- Subtotal -->
                                <div class="text-right min-w-[100px]">
                                    <span class="text-[10px] uppercase font-mono block text-gray-400">Subtotal</span>
                                    <span class="font-display text-2xl text-pitch dark:text-lime-accent">
                                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                    </span>
                                </div>

                                <!-- Remove button -->
                                <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus produk ini dari keranjang?')" class="p-2 text-red-500 hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-950/40 border border-transparent hover:border-red-500 transition" title="Hapus Produk">
                                        🗑️
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>

                <!-- Summary & Checkout (4 cols) -->
                <div class="lg:col-span-4">
                    <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 sticky top-28 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">
                        <h2 class="font-display text-3xl mb-6 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                            RINGKASAN PESANAN
                        </h2>

                        <div class="space-y-3 text-sm font-semibold mb-6">
                            <div class="flex justify-between">
                                <span class="text-graphite dark:text-gray-400">Total Item</span>
                                <span class="font-mono">{{ $cart->item_count }} pcs</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-graphite dark:text-gray-400">Subtotal Produk</span>
                                <span class="font-mono">Rp {{ number_format($cart->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-graphite dark:text-gray-400">Ongkos Kirim</span>
                                <span class="font-mono text-lime-accent font-bold">GRATIS / DIHITUNG NANTI</span>
                            </div>
                            <div class="border-t-2 border-pitch dark:border-paper/20 pt-3 flex justify-between items-baseline">
                                <span class="font-bold uppercase text-base">TOTAL HARGA</span>
                                <span class="font-display text-4xl text-pitch dark:text-lime-accent">
                                    Rp {{ number_format($cart->total, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('checkout.index') }}" class="block w-full text-center py-4 px-6 bg-lime-accent text-pitch border-2 border-pitch font-bold text-sm uppercase tracking-wider shadow-[4px_4px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                            LANJUT KE CHECKOUT →
                        </a>

                        <a href="{{ route('products.index') }}" class="block w-full text-center mt-3 py-2 text-xs font-bold uppercase tracking-wider text-graphite dark:text-gray-400 hover:text-lime-accent transition">
                            ← Lanjut Belanja Produk Lain
                        </a>
                    </div>
                </div>

            </div>
        @else
            <!-- Empty Cart State -->
            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-16 text-center max-w-2xl mx-auto shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">
                <div class="text-6xl mb-4">🛒</div>
                <h2 class="font-display text-4xl text-pitch dark:text-paper mb-2">KERANJANG BELANJA ANDA KOSONG</h2>
                <p class="text-sm text-graphite dark:text-gray-400 mb-8 max-w-md mx-auto">
                    Sepertinya Anda belum memilih produk vape apa pun. Silakan lihat katalog produk terbaik kami!
                </p>
                <a href="{{ route('products.index') }}" class="inline-block px-8 py-4 bg-lime-accent text-pitch border-2 border-pitch font-bold text-sm uppercase tracking-wider shadow-[4px_4px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                    Mulai Belanja Sekarang →
                </a>
            </div>
        @endif
    </div>

@endsection