<div class="group border-2 border-pitch dark:border-paper/30 bg-white dark:bg-charcoal flex flex-col justify-between transition-all duration-200 hover:-translate-y-1 shadow-[4px_4px_0px_#111] dark:shadow-[4px_4px_0px_#D4FF00]">

    <!-- Card Header / Image Container -->
    <div class="relative bg-paper dark:bg-surface-dark border-b-2 border-pitch dark:border-paper/20 aspect-square overflow-hidden flex items-center justify-center p-4">
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-300">
        @else
            <!-- Stylized Vape Graphic Placeholder -->
            <div class="flex flex-col items-center justify-center text-graphite dark:text-gray-400">
                <svg class="w-20 h-20 opacity-40 group-hover:opacity-75 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                <span class="font-mono text-[10px] uppercase font-bold tracking-widest mt-2 opacity-60">KING VAPEZONE</span>
            </div>
        @endif

        <!-- Category Badge -->
        <div class="absolute top-3 left-3">
            <span class="inline-block px-2.5 py-1 text-[11px] font-mono font-bold uppercase tracking-wider bg-lime-accent text-pitch border border-pitch shadow-[2px_2px_0px_#111]">
                {{ $product->category->name ?? 'VAPE' }}
            </span>
        </div>

        <!-- Stock Indicator -->
        <div class="absolute top-3 right-3">
            @if($product->stock > 5)
                <span class="inline-block px-2 py-0.5 text-[10px] font-mono font-bold bg-green-500 text-white border border-pitch">
                    STOK: {{ $product->stock }}
                </span>
            @elseif($product->stock > 0)
                <span class="inline-block px-2 py-0.5 text-[10px] font-mono font-bold bg-yellow-400 text-pitch border border-pitch">
                    SISA: {{ $product->stock }}!
                </span>
            @else
                <span class="inline-block px-2 py-0.5 text-[10px] font-mono font-bold bg-red-600 text-white border border-pitch">
                    HABIS
                </span>
            @endif
        </div>
    </div>

    <!-- Card Body -->
    <div class="p-5 flex-1 flex flex-col justify-between">
        <div>
            <a href="{{ route('products.show', $product->slug) }}" class="block">
                <h3 class="font-bold text-base line-clamp-2 hover:text-lime-accent transition group-hover:underline">
                    {{ $product->name }}
                </h3>
            </a>
            <p class="text-xs text-graphite dark:text-gray-400 mt-2 line-clamp-2">
                {{ $product->description }}
            </p>
        </div>

        <div class="mt-5 pt-3 border-t-2 border-dashed border-gray-300 dark:border-gray-800 flex items-center justify-between">
            <div>
                <span class="text-[10px] uppercase tracking-wider font-mono text-gray-500 dark:text-gray-400 block font-bold">Harga Resmi</span>
                <span class="font-display text-2xl tracking-wide text-pitch dark:text-lime-accent leading-none">
                    {{ $product->formatted_price }}
                </span>
            </div>

            <!-- Action: Add to Cart or Detail -->
            @if($product->isInStock())
                @auth
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="px-3 py-2 bg-lime-accent text-pitch border-2 border-pitch font-bold text-xs uppercase tracking-wider shadow-[2px_2px_0px_#111] hover:bg-pitch hover:text-lime-accent transition" title="Tambah ke Keranjang">
                            + BELI
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-3 py-2 bg-lime-accent text-pitch border-2 border-pitch font-bold text-xs uppercase tracking-wider shadow-[2px_2px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                        + BELI
                    </a>
                @endauth
            @else
                <button disabled class="px-3 py-2 bg-gray-300 dark:bg-gray-800 text-gray-500 border-2 border-gray-400 dark:border-gray-700 font-bold text-xs uppercase tracking-wider cursor-not-allowed">
                    HABIS
                </button>
            @endif
        </div>
    </div>
</div>
