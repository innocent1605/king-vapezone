@extends('layouts.app')

@section('title', 'FAQ — King Vapezone')

@section('content')

    <!-- Full-Bleed Acid Lime Block matching Design Specification -->
    <div class="bg-lime-accent text-pitch py-16 lg:py-24 border-b-4 border-pitch">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-16">
                <span class="font-mono text-xs uppercase font-bold tracking-widest bg-pitch text-lime-accent px-3 py-1 border border-pitch inline-block">
                    KONSULTASI & INFORMASI
                </span>
                <h1 class="font-display text-5xl sm:text-7xl tracking-tight mt-3 text-pitch uppercase">
                    FREQUENTLY ASKED QUESTIONS
                </h1>
                <p class="text-sm font-semibold text-pitch/80 max-w-xl mx-auto mt-3">
                    Semua jawaban seputar keaslian produk, tata cara transaksi otomatis ke WhatsApp, pembayaran transfer, dan pengiriman barang.
                </p>
            </div>

            <!-- Accordion List -->
            <div class="space-y-4">
                @forelse($faqs as $faq)
                    <div x-data="{ open: false }" class="border-2 border-pitch bg-paper text-pitch shadow-[5px_5px_0px_#111]">
                        <button @click="open = !open" class="w-full text-left p-6 flex items-center justify-between gap-4 font-bold text-base sm:text-lg uppercase">
                            <span class="flex items-center gap-3">
                                <span class="font-mono text-xs px-2 py-0.5 bg-lime-accent text-pitch border border-pitch">Q{{ $loop->iteration }}</span>
                                <span>{{ $faq->question }}</span>
                            </span>
                            <span class="font-mono text-2xl font-black min-w-[24px] text-center" x-text="open ? '−' : '+'"></span>
                        </button>
                        <div x-show="open" x-transition class="px-6 pb-6 pt-2 text-sm text-graphite border-t-2 border-pitch/20 font-medium leading-relaxed">
                            {{ $faq->answer }}
                        </div>
                    </div>
                @empty
                    <div class="border-2 border-pitch bg-paper p-8 text-center font-bold">
                        Belum ada data FAQ yang tersedia saat ini.
                    </div>
                @endforelse
            </div>

            <!-- Still Have Questions CTA -->
            <div class="mt-16 text-center border-4 border-pitch bg-pitch text-paper p-8 shadow-[8px_8px_0px_#fff]">
                <h3 class="font-display text-3xl text-lime-accent mb-2">MASIH MEMILIKI PERTANYAAN LAIN?</h3>
                <p class="text-xs text-gray-300 max-w-md mx-auto mb-6">
                    Customer service dan tim vape expert kami siap membantu Anda setiap hari dari jam 10.00 hingga 23.00 WIB.
                </p>
                <a href="https://wa.me/{{ $siteSettings['whatsapp_number'] ?? '6281234567890' }}" target="_blank" class="inline-block px-8 py-4 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-lime-accent hover:bg-paper hover:text-pitch transition shadow-[4px_4px_0px_#D4FF00]">
                    💬 Konsultasi Langsung di WhatsApp →
                </a>
            </div>

        </div>
    </div>

@endsection
