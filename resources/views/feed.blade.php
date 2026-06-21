@extends('layouts.app')

@section('title', 'Eksplorasi - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] flex flex-col items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden bg-slate-50">
    <!-- Background Accents -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-brand-accent/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-2xl w-full text-center z-10 animate-fade-in-up">
        <!-- Icon Banner -->
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-3xl bg-brand-primary/10 text-brand-primary shadow-xl shadow-brand-primary/5 mb-8">
            <i class="fa-solid fa-compass text-3xl animate-spin-slow"></i>
        </div>

        <h1 class="text-4xl font-extrabold text-brand-primary tracking-tight leading-tight mb-4">
            Eksplorasi Feed GudangMeme
        </h1>
        
        <p class="text-lg text-slate-600 mb-8 max-w-lg mx-auto">
            Halaman Eksplorasi Feed sedang dalam tahap pengembangan oleh pengembang modul Livewire Feed (Afriza).
        </p>

        <!-- Profile Card Mockup to verify user is logged in -->
        @if(isset($authUser))
            <div class="bg-white rounded-3xl border border-slate-100 shadow-xl p-6 mb-8 max-w-sm mx-auto flex items-center gap-4 text-left hover:scale-[1.02] transition-all">
                <img 
                    src="{{ $authUser->profile_photo ? asset($authUser->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($authUser->name).'&background=293681&color=fff&bold=true&size=100' }}" 
                    alt="Foto Profil" 
                    class="w-16 h-16 rounded-2xl object-cover border border-slate-100"
                >
                <div>
                    <h3 class="font-bold text-slate-800 leading-none mb-1">{{ $authUser->name }}</h3>
                    <p class="text-xs text-slate-500 font-medium mb-2">@ {{ $authUser->username }}</p>
                    <a href="{{ route('profile.edit') }}" class="inline-flex items-center text-xs font-bold text-brand-accent hover:text-brand-primary transition-colors gap-1">
                        Edit Profil Anda <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('profile.edit') }}" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 rounded-xl text-white bg-brand-primary hover:bg-brand-primary/95 font-semibold text-sm transition-all duration-300 shadow-md">
                <i class="fa-solid fa-user-pen mr-2"></i> Edit Profil
            </a>
            <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-6 py-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-semibold text-sm transition-all duration-300">
                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Keluar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
