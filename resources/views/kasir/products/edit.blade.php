@extends('layouts.admin')

@section('title', 'Update Produk Kasir — King Vapezone')
@section('header', 'KASIR: UPDATE PRODUK & STOK')

@section('content')

    <div class="max-w-2xl border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 sm:p-8 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">

        <div class="flex items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-4 mb-6">
            <div>
                <span class="text-xs font-mono font-bold uppercase text-lime-accent">MODE KASIR</span>
                <h2 class="font-display text-3xl text-pitch dark:text-paper">{{ $product->name }}</h2>
            </div>
            <a href="{{ route('kasir.products.index') }}" class="text-xs font-mono font-bold hover:text-lime-accent">← Kembali</a>
        </div>

        <form action="{{ route('kasir.products.update.post', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Kategori *</label>
                    <select name="category_id" required class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Harga (Rp) *</label>
                    <input type="number" name="price" value="{{ old('price', (int)$product->price) }}" required min="0" step="1000" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper font-bold">
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Stok Unit Tersedia *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper font-bold text-lg">
                </div>
            </div>

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Deskripsi Produk</label>
                <textarea name="description" rows="4" required class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer font-mono text-xs font-bold uppercase">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-4 h-4 text-lime-accent border-2 border-pitch">
                    <span>Produk Aktif & Dijual</span>
                </label>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                    Simpan Perubahan Stok
                </button>
                <a href="{{ route('kasir.products.index') }}" class="px-6 py-3 border-2 border-pitch font-bold text-xs uppercase hover:bg-gray-200 dark:hover:bg-gray-800 transition">
                    Batal
                </a>
            </div>
        </form>

    </div>

@endsection
