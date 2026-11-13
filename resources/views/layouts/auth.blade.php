<!DOCTYPE html>
<html lang="id" class="dark" x-data="{
    darkMode: localStorage.getItem('theme') === 'light' ? false : true,
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
    <title>@yield('title', 'Autentikasi') — King Vapezone</title>

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
                    },
                    fontFamily: {
                        display: ['"Bebas Neue"', 'sans-serif'],
                        sans: ['"Inter"', 'sans-serif'],
                        serif: ['"Playfair Display"', 'serif'],
                    },
                    boxShadow: {
                        'brutal': '6px 6px 0px #111111',
                        'brutal-lime': '6px 6px 0px #D4FF00',
                    }
                }
            }
        }
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-display { font-family: 'Bebas Neue', sans-serif; }
    </style>
</head>
<body class="bg-paper dark:bg-pitch text-pitch dark:text-paper min-h-screen flex items-center justify-center p-4">

    <!-- Top floating button to go home -->
    <div class="fixed top-6 left-6 z-20">
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-4 py-2 border-2 border-pitch dark:border-paper bg-white dark:bg-charcoal text-pitch dark:text-paper font-bold text-sm uppercase tracking-wider shadow-brutal hover:bg-lime-accent hover:text-pitch transition">
            ← Beranda
        </a>
    </div>

    <!-- Theme toggle -->
    <div class="fixed top-6 right-6 z-20">
        <button @click="toggleTheme()" class="p-2 border-2 border-pitch dark:border-paper bg-white dark:bg-charcoal text-pitch dark:text-paper shadow-brutal hover:bg-lime-accent hover:text-pitch transition">
            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 9H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
        </button>
    </div>

    <div class="w-full max-w-4xl">
        @yield('content')
    </div>

</body>
</html>
