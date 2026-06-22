@extends('layouts.app')

@section('title', 'Edit Postingan - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <!-- Background Accents -->
    <div class="absolute top-20 left-10 w-80 h-80 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-brand-accent/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-3xl mx-auto z-10 relative animate-fade-in-up">
        
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('feed') }}" class="p-2 rounded-xl bg-white hover:bg-slate-100 border border-slate-200/60 shadow-sm text-slate-600 hover:text-brand-primary transition-all">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-brand-primary tracking-tight">Edit Postingan</h1>
                <p class="text-slate-500 text-sm mt-0.5">Perbarui informasi, deskripsi, atau ganti gambar meme Anda.</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden p-8 sm:p-10">
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
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('title') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
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
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('description') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
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
                        <div class="border border-slate-200 rounded-3xl p-4 bg-slate-50 text-center flex flex-col items-center justify-center">
                            <span class="text-xs text-slate-400 font-bold uppercase tracking-wider mb-2">Gambar Saat Ini</span>
                            <div class="w-full max-h-[160px] overflow-hidden rounded-xl">
                                <img src="{{ asset($post->image_path) }}" alt="{{ $post->title }}" class="w-full h-full object-contain max-h-[160px]">
                            </div>
                        </div>

                        <!-- Dropzone for New Upload -->
                        <div id="dropzone" class="relative border-2 border-dashed border-slate-300 hover:border-brand-accent rounded-3xl p-4 text-center transition-all bg-slate-50/50 hover:bg-white flex flex-col items-center justify-center min-h-[180px] group @error('image') border-red-300 bg-red-50/10 @enderror">
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
                                <div class="w-12 h-12 rounded-xl bg-brand-primary/10 text-brand-primary flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
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
                        <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/60 text-center">
                            <p class="text-sm text-slate-500">Anda belum memiliki koleksi.</p>
                            <a href="{{ route('collections.create') }}" class="text-xs font-bold text-brand-accent hover:text-brand-primary transition-colors mt-1 inline-flex items-center gap-1">
                                Buat koleksi pertama Anda <i class="fa-solid fa-angle-right"></i>
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 max-h-[160px] overflow-y-auto p-1 pr-2">
                            @foreach($collections as $collection)
                                <label class="flex items-center gap-3 p-3 rounded-xl border border-slate-200/80 hover:border-brand-accent bg-white cursor-pointer hover:shadow-sm transition-all select-none">
                                    <input 
                                        type="checkbox" 
                                        name="collection_ids[]" 
                                        value="{{ $collection->id }}"
                                        {{ in_array($collection->id, old('collection_ids', $postCollectionIds)) ? 'checked' : '' }}
                                        class="w-4.5 h-4.5 rounded border-slate-300 text-brand-accent focus:ring-brand-accent/20 cursor-pointer"
                                    >
                                    <div class="flex items-center gap-2">
                                        @if($collection->is_private)
                                            <i class="fa-solid fa-folder-shield text-amber-500"></i>
                                        @else
                                            <i class="fa-solid fa-folder-open text-brand-primary"></i>
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
                        class="w-full sm:w-auto text-center px-6 py-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-bold text-sm transition-all"
                    >
                        Batalkan
                    </a>
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto px-8 py-3 rounded-xl bg-brand-primary hover:bg-brand-primary/95 text-white font-bold text-sm shadow-md shadow-brand-primary/10 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer"
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
