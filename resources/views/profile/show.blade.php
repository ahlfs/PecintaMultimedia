@extends('layouts.app')

@section('title', 'Profil ' . $user->name . ' - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50 overflow-hidden">
    <!-- Background Accents -->
    <div class="absolute top-10 left-10 w-80 h-80 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-brand-accent/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-[1600px] mx-auto z-10 relative animate-fade-in-up">
        
        <!-- Profile Header Block -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-6 sm:p-10 mb-10">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-8 sm:gap-12">
                
                <!-- Avatar Column -->
                <div class="flex-shrink-0">
                    <img 
                        src="{{ $user->profile_photo ? asset($user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=293681&color=fff&bold=true&size=150' }}" 
                        alt="{{ $user->name }}" 
                        class="w-28 h-28 sm:w-36 sm:h-36 rounded-full object-cover border-4 border-slate-50 shadow-md"
                    >
                </div>

                <!-- Profile Info Column -->
                <div class="flex-grow text-center md:text-left">
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 mb-4">
                        <h2 class="text-2xl font-extrabold text-brand-primary">@ {{ $user->username }}</h2>
                        
                        @if($isOwner)
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-2">
                            <a 
                                href="{{ route('profile.edit') }}" 
                                class="inline-flex items-center justify-center px-4 py-2 text-xs font-bold rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 shadow-sm transition-all"
                            >
                                <i class="fa-solid fa-user-gear mr-1.5"></i> Edit Profil
                            </a>
                            <button 
                                type="button" 
                                onclick="confirmLogout(event)"
                                class="inline-flex items-center justify-center px-4 py-2 text-xs font-bold rounded-xl border border-red-200 bg-white hover:bg-red-50 text-red-500 shadow-sm transition-all cursor-pointer"
                            >
                                <i class="fa-solid fa-right-from-bracket mr-1.5"></i> Keluar
                            </button>
                        </div>
                        @endif
                    </div>

                    <!-- Stats Row -->
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

                    <!-- Name and Bio -->
                    <div>
                        <h1 class="font-bold text-slate-800 text-base sm:text-lg mb-1">{{ $user->name }}</h1>
                        <p class="text-slate-600 text-xs sm:text-sm leading-relaxed max-w-2xl">
                            {{ $user->bio ?? 'Belum ada deskripsi profil untuk pengguna ini.' }}
                        </p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Dynamic Content Tabs Block (Alpine.js) -->
        <div x-data="{ activeTab: 'posts' }" class="w-full">
            
            <!-- Tabs Navigation Bar -->
            <div class="flex items-center justify-center border-t border-slate-200/80 mb-8 gap-12">
                
                <!-- Posts Tab Header -->
                <button 
                    @click="activeTab = 'posts'"
                    :class="activeTab === 'posts' ? 'border-t-2 border-brand-primary text-brand-primary font-bold' : 'border-t-2 border-transparent text-slate-400 hover:text-slate-700'"
                    class="pt-4 px-2 text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all cursor-pointer"
                >
                    <i class="fa-solid fa-table-cells text-sm"></i> Kiriman
                </button>

                <!-- Collections Tab Header -->
                <button 
                    @click="activeTab = 'collections'"
                    :class="activeTab === 'collections' ? 'border-t-2 border-brand-primary text-brand-primary font-bold' : 'border-t-2 border-transparent text-slate-400 hover:text-slate-700'"
                    class="pt-4 px-2 text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all cursor-pointer"
                >
                    <i class="fa-solid fa-folder-open text-sm"></i> Koleksi
                </button>

                <!-- Likes Tab Header -->
                <button 
                    @click="activeTab = 'likes'"
                    :class="activeTab === 'likes' ? 'border-t-2 border-brand-primary text-brand-primary font-bold' : 'border-t-2 border-transparent text-slate-400 hover:text-slate-700'"
                    class="pt-4 px-2 text-xs font-bold uppercase tracking-wider flex items-center gap-2 transition-all cursor-pointer"
                >
                    <i class="fa-solid fa-heart text-sm"></i> Suka
                </button>

            </div>

            <!-- Tabs Content Panels -->
            <div>
                
                <!-- 1. Kiriman (Own Posts) Tab -->
                <div x-show="activeTab === 'posts'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    @if($posts->isEmpty())
                        <!-- Empty Posts State -->
                        <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-sm max-w-md mx-auto">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary mb-4">
                                <i class="fa-regular fa-image text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Belum Ada Kiriman</h3>
                            <p class="text-xs text-slate-500 max-w-xs mx-auto px-4 mb-5">Bagikan meme terlucu dan terpopuler buatan Anda sendiri sekarang!</p>
                            <a href="{{ route('posts.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-white bg-brand-accent hover:bg-brand-accent/90 font-bold text-xs shadow-sm transition-all">
                                <i class="fa-solid fa-circle-plus mr-1.5"></i> Unggah Meme Pertama
                            </a>
                        </div>
                    @else
                        <!-- Posts Pinterest Grid -->
                        <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 xl:columns-5 gap-4 space-y-4">
                            @foreach($posts as $post)
                                <div class="break-inside-avoid overflow-hidden rounded-2xl group relative mb-4 shadow-sm hover:shadow-lg transition-all duration-300">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="block relative overflow-hidden bg-slate-100">
                                        <img 
                                            src="{{ asset($post->image_path) }}" 
                                            alt="{{ $post->title }}"
                                            loading="lazy" 
                                            class="w-full h-auto object-cover group-hover:scale-[1.04] transition-transform duration-500"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                            <h4 class="font-bold text-white text-sm line-clamp-1 leading-snug">{{ $post->title }}</h4>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- 2. Koleksi (Collections) Tab -->
                <div x-show="activeTab === 'collections'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
                    @if($collections->isEmpty())
                        <!-- Empty Collections State -->
                        <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-sm max-w-md mx-auto">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary mb-4">
                                <i class="fa-solid fa-folder-open text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Belum Ada Koleksi</h3>
                            <p class="text-xs text-slate-500 max-w-xs mx-auto px-4 mb-5">Organisasikan meme terlucu dan visual estetik Anda ke dalam folder khusus.</p>
                            <a href="{{ route('collections.create') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-white bg-brand-accent hover:bg-brand-accent/90 font-bold text-xs shadow-sm transition-all">
                                <i class="fa-solid fa-folder-plus mr-1.5"></i> Buat Koleksi Pertama
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
                                                         <span class="text-white text-3xs font-bold uppercase tracking-wider">Koleksi Kosong</span>
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
                                         <h3 class="font-extrabold text-slate-900 text-base sm:text-lg hover:text-brand-accent transition-colors leading-snug">
                                             <a href="{{ route('collections.show', $collection->slug) }}">{{ $collection->name }}</a>
                                         </h3>
                                         <span class="text-xs sm:text-sm font-semibold text-slate-500 mt-1 block">{{ $collection->posts_count }} post</span>
                                     </div>
                                 </div>
                             @endforeach
                        </div>
                    @endif
                </div>

                <!-- 3. Suka (Liked Posts) Tab -->
                <div x-show="activeTab === 'likes'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" style="display: none;">
                    @if($likedPosts->isEmpty())
                        <!-- Empty Likes State -->
                        <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-sm max-w-md mx-auto">
                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary mb-4">
                                <i class="fa-regular fa-heart text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-1">Belum Ada Like</h3>
                            <p class="text-xs text-slate-500 max-w-xs mx-auto px-4">Kembali ke feed utama untuk menyukai meme yang Anda temukan!</p>
                            <a href="{{ route('feed') }}" class="inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-white bg-brand-primary hover:bg-brand-primary/95 font-bold text-xs shadow-sm mt-5 transition-all">
                                <i class="fa-solid fa-compass mr-1.5"></i> Eksplorasi Feed
                            </a>
                        </div>
                    @else
                        <!-- Liked Posts Pinterest Grid -->
                        <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 xl:columns-5 gap-4 space-y-4">
                            @foreach($likedPosts as $post)
                                <div class="break-inside-avoid overflow-hidden rounded-2xl group relative mb-4 shadow-sm hover:shadow-lg transition-all duration-300">
                                    <a href="{{ route('posts.show', $post->slug) }}" class="block relative overflow-hidden bg-slate-100">
                                        <img 
                                            src="{{ asset($post->image_path) }}" 
                                            alt="{{ $post->title }}"
                                            loading="lazy" 
                                            class="w-full h-auto object-cover group-hover:scale-[1.04] transition-transform duration-500"
                                        >
                                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                                            <h4 class="font-bold text-white text-sm line-clamp-1 leading-snug">{{ $post->title }}</h4>
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

<!-- Outside Logout Form to prevent nested forms -->
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
            confirmButtonColor: '#293681', // brand-primary
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-3xl',
                confirmButton: 'rounded-xl px-5 py-2.5 font-bold',
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
