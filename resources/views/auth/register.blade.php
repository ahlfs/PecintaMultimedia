@extends('layouts.app')

@section('title', 'Daftar Akun Baru - GudangMeme')

@section('content')
{{-- ============================================================
     CUSTOM CSS & JS - DIGABUNG DALAM SATU BLOK
     - Font Google (Chewy)
     - Keyframes animasi fade-in-up
     - Toggle password visibility (untuk 2 input)
     ============================================================ --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Chewy&display=swap');
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
<script>
    function togglePasswordVisibility(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon  = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

<div class="relative min-h-[calc(100vh-140px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden bg-white">
    {{-- Background Accents dengan palet kuning --}}
    <div class="absolute top-10 right-10 w-72 h-72 bg-[#e6cc00]/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 left-10 w-96 h-96 bg-[#e6b400]/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row z-10 animate-[fade-in-up_0.8s_ease-out_forwards] relative">
        {{-- Glowing orange border effect --}}
        <div class="absolute -inset-1 bg-gradient-to-r from-[#e69b00] via-[#f59e0b] to-[#e6b400] rounded-3xl opacity-60 blur-lg animate-pulse"></div>
        <div class="absolute -inset-0.5 bg-gradient-to-r from-[#f59e0b] via-[#e69b00] to-[#e6b400] rounded-3xl opacity-40 blur-md"></div>

        {{-- Left Side: Aesthetic Showcase dengan palet kuning --}}
        <div class="w-full md:w-1/2 bg-gradient-to-tr from-[#e69b00] via-[#e6b400] to-[#f59e0b] text-white p-12 flex flex-col justify-between relative overflow-hidden">
            {{-- Background floating glow kuning --}}
            <div class="absolute -right-20 -top-20 w-60 h-60 bg-[#e6cc00]/40 rounded-full blur-2xl"></div>
            <div class="absolute -left-20 -bottom-20 w-40 h-40 bg-[#e5de00]/30 rounded-full blur-2xl"></div>

            <div class="relative z-10">
                {{-- Logo dengan icon putih --}}
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-images text-[#e69b00] text-sm"></i>
                    </div>
                    <span class="font-['Chewy'] text-2xl tracking-wide">Gudang<span class="text-[#e5de00]">Meme</span></span>
                </div>

                <h2 class="text-3xl font-extrabold tracking-tight mb-4 leading-tight">
                    Mulai Susun Folder Koleksi Unikmu Sekarang.
                </h2>
                <p class="text-white/90 text-sm leading-relaxed max-w-sm">
                    Buat akun gratis hari ini untuk menyimpan inspirasi visual, mengunggah meme buatanmu, dan berdiskusi dengan sesama kreator secara real-time.
                </p>
            </div>

            {{-- Illustration / Quick info bullets --}}
            <div class="hidden md:flex flex-col gap-4 mt-6 relative z-10">
                <div class="bg-white/20 backdrop-blur-md border border-white/30 p-4 rounded-2xl flex items-center gap-3 hover:bg-white/30 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-white/30 flex items-center justify-center">
                        <i class="fa-solid fa-user-shield text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold">Autentikasi Aman</p>
                        <p class="text-[10px] text-white/80">Dilindungi dengan enkripsi Argon2id.</p>
                    </div>
                </div>
                <div class="bg-white/20 backdrop-blur-md border border-white/30 p-4 rounded-2xl flex items-center gap-3 ml-6 hover:bg-white/30 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-white/30 flex items-center justify-center">
                        <i class="fa-solid fa-cloud-arrow-up text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold">Unggah Tanpa Batas</p>
                        <p class="text-[10px] text-white/80">Bagikan karyamu secara instan.</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-xs text-white/70 relative z-10">
                Tugas Akhir Kelompok 1 - Pemrograman Web
            </div>
        </div>

        {{-- Right Side: Signup Form dengan border orange menyala --}}
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center bg-white relative">
            {{-- Inner glossy effect --}}
            <div class="absolute inset-0 bg-gradient-to-br from-white/50 via-transparent to-[#e6cc00]/5 pointer-events-none"></div>

            <div class="mb-6 relative z-10">
                <h3 class="text-2xl font-bold bg-gradient-to-r from-[#e69b00] to-[#e6b400] bg-clip-text text-transparent">Daftar Akun</h3>
                <p class="text-slate-500 text-sm mt-1">Lengkapi form berikut untuk bergabung dengan kami.</p>
            </div>

            <form action="{{ url('/register') }}" method="POST" class="space-y-4 relative z-10">
                @csrf

                {{-- Full Name input --}}
                <div>
                    <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <div class="w-8 h-8 rounded-full bg-[#e69b00] flex items-center justify-center group-focus-within:bg-[#e6b400] transition-colors shadow-lg shadow-[#e69b00]/25">
                                <i class="fa-solid fa-signature text-white text-xs"></i>
                            </div>
                        </div>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            placeholder="Nama Lengkap Anda"
                            class="w-full pl-14 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6cc00]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm bg-white/80 backdrop-blur-sm hover:border-[#e6cc00]/50 @error('name') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                        <div class="absolute inset-0 rounded-xl bg-[#e6b400]/0 group-focus-within:bg-[#e6b400]/5 transition-all duration-300 pointer-events-none"></div>
                    </div>
                    @error('name')
                        <p class="text-xs text-red-500 mt-1 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Username input --}}
                <div>
                    <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Username</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <div class="w-8 h-8 rounded-full bg-[#e69b00] flex items-center justify-center group-focus-within:bg-[#e6b400] transition-colors shadow-lg shadow-[#e69b00]/25">
                                <i class="fa-solid fa-at text-white text-xs"></i>
                            </div>
                        </div>
                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username') }}"
                            required
                            placeholder="username_anda"
                            class="w-full pl-14 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6cc00]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm bg-white/80 backdrop-blur-sm hover:border-[#e6cc00]/50 @error('username') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                        <div class="absolute inset-0 rounded-xl bg-[#e6b400]/0 group-focus-within:bg-[#e6b400]/5 transition-all duration-300 pointer-events-none"></div>
                    </div>
                    @error('username')
                        <p class="text-xs text-red-500 mt-1 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email input --}}
                <div>
                    <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Alamat Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <div class="w-8 h-8 rounded-full bg-[#e69b00] flex items-center justify-center group-focus-within:bg-[#e6b400] transition-colors shadow-lg shadow-[#e69b00]/25">
                                <i class="fa-solid fa-envelope text-white text-xs"></i>
                            </div>
                        </div>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            placeholder="email@example.com"
                            class="w-full pl-14 pr-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6cc00]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm bg-white/80 backdrop-blur-sm hover:border-[#e6cc00]/50 @error('email') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                        <div class="absolute inset-0 rounded-xl bg-[#e6b400]/0 group-focus-within:bg-[#e6b400]/5 transition-all duration-300 pointer-events-none"></div>
                    </div>
                    @error('email')
                        <p class="text-xs text-red-500 mt-1 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password input dengan toggle --}}
                <div>
                    <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Kata Sandi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <div class="w-8 h-8 rounded-full bg-[#e69b00] flex items-center justify-center group-focus-within:bg-[#e6b400] transition-colors shadow-lg shadow-[#e69b00]/25">
                                <i class="fa-solid fa-lock text-white text-xs"></i>
                            </div>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            placeholder="Minimal 6 karakter"
                            class="w-full pl-14 pr-12 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6cc00]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm bg-white/80 backdrop-blur-sm hover:border-[#e6cc00]/50 @error('password') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                        <button
                            type="button"
                            onclick="togglePasswordVisibility('password', 'password-toggle-icon')"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-white bg-[#e69b00] hover:bg-[#e6b400] rounded-full w-8 h-8 flex items-center justify-center text-sm transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#e6cc00]/30"
                        >
                            <i id="password-toggle-icon" class="fa-solid fa-eye"></i>
                        </button>
                        <div class="absolute inset-0 rounded-xl bg-[#e6b400]/0 group-focus-within:bg-[#e6b400]/5 transition-all duration-300 pointer-events-none"></div>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 mt-1 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Confirm Password input dengan toggle --}}
                <div>
                    <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Ulangi Kata Sandi</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                            <div class="w-8 h-8 rounded-full bg-[#e69b00] flex items-center justify-center group-focus-within:bg-[#e6b400] transition-colors shadow-lg shadow-[#e69b00]/25">
                                <i class="fa-solid fa-circle-check text-white text-xs"></i>
                            </div>
                        </div>
                        <input
                            type="password"
                            id="password_confirmation"
                            name="password_confirmation"
                            required
                            placeholder="Ulangi kata sandi"
                            class="w-full pl-14 pr-12 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6cc00]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm bg-white/80 backdrop-blur-sm hover:border-[#e6cc00]/50"
                        >
                        <button
                            type="button"
                            onclick="togglePasswordVisibility('password_confirmation', 'confirm-toggle-icon')"
                            class="absolute right-2 top-1/2 -translate-y-1/2 text-white bg-[#e69b00] hover:bg-[#e6b400] rounded-full w-8 h-8 flex items-center justify-center text-sm transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#e6cc00]/30"
                        >
                            <i id="confirm-toggle-icon" class="fa-solid fa-eye"></i>
                        </button>
                        <div class="absolute inset-0 rounded-xl bg-[#e6b400]/0 group-focus-within:bg-[#e6b400]/5 transition-all duration-300 pointer-events-none"></div>
                    </div>
                </div>

                {{-- Submit Button dengan efek glow --}}
                <button
                    type="submit"
                    class="group relative w-full py-3 px-6 rounded-xl bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] text-white font-bold text-sm tracking-wide shadow-lg shadow-[#e69b00]/25 hover:shadow-xl hover:shadow-[#e6b400]/40 transition-all duration-300 transform hover:-translate-y-0.5 mt-4 cursor-pointer overflow-hidden"
                >
                    {{-- Shine effect --}}
                    <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full bg-gradient-to-r from-transparent via-white/20 to-transparent transition-transform duration-700"></div>
                    {{-- Glow effect --}}
                    <div class="absolute inset-0 bg-[#e6cc00]/0 group-hover:bg-[#e6cc00]/20 blur-xl transition-all duration-300"></div>
                    <span class="relative flex items-center justify-center gap-2">
                        Daftar Akun Baru
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                    </span>
                </button>
            </form>

            <!-- Divider "Atau daftar dengan" -->
            <div class="relative flex py-3 items-center z-10">
                <div class="flex-grow border-t border-slate-200"></div>
                <span class="flex-shrink mx-4 text-slate-400 text-xs font-semibold uppercase tracking-wider">Atau daftar dengan</span>
                <div class="flex-grow border-t border-slate-200"></div>
            </div>

            <!-- Tombol Google Register Premium -->
            <a 
                href="{{ route('auth.google') }}" 
                class="group relative flex items-center justify-center gap-3 w-full py-2.5 px-6 rounded-xl bg-white hover:bg-slate-50 text-slate-700 hover:text-slate-900 font-bold text-sm tracking-wide shadow-md hover:shadow-lg border-2 border-slate-200/80 hover:border-slate-300 transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer overflow-hidden z-10"
            >
                <svg class="w-5 h-5 transition-transform group-hover:scale-110 duration-300" viewBox="0 0 24 24">
                    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.56-2.77c-.98.66-2.23 1.06-3.72 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                    <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z"/>
                    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z"/>
                </svg>
                <span>Daftar dengan Google</span>
                <!-- Glow light effect -->
                <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-slate-500/0 via-slate-500/5 to-slate-500/0 group-hover:from-slate-500/5 group-hover:via-slate-500/10 group-hover:to-slate-500/5 transition-all duration-500 pointer-events-none blur-sm"></div>
            </a>

            <div class="mt-6 text-center text-sm text-slate-500 relative z-10">
                Sudah memiliki akun?
                <a href="{{ route('login') }}" class="font-bold bg-gradient-to-r from-[#e69b00] to-[#e6b400] bg-clip-text text-transparent hover:from-[#e6b400] hover:to-[#e6cc00] transition-all duration-300 underline decoration-[#e6cc00]/30 hover:decoration-[#e6b400]">
                    Masuk Di Sini
                </a>
            </div>
        </div>
    </div>
</div>
@endsection