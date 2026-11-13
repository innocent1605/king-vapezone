@extends('layouts.admin')

@section('title', 'Tambah Produk — Admin King Vapezone')
@section('header', 'TAMBAH PRODUK BARU')

@section('content')

    <div class="max-w-3xl border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 sm:p-8 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">

        <div class="flex items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-4 mb-6">
            <h2 class="font-display text-3xl text-pitch dark:text-paper">FORMULIR PRODUK</h2>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-mono font-bold hover:text-lime-accent">← Kembali ke List</a>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: OXVA Xlim Pro 2 Pod Kit" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Kategori *</label>
                    <select name="category_id" required class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Harga (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price') }}" required min="0" step="1000" placeholder="150000" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Stok Awal *</label>
                    <input type="number" name="stock" value="{{ old('stock', 10) }}" required min="0" placeholder="10" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                </div>
            </div>

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Deskripsi Lengkap *</label>
                <textarea name="description" rows="5" required placeholder="Jelaskan spesifikasi, varian warna, kelengkapan kotak, dan fitur utama..." class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Foto Produk</label>
                <input type="file" name="image" accept="image/*" class="w-full text-xs p-2 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch">
                <span class="text-[10px] text-gray-500 font-mono">Format: JPG, PNG, WEBP (Maks 2MB)</span>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer font-mono text-xs font-bold uppercase">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-4 h-4 text-lime-accent border-2 border-pitch">
                    <span>Produk Aktif & Tampil di Toko</span>
                </label>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                    Simpan Produk Baru
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border-2 border-pitch font-bold text-xs uppercase hover:bg-gray-200 dark:hover:bg-gray-800 transition">
                    Batal
                </a>
            </div>
        </form>

    </div>

@endsection
