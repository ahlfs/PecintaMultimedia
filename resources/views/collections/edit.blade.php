@extends('layouts.app')

@section('title', 'Edit Koleksi - GudangMeme')

@section('content')
{{-- ============================================================
     CUSTOM CSS - HANYA UNTUK KEYFRAMES & PSEUDO-ELEMENTS
     yang tidak bisa di-replace oleh Tailwind
     ============================================================ --}}
<style>
    /* Glowing border effect untuk main card */
    .glowing-border {
        position: relative;
        border: 1px solid rgba(230, 180, 0, 0.2);
        box-shadow: 0 0 40px rgba(230, 155, 0, 0.15),
                    0 0 80px rgba(230, 180, 0, 0.1),
                    inset 0 1px 0 rgba(255, 255, 255, 0.6);
    }

    .glowing-border::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #e69b00, #e6b400, #e6cc00, #e5de00, #e6b400, #e69b00);
        border-radius: inherit;
        z-index: -1;
        filter: blur(20px);
        opacity: 0.4;
        animation: glowRotate 8s linear infinite;
        background-size: 400% 400%;
    }

    @keyframes glowRotate {
        0%   { background-position: 0% 50%; }
        50%  { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Button shine effect */
    .btn-glow-yellow {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .btn-glow-yellow::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-glow-yellow:hover::before {
        left: 100%;
    }

    /* Fade in up animation */
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.8s ease-out forwards;
    }
</style>

<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    {{-- Background Accents with yellow palette --}}
    <div class="absolute top-20 left-10 w-80 h-80 bg-[radial-gradient(circle,rgba(230,155,0,0.08)_0%,transparent_70%)] rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-[radial-gradient(circle,rgba(230,180,0,0.08)_0%,transparent_70%)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-2xl mx-auto z-10 relative animate-fade-in-up">

        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('collections.index') }}" class="p-2 rounded-xl bg-white hover:bg-slate-50 border border-slate-200/60 shadow-sm text-slate-600 hover:text-[#e69b00] hover:shadow-[0_0_30px_rgba(230,155,0,0.4),0_0_60px_rgba(230,180,0,0.2)] hover:-translate-y-0.5 transition-all btn-glow-yellow">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent tracking-tight">Edit Koleksi</h1>
                <p class="text-slate-500 text-sm mt-0.5">Perbarui nama, deskripsi, atau tingkat privasi koleksi Anda.</p>
            </div>
        </div>

        {{-- Form Card with Glowing Border --}}
        <div class="bg-white rounded-3xl glowing-border overflow-hidden p-8 sm:p-10">
            <form action="{{ route('collections.update', $collection->slug) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Name Input --}}
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Koleksi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-folder text-slate-400 group-focus-within:text-[#e6b400] transition-colors"></i>
                        </div>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name', $collection->name) }}"
                            required
                            placeholder="Contoh: Meme Programmer Terkocak"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] focus:shadow-[0_0_0_4px_rgba(230,180,0,0.1),0_0_20px_rgba(230,155,0,0.15)] text-slate-800 placeholder-slate-400 transition-all text-sm hover:border-[#e6cc00]/50 @error('name') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                    </div>
                    @error('name')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Description Textarea --}}
                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi (Opsional)</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Tulis deskripsi singkat mengenai koleksi ini..."
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] focus:shadow-[0_0_0_4px_rgba(230,180,0,0.1),0_0_20px_rgba(230,155,0,0.15)] text-slate-800 placeholder-slate-400 transition-all text-sm hover:border-[#e6cc00]/50 @error('description') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                    >{{ old('description', $collection->description) }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Privacy Option (Checkbox styled as toggle card) --}}
                <div class="p-5 rounded-2xl bg-gradient-to-b from-amber-50/30 to-white border border-slate-200/60 flex items-start gap-4 hover:shadow-[0_4px_20px_rgba(230,155,0,0.08)] transition-all duration-300">
                    <div class="flex items-center h-5 mt-0.5">
                        <input
                            type="checkbox"
                            id="is_private"
                            name="is_private"
                            value="1"
                            {{ old('is_private', $collection->is_private) ? 'checked' : '' }}
                            class="size-[18px] rounded border-slate-300 text-[#e69b00] focus:ring-[#e69b00]/20 cursor-pointer accent-[#e69b00] hover:border-[#e6cc00] transition-colors"
                        >
                    </div>
                    <div class="text-sm cursor-pointer select-none">
                        <label for="is_private" class="font-bold text-slate-800 flex items-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-lock text-[#e69b00] text-xs"></i> Jadikan Koleksi Rahasia
                        </label>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                            Koleksi rahasia bersifat privat. Hanya Anda yang dapat melihat koleksi ini beserta postingan meme di dalamnya.
                        </p>
                    </div>
                </div>

                {{-- Submit / Cancel actions --}}
                <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
                    <a
                        href="{{ route('collections.index') }}"
                        class="w-full sm:w-auto text-center px-6 py-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm transition-all btn-glow-yellow"
                    >
                        Batalkan
                    </a>
                    <button
                        type="submit"
                        class="w-full sm:w-auto px-8 py-3 rounded-xl bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] text-white font-bold text-sm shadow-lg shadow-[#e69b00]/25 hover:shadow-[0_0_30px_rgba(230,155,0,0.4),0_0_60px_rgba(230,180,0,0.2)] hover:-translate-y-0.5 transition-all duration-300 transform cursor-pointer btn-glow-yellow"
                    >
                        Perbarui Koleksi
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection