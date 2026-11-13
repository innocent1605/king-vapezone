@extends('layouts.admin')

@section('title', 'Katalog & Update Stok — Kasir King Vapezone')
@section('header', 'PANEL KASIR: UPDATE STOK PRODUK')

@section('content')

    <div class="space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-display text-3xl text-pitch dark:text-paper">UPDATE KETERSEDIAAN STOK</h2>
                <p class="text-xs font-mono text-gray-400">Kasir dapat memperbarui jumlah unit dan harga produk saat admin sibuk</p>
            </div>
        </div>

        <!-- Filter bar -->
        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-4 shadow-[4px_4px_0px_#111]">
            <form action="{{ route('kasir.products.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk..." class="flex-1 px-3 py-2 text-xs border border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">

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
                        <th class="p-3">Stok Saat Ini</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Aksi Kasir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($products as $product)
                        <tr class="hover:bg-lime-accent/10 transition">
                            <td class="p-3">
                                <div class="w-12 h-12 border border-pitch bg-paper dark:bg-pitch flex items-center justify-center overflow-hidden">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                                    @else
                                        <span class="text-[9px] font-bold">NO IMG</span>
                                    @endif
                                </div>
                            </td>
                            <td class="p-3 font-bold text-sm">
                                {{ $product->name }}
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
                                <span class="px-2.5 py-1 font-bold text-sm {{ $product->stock > 5 ? 'bg-green-100 text-green-900' : 'bg-red-100 text-red-900' }}">
                                    {{ $product->stock }} unit
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
                                <a href="{{ route('kasir.products.edit', $product->slug) }}" class="px-3 py-1.5 bg-lime-accent text-pitch font-bold uppercase border border-pitch shadow-[2px_2px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                                    ✏️ Update Stok
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400 font-mono">
                                Tidak ada produk ditemukan.
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
