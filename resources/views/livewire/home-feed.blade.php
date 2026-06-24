<div class="max-w-[1600px] mx-auto px-3 sm:px-6 lg:px-8 py-6 sm:py-8">

    @if($posts->isEmpty())
        <!-- Empty State -->
        <div class="flex flex-col items-center justify-center py-16 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-gradient-to-br from-[#e69b00]/20 to-[#e6b400]/20 text-[#e69b00] mb-4">
                <i class="fa-regular fa-image text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Meme</h3>
            <p class="text-sm text-slate-500 max-w-xs mx-auto">
                Belum ada postingan yang tersedia saat ini. Kembali lagi nanti untuk melihat meme terbaru!
            </p>
        </div>
    @else
        <!-- Grid Layout - 2 kolom di HP, terus ke bawah -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 sm:gap-4">
            @foreach($posts as $post)
                <div class="relative group rounded-xl sm:rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-lg transition-all duration-300">
                    <a href="{{ route('posts.show', $post->slug) }}" class="block relative">
                        <!-- Foto dengan aspect ratio square agar rapi -->
                        <div class="aspect-square overflow-hidden bg-slate-100">
                            <img 
                                src="{{ asset($post->image_path) }}" 
                                alt="{{ $post->title }}" 
                                loading="lazy"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            >
                        </div>
                        
                        <!-- Like Button -->
                        <button 
                            class="absolute top-2 right-2 w-7 h-7 sm:w-8 sm:h-8 rounded-full bg-white/90 backdrop-blur-sm flex items-center justify-center shadow-md hover:bg-white hover:scale-110 transition-all z-10"
                            onclick="event.preventDefault(); event.stopPropagation();"
                            wire:click="toggleLike({{ $post->id }})"
                        >
                            <i class="fa-regular fa-heart text-[#e69b00] text-xs sm:text-sm"></i>
                        </button>

                        <!-- Overlay Judul SAJA (muncul saat hover) -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-2 sm:p-3">
                            <h4 class="font-bold text-white text-[11px] sm:text-sm line-clamp-2 leading-snug">
                                {{ $post->title }}
                            </h4>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <!-- Infinite Scroll Trigger -->
        @if($hasMore)
            <div 
                x-data="{
                    loading: false,
                    init() {
                        const observer = new IntersectionObserver((entries) => {
                            if (entries[0].isIntersecting && !this.loading) {
                                this.loading = true;
                                @this.call('loadMore').then(() => {
                                    this.loading = false;
                                });
                            }
                        }, {
                            rootMargin: '400px'
                        });
                        observer.observe(this.$refs.loadMoreTrigger);
                    }
                }"
                class="mt-8 sm:mt-12 py-6 flex justify-center items-center"
                wire:key="feed-trigger-{{ count($posts) }}"
            >
                <div x-ref="loadMoreTrigger" class="flex flex-col items-center gap-2">
                    <i class="fa-solid fa-circle-notch animate-spin text-2xl text-[#e69b00]"></i>
                    <span class="text-xs text-slate-500 font-bold tracking-wide">Memuat lebih banyak meme...</span>
                </div>
            </div>
        @else
            <!-- End of Feed Message -->
            <div class="mt-10 sm:mt-16 text-center text-slate-400 py-6 sm:py-8 border-t border-slate-100 max-w-sm mx-auto">
                <i class="fa-solid fa-face-smile text-xl mb-2 text-[#e6b400]"></i>
                <p class="text-xs font-semibold">Anda telah menjelajahi semua meme untuk saat ini!</p>
            </div>
        @endif
    @endif
</div>