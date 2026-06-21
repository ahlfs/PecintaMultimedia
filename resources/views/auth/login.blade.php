@extends('layouts.app')

@section('title', 'Masuk - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden bg-slate-50">
    <!-- Background Accents -->
    <div class="absolute top-10 left-10 w-72 h-72 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-96 h-96 bg-brand-accent/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-slate-100 flex flex-col md:flex-row z-10 animate-fade-in-up">
        
        <!-- Left Side: Aesthetic Showcase -->
        <div class="w-full md:w-1/2 bg-gradient-to-tr from-brand-primary via-brand-primary to-slate-900 text-white p-12 flex flex-col justify-between relative overflow-hidden">
            <!-- Background floating glow -->
            <div class="absolute -right-20 -top-20 w-60 h-60 bg-brand-accent/25 rounded-full blur-2xl"></div>
            
            <div class="relative z-10">
                <!-- Logo -->
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center">
                        <i class="fa-solid fa-images text-brand-primary text-sm"></i>
                    </div>
                    <span class="font-chewy text-2xl tracking-wide">Gudang<span class="text-brand-accent-light">Meme</span></span>
                </div>
                
                <h2 class="text-3xl font-extrabold tracking-tight mb-4 leading-tight">
                    Temukan Ide Visual & Simpan Meme Favoritmu.
                </h2>
                <p class="text-slate-200 text-sm leading-relaxed max-w-sm">
                    Kembali masuk untuk mengorganisasikan koleksi meme terlucu, foto estetik, dan referensi desain andalanmu.
                </p>
            </div>

            <!-- Illustration / Staggered items visual mockup -->
            <div class="hidden md:flex flex-col gap-4 mt-8 relative z-10">
                <div class="bg-white/10 backdrop-blur-md border border-white/15 p-4 rounded-2xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-brand-accent/20 flex items-center justify-center text-brand-accent-light">
                        <i class="fa-solid fa-thumbtack text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold">Organisasikan Koleksi</p>
                        <p class="text-[10px] text-slate-300">Masukkan postingan ke folder khusus.</p>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-md border border-white/15 p-4 rounded-2xl flex items-center gap-3 ml-6">
                    <div class="w-10 h-10 rounded-xl bg-brand-accent-light/20 flex items-center justify-center text-brand-accent-light">
                        <i class="fa-solid fa-heart text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold">Interaksi Real-Time</p>
                        <p class="text-[10px] text-slate-300">Sukai dan beri komentar instan.</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-xs text-slate-400 relative z-10">
                Tugas Akhir Kelompok 1 - Pemrograman Web
            </div>
        </div>

        <!-- Right Side: Login Form -->
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center bg-white">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-brand-primary">Selamat Datang Kembali!</h3>
                <p class="text-slate-500 text-sm mt-1">Masukkan akun Anda untuk melanjutkan penjelajahan.</p>
            </div>

            <form action="{{ url('/login') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email or Username input -->
                <div>
                    <label for="login" class="block text-sm font-semibold text-slate-700 mb-2">Username atau Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                        </div>
                        <input 
                            type="text" 
                            id="login" 
                            name="login" 
                            value="{{ old('login') }}" 
                            required 
                            placeholder="username atau email@domain.com"
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('login') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                    </div>
                    @error('login')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password input -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-semibold text-slate-700">Kata Sandi</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            placeholder="••••••••"
                            class="w-full pl-11 pr-12 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('password') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                        <!-- Show/Hide password toggle script option -->
                        <button type="button" onclick="togglePasswordVisibility()" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 transition-colors">
                            <i id="password-toggle-icon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me (Mocked checkbox, standard styled) -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4.5 h-4.5 rounded border-slate-300 text-brand-accent focus:ring-brand-accent/20 cursor-pointer">
                        <span>Ingat Saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-3.5 px-6 rounded-xl bg-brand-primary hover:bg-brand-primary/95 text-white font-bold text-sm tracking-wide shadow-md shadow-brand-primary/10 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer"
                >
                    Masuk Akun
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-slate-500">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-brand-accent hover:text-brand-accent/90 transition-colors underline decoration-brand-accent/30 hover:decoration-brand-accent">
                    Daftar Sekarang
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
