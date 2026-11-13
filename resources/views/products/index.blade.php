@extends('layouts.app')

@section('title', 'Katalog Produk — King Vapezone')

@section('content')

    <!-- Header Section -->
    <div class="border-b-4 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">BELANJA RESMI</span>
            <h1 class="font-display text-5xl sm:text-6xl text-pitch dark:text-paper leading-none mt-1">
                KATALOG SEMUA PRODUK
            </h1>
            <p class="text-sm text-graphite dark:text-gray-400 mt-2 max-w-xl">
                Temukan varian device pod, mod kit, liquid freebase, salt nic, coil dan cartridge dengan jaminan 100% original.
            </p>
        </div>
    </div>

    <!-- Main Content & Filter -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <!-- Sidebar Filter -->
            <div class="lg:col-span-1 space-y-6">

                <!-- Search Box -->
                <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-5 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                    <h3 class="font-display text-xl mb-3 text-pitch dark:text-paper">CARI PRODUK</h3>
                    <form action="{{ route('products.index') }}" method="GET">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        <div class="flex">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nama produk..." class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">
                            <button type="submit" class="px-4 bg-lime-accent text-pitch border-2 border-l-0 border-pitch font-bold text-xs">
                                🔍
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Category Filter List -->
                <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-5 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                    <h3 class="font-display text-xl mb-3 text-pitch dark:text-paper">KATEGORI</h3>
                    <ul class="space-y-1.5 text-sm">
                        <li>
                            <a href="{{ route('products.index', array_filter(['search' => request('search'), 'sort' => request('sort')])) }}" class="flex items-center justify-between py-1.5 px-2 font-bold {{ !request('category') ? 'bg-lime-accent text-pitch border border-pitch' : 'hover:text-lime-accent' }}">
                                <span>Semua Kategori</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            <li>
                                <a href="{{ route('products.index', array_filter(['category' => $category->slug, 'search' => request('search'), 'sort' => request('sort')])) }}" class="flex items-center justify-between py-1.5 px-2 font-bold {{ request('category') === $category->slug ? 'bg-lime-accent text-pitch border border-pitch' : 'hover:text-lime-accent' }}">
                                    <span>{{ $category->name }}</span>
                                    <span class="text-xs font-mono font-normal">({{ $category->products_count }})</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Sort Filter -->
                <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-5 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">
                    <h3 class="font-display text-xl mb-3 text-pitch dark:text-paper">URUTKAN HARGA</h3>
                    <div class="space-y-2 text-xs font-bold uppercase">
                        <a href="{{ route('products.index', array_filter(array_merge(request()->all(), ['sort' => 'latest']))) }}" class="block p-2 border {{ request('sort', 'latest') === 'latest' ? 'bg-pitch text-paper dark:bg-paper dark:text-pitch' : 'hover:bg-lime-accent hover:text-pitch' }}">
                            Terbaru
                        </a>
                        <a href="{{ route('products.index', array_filter(array_merge(request()->all(), ['sort' => 'price_low']))) }}" class="block p-2 border {{ request('sort') === 'price_low' ? 'bg-pitch text-paper dark:bg-paper dark:text-pitch' : 'hover:bg-lime-accent hover:text-pitch' }}">
                            Harga: Termurah ke Termahal
                        </a>
                        <a href="{{ route('products.index', array_filter(array_merge(request()->all(), ['sort' => 'price_high']))) }}" class="block p-2 border {{ request('sort') === 'price_high' ? 'bg-pitch text-paper dark:bg-paper dark:text-pitch' : 'hover:bg-lime-accent hover:text-pitch' }}">
                            Harga: Termahal ke Termurah
                        </a>
                    </div>
                </div>

            </div>

            <!-- Products Grid Column -->
            <div class="lg:col-span-3">

                <!-- Active filters banner -->
                @if(request('search') || request('category'))
                    <div class="mb-6 p-4 border-2 border-pitch bg-lime-accent text-pitch flex items-center justify-between font-bold text-xs uppercase shadow-[3px_3px_0px_#111]">
                        <div>
                            <span>Filter Aktif: </span>
                            @if(request('search'))
                                <span class="bg-pitch text-white px-2 py-0.5">Cari: "{{ request('search') }}"</span>
                            @endif
                            @if(request('category'))
                                <span class="bg-pitch text-white px-2 py-0.5 ml-1">Kategori: {{ $selectedCategory->name ?? request('category') }}</span>
                            @endif
                        </div>
                        <a href="{{ route('products.index') }}" class="underline hover:text-white">Reset Filter ✕</a>
                    </div>
                @endif

                @if($products->count() > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($products as $product)
                            @include('components.product-card', ['product' => $product])
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-12">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-12 text-center shadow-[6px_6px_0px_#111]">
                        <div class="font-display text-4xl text-pitch dark:text-paper mb-2">TIDAK ADA PRODUK DITEMUKAN</div>
                        <p class="text-sm text-graphite dark:text-gray-400 mb-6">Coba gunakan kata kunci pencarian lain atau pilih kategori berbeda.</p>
                        <a href="{{ route('products.index') }}" class="inline-block px-6 py-3 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111]">
                            Lihat Semua Produk
                        </a>
                    </div>
                @endif

            </div>

        </div>
    </div>

@endsection
