@extends('layouts.app')

@section('title', 'Koleksi Saya - GudangMeme')

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

    <div class="max-w-7xl mx-auto z-10 relative animate-fade-in-up">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10 border-b border-slate-200/60 pb-6">
            <div>
                <h1 class="text-3xl font-extrabold text-gradient-yellow tracking-tight">Koleksi Saya</h1>
                <p class="text-slate-500 text-sm mt-1">Organisasikan meme terlucu dan gambar inspiratif ke dalam folder terpisah.</p>
            </div>
            <div>
                <a 
                    href="{{ route('collections.create') }}" 
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-sm shadow-lg shadow-[#e69b00]/25 hover:shadow-[#e69b00]/40 transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer btn-glow-yellow"
                >
                    <i class="fa-solid fa-folder-plus mr-2"></i> Buat Koleksi Baru
                </a>
            </div>
        </div>

        @if($collections->isEmpty())
            <!-- Empty State Card with Glowing Border -->
            <div class="bg-white rounded-3xl glowing-border p-12 text-center max-w-xl mx-auto">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-[#e69b00]/20 to-[#e6b400]/20 text-[#e69b00] shadow-xl shadow-[#e69b00]/10 mb-6">
                    <i class="fa-solid fa-folder-open text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gradient-yellow mb-2">Belum ada Koleksi</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                    Meme terlucu dan foto estetik milik Anda membutuhkan tempat penyimpanan khusus. Mulai dengan membuat koleksi pertama Anda sekarang!
                </p>
                <a 
                    href="{{ route('collections.create') }}" 
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-sm shadow-lg shadow-[#e69b00]/25 hover:shadow-[#e69b00]/40 transition-all duration-300 btn-glow-yellow"
                >
                    Buat Koleksi Pertama
                </a>
            </div>
        @else
            <!-- Collections Card Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($collections as $collection)
                    <div class="group bg-transparent flex flex-col justify-between overflow-hidden">
                        <!-- Collection Preview Grid (Pinterest aspect ratio & layout) -->
                        <a href="{{ route('collections.show', $collection->slug) }}" class="block w-full">
                            <div class="grid grid-cols-3 grid-rows-2 gap-[2px] aspect-[4/3] w-full rounded-3xl overflow-hidden bg-slate-100 border border-slate-200/60 shadow-sm hover:shadow-md transition-all duration-300">
                                @if($collection->posts->isEmpty())
                                    <div class="col-span-3 row-span-2 relative overflow-hidden bg-slate-100 flex items-center justify-center">
                                        <img src="https://images.unsplash.com/photo-1509281373149-e957c6296406?w=600&auto=format&fit=crop&q=80" alt="Koleksi Kosong" class="w-full h-full object-cover brightness-95">
                                        <div class="absolute inset-0 bg-slate-950/40 flex flex-col items-center justify-center p-4">
                                            <i class="fa-solid fa-folder-open text-white text-3xl mb-2"></i>
                                            <span class="text-white text-xs font-bold uppercase tracking-wider">Koleksi Kosong</span>
                                        </div>
                                    </div>
                                @elseif($collection->posts->count() === 1)
                                    <div class="col-span-3 row-span-2 relative overflow-hidden bg-slate-200">
                                        <img src="{{ asset($collection->posts[0]->image_path) }}" alt="{{ $collection->posts[0]->title }}" class="w-full h-full object-cover">
                                    </div>
                                @elseif($collection->posts->count() === 2)
                                    <div class="col-span-2 row-span-2 relative overflow-hidden bg-slate-200">
                                        <img src="{{ asset($collection->posts[0]->image_path) }}" alt="{{ $collection->posts[0]->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="row-span-2 relative overflow-hidden bg-slate-200">
                                        <img src="{{ asset($collection->posts[1]->image_path) }}" alt="{{ $collection->posts[1]->title }}" class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <!-- Left: 1 big image (takes 2/3 width) -->
                                    <div class="col-span-2 row-span-2 relative overflow-hidden bg-slate-200">
                                        <img src="{{ asset($collection->posts[0]->image_path) }}" alt="{{ $collection->posts[0]->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Right Top: 1 small image -->
                                    <div class="relative overflow-hidden bg-slate-200">
                                        <img src="{{ asset($collection->posts[1]->image_path) }}" alt="{{ $collection->posts[1]->title }}" class="w-full h-full object-cover">
                                    </div>
                                    <!-- Right Bottom: 1 small image -->
                                    <div class="relative overflow-hidden bg-slate-200">
                                        <img src="{{ asset($collection->posts[2]->image_path) }}" alt="{{ $collection->posts[2]->title }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>
                        </a>

                        <!-- Title & Post Count -->
                        <div class="mt-3 px-1">
                            <h3 class="font-extrabold text-slate-900 text-base sm:text-lg hover:text-[#e6b400] transition-colors leading-snug">
                                <a href="{{ route('collections.show', $collection->slug) }}">{{ $collection->name }}</a>
                            </h3>
                            <span class="text-xs sm:text-sm font-semibold text-slate-500 mt-1 block">{{ $collection->posts_count }} post</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $collections->links() }}
            </div>
        @endif

    </div>
</div>
@endsection