@extends('layouts.app')

@section('title', 'Koleksi Saya - GudangMeme')

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

    <div class="max-w-7xl mx-auto z-10 relative animate-fade-in-up">

        {{-- Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10 border-b border-slate-200/60 pb-6">
            <div>
                <h1 class="text-3xl font-extrabold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent tracking-tight">Koleksi Saya</h1>
                <p class="text-slate-500 text-sm mt-1">Organisasikan meme terlucu dan gambar inspiratif ke dalam folder terpisah.</p>
            </div>
            <div>
                <a
                    href="{{ route('collections.create') }}"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-sm shadow-lg shadow-[#e69b00]/25 hover:shadow-[0_0_30px_rgba(230,155,0,0.4),0_0_60px_rgba(230,180,0,0.2)] hover:-translate-y-0.5 transition-all duration-300 transform cursor-pointer btn-glow-yellow"
                >
                    <i class="fa-solid fa-folder-plus mr-2"></i> Buat Koleksi Baru
                </a>
            </div>
        </div>

        @if($collections->isEmpty())
            {{-- Empty State Card with Glowing Border --}}
            <div class="bg-white rounded-3xl glowing-border p-12 text-center max-w-xl mx-auto">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-gradient-to-br from-[#e69b00]/20 to-[#e6b400]/20 text-[#e69b00] shadow-xl shadow-[#e69b00]/10 mb-6">
                    <i class="fa-solid fa-folder-open text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent mb-2">Belum ada Koleksi</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                    Meme terlucu dan foto estetik milik Anda membutuhkan tempat penyimpanan khusus. Mulai dengan membuat koleksi pertama Anda sekarang!
                </p>
                <a
                    href="{{ route('collections.create') }}"
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-sm shadow-lg shadow-[#e69b00]/25 hover:shadow-[0_0_30px_rgba(230,155,0,0.4),0_0_60px_rgba(230,180,0,0.2)] hover:-translate-y-0.5 transition-all duration-300 btn-glow-yellow"
                >
                    Buat Koleksi Pertama
                </a>
            </div>
        @else
            {{-- Collections Card Grid --}}
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($collections as $collection)
                    <div class="group bg-transparent flex flex-col justify-between overflow-hidden">
                        {{-- Collection Preview Grid (Pinterest aspect ratio & layout) --}}
                        <a href="{{ route('collections.show', $collection->slug) }}" class="block w-full">
                            <div class="grid grid-cols-3 grid-rows-2 gap-[2px] aspect-[4/3] w-full rounded-2xl sm:rounded-3xl overflow-hidden bg-slate-100 border border-slate-200/60 shadow-sm hover:shadow-md transition-all duration-300">
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
                                    {{-- Left: 1 big image (takes 2/3 width) --}}
                                    <div class="col-span-2 row-span-2 relative overflow-hidden bg-slate-200">
                                        <img src="{{ asset($collection->posts[0]->image_path) }}" alt="{{ $collection->posts[0]->title }}" class="w-full h-full object-cover">
                                    </div>
                                    {{-- Right Top: 1 small image --}}
                                    <div class="relative overflow-hidden bg-slate-200">
                                        <img src="{{ asset($collection->posts[1]->image_path) }}" alt="{{ $collection->posts[1]->title }}" class="w-full h-full object-cover">
                                    </div>
                                    {{-- Right Bottom: 1 small image --}}
                                    <div class="relative overflow-hidden bg-slate-200">
                                        <img src="{{ asset($collection->posts[2]->image_path) }}" alt="{{ $collection->posts[2]->title }}" class="w-full h-full object-cover">
                                    </div>
                                @endif
                            </div>
                        </a>

                        {{-- Title & Post Count --}}
                        <div class="mt-3 px-1">
                            <h3 class="font-extrabold text-slate-900 text-sm sm:text-base md:text-lg hover:text-[#e6b400] transition-colors leading-snug">
                                <a href="{{ route('collections.show', $collection->slug) }}">{{ $collection->name }}</a>
                            </h3>
                            <span class="text-[10px] sm:text-xs md:text-sm font-semibold text-slate-500 mt-1 block">{{ $collection->posts_count }} post</span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-10">
                {{ $collections->links() }}
            </div>
        @endif

    </div>
</div>
@endsection