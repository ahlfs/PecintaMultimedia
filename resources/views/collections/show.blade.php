@extends('layouts.app')

@section('title', $collection->name . ' - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <!-- Background Accents -->
    <div class="absolute top-20 left-10 w-80 h-80 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-brand-accent/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto z-10 relative animate-fade-in-up">
        
        <!-- Back Navigation & Meta Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10 border-b border-slate-200/60 pb-6">
            <div class="flex items-start gap-4">
                <a href="{{ route('collections.index') }}" class="p-2 mt-1 rounded-xl bg-white hover:bg-slate-100 border border-slate-200/60 shadow-sm text-slate-600 hover:text-brand-primary transition-all">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                </a>
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-1.5">
                        <h1 class="text-3xl font-extrabold text-brand-primary tracking-tight leading-tight">{{ $collection->name }}</h1>
                        @if($collection->is_private)
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold text-amber-700 bg-amber-50 border border-amber-100">
                                <i class="fa-solid fa-lock text-[10px]"></i> Rahasia
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-100">
                                <i class="fa-solid fa-globe text-[10px]"></i> Publik
                            </span>
                        @endif
                    </div>
                    <p class="text-slate-500 text-sm italic mb-2">{{ $collection->description ?? 'Tidak ada deskripsi untuk koleksi ini.' }}</p>
                    <p class="text-xs text-slate-400 font-medium">
                        Dibuat oleh: <span class="font-bold text-slate-600">{{ $collection->user->name }}</span> • {{ $collection->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>

            <!-- Owner Operations -->
            @if($collection->user_id === session('user_id'))
                <div class="flex items-center gap-3 self-start md:self-center">
                    <a 
                        href="{{ route('collections.edit', $collection->id) }}" 
                        class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs shadow-sm transition-all"
                    >
                        <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Koleksi
                    </a>
                    
                    <form 
                        action="{{ route('collections.destroy', $collection->id) }}" 
                        method="POST" 
                        class="form-delete-confirm inline"
                        data-confirm-message="Koleksi '{{ $collection->name }}' beserta seluruh tautan di dalamnya akan dihapus permanen."
                    >
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-white bg-red-500 hover:bg-red-600 font-bold text-xs shadow-sm transition-all cursor-pointer"
                        >
                            <i class="fa-solid fa-trash-can mr-2"></i> Hapus
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Posts Content Grid -->
        @if($posts->isEmpty())
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-12 text-center max-w-xl mx-auto">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-brand-accent/10 text-brand-accent shadow-xl shadow-brand-accent/5 mb-6">
                    <i class="fa-solid fa-images text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-brand-primary mb-2">Koleksi ini Kosong</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                    Koleksi ini belum memiliki post tersimpan. Jelajahi feed eksplorasi untuk menemukan meme terlucu dan simpan ke koleksi ini.
                </p>
                <a 
                    href="{{ route('feed') }}" 
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl text-white bg-brand-accent hover:bg-brand-accent/95 font-bold text-sm shadow-md transition-all duration-300"
                >
                    Jelajahi Feed Eksplorasi
                </a>
            </div>
        @else
            <!-- Pinterest-like Staggered Grid/Cards -->
            <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-6 space-y-6">
                @foreach($posts as $post)
                    <div class="break-inside-avoid bg-white rounded-2xl border border-slate-200/60 shadow-sm overflow-hidden hover:shadow-lg transition-all duration-300 group">
                        <!-- Post Image -->
                        <div class="relative overflow-hidden cursor-pointer">
                            <img 
                                src="{{ asset($post->image_path) }}" 
                                alt="{{ $post->title }}" 
                                class="w-full object-cover transition-transform duration-500 group-hover:scale-105"
                            >
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                                <span class="text-white text-xs font-bold font-sans flex items-center gap-1.5">
                                    <i class="fa-solid fa-user-circle"></i> {{ $post->user->name }}
                                </span>
                            </div>
                        </div>

                        <!-- Post Info -->
                        <div class="p-4 border-t border-slate-100">
                            <h4 class="font-bold text-slate-800 text-sm line-clamp-2 leading-snug group-hover:text-brand-primary transition-colors">
                                {{ $post->title }}
                            </h4>
                            <p class="text-xs text-slate-400 mt-1 line-clamp-1">
                                {{ Str::limit($post->description ?? 'Tidak ada deskripsi.', 50) }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $posts->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
