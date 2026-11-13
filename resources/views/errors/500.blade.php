@extends('layouts.app')

@section('title', '500 — Kesalahan Server')

@section('content')
    <div class="min-h-[60vh] flex items-center justify-center p-6">
        <div class="max-w-md w-full border-4 border-pitch dark:border-lime-accent bg-white dark:bg-charcoal p-8 text-center shadow-brutal dark:shadow-brutal-lime">
            <span class="font-display text-8xl text-red-600 block leading-none">500</span>
            <h1 class="font-display text-3xl mt-2 mb-3 text-pitch dark:text-paper">INTERNAL SERVER ERROR</h1>
            <p class="text-xs text-graphite dark:text-gray-400 font-mono mb-6">
                Terjadi kendala pada server kami. Silakan segarkan halaman atau hubungi admin jika masalah berlanjut.
            </p>
            <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-lime-accent text-pitch font-bold text-xs uppercase border-2 border-pitch shadow-[3px_3px_0px_#111]">
                ← Kembali ke Beranda
            </a>
        </div>
    </div>
@endsection
