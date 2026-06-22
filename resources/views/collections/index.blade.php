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
                    <div class="group bg-transparent flex flex-col justify-between overflow-hidden">
                        <!-- Collection Preview Grid (Pinterest aspect ratio & layout) -->
                        <a href="{{ route('collections.show', $collection->slug) }}" class="block w-full">
                            <div class="grid grid-cols-3 grid-rows-2 gap-[2px] aspect-[4/3] w-full rounded-3xl overflow-hidden bg-slate-100 border border-slate-200/60 shadow-sm hover:shadow-md transition-all duration-300">
                                @if($collection->posts->isEmpty())
                                    <div class="col-span-3 row-span-2 relative overflow-hidden bg-slate-100 flex items-center justify-center">
                                        <img src="https://images.unsplash.com/photo-1509281373149-e957c6296406?w=600&auto=format&fit=crop&q=80" alt="Koleksi Kosong" class="w-full h-full object-cover brightness-95">
                                        <div class="absolute inset-0 bg-slate-950/40 flex flex-col items-center justify-center p-4">
                                            <i class="fa-solid fa-folder-open text-white text-3xl mb-2"></i>
                                            <span class="text-white text-xs font-bold uppercase tracking-wider">Koleksi Kosong</span>
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

            <!-- Pagination -->
            <div class="mt-10">
                {{ $collections->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
