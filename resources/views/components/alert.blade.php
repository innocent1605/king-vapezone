<div x-data="{ show: true }" x-show="show" class="w-full">
    @if(session('success'))
        <div class="bg-lime-accent text-pitch border-b-2 border-pitch px-4 py-3 flex items-center justify-between font-bold text-sm">
            <div class="flex items-center gap-2">
                <span class="inline-block px-2 py-0.5 bg-pitch text-lime-accent text-xs uppercase font-mono">SUKSES</span>
                <span>{{ session('success') }}</span>
            </div>
            <button @click="show = false" class="text-pitch hover:scale-125 transition font-black text-lg">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white border-b-2 border-pitch px-4 py-3 flex items-center justify-between font-bold text-sm">
            <div class="flex items-center gap-2">
                <span class="inline-block px-2 py-0.5 bg-pitch text-white text-xs uppercase font-mono">ERROR</span>
                <span>{{ session('error') }}</span>
            </div>
            <button @click="show = false" class="text-white hover:scale-125 transition font-black text-lg">&times;</button>
        </div>
    @endif

    @if(session('warning'))
        <div class="bg-yellow-400 text-pitch border-b-2 border-pitch px-4 py-3 flex items-center justify-between font-bold text-sm">
            <div class="flex items-center gap-2">
                <span class="inline-block px-2 py-0.5 bg-pitch text-yellow-400 text-xs uppercase font-mono">PERHATIAN</span>
                <span>{{ session('warning') }}</span>
            </div>
            <button @click="show = false" class="text-pitch hover:scale-125 transition font-black text-lg">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-600 text-white border-b-2 border-pitch px-4 py-3 font-medium text-sm">
            <div class="flex items-center justify-between font-bold mb-1">
                <span class="inline-block px-2 py-0.5 bg-pitch text-white text-xs uppercase font-mono">TERJADI KESALAHAN VALIDASI</span>
                <button @click="show = false" class="text-white hover:scale-125 transition font-black text-lg">&times;</button>
            </div>
            <ul class="list-disc list-inside text-xs space-y-1 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
