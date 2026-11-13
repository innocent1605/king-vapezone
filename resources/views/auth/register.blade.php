@extends('layouts.auth')

@section('title', 'Daftar Akun Pelanggan — King Vapezone')

@section('content')

    <div class="grid grid-cols-1 md:grid-cols-12 border-4 border-pitch dark:border-paper/40 bg-white dark:bg-charcoal shadow-brutal dark:shadow-brutal-lime overflow-hidden">

        <!-- Left Column: Branding / Benefits (5 cols) -->
        <div class="md:col-span-5 bg-pitch text-paper p-8 flex flex-col justify-between border-b-4 md:border-b-0 md:border-r-4 border-pitch">
            <div>
                <div class="w-12 h-12 bg-lime-accent text-pitch font-black text-2xl flex items-center justify-center border-2 border-pitch shadow-[3px_3px_0px_#fff] mb-6">
                    KV
                </div>
                <h2 class="font-display text-4xl lg:text-5xl tracking-wide leading-none">
                    JOIN THE <br>
                    <span class="text-lime-accent">KINGDOM.</span>
                </h2>
                <p class="font-mono text-xs uppercase tracking-widest text-lime-accent mt-2 font-bold">
                    REGISTRASI PELANGGAN RESMI
                </p>
            </div>

            <div class="my-6 space-y-4 font-mono text-xs">
                <div class="p-4 border border-lime-accent/40 bg-white/5">
                    <p class="font-bold text-lime-accent mb-1">MENGAPA WAJIB DAFTAR?</p>
                    <p class="text-gray-300 leading-relaxed">
                        Data nama, nomor WhatsApp, dan alamat pengiriman tersimpan aman, membuat checkout pesanan dan konfirmasi WhatsApp menjadi otomatis secepat kilat!
                    </p>
                </div>

                <div class="flex items-center gap-2 text-xs text-gray-300">
                    <span class="text-lime-accent font-bold">🔞</span>
                    <span>Khusus Usia 21 Tahun ke Atas (21+)</span>
                </div>
            </div>

            <div class="text-[11px] text-gray-400 font-mono">
                King Vapezone © {{ date('Y') }} • All Rights Reserved
            </div>
        </div>

        <!-- Right Column: Register Form (7 cols) -->
        <div class="md:col-span-7 p-8 sm:p-10 flex flex-col justify-center">

            <div class="mb-6">
                <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">AKUN BARU</span>
                <h1 class="font-display text-4xl text-pitch dark:text-paper leading-none mt-1">
                    BUAT AKUN PELANGGAN
                </h1>
            </div>

            @if ($errors->any())
                <div class="p-3 bg-red-500 text-white border-2 border-pitch mb-6 font-bold text-xs uppercase">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="Nama Anda" class="w-full px-4 py-2.5 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="email@anda.com" class="w-full px-4 py-2.5 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Nomor WhatsApp *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="08xxxxxxxxxx" class="w-full px-4 py-2.5 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Alamat Domisili / Pengiriman</label>
                    <textarea name="address" rows="2" placeholder="Nama jalan, kota, kode pos" class="w-full px-4 py-2 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">{{ old('address') }}</textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Kata Sandi *</label>
                        <input type="password" name="password" required placeholder="Min. 8 karakter" class="w-full px-4 py-2.5 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Ulangi Sandi *</label>
                        <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi" class="w-full px-4 py-2.5 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 bg-lime-accent text-pitch border-2 border-pitch font-bold text-xs uppercase tracking-wider shadow-[4px_4px_0px_#111] hover:bg-pitch hover:text-lime-accent transition mt-4">
                    DAFTAR SEBAGAI PELANGGAN →
                </button>
            </form>

            <div class="mt-6 pt-4 border-t-2 border-dashed border-gray-300 dark:border-gray-800 text-center text-xs font-mono">
                <span class="text-graphite dark:text-gray-400">Sudah memiliki akun terdaftar?</span>
                <a href="{{ route('login') }}" class="font-bold text-pitch dark:text-lime-accent hover:underline ml-1">
                    Masuk di Sini →
                </a>
            </div>

        </div>

    </div>

@endsection
