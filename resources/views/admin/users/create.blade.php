@extends('layouts.admin')

@section('title', 'Tambah Pengguna Baru — Admin King Vapezone')
@section('header', 'TAMBAH PENGGUNA BARU')

@section('content')

    <div class="max-w-2xl border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 sm:p-8 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">

        <div class="flex items-center justify-between border-b-2 border-pitch dark:border-paper/20 pb-4 mb-6">
            <div>
                <h2 class="font-display text-3xl text-pitch dark:text-paper">FORM PENGGUNA BARU</h2>
                <p class="text-xs font-mono text-gray-400">Buat akun untuk Admin, Kasir, atau Pelanggan</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="text-xs font-mono font-bold hover:text-lime-accent">← Kembali</a>
        </div>

        @if(isset($errors) && $errors->any())
            <div class="mb-6 p-4 border-2 border-red-500 bg-red-500/10 text-red-500 text-xs font-mono">
                <p class="font-bold mb-1">TERJADI KESALAHAN:</p>
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Lengkap *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Nama lengkap pengguna" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Alamat Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required placeholder="contoh@domain.com" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">No. WhatsApp / HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" placeholder="081234567890" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Role / Hak Akses *</label>
                    <select name="role" required class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent font-bold">
                        <option value="kasir" {{ old('role') === 'kasir' ? 'selected' : '' }}>KASIR (Kelola Pesanan & Stok)</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>ADMIN (Akses Penuh Sistem)</option>
                        <option value="pelanggan" {{ old('role') === 'pelanggan' ? 'selected' : '' }}>PELANGGAN (Customer Biasa)</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Password *</label>
                    <input type="password" name="password" required placeholder="Minimal 6 karakter" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">
                </div>

                <div>
                    <label class="block text-xs font-mono font-bold uppercase mb-1">Konfirmasi Password *</label>
                    <input type="password" name="password_confirmation" required placeholder="Ulangi password" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">
                </div>
            </div>

            <div>
                <label class="block text-xs font-mono font-bold uppercase mb-1">Alamat Lengkap</label>
                <textarea name="address" rows="3" placeholder="Alamat tempat tinggal / domisili..." class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper focus:outline-none focus:border-lime-accent">{{ old('address') }}</textarea>
            </div>

            <div class="pt-4 flex items-center gap-4">
                <button type="submit" class="px-6 py-3 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                    + Simpan Pengguna Baru
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-6 py-3 border-2 border-pitch font-bold text-xs uppercase hover:bg-gray-200 dark:hover:bg-gray-800 transition">
                    Batal
                </a>
            </div>
        </form>

    </div>

@endsection
