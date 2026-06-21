<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Search Bar -->
    <div class="mb-8 max-w-xl mx-auto relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <i class="fa-solid fa-magnifying-glass text-slate-400"></i>
        </div>
        <input 
            type="text" 
            wire:model.live.debounce.300ms="search" 
            placeholder="Cari meme berdasarkan judul, deskripsi, atau pembuat..."
            class="block w-full pl-11 pr-12 py-3.5 rounded-2xl border border-slate-200 bg-white placeholder-slate-400 text-slate-800 focus:outline-none focus:border-brand-accent focus:ring-4 focus:ring-brand-accent/15 transition-all text-sm shadow-sm"
        >
        <!-- Spinner for Loading -->
        <div wire:loading wire:target="search" class="absolute inset-y-0 right-0 pr-4 flex items-center">
            <i class="fa-solid fa-spinner animate-spin text-brand-accent"></i>
        </div>
    </div>

    <!-- Masonry Grid -->
    @if($posts->isEmpty())
        <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-xl max-w-md mx-auto z-10 animate-fade-in-up">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary mb-4 shadow-sm shadow-brand-primary/5">
                <i class="fa-regular fa-image text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-1">Meme Tidak Ditemukan</h3>
            <p class="text-xs text-slate-500 max-w-xs mx-auto px-4">Coba cari dengan kata kunci lain atau unggah meme baru Anda sendiri.</p>
        </div>
    @else
        <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 space-y-4">
            @foreach($posts as $post)
                <div class="break-inside-avoid bg-white rounded-2xl border border-slate-100 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden group flex flex-col relative mb-4">
                    <!-- Post Image & Overlay -->
                    <a href="{{ route('posts.show', $post->id) }}" class="block relative overflow-hidden bg-slate-100">
                        <img 
                            src="{{ asset($post->image_path) }}" 
                            alt="{{ $post->title }}"
                            loading="lazy" 
                            class="w-full h-auto object-cover group-hover:scale-[1.03] transition-transform duration-500"
                        >
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/75 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4">
                            <h4 class="font-bold text-white text-sm line-clamp-1 leading-snug">{{ $post->title }}</h4>
                            <p class="text-xs text-white/80 line-clamp-1 mt-0.5">{{ $post->description ?? 'Lihat detail...' }}</p>
                        </div>
                    </a>

                    <!-- Post Info Footer -->
                    <div class="p-3.5 flex items-center justify-between gap-2 border-t border-slate-50 bg-white">
                        <div class="flex items-center gap-2">
                            <img 
                                src="{{ $post->user->profile_photo ? asset($post->user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($post->user->name).'&background=293681&color=fff&bold=true' }}" 
                                alt="{{ $post->user->name }}" 
                                class="w-8 h-8 rounded-lg object-cover border border-slate-200"
                            >
                            <div class="text-left">
                                <p class="text-xs font-bold text-slate-800 line-clamp-1 leading-none mb-0.5">{{ $post->user->name }}</p>
                                <p class="text-3xs text-slate-500 font-medium">@ {{ $post->user->username }}</p>
                            </div>
                        </div>
                        
                        <!-- Interactions (Likes & Comments Count) -->
                        <div class="flex items-center gap-2.5 text-slate-500">
                            <span class="inline-flex items-center text-3xs font-bold gap-0.5" title="Suka">
                                <i class="fa-regular fa-heart text-red-500 text-2xs"></i>
                                <span>{{ $post->likes_count }}</span>
                            </span>
                            <span class="inline-flex items-center text-3xs font-bold gap-0.5" title="Komentar">
                                <i class="fa-regular fa-comment text-slate-400 text-2xs"></i>
                                <span>{{ $post->comments_count }}</span>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>
    @endif
</div>
