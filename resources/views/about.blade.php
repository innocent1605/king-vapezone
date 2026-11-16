@extends('layouts.app')

@section('title', 'Tentang Kami — King Vapezone')

@section('content')

    <!-- Hero About -->
    <div class="border-b-4 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">PROFIL TOKO</span>
            <h1 class="font-display text-5xl sm:text-7xl text-pitch dark:text-paper leading-none mt-1">
                TENTANG KING VAPEZONE
            </h1>
            <p class="text-base text-graphite dark:text-gray-300 mt-4 max-w-2xl font-medium">
                Pusat vape autentik, legal berpita cukai, dan bergaransi resmi. Kami hadir menyediakan alternatif gaya hidup harm reduction yang bertanggung jawab untuk perokok dewasa.
            </p>
        </div>
    </div>

    <!-- Story & Mission -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

            <div class="lg:col-span-7 space-y-6">
                <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">CERITA KAMI</span>
                <h2 class="font-display text-4xl sm:text-5xl text-pitch dark:text-paper leading-tight">
                    BERDIRI DENGAN SATU PRINSIP: <br>
                    <span class="text-lime-accent">HANYA PRODUK ASLI & TERBAIK.</span>
                </h2>
                <div class="text-sm leading-relaxed text-graphite dark:text-gray-300 space-y-4">
                    <p>
                        {{ $settings['about_story'] ?? 'Didirikan dengan dedikasi penuh pada kualitas, King Vapezone berkembang menjadi toko vape terkemuka yang melayani ribuan vapers di seluruh penjuru Indonesia. Kami percaya bahwa setiap pengguna berhak mendapatkan perangkat yang aman, cairan liquid yang teruji di laboratorium, dan pelayanan purna jual yang sigap.' }}
                    </p>
                    <p>
                        Industri vape sering kali diramaikan oleh barang tiruan (clone) yang berisiko pada keselamatan dan kesehatan pengguna. Di King Vapezone, kami menerapkan standardisasi ketat: tidak ada satu pun produk tanpa sertifikasi resmi dan jalur distribusi legal.
                    </p>
                </div>

                <!-- 3 Pillars -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4">
                    <div class="border-2 border-pitch dark:border-paper/30 p-4 bg-paper dark:bg-surface-dark shadow-[3px_3px_0px_#111]">
                        <span class="font-display text-3xl text-lime-accent">01</span>
                        <h4 class="font-bold text-sm uppercase mt-1">100% LEGAL</h4>
                        <p class="text-xs text-gray-500 mt-1">Seluruh liquid memiliki pita cukai resmi dari Bea & Cukai RI.</p>
                    </div>
                    <div class="border-2 border-pitch dark:border-paper/30 p-4 bg-paper dark:bg-surface-dark shadow-[3px_3px_0px_#111]">
                        <span class="font-display text-3xl text-lime-accent">02</span>
                        <h4 class="font-bold text-sm uppercase mt-1">GARANSI TOKO</h4>
                        <p class="text-xs text-gray-500 mt-1">Perlindungan ganti unit 7 hari jika cacat pabrik.</p>
                    </div>
                    <div class="border-2 border-pitch dark:border-paper/30 p-4 bg-paper dark:bg-surface-dark shadow-[3px_3px_0px_#111]">
                        <span class="font-display text-3xl text-lime-accent">03</span>
                        <h4 class="font-bold text-sm uppercase mt-1">FAST SERVICE</h4>
                        <p class="text-xs text-gray-500 mt-1">Pengiriman hari yang sama & respon WhatsApp instan.</p>
                    </div>
                </div>
            </div>

            <!-- Right Box Decorative Frame -->
            <div class="lg:col-span-5">
                <div class="border-4 border-pitch dark:border-paper bg-charcoal p-8 text-paper shadow-[8px_8px_0px_#D4FF00]">
                    <div class="border-b-2 border-lime-accent pb-4 mb-6">
                        <span class="font-mono text-xs text-lime-accent font-bold uppercase">OUTLET RESMI KAMI</span>
                    </div>

                    <div class="space-y-4 text-sm font-mono">
                        <div>
                            <span class="text-xs uppercase text-gray-400 block">Alamat Fisik:</span>
                            <span class="font-bold text-paper">Jl. Ciputat, Ciawigebang, Pos 45591</span>
                        </div>
                        <div>
                            <span class="text-xs uppercase text-gray-400 block">WhatsApp Penjualan:</span>
                            <span class="font-bold text-lime-accent">{{ $settings['whatsapp_number'] ?? '6281234567890' }}</span>
                        </div>
                        <div>
                            <span class="text-xs uppercase text-gray-400 block">Email Resmi:</span>
                            <span class="font-bold text-paper">{{ $settings['email'] ?? 'contact@kingvapezone.com' }}</span>
                        </div>
                        <div>
                            <span class="text-xs uppercase text-gray-400 block">Jam Operasional Toko:</span>
                            <span class="font-bold text-paper">{{ $settings['opening_hours'] ?? '10.00 - 23.00 WIB' }}</span>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t-2 border-paper/20">
                        <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '6281234567890' }}" target="_blank" class="w-full block text-center py-3 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch hover:bg-pitch hover:text-lime-accent hover:border-lime-accent transition">
                            💬 Hubungi Admin via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection