<div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 py-8">

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
                class="mt-12 py-6 flex justify-center items-center"
                wire:key="feed-trigger-{{ count($posts) }}"
            >
                <div x-ref="loadMoreTrigger" class="flex flex-col items-center gap-2">
                    <i class="fa-solid fa-circle-notch animate-spin text-2xl text-brand-accent"></i>
                    <span class="text-xs text-slate-500 font-bold tracking-wide">Memuat lebih banyak meme...</span>
                </div>
            </div>
        @else
            <!-- End of Feed Message -->
            <div class="mt-16 text-center text-slate-400 py-8 border-t border-slate-100 max-w-sm mx-auto">
                <i class="fa-solid fa-face-smile text-xl mb-2"></i>
                <p class="text-xs font-semibold">Anda telah menjelajahi semua meme untuk saat ini!</p>
            </div>
        @endif
    @endif
</div>
