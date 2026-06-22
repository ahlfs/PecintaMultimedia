@extends('layouts.app')

@section('title', 'Eksplorasi - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] py-12 bg-slate-50 overflow-hidden">
    <!-- Background Accents -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-brand-accent/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10 animate-fade-in-up">


        <!-- Livewire Component -->
        @livewire('home-feed')
    </div>
</div>
@endsection
