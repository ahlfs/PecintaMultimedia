@extends('layouts.app')

@section('title', 'Koleksi Saya - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <!-- Background Accents -->
    <div class="absolute top-20 left-10 w-80 h-80 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-brand-accent/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto z-10 relative animate-fade-in-up">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-10 border-b border-slate-200/60 pb-6">
            <div>
                <h1 class="text-3xl font-extrabold text-brand-primary tracking-tight">Koleksi Saya</h1>
                <p class="text-slate-500 text-sm mt-1">Organisasikan meme terlucu dan gambar inspiratif ke dalam folder terpisah.</p>
            </div>
            <div>
                <a 
                    href="{{ route('collections.create') }}" 
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl text-white bg-brand-accent hover:bg-brand-accent/95 font-bold text-sm shadow-md shadow-brand-accent/15 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer"
                >
                    <i class="fa-solid fa-folder-plus mr-2"></i> Buat Koleksi Baru
                </a>
            </div>
        </div>

        @if($collections->isEmpty())
            <!-- Empty State Card -->
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-12 text-center max-w-xl mx-auto">
                <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-brand-primary/10 text-brand-primary shadow-xl shadow-brand-primary/5 mb-6">
                    <i class="fa-solid fa-folder-open text-3xl"></i>
                </div>
                <h3 class="text-xl font-bold text-brand-primary mb-2">Belum ada Koleksi</h3>
                <p class="text-slate-500 text-sm leading-relaxed mb-6">
                    Meme terlucu dan foto estetik milik Anda membutuhkan tempat penyimpanan khusus. Mulai dengan membuat koleksi pertama Anda sekarang!
                </p>
                <a 
                    href="{{ route('collections.create') }}" 
                    class="inline-flex items-center justify-center px-6 py-3 rounded-xl text-white bg-brand-primary hover:bg-brand-primary/95 font-bold text-sm shadow-md transition-all duration-300"
                >
                    Buat Koleksi Pertama
                </a>
            </div>
        @else
            <!-- Collections Card Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($collections as $collection)
                    <div class="group bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col justify-between overflow-hidden">
                        
                        <!-- Card Body -->
                        <div class="p-6 sm:p-8">
                            <div class="flex items-center justify-between gap-3 mb-4">
                                <!-- Folder icon and name -->
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-brand-primary/10 text-brand-primary flex items-center justify-center group-hover:bg-brand-primary group-hover:text-white transition-all duration-300">
                                        @if($collection->is_private)
                                            <i class="fa-solid fa-folder-shield text-lg"></i>
                                        @else
                                            <i class="fa-solid fa-folder-open text-lg"></i>
                                        @endif
                                    </div>
                                    <h3 class="font-extrabold text-lg text-slate-800 group-hover:text-brand-primary transition-colors leading-snug">
                                        <a href="{{ route('collections.show', $collection->id) }}">{{ $collection->name }}</a>
                                    </h3>
                                </div>
                                
                                <!-- Privacy Badge -->
                                <div>
                                    @if($collection->is_private)
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold text-amber-700 bg-amber-50 border border-amber-100" title="Rahasia (Hanya Anda)">
                                            <i class="fa-solid fa-lock text-[10px]"></i> Rahasia
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold text-emerald-700 bg-emerald-50 border border-emerald-100" title="Publik (Terbuka untuk Umum)">
                                            <i class="fa-solid fa-globe text-[10px]"></i> Publik
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Description -->
                            <p class="text-slate-500 text-sm leading-relaxed min-h-[40px] mb-4">
                                {{ Str::limit($collection->description ?? 'Tidak ada deskripsi tambahan.', 80) }}
                            </p>

                            <!-- Counter Badge -->
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-semibold text-slate-500 bg-slate-100 border border-slate-200/50">
                                <i class="fa-solid fa-images"></i>
                                <span>{{ $collection->posts_count }} post disimpan</span>
                            </div>
                        </div>

                        <!-- Card Footer actions -->
                        <div class="px-6 py-4 bg-slate-50/50 border-t border-slate-100/80 flex items-center justify-between gap-3">
                            <a 
                                href="{{ route('collections.show', $collection->id) }}" 
                                class="inline-flex items-center gap-1 text-xs font-bold text-brand-primary hover:text-brand-accent transition-colors"
                            >
                                <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Koleksi
                            </a>
                            
                            <div class="flex items-center gap-1">
                                <!-- Edit -->
                                <a 
                                    href="{{ route('collections.edit', $collection->id) }}" 
                                    class="p-2 rounded-lg text-slate-500 hover:text-brand-primary hover:bg-white border border-transparent hover:border-slate-200/60 transition-all"
                                    title="Edit Koleksi"
                                >
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                <!-- Delete (Form with custom interceptor class) -->
                                <form 
                                    action="{{ route('collections.destroy', $collection->id) }}" 
                                    method="POST" 
                                    class="inline form-delete-confirm"
                                    data-confirm-message="Koleksi '{{ $collection->name }}' beserta seluruh tautan meme di dalamnya akan dihapus permanen."
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button 
                                        type="submit" 
                                        class="p-2 rounded-lg text-red-500 hover:text-red-600 hover:bg-white border border-transparent hover:border-red-100 transition-all cursor-pointer"
                                        title="Hapus Koleksi"
                                    >
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-10">
                {{ $collections->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
