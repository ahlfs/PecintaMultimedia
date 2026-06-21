<div>
    <button 
        wire:click="toggleLike"
        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border transition-all duration-300 shadow-sm cursor-pointer {{ $isLiked ? 'border-red-100 bg-red-50/50 text-red-500' : 'border-slate-200 bg-white hover:bg-red-50 hover:text-red-500 text-slate-600' }}"
    >
        @if($isLiked)
            <i class="fa-solid fa-heart text-base text-red-500 scale-110 transition-transform duration-300"></i>
        @else
            <i class="fa-regular fa-heart text-base text-slate-400 group-hover:text-red-500 transition-colors duration-300"></i>
        @endif
        <span class="text-sm font-bold">{{ $likesCount }} Suka</span>
    </button>
</div>
