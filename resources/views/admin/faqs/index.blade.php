@extends('layouts.admin')

@section('title', 'Kelola FAQ — Admin King Vapezone')
@section('header', 'MANAJEMEN PERTANYAAN UMUM (FAQ)')

@section('content')

    <div class="space-y-6">

        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-display text-3xl text-pitch dark:text-paper">DAFTAR FAQ</h2>
                <p class="text-xs font-mono text-gray-400">Total: {{ $faqs->total() }} entri</p>
            </div>
            <a href="{{ route('admin.faqs.create') }}" class="px-5 py-2.5 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                + Tambah FAQ
            </a>
        </div>

        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00] overflow-x-auto">
            <table class="w-full text-left text-xs font-mono">
                <thead class="border-b-2 border-pitch dark:border-paper/20 uppercase bg-paper dark:bg-surface-dark">
                    <tr>
                        <th class="p-3 w-16">Urutan</th>
                        <th class="p-3">Pertanyaan</th>
                        <th class="p-3">Jawaban</th>
                        <th class="p-3">Status</th>
                        <th class="p-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($faqs as $faq)
                        <tr class="hover:bg-lime-accent/10 transition">
                            <td class="p-3 font-bold text-center">
                                #{{ $faq->sort_order }}
                            </td>
                            <td class="p-3 font-bold text-sm max-w-xs">
                                {{ $faq->question }}
                            </td>
                            <td class="p-3 text-gray-400 max-w-md truncate">
                                {{ $faq->answer }}
                            </td>
                            <td class="p-3">
                                @if($faq->is_active)
                                    <span class="px-2 py-0.5 bg-lime-accent text-pitch font-bold text-[10px] uppercase border border-pitch">Aktif</span>
                                @else
                                    <span class="px-2 py-0.5 bg-gray-400 text-white font-bold text-[10px] uppercase">Nonaktif</span>
                                @endif
                            </td>
                            <td class="p-3 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="px-2 py-1 bg-white dark:bg-charcoal border border-pitch font-bold uppercase hover:bg-lime-accent hover:text-pitch transition">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
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
                                Belum ada data FAQ.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $faqs->links() }}
        </div>

    </div>

@endsection
