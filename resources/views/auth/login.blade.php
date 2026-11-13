@extends('layouts.auth')

@section('title', 'Masuk Akun — King Vapezone')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-12 border-4 border-pitch dark:border-paper/40 bg-white dark:bg-charcoal shadow-brutal dark:shadow-brutal-lime overflow-hidden">

        <!-- Left Column: Branding / Industrial Retro (5 cols) -->
        <div class="md:col-span-5 bg-pitch text-paper p-8 flex flex-col justify-between border-b-4 md:border-b-0 md:border-r-4 border-pitch">
            <div>
                <div class="w-12 h-12 bg-lime-accent text-pitch font-black text-2xl flex items-center justify-center border-2 border-pitch shadow-[3px_3px_0px_#fff] mb-6">
                    KV
                </div>
                <h2 class="font-display text-4xl lg:text-5xl tracking-wide leading-none">
                    KING <br>
                    <span class="text-lime-accent">VAPEZONE</span>
                </h2>
                <p class="font-mono text-xs uppercase tracking-widest text-lime-accent mt-2 font-bold">
                    PORTAL LOGIN RESMI
                </p>
            </div>

            <div class="my-8 py-6 border-t border-b border-paper/20 space-y-3 font-mono text-xs">
                <div class="flex items-center gap-2 text-gray-300">
                    <span class="text-lime-accent font-bold">✓</span>
                    <span>100% Produk Terverifikasi</span>
                </div>
                <div class="flex items-center gap-2 text-gray-300">
                    <span class="text-lime-accent font-bold">✓</span>
                    <span>Riwayat Pesanan Lengkap</span>
                </div>
                <div class="flex items-center gap-2 text-gray-300">
                    <span class="text-lime-accent font-bold">✓</span>
                    <span>Checkout Cepat ke WhatsApp</span>
                </div>
            </div>

            <div class="text-[11px] text-gray-400 font-mono">
                <p class="font-bold text-paper mb-1">AKUN DEMO CEPAT:</p>
                <p>Admin: admin@kingvapezone.com / password</p>
                <p>Kasir: kasir@kingvapezone.com / password</p>
                <p>Pelanggan: pelanggan@kingvapezone.com / password</p>
            </div>
        </div>

        <!-- Right Column: Login Form (7 cols) -->
        <div class="md:col-span-7 p-8 sm:p-10 flex flex-col justify-center">

            <div class="mb-6">
                <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">SELAMAT DATANG KEMBALI</span>
                <h1 class="font-display text-4xl text-pitch dark:text-paper leading-none mt-1">
                    MASUK KE AKUN ANDA
                </h1>
            </div>

            <!-- Error Notifications -->
            @if ($errors->any())
                <div class="p-3 bg-red-500 text-white border-2 border-pitch mb-6 font-bold text-xs uppercase">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Alamat Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" class="w-full px-4 py-3 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Kata Sandi *</label>
                    <input type="password" name="password" required placeholder="••••••••" class="w-full px-4 py-3 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                </div>

                <div class="flex items-center justify-between text-xs font-mono pt-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 border-2 border-pitch text-lime-accent focus:ring-0">
                        <span>Ingat saya</span>
                    </label>
                    <span class="text-gray-400">Cyber Sec Protected 🛡️</span>
                </div>

                <button type="submit" class="w-full py-4 bg-lime-accent text-pitch border-2 border-pitch font-bold text-xs uppercase tracking-wider shadow-[4px_4px_0px_#111] hover:bg-pitch hover:text-lime-accent transition mt-4">
                    MASUK SEKARANG →
                </button>
            </form>

            <div class="mt-8 pt-6 border-t-2 border-dashed border-gray-300 dark:border-gray-800 text-center text-xs font-mono">
                <span class="text-graphite dark:text-gray-400">Belum memiliki akun pelanggan?</span>
                <a href="{{ route('register') }}" class="font-bold text-pitch dark:text-lime-accent hover:underline ml-1">
                    Daftar di Sini →
                </a>
            </div>

        </div>

    </div>

@endsection
