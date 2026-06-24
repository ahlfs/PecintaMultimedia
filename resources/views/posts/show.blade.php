@extends('layouts.app')

@section('title', $post->title . ' - GudangMeme')

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
    
    /* Modal glow */
    .modal-glow {
        box-shadow: 0 0 60px rgba(230, 155, 0, 0.2),
                    0 0 100px rgba(230, 180, 0, 0.1);
    }
</style>

<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <!-- Background Accents with yellow palette -->
    <div class="absolute top-20 left-10 w-80 h-80 bg-glow-yellow-1 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-glow-yellow-2 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto z-10 relative animate-fade-in-up">
        <!-- Back Navigation & Meta Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('feed') }}" class="p-2 rounded-xl bg-white hover:bg-slate-50 border border-slate-200/60 shadow-sm text-slate-600 hover:text-[#e69b00] transition-all btn-glow-yellow">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <span class="text-sm font-bold text-slate-500">Kembali ke Eksplorasi</span>
        </div>

        <!-- Post Detail Layout (Split Grid) with Glowing Border -->
        <div class="bg-white rounded-3xl glowing-border overflow-hidden grid grid-cols-1 lg:grid-cols-12 min-h-[500px]">
            
            <!-- Left Side: Image Container (lg:col-span-7) -->
            <div class="lg:col-span-7 bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 flex items-center justify-center p-4 sm:p-6 relative group min-h-[350px]">
                <!-- Subtle yellow glow on image container -->
                <div class="absolute inset-0 bg-gradient-to-br from-[#e69b00]/5 to-transparent pointer-events-none"></div>
                <img 
                    src="{{ asset($post->image_path) }}" 
                    alt="{{ $post->title }}" 
                    class="max-w-full max-h-[600px] object-contain rounded-2xl shadow-2xl transition-transform duration-500 relative z-10"
                >
            </div>

            <!-- Right Side: Details & Actions (lg:col-span-5) -->
            <div class="lg:col-span-5 p-6 sm:p-8 flex flex-col justify-between border-t lg:border-t-0 lg:border-l border-slate-100 bg-white">
                
                <!-- Top Section: Title & Description -->
                <div>
                    <!-- Category / Post date & Owner Operations -->
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <span class="text-2xs font-extrabold uppercase tracking-wider text-[#e69b00] bg-[#e6b400]/10 px-3 py-1.5 rounded-lg">
                            <i class="fa-solid fa-clock mr-1"></i> {{ $post->created_at->diffForHumans() }}
                        </span>

                        @if($post->user_id === session('user_id'))
                            <div class="flex items-center gap-2">
                                <a 
                                    href="{{ route('posts.edit', $post->slug) }}" 
                                    class="p-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-500 hover:text-[#e69b00] hover:border-[#e6b400]/40 transition-all text-xs font-bold btn-glow-yellow"
                                    title="Edit Postingan"
                                >
                                    <i class="fa-solid fa-pen-to-square text-sm"></i>
                                </a>
                                
                                <form 
                                    action="{{ route('posts.destroy', $post->slug) }}" 
                                    method="POST" 
                                    class="form-delete-confirm inline"
                                    data-confirm-message="Meme '{{ $post->title }}' akan dihapus permanen beserta semua datanya."
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="p-2.5 rounded-xl text-red-500 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-100 transition-all cursor-pointer btn-glow-yellow"
                                        title="Hapus Postingan"
                                    >
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-gradient-yellow tracking-tight leading-tight mb-4">
                        {{ $post->title }}
                    </h1>

                    <!-- Description -->
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        {{ $post->description ?? 'Tidak ada deskripsi tambahan untuk postingan ini.' }}
                    </p>

                    <!-- Author Details -->
                    <a href="{{ route('profile.show', $post->user->id) }}" class="flex items-center gap-3 mb-6 group inline-flex">
                        <img 
                            src="{{ $post->user->profile_photo ? asset($post->user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($post->user->name).'&background=e69b00&color=fff&bold=true' }}" 
                            alt="{{ $post->user->name }}" 
                            class="w-10 h-10 rounded-full object-cover border-2 border-[#e6b400]/30 group-hover:border-[#e6b400] group-hover:scale-105 transition-all duration-300"
                        >
                        <div>
                            <span class="text-base font-extrabold text-slate-800 group-hover:text-[#e69b00] transition-colors duration-300">@ {{ $post->user->username }}</span>
                        </div>
                    </a>
                </div>

                <!-- Bottom Section: Interactivity & Collections -->
                <div class="space-y-6 pt-6 border-t border-slate-100">
                    
                    <!-- Likes & Save to Collection Row -->
                    <div class="flex items-center justify-between gap-4">
                        
                        <!-- Interactive Button (Likes) -->
                        <div class="flex items-center gap-2">
                            @livewire('like-button', ['post' => $post])
                        </div>

                        <!-- Save to Collection Button -->
                        @if(session()->has('user_id'))
                            <button 
                                onclick="openSaveModal()"
                                class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-sm shadow-lg shadow-[#e69b00]/25 hover:shadow-[#e69b00]/40 transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer btn-glow-yellow"
                            >
                                <i class="fa-solid fa-folder-plus mr-2"></i> Simpan ke Koleksi
                            </button>
                        @endif
                    </div>

                    <!-- Comments Section Placeholder (Afriza's Task area) -->
                    <div class="rounded-2xl border border-slate-200/60 p-4 bg-gradient-to-b from-amber-50/30 to-white">
                        <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-3">Komentar</h4>
                        
                        <!-- Comments section will be mounted here dynamically via Livewire -->
                        <div class="text-center py-6 text-slate-400">
                            <i class="fa-regular fa-comments text-2xl mb-2 block"></i>
                            <p class="text-xs">Fitur komentar real-time sedang dipersiapkan.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

<!-- Modal Simpan ke Koleksi -->
@if(session()->has('user_id'))
    <div id="save-modal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeSaveModal()"></div>

        <!-- Modal Wrapper -->
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl modal-glow transition-all sm:my-8 sm:w-full sm:max-w-lg animate-fade-in-up">
                
                <!-- Modal Header -->
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-extrabold text-gradient-yellow flex items-center gap-2">
                        <i class="fa-solid fa-folder-open text-[#e69b00]"></i> Simpan Meme ke Koleksi
                    </h3>
                    <button type="button" class="text-slate-400 hover:text-slate-600 transition-colors" onclick="closeSaveModal()">
                        <i class="fa-solid fa-xmark text-lg"></i>
                    </button>
                </div>

                <!-- Modal Body -->
                <form action="{{ route('posts.save-to-collection', $post->slug) }}" method="POST">
                    @csrf
                    <div class="p-6">
                        <p class="text-xs text-slate-500 mb-4 leading-relaxed">
                            Pilih satu atau beberapa folder koleksi Anda tempat Anda ingin menyimpan meme ini. Kosongkan pilihan jika ingin menghapus meme ini dari semua folder koleksi Anda.
                        </p>

                        @if($collections->isEmpty())
                            <div class="p-6 rounded-2xl bg-gradient-to-b from-amber-50/30 to-white border border-slate-200/60 text-center">
                                <p class="text-sm text-slate-500 mb-3">Anda belum memiliki koleksi apapun.</p>
                                <a href="{{ route('collections.create') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-xs shadow-lg shadow-[#e69b00]/25 transition-all btn-glow-yellow">
                                    Buat Koleksi Pertama
                                </a>
                            </div>
                        @else
                            <div class="space-y-2.5 max-h-[220px] overflow-y-auto pr-1">
                                @foreach($collections as $collection)
                                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200/80 hover:border-[#e6b400] hover:bg-slate-50/50 transition-all cursor-pointer select-none">
                                        <input 
                                            type="checkbox" 
                                            name="collection_ids[]" 
                                            value="{{ $collection->id }}"
                                            {{ $collection->posts->contains($post->id) ? 'checked' : '' }}
                                            class="w-5 h-5 rounded border-slate-300 text-[#e6b400] focus:ring-[#e6b400]/20 cursor-pointer"
                                        >
                                        <div class="flex items-center gap-2">
                                            @if($collection->is_private)
                                                <i class="fa-solid fa-folder-shield text-amber-500"></i>
                                            @else
                                                <i class="fa-solid fa-folder-open text-[#e69b00]"></i>
                                            @endif
                                            <div>
                                                <span class="text-sm font-bold text-slate-800 line-clamp-1 leading-snug">{{ $collection->name }}</span>
                                                <span class="text-3xs text-slate-400 uppercase tracking-wider block mt-0.5">{{ $collection->is_private ? 'Rahasia' : 'Publik' }}</span>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Modal Footer -->
                    <div class="px-6 py-4 bg-gradient-to-r from-amber-50/50 to-white border-t border-slate-100 flex items-center justify-end gap-3 rounded-b-3xl">
                        <button type="button" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-xs transition-all cursor-pointer btn-glow-yellow" onclick="closeSaveModal()">
                            Batal
                        </button>
                        @if(!$collections->isEmpty())
                            <button type="submit" class="px-6 py-2.5 rounded-xl text-white bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] font-bold text-xs shadow-lg shadow-[#e69b00]/25 hover:shadow-[#e69b00]/40 transition-all duration-300 cursor-pointer btn-glow-yellow">
                                Perbarui Penyimpanan
                            </button>
                        @endif
                    </div>
                </form>

            </div>
        </div>
    </div>
@endif

@push('scripts')
<script>
    function openSaveModal() {
        const modal = document.getElementById('save-modal');
        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    }

    function closeSaveModal() {
        const modal = document.getElementById('save-modal');
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    }
</script>
@endpush
@endsection