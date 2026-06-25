@extends('layouts.app')

@section('title', 'Profil ' . $user->name . ' - GudangMeme')

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

    /* Avatar glow effect */
    .avatar-glow {
        position: relative;
    }

    .avatar-glow::before {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        background: linear-gradient(45deg, #e69b00, #e6b400, #e6cc00, #e5de00, #e6b400, #e69b00);
        border-radius: 9999px;
        z-index: -1;
        filter: blur(10px);
        opacity: 0.5;
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

<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50 overflow-hidden">
    {{-- Background Accents with yellow palette --}}
    <div class="absolute top-10 left-10 w-80 h-80 bg-[radial-gradient(circle,rgba(230,155,0,0.08)_0%,transparent_70%)] rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-[radial-gradient(circle,rgba(230,180,0,0.08)_0%,transparent_70%)] rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-[1600px] mx-auto z-10 relative animate-fade-in-up">

        {{-- Profile Header Block with Glowing Border --}}
        <div class="bg-white rounded-3xl glowing-border p-6 sm:p-10 mb-10">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8 sm:gap-12">

                {{-- Avatar Column with Glow --}}
                <div class="flex-shrink-0 avatar-glow">
                    <img
                        src="{{ $user->profile_photo ? asset($user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=e69b00&color=fff&bold=true&size=150' }}"
                        alt="{{ $user->name }}"
                        class="w-28 h-28 sm:w-36 sm:h-36 rounded-full object-cover border-4 border-white shadow-lg"
                    >
                </div>

                {{-- Profile Info Column --}}
                <div class="flex-grow text-center md:text-left">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-4">
                        <h2 class="text-2xl font-extrabold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent">@ {{ $user->username }}</h2>

                        @if($isOwner)
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-2">
                            <a
                                href="{{ route('profile.edit') }}"
                                class="inline-flex items-center justify-center px-4 py-2 text-xs font-bold rounded-xl border border-slate-200 bg-white hover:bg-slate-50 hover:shadow-[0_0_30px_rgba(230,155,0,0.4),0_0_60px_rgba(230,180,0,0.2)] hover:-translate-y-0.5 text-slate-700 shadow-sm transition-all btn-glow-yellow"
                            >
                                <i class="fa-solid fa-user-gear mr-1.5"></i> Edit Profil
                            </a>
                            <button
                                type="button"
                                onclick="confirmLogout(event)"
                                class="inline-flex items-center justify-center px-4 py-2 text-xs font-bold rounded-xl border border-red-200 bg-white hover:bg-red-50 hover:border-red-300 hover:shadow-[0_0_30px_rgba(239,68,68,0.3),0_0_60px_rgba(239,68,68,0.15)] hover:-translate-y-0.5 text-red-500 shadow-sm transition-all cursor-pointer btn-glow-yellow"
                            >
                                <i class="fa-solid fa-right-from-bracket mr-1.5"></i> Keluar
                            </button>
                        </div>
                        @endif
                    </div>

                    {{-- Stats Row --}}
                    <div class="flex items-center justify-center md:justify-start gap-8 mb-4 border-y sm:border-y-0 border-slate-100 py-3 sm:py-0">
                        <div>
                            <span class="font-extrabold text-slate-800 text-base sm:text-lg">{{ $user->posts_count }}</span>
                            <span class="text-xs sm:text-sm text-slate-500 ml-1">Kiriman</span>
                        </div>
                        <div>
                            <span class="font-extrabold text-slate-800 text-base sm:text-lg">{{ $user->collections_count }}</span>
                            <span class="text-xs sm:text-sm text-slate-500 ml-1">Koleksi</span>
                        </div>
                        <div>
                            <span class="font-extrabold text-slate-800 text-base sm:text-lg">{{ $likesCount }}</span>
                            <span class="text-xs sm:text-sm text-slate-500 ml-1">Suka</span>
                        </div>
                    </div>

                    {{-- Name and Bio --}}
                    <div>
                        <h1 class="font-bold text-slate-800 text-base sm:text-lg mb-1">{{ $user->name }}</h1>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-2xl">
                            {{ $user->bio ?? 'Belum ada deskripsi profil untuk pengguna ini.' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        {{-- Dynamic Content Tabs Block (Alpine.js) --}}
        <div x-data="{ activeTab: 'posts' }" class="w-full">

            {{-- Tabs Navigation Bar --}}
            <div class="flex items-center justify-center border-t border-slate-200/80 mb-8 gap-12">

                {{-- Posts Tab Header --}}
                <button
                    @click="activeTab = 'posts'"
                    :class="activeTab === 'posts'
                        ? 'border-[#e69b00] text-[#e69b00] font-bold [text-shadow:0_0_15px_rgba(230,155,0,0.3)]'
                        : 'border-t-2 border-transparent text-slate-400 hover:text-[#e69b00]'"
                    class="pt-4 px-2 text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all cursor-pointer border-t-2"
                >
                    <i class="fa-solid fa-table-cells text-sm"></i> Kiriman
                </button>

                {{-- Collections Tab Header --}}
                <button
                    @click="activeTab = 'collections'"
                    :class="activeTab === 'collections'
                        ? 'border-[#e69b00] text-[#e69b00] font-bold [text-shadow:0_0_15px_rgba(230,155,0,0.3)]'
                        : 'border-t-2 border-transparent text-slate-400 hover:text-[#e69b00]'"
                    class="pt-4 px-2 text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all cursor-pointer border-t-2"
                >
                    <i class="fa-solid fa-folder-open text-sm"></i> Koleksi
                </button>

                {{-- Likes Tab Header --}}
                <button
                    @click="activeTab = 'likes'"
                    :class="activeTab === 'likes'
                        ? 'border-[#e69b00] text-[#e69b00] font-bold [text-shadow:0_0_15px_rgba(230,155,0,0.3)]'
                        : 'border-t-2 border-transparent text-slate-400 hover:text-[#e69b00]'"
                    class="pt-4 px-2 text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all cursor-pointer border-t-2"
                >
                    <i class="fa-solid fa-heart text-sm"></i> Suka
                </button>

            </div>

            {{-- Tabs Content Panels --}}
            <div>

                {{-- 1. Kiriman (Own Posts) Tab --}}
                <div x-show="activeTab === 'posts'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    @if($posts->isEmpty())
                        {{-- Empty Posts State --}}
                        <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-sm max-w-md mx-auto hover:shadow-[0_4px_20px_rgba(230,155,0,0.08)] transition-all duration-300">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#e69b00]/10 text-[#e69b00] mb-4">
                                <i class="fa-regular fa-image text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Belum Ada Kiriman</h3>
                            <p class="text-xs text-slate-500 max-w-xs mx-auto px-4 mb-5">Bagikan meme terlucu dan terpopuler buatan Anda sendiri sekarang!</p>
                            <a href="{{ route('posts.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-xs shadow-lg shadow-[#e69b00]/25 hover:shadow-[0_0_30px_rgba(230,155,0,0.4),0_0_60px_rgba(230,180,0,0.2)] hover:-translate-y-0.5 transition-all btn-glow-yellow">
                                <i class="fa-solid fa-circle-plus mr-1.5"></i> Unggah Meme Pertama
                            </a>
                        </div>
                    @else
                        {{-- Posts Pinterest Grid --}}
                        <div class="columns-2 sm:columns-2 md:columns-3 lg:columns-4 xl:columns-5 gap-3 sm:gap-4">
                            @foreach($posts as $post)
                                <div class="break-inside-avoid overflow-hidden rounded-xl sm:rounded-2xl group relative mb-3 sm:mb-4 shadow-sm hover:shadow-[0_10px_40px_rgba(230,155,0,0.15),0_0_20px_rgba(230,180,0,0.1)] hover:scale-[1.02] transition-all duration-300">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="block relative overflow-hidden bg-slate-100">
                                        <img
                                            src="{{ asset($post->image_path) }}"
                                            alt="{{ $post->title }}"
                                            loading="lazy"
                                            class="w-full h-auto object-cover group-hover:scale-[1.04] transition-transform duration-500"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                            <h4 class="font-bold text-white text-sm line-clamp-1 leading-snug drop-shadow-lg">{{ $post->title }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- 2. Koleksi (Collections) Tab --}}
                <div x-show="activeTab === 'collections'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
                    @if($collections->isEmpty())
                        {{-- Empty Collections State --}}
                        <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-sm max-w-md mx-auto hover:shadow-[0_4px_20px_rgba(230,155,0,0.08)] transition-all duration-300">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#e69b00]/10 text-[#e69b00] mb-4">
                                <i class="fa-solid fa-folder-open text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Belum Ada Koleksi</h3>
                            <p class="text-xs text-slate-500 max-w-xs mx-auto px-4 mb-5">Organisasikan meme terlucu dan visual estetik Anda ke dalam folder khusus.</p>
                            <a href="{{ route('collections.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-xs shadow-lg shadow-[#e69b00]/25 hover:shadow-[0_0_30px_rgba(230,155,0,0.4),0_0_60px_rgba(230,180,0,0.2)] hover:-translate-y-0.5 transition-all btn-glow-yellow">
                                <i class="fa-solid fa-folder-plus mr-1.5"></i> Buat Koleksi Pertama
                            </a>
                        </div>
                    @else
                        {{-- Collections Card Grid --}}
                        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                             @foreach($collections as $collection)
                                 <div class="group bg-transparent flex flex-col justify-between overflow-hidden">
                                     {{-- Collection Preview Grid (Pinterest aspect ratio & layout) --}}
                                     <a href="{{ route('collections.show', $collection->slug) }}" class="block w-full">
                                         <div class="grid grid-cols-3 grid-rows-2 gap-[2px] aspect-[4/3] w-full rounded-2xl sm:rounded-3xl overflow-hidden bg-slate-100 border border-slate-200/60 shadow-sm hover:shadow-md hover:border-[#e6b400]/40 transition-all duration-300">
                                             @if($collection->posts->isEmpty())
                                                 <div class="col-span-3 row-span-2 relative overflow-hidden bg-slate-100 flex items-center justify-center">
                                                     <img src="https://images.unsplash.com/photo-1509281373149-e957c6296406?w=600&auto=format&fit=crop&q=80" alt="Koleksi Kosong" class="w-full h-full object-cover brightness-95">
                                                     <div class="absolute inset-0 bg-slate-950/40 flex flex-col items-center justify-center p-4">
                                                         <i class="fa-solid fa-folder-open text-white text-3xl mb-2"></i>
                                                         <span class="text-white text-[8px] font-bold uppercase tracking-wider">Koleksi Kosong</span>
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
                    @endif
                </div>

                {{-- 3. Suka (Liked Posts) Tab --}}
                <div x-show="activeTab === 'likes'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
                    @if($likedPosts->isEmpty())
                        {{-- Empty Likes State --}}
                        <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-sm max-w-md mx-auto hover:shadow-[0_4px_20px_rgba(230,155,0,0.08)] transition-all duration-300">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#e69b00]/10 text-[#e69b00] mb-4">
                                <i class="fa-regular fa-heart text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Belum Ada Like</h3>
                            <p class="text-xs text-slate-500 max-w-xs mx-auto px-4">Kembali ke feed utama untuk menyukai meme yang Anda temukan!</p>
                            <a href="{{ route('feed') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-xs shadow-lg shadow-[#e69b00]/25 hover:shadow-[0_0_30px_rgba(230,155,0,0.4),0_0_60px_rgba(230,180,0,0.2)] hover:-translate-y-0.5 transition-all btn-glow-yellow mt-5">
                                <i class="fa-solid fa-compass mr-1.5"></i> Eksplorasi Feed
                            </a>
                        </div>
                    @else
                        {{-- Liked Posts Pinterest Grid --}}
                        <div class="columns-2 sm:columns-2 md:columns-3 lg:columns-4 xl:columns-5 gap-3 sm:gap-4">
                            @foreach($likedPosts as $post)
                                <div class="break-inside-avoid overflow-hidden rounded-xl sm:rounded-2xl group relative mb-3 sm:mb-4 shadow-sm hover:shadow-[0_10px_40px_rgba(230,155,0,0.15),0_0_20px_rgba(230,180,0,0.1)] hover:scale-[1.02] transition-all duration-300">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="block relative overflow-hidden bg-slate-100">
                                        <img
                                            src="{{ asset($post->image_path) }}"
                                            alt="{{ $post->title }}"
                                            loading="lazy"
                                            class="w-full h-auto object-cover group-hover:scale-[1.04] transition-transform duration-500"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                            <h4 class="font-bold text-white text-sm line-clamp-1 leading-snug drop-shadow-lg">{{ $post->title }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>

        </div>

    </div>
</div>

{{-- Outside Logout Form to prevent nested forms --}}
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
    @csrf
</form>

@push('scripts')
<script>
    function confirmLogout(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            text: "Anda harus masuk kembali untuk mengakses feed dan koleksi Anda.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e69b00',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-3xl',
                confirmButton: 'rounded-xl px-5 py-2.5 font-bold bg-gradient-to-r from-[#e69b00] to-[#e6b400] hover:from-[#e6b400] hover:to-[#e6cc00] text-white shadow-lg',
                cancelButton: 'rounded-xl px-5 py-2.5 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
@endpush
@endsection