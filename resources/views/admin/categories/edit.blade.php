@extends('layouts.admin')

@section('title', 'Edit Kategori — Admin King Vapezone')
@section('header', 'EDIT KATEGORI: ' . $category->name)

@section('content')

    <div class="max-w-xl border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 sm:p-8 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">

        <div class="flex items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-4 mb-6">
            <h2 class="font-display text-3xl text-pitch dark:text-paper">UBAH KATEGORI</h2>
            <a href="{{ route('admin.categories.index') }}" class="text-xs font-mono font-bold hover:text-lime-accent">← Kembali</a>
        </div>

        <form action="{{ route('admin.categories.update', $category->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Kategori *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">
            </div>

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Deskripsi Kategori</label>
                <textarea name="description" rows="3" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 border-2 border-pitch font-bold text-xs uppercase hover:bg-gray-200 dark:hover:bg-gray-800 transition">
                    Batal
                </a>
            </div>
        </form>

    </div>

@endsection
