@extends('layouts.admin')

@section('title', 'Kelola Pengguna & Hak Akses — Admin King Vapezone')
@section('header', 'MANAJEMEN PENGGUNA & ROLE')

@section('content')

    <div class="space-y-6">

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h2 class="font-display text-3xl text-pitch dark:text-paper">DAFTAR PENGGUNA TERDAFTAR</h2>
                <p class="text-xs font-mono text-gray-400">Total: {{ $users->total() }} user</p>
            </div>
            <a href="{{ route('admin.users.create') }}" class="px-5 py-2.5 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition flex items-center gap-2 self-start sm:self-auto">
                <span>+</span> Tambah Pengguna Baru
            </a>
        </div>

        <!-- Filter bar -->
        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-4 shadow-[4px_4px_0px_#111]">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / email / no HP..." class="flex-1 px-3 py-2 text-xs border border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">

                <select name="role" class="px-3 py-2 text-xs border border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                    <option value="all">Semua Role</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="kasir" {{ request('role') === 'kasir' ? 'selected' : '' }}>Kasir</option>
                    <option value="pelanggan" {{ request('role') === 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                </select>

                <button type="submit" class="px-4 py-2 bg-pitch text-paper dark:bg-paper dark:text-pitch font-bold text-xs uppercase">
                    Filter
                </button>
            </form>
        </div>

        <!-- Users Table -->
        <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00] overflow-x-auto">
            <table class="w-full text-left text-xs font-mono">
                <thead class="border-b-2 border-pitch dark:border-paper/20 uppercase bg-paper dark:bg-surface-dark">
                    <tr>
                        <th class="p-3">Nama Pengguna</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">WhatsApp</th>
                        <th class="p-3">Total Order</th>
                        <th class="p-3">Role Saat Ini</th>
                        <th class="p-3 text-right">Ubah Hak Akses & Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                    @forelse($users as $user)
                        <tr class="hover:bg-lime-accent/10 transition">
                            <td class="p-3 font-bold text-sm">
                                {{ $user->name }}
                                @if($user->id === auth()->id())
                                    <span class="text-[9px] px-1 bg-lime-accent text-pitch ml-1">AKUN ANDA</span>
                                @endif
                            </td>
                            <td class="p-3 text-gray-400">{{ $user->email }}</td>
                            <td class="p-3">{{ $user->phone ?? '-' }}</td>
                            <td class="p-3 font-bold">{{ $user->orders_count }} transaksi</td>
                            <td class="p-3">
                                <span class="px-2 py-0.5 font-bold uppercase text-[10px] border border-pitch {{ $user->role === 'admin' ? 'bg-red-500 text-white' : ($user->role === 'kasir' ? 'bg-yellow-400 text-pitch' : 'bg-lime-accent text-pitch') }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="p-3 text-right">
                                @if($user->id !== auth()->id())
                                    <div class="inline-flex items-center gap-2 justify-end">
                                        <form action="{{ route('admin.users.role', $user->id) }}" method="POST" class="inline-flex items-center gap-1">
                                            @csrf
                                            @method('PUT')
                                            <select name="role" class="p-1 text-xs border border-pitch bg-paper dark:bg-pitch">
                                                <option value="pelanggan" {{ $user->role === 'pelanggan' ? 'selected' : '' }}>Pelanggan</option>
                                                <option value="kasir" {{ $user->role === 'kasir' ? 'selected' : '' }}>Kasir</option>
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                            <button type="submit" class="px-2 py-1 bg-lime-accent text-pitch font-bold border border-pitch uppercase text-[10px] hover:bg-pitch hover:text-lime-accent transition" title="Ubah Role">
                                                Simpan
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengguna {{ $user->name }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-500 text-white font-bold border border-pitch uppercase text-[10px] hover:bg-red-700 transition" title="Hapus Pengguna">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-[10px] italic">Terkunci (Akun Anda)</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-400 font-mono">
                                Tidak ada data pengguna yang cocok.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div>
            {{ $users->links() }}
        </div>

    </div>

@endsection
