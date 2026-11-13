@extends('layouts.app')

@section('title', 'King Vapezone — Toko Vape Terlengkap & Terpercaya')

@section('content')

    <!-- HERO SECTION (Neo-Brutalist 2-Column Asymmetric) -->
    <section class="border-b-4 border-pitch dark:border-paper/20 relative overflow-hidden bg-paper dark:bg-pitch">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 lg:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

                <!-- Left Column (58%) -->
                <div class="lg:col-span-7 space-y-6">
                    <!-- Brutalist Tag -->
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-lime-accent text-pitch font-mono font-bold text-xs uppercase border-2 border-pitch shadow-[3px_3px_0px_#111]">
                        <span>⚡</span>
                        <span>PUSAT VAPE ORIGINAL #1 SE-INDONESIA</span>
                    </div>

                    <!-- Massive Headline -->
                    <h1 class="font-display text-6xl sm:text-7xl lg:text-8xl tracking-tight leading-[0.9] text-pitch dark:text-paper uppercase">
                        LEVEL UP <br>
                        <span class="text-lime-accent underline decoration-4 decoration-pitch dark:decoration-paper">YOUR VAPE</span> <br>
                        EXPERIENCE.
                    </h1>

                    <p class="text-base sm:text-lg text-graphite dark:text-gray-300 max-w-xl font-medium leading-relaxed">
                        Perangkat pod kit, box mod bertenaga, liquid premium dengan pita cukai resmi, serta coil dan aksesoris original terlengkap. Transaksi cepat terhubung langsung ke WhatsApp resmi kami.
                    </p>

                    <!-- CTAs -->
                    <div class="flex flex-wrap items-center gap-4 pt-4">
                        <a href="{{ route('products.index') }}" class="px-8 py-4 bg-lime-accent text-pitch border-2 border-pitch font-bold text-sm uppercase tracking-wider shadow-[5px_5px_0px_#111] hover:bg-pitch hover:text-lime-accent hover:translate-x-0.5 hover:translate-y-0.5 transition">
                            Jelajahi Katalog Produk →
                        </a>
                        <a href="{{ route('about') }}" class="px-6 py-4 bg-white dark:bg-charcoal text-pitch dark:text-paper border-2 border-pitch dark:border-paper font-bold text-sm uppercase tracking-wider shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00] hover:bg-lime-accent hover:text-pitch transition">
                            Tentang Toko
                        </a>
                    </div>
                </div>

                <!-- Right Column (42%): Decorative Collage / Art -->
                <div class="lg:col-span-5 flex justify-center">
                    <div class="relative w-full max-w-md">
                        <!-- Neon Accent Background Layer -->
                        <div class="absolute inset-0 bg-lime-accent border-4 border-pitch transform rotate-3 translate-x-3 translate-y-3"></div>

                        <!-- Main Graphic Frame -->
                        <div class="relative bg-charcoal border-4 border-pitch p-8 text-paper shadow-[8px_8px_0px_#111]">
                            <div class="flex justify-between items-center border-b-2 border-lime-accent pb-4 mb-6">
                                <span class="font-mono text-xs text-lime-accent font-bold uppercase">KING VAPEZONE // 2024</span>
                                <span class="w-3 h-3 bg-lime-accent rounded-full animate-ping"></span>
                            </div>

                            <div class="py-8 text-center space-y-4">
                                <div class="font-display text-7xl text-lime-accent leading-none">
                                    AUTHENTIC ONLY
                                </div>
                                <p class="font-mono text-xs text-gray-300 uppercase tracking-widest">
                                    NO CLONE • 100% LEGAL CUKAI • RESMI
                                </p>
                            </div>

                            <div class="mt-6 pt-4 border-t-2 border-paper/20 flex items-center justify-between text-xs font-mono">
                                <span class="text-gray-400">STATUS OPERASIONAL:</span>
                                <span class="text-lime-accent font-bold">ONLINE & READY</span>
                            </div>
                        </div>

                        <!-- Neo-Duct Tape Decorative Badge -->
                        <div class="absolute -top-3 -right-3 bg-lime-accent text-pitch font-black text-xs uppercase px-4 py-1 border-2 border-pitch transform rotate-6 shadow-[2px_2px_0px_#111]">
                            GARANSI RESMI
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- BOTTOM METRIC BAR (4-Column Grid) -->
        <div class="border-t-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal">
            <div class="max-w-7xl mx-auto grid grid-cols-2 lg:grid-cols-4 divide-x-2 divide-y-2 lg:divide-y-0 divide-pitch dark:divide-paper/20">
                <div class="p-6 text-center">
                    <div class="font-display text-4xl lg:text-5xl text-pitch dark:text-lime-accent">{{ $stats['products'] ?? '50+' }}+</div>
                    <div class="text-xs font-mono uppercase tracking-wider font-bold text-graphite dark:text-gray-400 mt-1">Produk Ready Stock</div>
                </div>
                <div class="p-6 text-center">
                    <div class="font-display text-4xl lg:text-5xl text-pitch dark:text-lime-accent">{{ $stats['customers'] ?? '150+' }}+</div>
                    <div class="text-xs font-mono uppercase tracking-wider font-bold text-graphite dark:text-gray-400 mt-1">Pelanggan Puas</div>
                </div>
                <div class="p-6 text-center">
                    <div class="font-display text-4xl lg:text-5xl text-pitch dark:text-lime-accent">{{ $stats['transactions'] ?? '350+' }}+</div>
                    <div class="text-xs font-mono uppercase tracking-wider font-bold text-graphite dark:text-gray-400 mt-1">Transaksi Berhasil</div>
                </div>
                <div class="p-6 text-center">
                    <div class="font-display text-4xl lg:text-5xl text-pitch dark:text-lime-accent">{{ $stats['rating'] ?? '4.9/5.0' }}</div>
                    <div class="text-xs font-mono uppercase tracking-wider font-bold text-graphite dark:text-gray-400 mt-1">Rating Kepuasan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- KATEGORI PRODUK -->
    <section class="py-16 lg:py-24 border-b-4 border-pitch dark:border-paper/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">NAVIGASI CEPAT</span>
                    <h2 class="font-display text-5xl lg:text-6xl text-pitch dark:text-paper leading-none">
                        PILIH KATEGORI PRODUK
                    </h2>
                </div>
                <a href="{{ route('products.index') }}" class="font-bold text-sm uppercase tracking-wider text-pitch dark:text-paper hover:text-lime-accent transition flex items-center gap-1">
                    Semua Kategori →
                </a>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="group border-2 border-pitch dark:border-paper/30 bg-white dark:bg-charcoal p-6 hover:-translate-y-1 transition-all shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-mono text-xs uppercase font-bold text-graphite dark:text-gray-400">#{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <span class="px-2 py-0.5 text-[10px] font-mono font-bold bg-lime-accent text-pitch border border-pitch">
                                {{ $category->products_count }} ITEM
                            </span>
                        </div>
                        <h3 class="font-display text-2xl lg:text-3xl text-pitch dark:text-paper group-hover:text-lime-accent transition">
                            {{ $category->name }}
                        </h3>
                        <p class="text-xs text-graphite dark:text-gray-400 mt-2 line-clamp-2">
                            {{ $category->description }}
                        </p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- PRODUK UNGGULAN -->
    <section class="py-16 lg:py-24 border-b-4 border-pitch dark:border-paper/20 bg-paper dark:bg-pitch">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4">
                <div>
                    <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">REKOMENDASI TERBAIK</span>
                    <h2 class="font-display text-5xl lg:text-6xl text-pitch dark:text-paper leading-none">
                        PRODUK UNGGULAN
                    </h2>
                </div>
                <a href="{{ route('products.index') }}" class="px-5 py-2.5 bg-white dark:bg-charcoal border-2 border-pitch dark:border-paper font-bold text-xs uppercase tracking-wider shadow-[3px_3px_0px_#111] dark:shadow-[3px_3px_0px_#D4FF00] hover:bg-lime-accent hover:text-pitch transition">
                    Lihat Semua Produk ({{ $stats['products'] }})
                </a>
            </div>

            <!-- Products Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
        </div>
    </section>

    <!-- VALUE PROPOSITION & TAG MATRIX (Matching Design Spec) -->
    <section class="py-16 lg:py-20 bg-charcoal text-paper border-b-4 border-pitch">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center mb-12">
                <div class="lg:col-span-8">
                    <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest">KENAPA MEMILIH KAMI?</span>
                    <h2 class="font-display text-4xl sm:text-6xl text-paper tracking-tight mt-2 leading-none">
                        KAMI TIDAK MENJUAL CLONE. <br>
                        <span class="text-lime-accent">KAMI MENJAMIN KUALITAS ASLI.</span>
                    </h2>
                </div>
                <div class="lg:col-span-4 text-left lg:text-right">
                    <p class="text-sm text-gray-300">
                        Setiap item diperiksa secara ketat, berhologram distributor resmi, dan dilengkapi perlindungan konsumen nyata.
                    </p>
                </div>
            </div>

            <!-- Tag Matrix -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3 pt-6 border-t-2 border-paper/10">
                <div class="border-2 border-dashed border-paper/40 p-4 text-center">
                    <span class="font-serif-accent italic text-xs uppercase tracking-wider block text-lime-accent font-bold">100% ORIGINAL</span>
                </div>
                <div class="border-2 border-dashed border-paper/40 p-4 text-center">
                    <span class="font-serif-accent italic text-xs uppercase tracking-wider block text-lime-accent font-bold">PITA CUKAI RESMI</span>
                </div>
                <div class="border-2 border-dashed border-paper/40 p-4 text-center">
                    <span class="font-serif-accent italic text-xs uppercase tracking-wider block text-lime-accent font-bold">GARANSI TOKO 7 HARI</span>
                </div>
                <div class="border-2 border-dashed border-paper/40 p-4 text-center">
                    <span class="font-serif-accent italic text-xs uppercase tracking-wider block text-lime-accent font-bold">ORDER VIA WHATSAPP</span>
                </div>
                <div class="border-2 border-dashed border-paper/40 p-4 text-center">
                    <span class="font-serif-accent italic text-xs uppercase tracking-wider block text-lime-accent font-bold">PENGIRIMAN CEPAT</span>
                </div>
                <div class="border-2 border-dashed border-paper/40 p-4 text-center">
                    <span class="font-serif-accent italic text-xs uppercase tracking-wider block text-lime-accent font-bold">LAYANAN RAMAH 24/7</span>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION (Full-Bleed Acid Lime Block matching Design Spec) -->
    <section class="py-16 lg:py-24 bg-lime-accent text-pitch border-b-4 border-pitch">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="font-mono text-xs uppercase font-bold tracking-widest bg-pitch text-lime-accent px-3 py-1 border border-pitch inline-block">
                    PERTANYAAN UMUM
                </span>
                <h2 class="font-display text-5xl lg:text-6xl tracking-tight mt-3 text-pitch">
                    FREQUENTLY ASKED QUESTIONS
                </h2>
            </div>

            <!-- Accordion Grid -->
            <div class="space-y-4">
                @foreach($faqs as $faq)
                    <div x-data="{ open: false }" class="border-2 border-pitch bg-paper text-pitch shadow-[4px_4px_0px_#111]">
                        <button @click="open = !open" class="w-full text-left p-5 flex items-center justify-between gap-4 font-bold text-base sm:text-lg uppercase">
                            <span>{{ $faq->question }}</span>
                            <span class="font-mono text-2xl font-black" x-text="open ? '−' : '+'"></span>
                        </button>
                        <div x-show="open" x-transition class="px-5 pb-5 pt-2 text-sm text-graphite border-t-2 border-pitch/20 font-medium leading-relaxed">
                            {{ $faq->answer }}
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('faq') }}" class="inline-block px-6 py-3 bg-pitch text-lime-accent font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[4px_4px_0px_#fff] hover:bg-paper hover:text-pitch transition">
                    Lihat Semua Pertanyaan & Jawaban →
                </a>
            </div>
        </div>
    </section>

@endsection
