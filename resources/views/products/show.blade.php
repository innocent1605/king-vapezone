@extends('layouts.app')

@section('title', $product->name . ' — King Vapezone')

@section('content')

    <!-- Breadcrumb -->
    <div class="border-b-2 border-pitch dark:border-paper/20 bg-paper dark:bg-charcoal py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-xs font-mono font-bold uppercase tracking-wider text-graphite dark:text-gray-400">
            <a href="{{ route('home') }}" class="hover:text-lime-accent">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-lime-accent">Katalog</a>
            <span class="mx-2">/</span>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-lime-accent">{{ $product->category->name }}</a>
            <span class="mx-2">/</span>
            <span class="text-pitch dark:text-lime-accent">{{ Str::limit($product->name, 25) }}</span>
        </div>
    </div>

    <!-- Product Details Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <!-- Left: Product Image (Tilted Frame Neo-Brutalist) -->
            <div class="lg:col-span-5">
                <div class="relative sticky top-28">
                    <!-- Offset background shadow box -->
                    <div class="absolute inset-0 bg-lime-accent border-4 border-pitch transform rotate-2 translate-x-2 translate-y-2"></div>

                    <div class="relative bg-white dark:bg-charcoal border-4 border-pitch p-6 aspect-square flex items-center justify-center overflow-hidden">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                        @else
                            <div class="flex flex-col items-center justify-center text-graphite dark:text-gray-400">
                                <svg class="w-32 h-32 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                                <span class="font-mono text-xs uppercase font-bold tracking-widest mt-4">KING VAPEZONE AUTHENTIC</span>
                            </div>
                        @endif

                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 bg-pitch text-lime-accent font-mono font-bold text-xs uppercase border border-lime-accent shadow-[2px_2px_0px_#D4FF00]">
                                {{ $product->category->name }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Product Info & Actions -->
            <div class="lg:col-span-7 space-y-6">

                <div>
                    <div class="flex items-center gap-3 mb-2">
                        @if($product->stock > 5)
                            <span class="px-2.5 py-1 text-xs font-mono font-bold bg-green-500 text-white border border-pitch">
                                STOK TERSEDIA: {{ $product->stock }} UNIT
                            </span>
                        @elseif($product->stock > 0)
                            <span class="px-2.5 py-1 text-xs font-mono font-bold bg-yellow-400 text-pitch border border-pitch">
                                STOK MENIPIS: SISA {{ $product->stock }} UNIT
                            </span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-mono font-bold bg-red-600 text-white border border-pitch">
                                STOK HABIS
                            </span>
                        @endif

                        <span class="px-2.5 py-1 text-xs font-mono font-bold bg-paper dark:bg-pitch text-pitch dark:text-paper border border-pitch dark:border-paper/30">
                            100% ORIGINAL & CUKAI
                        </span>
                    </div>

                    <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl text-pitch dark:text-paper leading-tight">
                        {{ $product->name }}
                    </h1>

                    <div class="mt-4 p-4 bg-paper dark:bg-surface-dark border-2 border-pitch dark:border-paper/20 inline-block shadow-[4px_4px_0px_#111]">
                        <span class="text-xs uppercase font-mono font-bold text-gray-500 dark:text-gray-400 block">HARGA RESMI</span>
                        <span class="font-display text-4xl text-pitch dark:text-lime-accent leading-none">
                            {{ $product->formatted_price }}
                        </span>
                    </div>
                </div>

                <!-- Description -->
                <div class="border-t-2 border-b-2 border-pitch dark:border-paper/20 py-6">
                    <h3 class="font-display text-2xl text-pitch dark:text-paper mb-3">DESKRIPSI PRODUK</h3>
                    <div class="text-sm leading-relaxed text-graphite dark:text-gray-300 space-y-3 whitespace-pre-line">
                        {{ $product->description }}
                    </div>
                </div>

                <!-- Add to Cart Form -->
                @if($product->isInStock())
                    <form action="{{ route('cart.add') }}" method="POST" x-data="{ qty: 1, maxStock: {{ $product->stock }} }" class="space-y-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="flex items-center gap-4">
                            <span class="font-mono text-xs font-bold uppercase">JUMLAH:</span>
                            <div class="flex items-center border-2 border-pitch bg-white dark:bg-pitch">
                                <button type="button" @click="if(qty > 1) qty--" class="px-4 py-2 font-bold text-lg hover:bg-lime-accent hover:text-pitch transition">−</button>
                                <input type="number" name="quantity" x-model="qty" min="1" :max="maxStock" class="w-16 text-center font-mono font-bold py-2 bg-transparent focus:outline-none">
                                <button type="button" @click="if(qty < maxStock) qty++" class="px-4 py-2 font-bold text-lg hover:bg-lime-accent hover:text-pitch transition">+</button>
                            </div>
                            <span class="text-xs font-mono text-gray-500">Maks. {{ $product->stock }} pcs</span>
                        </div>

                        <div class="flex flex-wrap items-center gap-4 pt-2">
                            @auth
                                <button type="submit" class="flex-1 py-4 px-8 bg-lime-accent text-pitch border-2 border-pitch font-bold text-sm uppercase tracking-wider shadow-[5px_5px_0px_#111] hover:bg-pitch hover:text-lime-accent hover:translate-x-0.5 hover:translate-y-0.5 transition">
                                    🛒 MASUKKAN KE KERANJANG
                                </button>
                            @else
                                <a href="{{ route('login') }}" class="flex-1 text-center py-4 px-8 bg-lime-accent text-pitch border-2 border-pitch font-bold text-sm uppercase tracking-wider shadow-[5px_5px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                                    LOGIN UNTUK MEMBELI
                                </a>
                            @endauth
                        </div>
                    </form>
                @else
                    <div class="p-4 bg-red-100 dark:bg-red-950/40 border-2 border-red-500 text-red-700 dark:text-red-300 font-bold text-sm">
                        Produk ini sedang habis stok. Silakan hubungi admin via WhatsApp untuk ketersediaan berikutnya.
                    </div>
                @endif

                <!-- Guarantee Badges -->
                <div class="grid grid-cols-2 gap-4 pt-4 text-xs font-mono">
                    <div class="p-3 border border-pitch dark:border-paper/20 bg-white dark:bg-charcoal flex items-center gap-2">
                        <span>🛡️</span>
                        <span>Garansi Toko 7 Hari</span>
                    </div>
                    <div class="p-3 border border-pitch dark:border-paper/20 bg-white dark:bg-charcoal flex items-center gap-2">
                        <span>🚀</span>
                        <span>Kirim Hari Ini (s/d 17.00)</span>
                    </div>
                </div>

            </div>

        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <div class="mt-20 pt-12 border-t-4 border-pitch dark:border-paper/20">
                <div class="flex items-center justify-between mb-8">
                    <h2 class="font-display text-4xl text-pitch dark:text-paper">PRODUK SERUPA</h2>
                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="text-xs font-bold uppercase tracking-wider hover:text-lime-accent">
                        Lihat Lebih Banyak →
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($relatedProducts as $rel)
                        @include('components.product-card', ['product' => $rel])
                    @endforeach
                </div>
            </div>
        @endif

    </div>

@endsection
