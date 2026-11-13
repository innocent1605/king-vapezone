<aside :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }" class="fixed inset-y-0 left-0 z-30 w-64 bg-charcoal border-r-2 border-pitch dark:border-paper/20 transition-transform duration-300 md:translate-x-0 md:static md:inset-auto md:flex md:flex-col">

    <!-- Sidebar Header / Brand -->
    <div class="h-16 flex items-center justify-between px-6 border-b-2 border-paper/10 bg-pitch">
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <div class="w-8 h-8 bg-lime-accent border border-pitch flex items-center justify-center font-black text-pitch text-sm">
                KV
            </div>
            <span class="font-display text-2xl tracking-wider text-paper">
                KING <span class="text-lime-accent">VAPEZONE</span>
            </span>
        </a>
        <button @click="sidebarOpen = false" class="md:hidden text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Navigation links -->
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">

        @if(auth()->user()->isAdmin())
            <!-- ADMIN MENU -->
            <div class="px-3 pb-2 text-[10px] font-mono font-bold tracking-widest text-lime-accent uppercase">
                MENU UTAMA ADMIN
            </div>

            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('admin.dashboard') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>📊</span> Dashboard
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('admin.products.*') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>📦</span> Kelola Produk
            </a>

            <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('admin.categories.*') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>🏷️</span> Kategori
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('admin.orders.*') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>🛒</span> Pesanan
            </a>

            <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('admin.users.*') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>👥</span> Pengguna & Role
            </a>

            <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('admin.reports.*') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>📈</span> Laporan & PDF
            </a>

            <div class="pt-4 px-3 pb-2 text-[10px] font-mono font-bold tracking-widest text-lime-accent uppercase">
                KONTEN & SISTEM
            </div>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('admin.settings.*') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>⚙️</span> Pengaturan Toko
            </a>

            <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('admin.faqs.*') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>❓</span> Kelola FAQ
            </a>
        @elseif(auth()->user()->isKasir())
            <!-- KASIR MENU -->
            <div class="px-3 pb-2 text-[10px] font-mono font-bold tracking-widest text-lime-accent uppercase">
                PANEL KASIR
            </div>

            <a href="{{ route('kasir.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('kasir.dashboard') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>📊</span> Dashboard Kasir
            </a>

            <a href="{{ route('kasir.orders.index') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('kasir.orders.*') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>🛒</span> Transaksi & Pesanan
            </a>

            <a href="{{ route('kasir.products.index') }}" class="flex items-center gap-3 px-3 py-2.5 font-bold text-sm uppercase tracking-wider border-2 {{ request()->routeIs('kasir.products.*') ? 'bg-lime-accent text-pitch border-pitch shadow-[3px_3px_0px_#fff]' : 'text-gray-300 border-transparent hover:border-paper/20 hover:text-white' }} transition">
                <span>📦</span> Update Stok / Produk
            </a>
        @endif

    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t-2 border-paper/10 bg-pitch">
        <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 w-full py-2.5 bg-paper/10 text-paper border border-paper/30 font-bold text-xs uppercase tracking-wider hover:bg-lime-accent hover:text-pitch transition">
            ← Ke Halaman Toko
        </a>
    </div>

</aside>
