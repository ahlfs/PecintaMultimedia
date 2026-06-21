@extends('layouts.app')

@section('title', 'Edit Koleksi - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <!-- Background Accents -->
    <div class="absolute top-20 left-10 w-80 h-80 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-brand-accent/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-2xl mx-auto z-10 relative animate-fade-in-up">
        
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('collections.index') }}" class="p-2 rounded-xl bg-white hover:bg-slate-100 border border-slate-200/60 shadow-sm text-slate-600 hover:text-brand-primary transition-all">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-brand-primary tracking-tight">Edit Koleksi</h1>
                <p class="text-slate-500 text-sm mt-0.5">Perbarui nama, deskripsi, atau tingkat privasi koleksi Anda.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden p-8 sm:p-10">
            <form action="{{ route('collections.update', $collection->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Koleksi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-folder text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                        </div>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name', $collection->name) }}" 
                            required 
                            placeholder="Contoh: Meme Programmer Terkocak"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('name') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                    </div>
                    @error('name')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description Textarea -->
                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi (Opsional)</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4" 
                        placeholder="Tulis deskripsi singkat mengenai koleksi ini..."
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('description') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                    >{{ old('description', $collection->description) }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Privacy Option (Checkbox styled as toggle card) -->
                <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/60 flex items-start gap-4">
                    <div class="flex items-center h-5 mt-0.5">
                        <input 
                            type="checkbox" 
                            id="is_private" 
                            name="is_private" 
                            value="1" 
                            {{ old('is_private', $collection->is_private) ? 'checked' : '' }}
                            class="w-4.5 h-4.5 rounded border-slate-300 text-brand-primary focus:ring-brand-primary/20 cursor-pointer"
                        >
                    </div>
                    <div class="text-sm cursor-pointer select-none">
                        <label for="is_private" class="font-bold text-slate-800 flex items-center gap-1.5 cursor-pointer">
                            <i class="fa-solid fa-lock text-brand-primary text-xs"></i> Jadikan Koleksi Rahasia
                        </label>
                        <p class="text-xs text-slate-500 mt-1 leading-relaxed">
                            Koleksi rahasia bersifat privat. Hanya Anda yang dapat melihat koleksi ini beserta postingan meme di dalamnya.
                        </p>
                    </div>
                </div>

                <!-- Submit / Cancel actions -->
                <div class="pt-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
                    <a 
                        href="{{ route('collections.index') }}" 
                        class="w-full sm:w-auto text-center px-6 py-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-bold text-sm transition-all"
                    >
                        Batalkan
                    </a>
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto px-8 py-3 rounded-xl bg-brand-primary hover:bg-brand-primary/95 text-white font-bold text-sm shadow-md shadow-brand-primary/10 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer"
                    >
                        Perbarui Koleksi
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
