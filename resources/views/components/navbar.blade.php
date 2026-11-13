<nav class="sticky top-0 z-40 bg-white/95 dark:bg-pitch/95 backdrop-blur border-b-2 border-pitch dark:border-paper/20 transition-colors" x-data="{ mobileMenu: false, userMenu: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">

            <!-- Left: Brand Logo (Neo-Brutalist Bold) -->
            <div class="flex items-center gap-4">
                <a href="{{ route('home') }}" class="group flex items-center gap-2">
                    <div class="w-10 h-10 bg-lime-accent border-2 border-pitch flex items-center justify-center font-black text-pitch text-xl shadow-[3px_3px_0px_#111] group-hover:translate-x-0.5 group-hover:translate-y-0.5 transition">
                        KV
                    </div>
                    <div>
                        <span class="font-display text-3xl tracking-wider text-pitch dark:text-paper leading-none block">
                            KING <span class="text-lime-accent">VAPEZONE</span>
                        </span>
                        <span class="text-[10px] tracking-widest uppercase font-mono text-graphite dark:text-gray-400 block -mt-1 font-bold">
                            EST. 2024 • AUTHENTIC VAPE
                        </span>
                    </div>
                </a>
            </div>

            <!-- Center: Navigation Links -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ route('home') }}" class="font-bold uppercase tracking-wider text-sm hover:text-lime-accent transition {{ request()->routeIs('home') ? 'border-b-2 border-lime-accent text-lime-accent' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('products.index') }}" class="font-bold uppercase tracking-wider text-sm hover:text-lime-accent transition {{ request()->routeIs('products.*') ? 'border-b-2 border-lime-accent text-lime-accent' : '' }}">
                    Katalog Produk
                </a>
                <a href="{{ route('about') }}" class="font-bold uppercase tracking-wider text-sm hover:text-lime-accent transition {{ request()->routeIs('about') ? 'border-b-2 border-lime-accent text-lime-accent' : '' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('faq') }}" class="font-bold uppercase tracking-wider text-sm hover:text-lime-accent transition {{ request()->routeIs('faq') ? 'border-b-2 border-lime-accent text-lime-accent' : '' }}">
                    FAQ
                </a>
            </div>

            <!-- Right: Actions -->
            <div class="flex items-center gap-3">
                <!-- Dark Mode Toggle Button -->
                <button @click="toggleTheme()" class="p-2.5 border-2 border-pitch dark:border-paper/30 bg-paper dark:bg-charcoal text-pitch dark:text-paper shadow-[3px_3px_0px_#111] hover:bg-lime-accent hover:text-pitch transition" title="Ganti Mode Gelap/Terang">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>

                <!-- Cart Button (for logged-in customer) -->
                @auth
                    <a href="{{ route('cart.index') }}" class="relative p-2.5 border-2 border-pitch dark:border-paper/30 bg-paper dark:bg-charcoal text-pitch dark:text-paper shadow-[3px_3px_0px_#111] hover:bg-lime-accent hover:text-pitch transition" title="Keranjang Belanja">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        @if(isset($cartCount) && $cartCount > 0)
                            <span class="absolute -top-2 -right-2 bg-lime-accent text-pitch text-xs font-black px-1.5 py-0.5 rounded-none border border-pitch font-mono shadow-[1px_1px_0px_#111]">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>
                @endauth

                <!-- User Dropdown / Auth Links -->
                @auth
                    <div class="relative" @click.away="userMenu = false">
                        <button @click="userMenu = !userMenu" class="flex items-center gap-2 px-3 py-2 border-2 border-pitch dark:border-paper/30 bg-white dark:bg-charcoal font-bold text-xs uppercase tracking-wider shadow-[3px_3px_0px_#111] hover:bg-lime-accent hover:text-pitch transition">
                            <span>{{ Str::limit(auth()->user()->name, 12) }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="userMenu" x-transition class="absolute right-0 mt-2 w-56 bg-white dark:bg-charcoal border-2 border-pitch dark:border-paper shadow-[6px_6px_0px_#111] py-2 z-50">
                            <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-800">
                                <p class="text-xs text-gray-500 dark:text-gray-400">Masuk sebagai:</p>
                                <p class="text-sm font-bold truncate">{{ auth()->user()->email }}</p>
                                <span class="inline-block mt-1 text-[10px] uppercase font-mono px-1.5 py-0.5 bg-lime-accent text-pitch font-bold border border-pitch">
                                    {{ auth()->user()->role }}
                                </span>
                            </div>

                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm font-bold hover:bg-lime-accent hover:text-pitch transition">
                                    ⚙️ Dashboard Admin
                                </a>
                            @elseif(auth()->user()->isKasir())
                                <a href="{{ route('kasir.dashboard') }}" class="block px-4 py-2 text-sm font-bold hover:bg-lime-accent hover:text-pitch transition">
                                    💼 Dashboard Kasir
                                </a>
                            @endif

                            <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm font-bold hover:bg-lime-accent hover:text-pitch transition">
                                📦 Pesanan Saya
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm font-bold hover:bg-lime-accent hover:text-pitch transition">
                                👤 Pengaturan Profil
                            </a>

                            <div class="border-t border-gray-200 dark:border-gray-800 mt-2 pt-2">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30 transition">
                                        🚪 Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="hidden sm:flex items-center gap-2">
                        <a href="{{ route('login') }}" class="px-4 py-2 border-2 border-pitch dark:border-paper text-pitch dark:text-paper font-bold text-xs uppercase tracking-wider shadow-[3px_3px_0px_#111] hover:bg-lime-accent hover:text-pitch transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="px-4 py-2 bg-lime-accent text-pitch border-2 border-pitch font-bold text-xs uppercase tracking-wider shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                            Daftar
                        </a>
                    </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button @click="mobileMenu = !mobileMenu" class="md:hidden p-2 border-2 border-pitch dark:border-paper/30 text-pitch dark:text-paper">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu dropdown -->
    <div x-show="mobileMenu" class="md:hidden border-t-2 border-pitch dark:border-paper/20 bg-paper dark:bg-charcoal px-4 pt-4 pb-6 space-y-3">
        <a href="{{ route('home') }}" class="block font-bold uppercase text-base hover:text-lime-accent">Beranda</a>
        <a href="{{ route('products.index') }}" class="block font-bold uppercase text-base hover:text-lime-accent">Katalog Produk</a>
        <a href="{{ route('about') }}" class="block font-bold uppercase text-base hover:text-lime-accent">Tentang Kami</a>
        <a href="{{ route('faq') }}" class="block font-bold uppercase text-base hover:text-lime-accent">FAQ</a>

        @guest
            <div class="border-t border-gray-300 dark:border-gray-700 pt-4 flex flex-col gap-2">
                <a href="{{ route('login') }}" class="block text-center py-2 border-2 border-pitch bg-white dark:bg-charcoal font-bold uppercase text-sm">Masuk</a>
                <a href="{{ route('register') }}" class="block text-center py-2 bg-lime-accent text-pitch border-2 border-pitch font-bold uppercase text-sm">Daftar Akun Baru</a>
            </div>
        @endguest
    </div>
</nav>
