<!DOCTYPE html>
<html lang="id" class="dark" x-data="{
    darkMode: localStorage.getItem('theme') === 'light' ? false : true,
    sidebarOpen: false,
    toggleTheme() {
        this.darkMode = !this.darkMode;
        localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
        if (this.darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    }
}" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — King Vapezone</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;1,600;1,700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        'paper': '#F4F4F2',
                        'charcoal': '#1C1C1C',
                        'lime-accent': '#D4FF00',
                        'pitch': '#111111',
                        'graphite': '#4A4A4A',
                        'surface-dark': '#222222',
                        'card-dark': '#181818',
                    },
                    fontFamily: {
                        display: ['"Bebas Neue"', 'sans-serif'],
                        sans: ['"Inter"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    boxShadow: {
                        'brutal': '4px 4px 0px #111111',
                        'brutal-lime': '4px 4px 0px #D4FF00',
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Bebas Neue', sans-serif; }
    </style>
</head>
<body class="bg-paper dark:bg-pitch text-pitch dark:text-paper min-h-screen flex antialiased">

    <!-- Sidebar -->
    @include('components.admin.sidebar')

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
        <!-- Topbar -->
        <header class="h-16 border-b-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal flex items-center justify-between px-4 sm:px-6 z-10">
            <div class="flex items-center gap-3">
                <button @click="sidebarOpen = !sidebarOpen" class="md:hidden p-2 border-2 border-pitch dark:border-paper/30 text-pitch dark:text-paper">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
                <h1 class="font-display text-2xl tracking-wide hidden sm:block">
                    @yield('header', 'PANEL MANAJEMEN')
                </h1>
            </div>

            <div class="flex items-center gap-4">
                <!-- Theme Toggle -->
                <button @click="toggleTheme()" class="p-2 border-2 border-pitch dark:border-paper/30 text-pitch dark:text-paper hover:bg-lime-accent hover:text-pitch transition">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </button>

                <!-- User Badge -->
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <div class="text-sm font-bold">{{ auth()->user()->name }}</div>
                        <div class="text-xs uppercase font-mono px-1.5 py-0.5 bg-lime-accent text-pitch inline-block border border-pitch font-bold">
                            {{ auth()->user()->role }}
                        </div>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1.5 text-xs font-bold uppercase tracking-wider bg-red-600 text-white border-2 border-pitch hover:bg-pitch hover:text-red-500 transition shadow-[2px_2px_0px_#111]">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Flash Messages -->
        @include('components.alert')

        <!-- Page Content -->
        <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
