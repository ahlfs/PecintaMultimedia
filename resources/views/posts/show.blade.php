@extends('layouts.app')

@section('title', $post->title . ' - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <!-- Background Accents -->
    <div class="absolute top-20 left-10 w-80 h-80 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-brand-accent/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto z-10 relative animate-fade-in-up">
        <!-- Back Navigation & Meta Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('feed') }}" class="p-2 rounded-xl bg-white hover:bg-slate-100 border border-slate-200/60 shadow-sm text-slate-600 hover:text-brand-primary transition-all">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <span class="text-sm font-bold text-slate-500">Kembali ke Eksplorasi</span>
        </div>

        <!-- Post Detail Layout (Split Grid) -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden grid grid-cols-1 lg:grid-cols-12 min-h-[500px]">
            
            <!-- Left Side: Image Container (lg:col-span-7) -->
            <div class="lg:col-span-7 bg-slate-900 flex items-center justify-center p-4 sm:p-6 relative group min-h-[350px]">
                <img 
                    src="{{ asset($post->image_path) }}" 
                    alt="{{ $post->title }}" 
                    class="w-full max-h-[600px] object-contain rounded-2xl shadow-2xl transition-transform duration-500"
                >
            </div>

            <!-- Right Side: Details & Actions (lg:col-span-5) -->
            <div class="lg:col-span-5 p-6 sm:p-8 flex flex-col justify-between border-t lg:border-t-0 lg:border-l border-slate-100 bg-white">
                
                <!-- Top Section: Title & Description -->
                <div>
                    <!-- Category / Post date & Owner Operations -->
                    <div class="flex items-center justify-between gap-3 mb-6">
                        <span class="text-2xs font-extrabold uppercase tracking-wider text-brand-accent bg-brand-accent/10 px-3 py-1.5 rounded-lg">
                            <i class="fa-solid fa-clock mr-1"></i> {{ $post->created_at->diffForHumans() }}
                        </span>

                        @if($post->user_id == session('user_id'))
                            <div class="flex items-center gap-2">
                                <a 
                                    href="{{ route('posts.edit', $post->slug) }}" 
                                    class="p-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-500 hover:text-brand-primary hover:border-slate-300 transition-all text-xs font-bold"
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
                                        class="p-2.5 rounded-xl text-red-500 hover:text-red-600 hover:bg-red-50 border border-transparent hover:border-red-100 transition-all cursor-pointer"
                                        title="Hapus Postingan"
                                    >
                                        <i class="fa-solid fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="text-2xl sm:text-3xl font-extrabold text-brand-primary tracking-tight leading-tight mb-4">
                        {{ $post->title }}
                    </h1>

                    <!-- Description -->
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        {{ $post->description ?? 'Tidak ada deskripsi tambahan untuk postingan ini.' }}
                    </p>

                    <!-- Author Details -->
                    <a href="{{ route('profile.show', $post->user->username) }}" class="flex items-center gap-3 mb-6 group inline-flex">
                        <img 
                            src="{{ $post->user->profile_photo ? asset($post->user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($post->user->name).'&background=293681&color=fff&bold=true' }}" 
                            alt="{{ $post->user->name }}" 
                            class="w-10 h-10 rounded-full object-cover border border-slate-200 group-hover:scale-105 transition-transform duration-300"
                        >
                        <div>
                            <span class="text-base font-extrabold text-slate-800 group-hover:text-brand-accent transition-colors duration-300">@ {{ $post->user->username }}</span>
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

                        <!-- Action Buttons Row -->
                        <div class="flex items-center gap-2">

                            <!-- Download Button -->
                            <button
                                id="btn-download"
                                onclick="downloadImage('{{ asset($post->image_path) }}', '{{ Str::slug($post->title) }}')"
                                class="group relative inline-flex items-center justify-center px-4 py-2.5 rounded-xl text-slate-600 bg-white hover:bg-slate-50 border border-slate-200 hover:border-slate-300 font-bold text-sm shadow-sm hover:shadow-md transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer overflow-hidden"
                                title="Unduh Gambar"
                            >
                                <!-- Shine effect -->
                                <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full bg-gradient-to-r from-transparent via-white/50 to-transparent transition-transform duration-500 pointer-events-none"></div>
                                <i id="download-icon" class="fa-solid fa-download text-sm mr-1.5 group-hover:text-brand-primary transition-colors duration-300"></i>
                                <span class="relative">Unduh</span>
                            </button>

                            <!-- Save to Collection Button -->
                            @if(session()->has('user_id'))
                                <button 
                                    onclick="openSaveModal()"
                                    class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-white bg-brand-accent hover:bg-brand-accent/95 font-bold text-sm shadow-md shadow-brand-accent/15 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer"
                                >
                                    <i class="fa-solid fa-folder-plus mr-2"></i> Simpan ke Koleksi
                                </button>
                            @endif

                        </div>
                    </div>

                    <!-- Comments Section (Livewire - Afriza's Task) -->
                    <div class="rounded-2xl border border-slate-200/60 p-4 bg-slate-50/50">
                        <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-4 flex items-center gap-2">
                            <i class="fa-regular fa-comments text-brand-accent"></i> Komentar
                        </h4>
                        @livewire('comments-section', ['post' => $post])
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
            <div class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg animate-fade-in-up">
                
                <!-- Modal Header -->
                <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
                    <h3 class="text-lg font-extrabold text-brand-primary flex items-center gap-2">
                        <i class="fa-solid fa-folder-open text-brand-accent"></i> Simpan Meme ke Koleksi
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
                            <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/60 text-center">
                                <p class="text-sm text-slate-500 mb-3">Anda belum memiliki koleksi apapun.</p>
                                <a href="{{ route('collections.create') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-xl text-white bg-brand-primary hover:bg-brand-primary/95 font-bold text-xs shadow-sm transition-all">
                                    Buat Koleksi Pertama
                                </a>
                            </div>
                        @else
                            <div class="space-y-2.5 max-h-[220px] overflow-y-auto pr-1">
                                @foreach($collections as $collection)
                                    <label class="flex items-center gap-3 p-3.5 rounded-2xl border border-slate-200/80 hover:border-brand-accent hover:bg-slate-50/50 transition-all cursor-pointer select-none">
                                        <input 
                                            type="checkbox" 
                                            name="collection_ids[]" 
                                            value="{{ $collection->id }}"
                                            {{ $collection->posts->contains($post->id) ? 'checked' : '' }}
                                            class="w-5 h-5 rounded border-slate-300 text-brand-accent focus:ring-brand-accent/20 cursor-pointer"
                                        >
                                        <div class="flex items-center gap-2">
                                            @if($collection->is_private)
                                                <i class="fa-solid fa-folder-shield text-amber-500"></i>
                                            @else
                                                <i class="fa-solid fa-folder-open text-brand-primary"></i>
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
                    <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100 flex items-center justify-end gap-3 rounded-b-3xl">
                        <button type="button" class="px-5 py-2.5 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-bold text-xs transition-all cursor-pointer" onclick="closeSaveModal()">
                            Batal
                        </button>
                        @if(!$collections->isEmpty())
                            <button type="submit" class="px-6 py-2.5 rounded-xl text-white bg-brand-primary hover:bg-brand-primary/95 font-bold text-xs shadow-md transition-all duration-300 cursor-pointer">
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
<script src="{{ asset('assets/js/post-show.js') }}"></script>
<script>
    /**
     * Download post image as a file using fetch + Blob trick.
     * This avoids opening the image in a new browser tab.
     */
    async function downloadImage(imageUrl, filename) {
        const btn = document.getElementById('btn-download');
        const icon = document.getElementById('download-icon');

        // Show loading state
        btn.disabled = true;
        icon.className = 'fa-solid fa-spinner fa-spin text-sm mr-1.5 text-brand-primary';

        try {
            const response = await fetch(imageUrl);
            if (!response.ok) throw new Error('Network response was not ok');

            const blob = await response.blob();
            const extension = blob.type.split('/')[1] || 'jpg';
            const url = window.URL.createObjectURL(blob);

            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            a.download = filename + '.' + extension;
            document.body.appendChild(a);
            a.click();

            window.URL.revokeObjectURL(url);
            document.body.removeChild(a);

            // Show success state briefly
            icon.className = 'fa-solid fa-circle-check text-sm mr-1.5 text-green-500';
            setTimeout(() => {
                icon.className = 'fa-solid fa-download text-sm mr-1.5 group-hover:text-brand-primary transition-colors duration-300';
                btn.disabled = false;
            }, 2000);
        } catch (error) {
            console.error('Download failed:', error);
            icon.className = 'fa-solid fa-circle-xmark text-sm mr-1.5 text-red-500';
            setTimeout(() => {
                icon.className = 'fa-solid fa-download text-sm mr-1.5 group-hover:text-brand-primary transition-colors duration-300';
                btn.disabled = false;
            }, 2000);
        }
    }
</script>
<script>
    // Livewire event listeners for SweetAlert notifications
    document.addEventListener('livewire:init', function () {
        Livewire.on('notify-success', (data) => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.message,
                timer: 2500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
                background: '#fff',
                iconColor: '#4274D9',
                customClass: {
                    popup: 'rounded-xl shadow-lg border border-slate-100 font-sans'
                }
            });
        });

        Livewire.on('notify-error', (data) => {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: data.message,
                confirmButtonColor: '#293681',
                customClass: {
                    popup: 'rounded-2xl shadow-xl font-sans',
                    confirmButton: 'px-6 py-2.5 rounded-xl text-sm font-bold'
                }
            });
        });
    });
</script>
@endpush
@endsection
