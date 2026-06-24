@extends('layouts.app')

@section('title', $collection->name . ' - GudangMeme')

@section('content')
<style>
    /* Custom Yellow Palette Styles */
    .bg-brand-primary { background-color: #e69b00 !important; }
    .bg-brand-accent { background-color: #e6b400 !important; }
    .text-brand-primary { color: #e69b00 !important; }
    .text-brand-accent { color: #e6b400 !important; }
    .border-brand-primary { border-color: #e69b00 !important; }
    .border-brand-accent { border-color: #e6b400 !important; }
    .focus\\:ring-brand-accent\\/10:focus { --tw-ring-color: rgba(230, 180, 0, 0.1); }
    .focus\\:ring-brand-accent\\/20:focus { --tw-ring-color: rgba(230, 180, 0, 0.2); }
    .focus\\:border-brand-accent:focus { border-color: #e6b400; }
    .group-focus-within\\:text-brand-accent group-focus-within\:text-brand-accent { color: #e6b400; }
    .bg-brand-accent\\/10 { background-color: rgba(230, 180, 0, 0.1); }
    .bg-brand-accent\\/20 { background-color: rgba(230, 180, 0, 0.2); }
    .text-brand-accent\\/80 { color: rgba(230, 180, 0, 0.8); }
    
    /* Glowing border effect for main card */
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
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Button glow effects */
    .btn-glow-yellow {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
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
    
    .btn-glow-yellow:hover {
        box-shadow: 0 0 30px rgba(230, 155, 0, 0.4),
                    0 0 60px rgba(230, 180, 0, 0.2);
        transform: translateY(-2px);
    }
    
    .btn-glow-yellow:active {
        transform: translateY(0);
    }
    
    /* Input focus glow */
    .input-glow-yellow:focus {
        box-shadow: 0 0 0 4px rgba(230, 180, 0, 0.1),
                    0 0 20px rgba(230, 155, 0, 0.15);
    }
    
    /* Background glow shapes with yellow */
    .bg-glow-yellow-1 {
        background: radial-gradient(circle, rgba(230, 155, 0, 0.08) 0%, transparent 70%);
    }
    
    .bg-glow-yellow-2 {
        background: radial-gradient(circle, rgba(230, 180, 0, 0.08) 0%, transparent 70%);
    }
    
    /* Gradient text */
    .text-gradient-yellow {
        background: linear-gradient(135deg, #e69b00 0%, #e6b400 50%, #e6cc00 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Card section hover */
    .card-section-hover {
        transition: all 0.3s ease;
    }
    
    .card-section-hover:hover {
        box-shadow: 0 4px 20px rgba(230, 155, 0, 0.08);
    }

    /* Footer - All text white */
    footer, footer *, footer a, footer p, footer span, footer div {
        color: #ffffff !important;
    }
    
    footer a:hover {
        color: #f0f0f0 !important;
    }
</style>

<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <!-- Background Accents with yellow palette -->
    <div class="absolute top-20 left-10 w-80 h-80 bg-glow-yellow-1 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-glow-yellow-2 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-[1600px] mx-auto z-10 relative animate-fade-in-up">
        
        <!-- Back Navigation & Meta Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10 border-b border-slate-200/60 pb-6">
            <div class="flex items-start gap-4">
                <a href="{{ route('collections.index') }}" class="p-2 mt-1 rounded-xl bg-white hover:bg-slate-50 border border-slate-200/60 shadow-sm text-slate-600 hover:text-[#e69b00] transition-all btn-glow-yellow">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                </a>
                <div>
                    <div class="flex flex-wrap items-center gap-2 mb-1.5">
                        <h1 class="text-3xl font-extrabold text-gradient-yellow tracking-tight leading-tight">{{ $collection->name }}</h1>
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
                        href="{{ route('collections.edit', $collection->slug) }}" 
                        class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs shadow-sm transition-all btn-glow-yellow"
                    >
                        <i class="fa-solid fa-pen-to-square mr-2"></i> Edit Koleksi
                    </a>
                    
                    <form 
                        action="{{ route('collections.destroy', $collection->slug) }}" 
                        method="POST" 
                        class="form-delete-confirm inline"
                        data-confirm-message="Koleksi '{{ $collection->name }}' beserta seluruh tautan di dalamnya akan dihapus permanen."
                    >
                        @csrf
                        @method('DELETE')
                        <button 
                            type="submit" 
                            class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-white bg-red-500 hover:bg-red-600 font-bold text-xs shadow-sm transition-all cursor-pointer btn-glow-yellow"
                        >
                            <i class="fa-solid fa-trash-can mr-2"></i> Hapus
                        </button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Posts Content Grid -->
        @if($posts->isEmpty())
            <div class="bg-white rounded-3xl glowing-border p-12 text-center max-w-xl mx-auto">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-[#e69b00]/20 to-[#e6b400]/20 text-[#e69b00] shadow-xl shadow-[#e69b00]/10 mb-6">
                    <i class="fa-solid fa-images text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gradient-yellow mb-2">Koleksi ini Kosong</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                    Koleksi ini belum memiliki post tersimpan. Jelajahi feed eksplorasi untuk menemukan meme terlucu dan simpan ke koleksi ini.
                </p>
                <a 
                    href="{{ route('feed') }}" 
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-sm shadow-lg shadow-[#e69b00]/25 hover:shadow-[#e69b00]/40 transition-all duration-300 btn-glow-yellow"
                >
                    Jelajahi Feed Eksplorasi
                </a>
            </div>
        @else
            <!-- Pinterest-like Staggered Grid/Cards -->
            <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 xl:columns-5 gap-4 space-y-4">
                @foreach($posts as $post)
                    <div class="break-inside-avoid overflow-hidden rounded-2xl group relative mb-4 shadow-sm hover:shadow-lg transition-all duration-300">
                        <!-- Post Image & Overlay -->
                        <a href="{{ route('posts.show', $post->slug) }}" class="block relative overflow-hidden bg-slate-100">
                            <img 
                                src="{{ asset($post->image_path) }}" 
                                alt="{{ $post->title }}"
                                loading="lazy" 
                                class="w-full h-auto object-cover group-hover:scale-[1.04] transition-transform duration-500"
                            >
                            <!-- Hover Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                <h4 class="font-bold text-white text-sm line-clamp-1 leading-snug">{{ $post->title }}</h4>
                            </div>
                        </a>
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