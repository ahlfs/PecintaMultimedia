@extends('layouts.app')

@section('title', 'Daftar Akun Baru - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden bg-slate-50">
    <!-- Background Accents -->
    <div class="absolute top-10 right-10 w-72 h-72 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-96 h-96 bg-brand-accent/15 rounded-full blur-3xl pointer-events-none"></div>

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
                    Mulai Susun Folder Koleksi Unikmu Sekarang.
                </h2>
                <p class="text-slate-200 text-sm leading-relaxed max-w-sm">
                    Buat akun gratis hari ini untuk menyimpan inspirasi visual, mengunggah meme buatanmu, dan berdiskusi dengan sesama kreator secara real-time.
                </p>
            </div>

            <!-- Illustration / Quick info bullets -->
            <div class="hidden md:flex flex-col gap-4 mt-6 relative z-10">
                <div class="bg-white/10 backdrop-blur-md border border-white/15 p-4 rounded-2xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-brand-accent/20 flex items-center justify-center text-brand-accent-light">
                        <i class="fa-solid fa-user-shield text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold font-sans">Autentikasi Aman</p>
                        <p class="text-[10px] text-slate-300">Dilindungi dengan enkripsi Argon2id.</p>
                    </div>
                </div>
                <div class="bg-white/10 backdrop-blur-md border border-white/15 p-4 rounded-2xl flex items-center gap-3 ml-6">
                    <div class="w-10 h-10 rounded-xl bg-brand-accent-light/20 flex items-center justify-center text-brand-accent-light">
                        <i class="fa-solid fa-cloud-arrow-up text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold font-sans">Unggah Tanpa Batas</p>
                        <p class="text-[10px] text-slate-300">Bagikan karyamu secara instan.</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-xs text-slate-400 relative z-10 font-sans">
                Tugas Akhir Kelompok 1 - Pemrograman Web
            </div>
        </div>

        <!-- Right Side: Signup Form -->
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center bg-white">
            <div class="mb-6">
                <h3 class="text-2xl font-bold text-brand-primary">Daftar Akun</h3>
                <p class="text-slate-500 text-sm mt-1">Lengkapi form berikut untuk bergabung dengan kami.</p>
            </div>

            <form action="{{ url('/register') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Full Name input -->
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-signature text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                        </div>
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            value="{{ old('name') }}" 
                            required 
                            placeholder="Nama Lengkap Anda"
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('name') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                    </div>
                    @error('name')
                        <p class="text-xs text-red-500 mt-1 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Username input -->
                <div>
                    <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-at text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                        </div>
                        <input 
                            type="text" 
                            id="username" 
                            name="username" 
                            value="{{ old('username') }}" 
                            required 
                            placeholder="username_anda"
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('username') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                    </div>
                    @error('username')
                        <p class="text-xs text-red-500 mt-1 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Email input -->
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-envelope text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                        </div>
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            placeholder="email@example.com"
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('email') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                    </div>
                    @error('email')
                        <p class="text-xs text-red-500 mt-1 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password input -->
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kata Sandi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            placeholder="Minimal 6 karakter"
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('password') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 mt-1 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Confirm Password input -->
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ulangi Kata Sandi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-circle-check text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                        </div>
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required 
                            placeholder="Ulangi kata sandi"
                            class="w-full pl-11 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm"
                        >
                    </div>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full py-3 px-6 rounded-xl bg-brand-accent hover:bg-brand-accent/95 text-white font-bold text-sm tracking-wide shadow-md shadow-brand-accent/10 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 mt-4 cursor-pointer"
                >
                    Daftar Akun Baru
                </button>
            </form>

            <div class="mt-6 text-center text-sm text-slate-500">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-bold text-brand-primary hover:text-brand-primary/95 transition-colors underline decoration-brand-primary/30 hover:decoration-brand-primary">
                    Masuk Di Sini
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
