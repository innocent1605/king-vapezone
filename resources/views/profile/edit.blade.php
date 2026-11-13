@extends('layouts.app')

@section('title', 'Profil Saya — King Vapezone')

@section('content')

    <div class="border-b-4 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="font-mono text-xs uppercase font-bold text-lime-accent tracking-widest block">PENGATURAN AKUN</span>
            <h1 class="font-display text-5xl text-pitch dark:text-paper leading-none mt-1">
                PROFIL PENGGUNA
            </h1>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <!-- Data Diri Form -->
            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                <h2 class="font-display text-3xl mb-6 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                    BIODATA DIRI
                </h2>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <!-- Avatar Preview -->
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-16 h-16 rounded-none border-2 border-pitch bg-lime-accent flex items-center justify-center font-black text-xl text-pitch overflow-hidden shadow-[2px_2px_0px_#111]">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            @endif
                        </div>
                        <div>
                            <label class="block text-xs font-mono font-bold uppercase mb-1">Foto Profil</label>
                            <input type="file" name="avatar" accept="image/*" class="text-xs file:mr-2 file:py-1 file:px-2 file:border file:border-pitch file:text-[10px] file:font-bold file:bg-lime-accent">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Nama Lengkap *</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full px-3 py-2 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                    </div>

                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Alamat Email *</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full px-3 py-2 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                    </div>

                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Nomor WhatsApp / HP *</label>
                        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}" required class="w-full px-3 py-2 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                    </div>

                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Alamat Default Pengiriman</label>
                        <textarea name="address" rows="3" class="w-full px-3 py-2 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">{{ old('address', $user->address) }}</textarea>
                    </div>

                    <button type="submit" class="w-full py-3 bg-lime-accent text-pitch border-2 border-pitch font-bold text-xs uppercase tracking-wider shadow-[3px_3px_0px_#111] hover:bg-pitch hover:text-lime-accent transition">
                        Simpan Perubahan Biodata
                    </button>
                </form>
            </div>

            <!-- Ganti Password Form -->
            <div class="border-2 border-pitch dark:border-paper/20 bg-white dark:bg-charcoal p-6 shadow-[5px_5px_0px_#111] dark:shadow-[5px_5px_0px_#D4FF00]">
                <h2 class="font-display text-3xl mb-6 text-pitch dark:text-paper border-b-2 border-pitch dark:border-paper/20 pb-2">
                    KEAMANAN SANDI
                </h2>

                <form action="{{ route('profile.password') }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Kata Sandi Saat Ini *</label>
                        <input type="password" name="current_password" required class="w-full px-3 py-2 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                    </div>

                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Kata Sandi Baru *</label>
                        <input type="password" name="password" required placeholder="Minimal 8 karakter" class="w-full px-3 py-2 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                    </div>

                    <div>
                        <label class="block text-xs font-mono font-bold uppercase mb-1">Konfirmasi Sandi Baru *</label>
                        <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border-2 border-pitch dark:border-paper/40 bg-paper dark:bg-pitch text-pitch dark:text-paper text-sm focus:outline-none focus:border-lime-accent">
                    </div>

                    <div class="p-3 bg-paper dark:bg-pitch/60 border border-pitch dark:border-paper/20 text-xs text-gray-500 font-mono">
                        🔒 Gunakan sandi kuat campuran huruf besar, kecil, angka, dan simbol untuk keamanan maksimal.
                    </div>

                    <button type="submit" class="w-full py-3 bg-pitch text-paper dark:bg-paper dark:text-pitch border-2 border-pitch font-bold text-xs uppercase tracking-wider shadow-[3px_3px_0px_#111] hover:bg-lime-accent hover:text-pitch transition">
                        Perbarui Kata Sandi
                    </button>
                </form>
            </div>

        </div>
    </div>

@endsection
