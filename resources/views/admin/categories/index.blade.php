@extends('layouts.admin')

@section('title', 'Kategori Produk — Admin King Vapezone')
@section('header', 'MANAJEMEN KATEGORI')

@section('content')

    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-display text-3xl text-pitch dark:text-paper">DAFTAR KATEGORI</h2>
                <p class="text-xs font-mono text-gray-400">Total: {{ $categories->total() }} kategori</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="px-5 py-2.5 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                + Tambah Kategori
            </a>
        </div>

        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00] overflow-x-auto">
            <table class="w-full text-left text-xs font-mono">
                <thead class="border-b-2 border-pitch dark:border-paper/20 uppercase bg-paper dark:bg-surface-dark">
                    <tr>
                        <th class="p-3">Nama Kategori</th>
                        <th class="p-3">Slug</th>
                        <th class="p-3">Jumlah Produk</th>
                        <th class="p-3">Deskripsi</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($categories as $category)
                        <tr class="hover:bg-lime-accent/10 transition">
                            <td class="p-3 font-bold text-sm">
                                {{ $category->name }}
                            </td>
                            <td class="p-3 text-gray-400">
                                {{ $category->slug }}
                            </td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 bg-lime-accent text-pitch font-bold text-[10px] uppercase border border-pitch">
                                    {{ $category->products_count }} item
                                </span>
                            </td>
                            <td class="p-3 max-w-xs truncate text-gray-400">
                                {{ $category->description ?? '-' }}
                            </td>
                            <td class="p-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category->slug) }}" class="px-2 py-1 bg-white dark:bg-charcoal border border-pitch font-bold uppercase hover:bg-lime-accent hover:text-pitch transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
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
                            <td colspan="5" class="p-8 text-center text-gray-400 font-mono">
                                Belum ada kategori yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $categories->links() }}
        </div>

    </div>

@endsection
