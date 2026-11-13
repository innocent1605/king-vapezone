@extends('layouts.admin')

@section('title', 'Edit Produk — Admin King Vapezone')
@section('header', 'EDIT PRODUK: ' . $product->name)

@section('content')

    <div class="max-w-3xl border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 sm:p-8 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">

        <div class="flex items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-4 mb-6">
            <h2 class="font-display text-3xl text-pitch dark:text-paper">FORMULIR PERUBAHAN</h2>
            <a href="{{ route('admin.products.index') }}" class="text-xs font-mono font-bold hover:text-lime-accent">← Kembali ke List</a>
        </div>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Produk *</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">
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
                    <input type="number" name="price" value="{{ old('price', (int)$product->price) }}" required min="0" step="1000" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Stok Tersedia *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required min="0" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                </div>
            </div>

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Deskripsi Lengkap *</label>
                <textarea name="description" rows="5" required class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">{{ old('description', $product->description) }}</textarea>
            </div>

            <!-- Current image & new upload -->
            <div class="flex items-center gap-4 p-4 border border-pitch dark:border-paper/20 bg-paper dark:bg-pitch">
                <div class="w-16 h-16 border border-pitch flex-shrink-0 flex items-center justify-center overflow-hidden bg-white dark:bg-charcoal">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Preview" class="w-full h-full object-contain">
                    @else
                        <span class="text-[9px] font-mono">NO IMG</span>
                    @endif
                </div>
                <div class="flex-1">
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Ganti Foto Produk (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="w-full text-xs">
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer font-mono text-xs font-bold uppercase">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $product->is_active) ? 'checked' : '' }} class="w-4 h-4 text-lime-accent border-2 border-pitch">
                    <span>Produk Aktif & Tampil di Toko</span>
                </label>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-6 py-3 border-2 border-pitch font-bold text-xs uppercase hover:bg-gray-200 dark:hover:bg-gray-800 transition">
                    Batal
                </a>
            </div>
        </form>

    </div>

@endsection
