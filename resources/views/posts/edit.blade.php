@extends('layouts.app')

@section('title', 'Edit Postingan - GudangMeme')

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
</style>

<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <!-- Background Accents with yellow palette -->
    <div class="absolute top-20 left-10 w-80 h-80 bg-glow-yellow-1 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-glow-yellow-2 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-3xl mx-auto z-10 relative animate-fade-in-up">
        
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('feed') }}" class="p-2 rounded-xl bg-white hover:bg-slate-50 border border-slate-200/60 shadow-sm text-slate-600 hover:text-[#e69b00] transition-all btn-glow-yellow">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-gradient-yellow tracking-tight">Edit Postingan</h1>
                <p class="text-slate-500 text-sm mt-0.5">Perbarui informasi, deskripsi, atau ganti gambar meme Anda.</p>
            </div>
        </div>

        <!-- Form Card with Glowing Border -->
        <div class="bg-white rounded-3xl glowing-border overflow-hidden p-8 sm:p-10">
            <form action="{{ route('posts.update', $post->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Title Input -->
                <div>
                    <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Judul Postingan</label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title', $post->title) }}" 
                        required 
                        placeholder="Contoh: Ketika database production terhapus..."
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm input-glow-yellow @error('title') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                    >
                    @error('title')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Description Textarea -->
                <div>
                    <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi (Opsional)</label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="3" 
                        placeholder="Tulis konteks atau cerita di balik meme ini..."
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm input-glow-yellow @error('description') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                    >{{ old('description', $post->description) }}</textarea>
                    @error('description')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Image Upload with Existing Image & Preview -->
                <div>
                    <span class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Ganti Gambar (Opsional)</span>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Current Image Display -->
                        <div class="border border-slate-200 rounded-3xl p-4 bg-gradient-to-b from-amber-50/30 to-white text-center flex flex-col items-center justify-center">
                            <span class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-2">Gambar Saat Ini</span>
                            <div class="w-full max-h-[160px] overflow-hidden rounded-xl">
                                <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-contain max-h-[160px]">
                            </div>
                        </div>

                        <!-- Dropzone for New Upload -->
                        <div id="dropzone" class="relative border-2 border-dashed border-slate-300 hover:border-[#e6b400] rounded-3xl p-4 text-center transition-all bg-slate-50/50 hover:bg-white flex flex-col items-center justify-center min-h-[180px] group @error('image') border-red-300 bg-red-50/10 @enderror">
                            <input 
                                type="file" 
                                id="image" 
                                name="image" 
                                accept="image/*" 
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                onchange="previewImageLocal(event)"
                            >
                            
                            <!-- Preview State -->
                            <div id="image-preview-container" class="hidden w-full max-h-[160px] overflow-hidden rounded-xl relative">
                                <img id="image-preview" src="#" alt="Preview" class="w-full h-full object-contain max-h-[160px]">
                                <button 
                                    type="button" 
                                    onclick="removeImageLocal(event)"
                                    class="absolute top-2 right-2 w-7 h-7 rounded-full bg-black/60 hover:bg-black text-white flex items-center justify-center transition-all z-20"
                                    title="Hapus Gambar"
                                >
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>

                            <!-- Upload Prompt State -->
                            <div id="upload-prompt" class="flex flex-col items-center justify-center">
                                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-[#e69b00]/20 to-[#e6b400]/20 text-[#e69b00] flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                                </div>
                                <p class="text-xs font-bold text-slate-700">Pilih gambar baru untuk mengganti</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">JPG, PNG, GIF, JPEG (Maks. 2MB)</p>
                            </div>
                        </div>
                    </div>
                    @error('image')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Select Collections (Many-to-Many) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-3">Simpan ke Koleksi Anda</label>
                    
                    @if($collections->isEmpty())
                        <div class="p-5 rounded-2xl bg-gradient-to-b from-amber-50/30 to-white border border-slate-200/60 text-center">
                            <p class="text-sm text-slate-500">Anda belum memiliki koleksi.</p>
                            <a href="{{ route('collections.create') }}" class="text-xs font-bold text-[#e69b00] hover:text-[#e6b400] transition-colors mt-1 inline-flex items-center gap-1">
                                Buat koleksi pertama Anda <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[160px] overflow-y-auto p-1 pr-2">
                            @foreach($collections as $collection)
                                <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200/80 hover:border-[#e6b400] bg-white cursor-pointer hover:shadow-sm transition-all select-none">
                                    <input 
                                        type="checkbox" 
                                        name="collection_ids[]" 
                                        value="{{ $collection->id }}"
                                        {{ in_array($collection->id, old('collection_ids', $postCollectionIds)) ? 'checked' : '' }}
                                        class="w-4.5 h-4.5 rounded border-slate-300 text-[#e6b400] focus:ring-[#e6b400]/20 cursor-pointer"
                                    >
                                    <div class="flex items-center gap-2">
                                        @if($collection->is_private)
                                            <i class="fa-solid fa-folder-shield text-amber-500"></i>
                                        @else
                                            <i class="fa-solid fa-folder-open text-[#e69b00]"></i>
                                        @endif
                                        <span class="text-xs font-bold text-slate-800 line-clamp-1">{{ $collection->name }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Submit Actions -->
                <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
                    <a 
                        href="{{ route('posts.show', $post->slug) }}" 
                        class="w-full sm:w-auto text-center px-6 py-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm transition-all btn-glow-yellow"
                    >
                        Batalkan
                    </a>
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto px-8 py-3 rounded-xl bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] text-white font-bold text-sm shadow-lg shadow-[#e69b00]/25 hover:shadow-[#e69b00]/40 transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer btn-glow-yellow"
                    >
                        Perbarui Postingan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    function previewImageLocal(event) {
        const input = event.target;
        const reader = new FileReader();
        
        reader.onload = function() {
            const dataURL = reader.result;
            const preview = document.getElementById('image-preview');
            const previewContainer = document.getElementById('image-preview-container');
            const uploadPrompt = document.getElementById('upload-prompt');

            preview.src = dataURL;
            previewContainer.classList.remove('hidden');
            uploadPrompt.classList.add('hidden');
        };

        if (input.files && input.files[0]) {
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removeImageLocal(event) {
        event.stopPropagation();
        event.preventDefault();
        
        const input = document.getElementById('image');
        const preview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('image-preview-container');
        const uploadPrompt = document.getElementById('upload-prompt');

        input.value = '';
        preview.src = '#';
        previewContainer.classList.add('hidden');
        uploadPrompt.classList.remove('hidden');
    }
</script>
@endpush
@endsection