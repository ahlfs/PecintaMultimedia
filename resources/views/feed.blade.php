@extends('layouts.app')

@section('title', 'Eksplorasi - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] py-12 bg-slate-50 overflow-hidden">
    <!-- Background Accents -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-brand-accent/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-brand-primary/10 text-brand-primary shadow-md shadow-brand-primary/5 mb-4">
                <i class="fa-solid fa-compass text-2xl animate-spin-slow"></i>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-brand-primary tracking-tight leading-tight mb-2">
                Eksplorasi Feed GudangMeme
            </h1>
            <p class="text-sm sm:text-base text-slate-600 max-w-lg mx-auto">
                Temukan, simpan, dan bagikan meme terlucu dan terpopuler dari seluruh pengembang web!
            </p>
        </div>

        <!-- Livewire Component -->
        @livewire('home-feed')
    </div>
</div>
@endsection
