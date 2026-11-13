@extends('layouts.admin')

@section('title', 'Pengaturan Toko — Admin King Vapezone')
@section('header', 'PENGATURAN TOKO & SISTEM')

@section('content')

    <div class="max-w-4xl border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 sm:p-8 shadow-[6px_6px_0px_#111] dark:shadow-[6px_6px_0px_#D4FF00]">

        <div class="border-b-2 border-pitch dark:border-paper/20 pb-4 mb-6">
            <h2 class="font-display text-3xl text-pitch dark:text-paper">KONFIGURASI TOKO & PEMBAYARAN</h2>
            <p class="text-xs font-mono text-gray-400">Pengaturan ini akan langsung diterapkan pada seluruh halaman publik dan alur transaksi WhatsApp</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
            @csrf
            @method('PUT')

            <!-- Bagian 1: Identitas Toko -->
            <div>
                <h3 class="font-display text-2xl text-lime-accent border-b border-pitch dark:border-paper/20 pb-1 mb-4">
                    1. IDENTITAS TOKO
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Toko</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $settings['site_name'] ?? 'King Vapezone') }}" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Tagline</label>
                        <input type="text" name="site_tagline" value="{{ old('site_tagline', $settings['site_tagline'] ?? '') }}" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Deskripsi Singkat Toko</label>
                        <textarea name="site_description" rows="2" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Bagian 2: Kontak & WhatsApp -->
            <div>
                <h3 class="font-display text-2xl text-lime-accent border-b border-pitch dark:border-paper/20 pb-1 mb-4">
                    2. INTEGRASI WHATSAPP & KONTAK
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Nomor WhatsApp Toko (Format: 628xxxx) *</label>
                        <input type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number'] ?? '6281234567890') }}" required class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper font-mono font-bold">
                        <span class="text-[10px] text-gray-500 font-mono">Penting: nomor tujuan pesan WhatsApp otomatis saat checkout</span>
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Email Toko</label>
                        <input type="email" name="email" value="{{ old('email', $settings['email'] ?? 'contact@kingvapezone.com') }}" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Alamat Outlet Fisik</label>
                        <input type="text" name="address" value="{{ old('address', $settings['address'] ?? '') }}" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Jam Operasional</label>
                        <input type="text" name="opening_hours" value="{{ old('opening_hours', $settings['opening_hours'] ?? '10.00 - 23.00 WIB') }}" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                    </div>
                </div>
            </div>

            <!-- Bagian 3: Rekening Bank Pembayaran -->
            <div>
                <h3 class="font-display text-2xl text-lime-accent border-b border-pitch dark:border-paper/20 pb-1 mb-4">
                    3. REKENING BANK TRANSFER RESMI
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Bank</label>
                        <input type="text" name="bank_name" value="{{ old('bank_name', $settings['bank_name'] ?? 'BCA') }}" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Nomor Rekening</label>
                        <input type="text" name="bank_account" value="{{ old('bank_account', $settings['bank_account'] ?? '') }}" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper font-mono font-bold">
                    </div>
                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Atas Nama</label>
                        <input type="text" name="bank_holder" value="{{ old('bank_holder', $settings['bank_holder'] ?? '') }}" class="w-full px-3 py-2 text-sm border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper">
                    </div>
                </div>
            </div>

            <div class="pt-4 border-t-2 border-pitch dark:border-paper/20">
                <button type="submit" class="px-8 py-4 bg-lime-accent text-pitch font-bold text-xs uppercase tracking-wider border-2 border-pitch shadow-[4px_4px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                    Simpan Semua Pengaturan
                </button>
            </div>
        </form>

    </div>

@endsection
