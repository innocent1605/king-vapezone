<footer class="bg-charcoal text-paper border-t-4 border-pitch mt-20 relative overflow-hidden">
    <!-- Top accent bar -->
    <div class="h-2 bg-lime-accent w-full"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">

            <!-- Col 1: Brand & Bio -->
            <div class="md:col-span-2 space-y-6">
                <div>
                    <h2 class="font-display text-5xl md:text-6xl text-paper tracking-wider leading-none">
                        KING <span class="text-lime-accent">VAPEZONE</span>
                    </h2>
                    <p class="font-mono text-xs text-lime-accent uppercase tracking-widest mt-1 font-bold">
                        Pusat Vape Autentik & Berkualitas #1
                    </p>
                </div>
                <p class="text-gray-300 text-sm leading-relaxed max-w-md">
                    {{ $siteSettings['site_description'] ?? 'King Vapezone menyediakan perangkat vape, pod system, box mod kit, liquid premium bercukai resmi, coil dan aksesoris original terlengkap dengan jaminan kualitas dan pelayanan prima.' }}
                </p>
                <div class="flex items-center gap-3">
                    <span class="inline-block px-3 py-1 bg-lime-accent text-pitch font-mono font-bold text-xs uppercase border border-pitch">
                        21+ ADULT ONLY
                    </span>
                    <span class="inline-block px-3 py-1 bg-paper/10 text-paper font-mono font-bold text-xs uppercase border border-paper/20">
                        100% ORIGINAL & CUKAI RESMI
                    </span>
                </div>
            </div>

            <!-- Col 2: Kategori Cepat -->
            <div>
                <h3 class="font-display text-2xl text-lime-accent tracking-wide mb-4">
                    KATEGORI PRODUK
                </h3>
                <ul class="space-y-2 text-sm font-semibold">
                    <li><a href="{{ route('products.index', ['category' => 'pod-system']) }}" class="hover:text-lime-accent transition">→ Pod System</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'mod-kit']) }}" class="hover:text-lime-accent transition">→ Box Mod Kit</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'liquid']) }}" class="hover:text-lime-accent transition">→ Liquid Premium</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'freebase']) }}" class="hover:text-lime-accent transition">→ Liquid Freebase</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'salt-nic']) }}" class="hover:text-lime-accent transition">→ Liquid Salt Nic</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'coil']) }}" class="hover:text-lime-accent transition">→ Replacement Coil</a></li>
                    <li><a href="{{ route('products.index', ['category' => 'cartridge']) }}" class="hover:text-lime-accent transition">→ Cartridge Pod</a></li>
                </ul>
            </div>

            <!-- Col 3: Kontak & Jam Operasional -->
            <div>
                <h3 class="font-display text-2xl text-lime-accent tracking-wide mb-4">
                    KONTAK & TOKO
                </h3>
                <div class="space-y-3 text-sm text-gray-300">
                    <p class="flex items-start gap-2">
                        <span class="text-lime-accent font-bold">📍</span>
                        <span>{{ $siteSettings['address'] ?? 'Jl. Kemang Raya No. 88, Jakarta Selatan' }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-lime-accent font-bold">💬</span>
                        <span>WA: {{ $siteSettings['whatsapp_number'] ?? '6281234567890' }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-lime-accent font-bold">✉️</span>
                        <span>{{ $siteSettings['email'] ?? 'contact@kingvapezone.com' }}</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <span class="text-lime-accent font-bold">🕒</span>
                        <span>{{ $siteSettings['opening_hours'] ?? '10.00 - 23.00 WIB' }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- Bottom bar -->
        <div class="border-t border-paper/10 mt-12 pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-gray-400 font-mono">
            <p>© {{ date('Y') }} KING VAPEZONE. All rights reserved. Tugas Besar Cyber Security Web App.</p>
            <p class="mt-2 sm:mt-0">DIBANGUN DENGAN <span class="text-lime-accent font-bold">LARAVEL 11</span> & NEO-BRUTALISM</p>
        </div>
    </div>
</footer>
