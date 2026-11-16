@extends('layouts.admin')

@section('title', 'Kelola Produk — Admin King Vapezone')
@section('header', 'MANAJEMEN KATALOG PRODUK')

@section('content')

    <div class="space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-display text-3xl text-pitch dark:text-paper">DAFTAR SEMUA PRODUK</h2>
                <p class="text-xs font-mono text-gray-400">Total terdaftar: {{ $products->total() }} produk</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="px-5 py-2.5 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                + Tambah Produk Baru
            </a>
        </div>

        <!-- Filter & Search Bar -->
        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-4 shadow-[4px_4px_0px_#111]">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk / deskripsi..." class="flex-1 px-3 py-2 text-xs border border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">

                <select name="category" class="px-3 py-2 text-xs border border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                    <option value="">Semua Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-4 py-2 bg-pitch text-paper dark:bg-paper dark:text-pitch font-bold text-xs uppercase">
                    Filter
                </button>
            </form>
        </div>

        <!-- Products Table -->
        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00] overflow-x-auto">
            <table class="w-full text-left text-xs font-mono">
                <thead class="border-b-2 border-pitch dark:border-paper/20 uppercase bg-paper dark:bg-surface-dark">
                    <tr>
                        <th class="p-3 w-16">Foto</th>
                        <th class="p-3">Nama Produk</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Stok</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($products as $product)
                        <tr class="hover:bg-lime-accent/10 transition">
                            <td class="p-3">
                                <div class="w-12 h-12 border border-pitch bg-paper dark:bg-pitch flex items-center justify-center overflow-hidden">
                                    @if($product->image)
                                        <img src="{{ Str::startsWith($product->image, 'images/') ? asset($product->image) : asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                                    @else
                                        <span class="text-[9px] font-bold">NO IMG</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-3 font-bold text-sm">
                                <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="hover:text-lime-accent hover:underline">
                                    {{ $product->name }}
                                </a>
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 bg-paper dark:bg-pitch border border-pitch text-[10px] uppercase font-bold">
                                    {{ $product->category->name ?? '-' }}
                                </span>
                            </td>
                            <td class="p-3 font-bold">
                                {{ $product->formatted_price }}
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 font-bold {{ $product->stock > 5 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $product->stock }} pcs
                                </span>
                            </td>
                            <td class="p-3">
                                @if($product->is_active)
                                    <span class="px-2 py-0.5 bg-lime-accent text-pitch font-bold text-[10px] uppercase border border-pitch">Aktif</span>
                                @else
                                    <span class="px-2 py-0.5 bg-gray-400 text-white font-bold text-[10px] uppercase">Nonaktif</span>
                                @endif
                            </td>
                            <td class="p-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="px-2 py-1 bg-white dark:bg-charcoal border border-pitch font-bold uppercase hover:bg-lime-accent hover:text-pitch transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-600 text-white border border-pitch font-bold uppercase hover:bg-pitch transition">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400 font-mono">
                                Belum ada data produk. Silakan tambah produk baru.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $products->links() }}
        </div>

    </div>

@endsection