@extends('layouts.admin')

@section('title', 'Tambah FAQ — Admin King Vapezone')
@section('header', 'TAMBAH FAQ BARU')

@section('content')

    <div class="max-w-2xl border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 sm:p-8 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">

        <div class="flex items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-4 mb-6">
            <h2 class="font-display text-3xl text-pitch dark:text-paper">FORMULIR PERTANYAAN</h2>
            <a href="{{ route('admin.faqs.index') }}" class="text-xs font-mono font-bold hover:text-lime-accent">← Kembali</a>
        </div>

        <form action="{{ route('admin.faqs.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Pertanyaan *</label>
                <input type="text" name="question" value="{{ old('question') }}" required placeholder="Contoh: Apakah semua liquid bercukai resmi?" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">
            </div>

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Jawaban Lengkap *</label>
                <textarea name="answer" rows="4" required placeholder="Tuliskan jawaban yang jelas dan ramah..." class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">{{ old('answer') }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Urutan Tampil (Sort Order)</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 1) }}" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                </div>
                <div class="flex items-center pt-5">
                    <label class="flex items-center gap-2 cursor-pointer font-mono text-xs font-bold uppercase">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 text-lime-accent border-2 border-pitch">
                        <span>Aktifkan FAQ</span>
                    </label>
                </div>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                    Simpan FAQ
                </button>
                <a href="{{ route('admin.faqs.index') }}" class="px-6 py-3 border-2 border-pitch font-bold text-xs uppercase hover:bg-gray-200 dark:hover:bg-gray-800 transition">
                    Batal
                </a>
            </div>
        </form>

    </div>

@endsection
