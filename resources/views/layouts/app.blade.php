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
    <title>@yield('title', 'King Vapezone') — Official Vape Store</title>

    <!-- Google Fonts: Bebas Neue, Inter, Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:ital,wght@0,600;0,700;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN with custom config -->
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
                        'brutal-lg': '8px 8px 0px #111111',
                        'brutal-lg-lime': '8px 8px 0px #D4FF00',
                    }
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            letter-spacing: -0.01em;
        }
        .font-display {
            font-family: 'Bebas Neue', sans-serif;
            letter-spacing: 0.03em;
        }
        .font-serif-accent {
            font-family: 'Playfair Display', serif;
        }
        /* Custom Neo-Brutalist scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #111111;
        }
        ::-webkit-scrollbar-thumb {
            background: #D4FF00;
            border: 2px solid #111111;
        }
        .tilted-box {
            transform: rotate(-1.5deg);
            transition: transform 0.2s ease;
        }
        .tilted-box:hover {
            transform: rotate(0deg) scale(1.02);
        }
    </style>
</head>
<body class="bg-paper dark:bg-pitch text-pitch dark:text-paper min-h-screen flex flex-col transition-colors duration-200">

    <!-- Top Alert/Notification -->
    @include('components.alert')

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    @stack('scripts')
</body>
</html>
