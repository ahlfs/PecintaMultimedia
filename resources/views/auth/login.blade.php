<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('title', 'Masuk - GudangMeme')

@section('content')
<style>
    @keyframes fade-in-up {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }
</style>
<script>
    function togglePasswordVisibility() {
        const input = document.getElementById('password');
        const icon  = document.getElementById('password-toggle-icon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('fa-eye', 'fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('fa-eye-slash', 'fa-eye');
        }
    }
</script>

<div class="relative min-h-[calc(100vh-200px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden bg-gradient-to-br from-[#fff9e6] via-white to-[#fffef0]">
    {{-- Background Accents --}}
    <div class="absolute top-10 left-10 w-96 h-96 bg-gradient-to-br from-[#e6cc00]/20 to-[#f59e0b]/15 rounded-full blur-3xl pointer-events-none animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-[500px] h-[500px] bg-gradient-to-tl from-[#e6b400]/25 to-[#e69b00]/10 rounded-full blur-3xl pointer-events-none animate-pulse"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#e6cc00]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-2xl shadow-[#e69b00]/10 overflow-hidden flex flex-col md:flex-row z-10 animate-[fade-in-up_0.8s_ease-out_forwards] relative border border-[#e6b400]/20">
        {{-- Glowing orange border effect --}}
        <div class="absolute -inset-1.5 bg-gradient-to-r from-[#f59e0b] via-[#e69b00] to-[#e6b400] rounded-3xl opacity-70 blur-xl animate-pulse"></div>
        <div class="absolute -inset-1 bg-gradient-to-r from-[#e6b400] via-[#f59e0b] to-[#e69b00] rounded-3xl opacity-50 blur-lg"></div>
        <div class="absolute -inset-0.5 bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#f59e0b] rounded-3xl opacity-30 blur-md"></div>

        {{-- Left Side: Aesthetic Showcase --}}
        <div class="w-full md:w-1/2 bg-gradient-to-tr from-[#e69b00] via-[#f59e0b] to-[#e6b400] text-white p-12 flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-[#e6cc00]/50 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -left-20 -bottom-20 w-60 h-60 bg-[#e5de00]/40 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-[#f59e0b]/30 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-xl shadow-white/30">
                        <i class="fa-solid fa-images text-[#e69b00] text-lg"></i>
                    </div>
                    <span class="font-chewy text-2xl tracking-wide drop-shadow-lg">Gudang<span class="text-[#e5de00]">Meme</span></span>
                </div>

                <h2 class="text-3xl font-extrabold tracking-tight mb-4 leading-tight drop-shadow-lg">
                    Temukan Ide Visual & Simpan Meme Favoritmu.
                </h2>
                <p class="text-white/95 text-sm leading-relaxed max-w-sm drop-shadow-md">
                    Kembali masuk untuk mengorganisasikan koleksi meme terlucu, foto estetik, dan referensi desain andalanmu.
                </p>
            </div>

            <div class="hidden md:flex flex-col gap-4 mt-8 relative z-10">
                <div class="bg-white/25 backdrop-blur-lg border-2 border-white/40 p-4 rounded-2xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-white/40 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-thumbtack text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold">Organisasikan Koleksi</p>
                        <p class="text-[10px] text-white/90">Masukkan postingan ke folder khusus.</p>
                    </div>
                </div>
                <div class="bg-white/25 backdrop-blur-lg border-2 border-white/40 p-4 rounded-2xl flex items-center gap-3 ml-6">
                    <div class="w-10 h-10 rounded-xl bg-white/40 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-heart text-white text-lg"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold">Interaksi Real-Time</p>
                        <p class="text-[10px] text-white/90">Sukai dan beri komentar instan.</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-xs text-white/80 relative z-10">
                Tugas Akhir Kelompok 1 - Pemrograman Web
            </div>
        </div>

        {{-- Right Side: Login Form --}}
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center bg-white relative">
            <div class="absolute inset-0 bg-gradient-to-br from-[#e6cc00]/5 via-transparent to-[#f59e0b]/5 pointer-events-none"></div>

            <div class="mb-8 relative z-10">
                <h3 class="text-2xl font-bold bg-gradient-to-r from-[#e69b00] via-[#f59e0b] to-[#e6b400] bg-clip-text text-transparent">Selamat Datang Kembali!</h3>
                <p class="text-slate-500 text-sm mt-1">Masukkan akun Anda untuk melanjutkan penjelajahan.</p>
            </div>

            <form action="{{ url('/login') }}" method="POST" class="space-y-6 relative z-10">
                @csrf

                {{-- Username / Email --}}
                <div>
                    <label for="login" class="block text-sm font-semibold text-slate-700 mb-2">Username atau Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-white bg-gradient-to-br from-[#e69b00] to-[#f59e0b] rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg shadow-[#e69b00]/30 transition-all duration-300"></i>
                        </div>
                        <input
                            type="text"
                            id="login"
                            name="login"
                            value="{{ old('login') }}"
                            required
                            placeholder="username atau email@domain.com"
                            class="w-full pl-14 pr-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#f59e0b]/20 focus:border-[#e69b00] text-slate-800 placeholder-slate-400 transition-all duration-300 text-sm bg-slate-50/50 hover:border-[#e6cc00]/60 @error('login') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                    </div>
                    @error('login')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-semibold text-slate-700">Kata Sandi</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-white bg-gradient-to-br from-[#e69b00] to-[#f59e0b] rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg shadow-[#e69b00]/30 transition-all duration-300"></i>
                        </div>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="w-full pl-14 pr-14 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#f59e0b]/20 focus:border-[#e69b00] text-slate-800 placeholder-slate-400 transition-all duration-300 text-sm bg-slate-50/50 hover:border-[#e6cc00]/60 @error('password') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                        <button
                            type="button"
                            onclick="togglePasswordVisibility()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-white bg-gradient-to-br from-[#e69b00] to-[#f59e0b] hover:from-[#f59e0b] hover:to-[#e6b400] rounded-full w-8 h-8 flex items-center justify-center text-sm transition-all duration-300 shadow-lg shadow-[#e69b00]/30"
                        >
                            <i id="password-toggle-icon" class="fa-solid fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer select-none">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-2 border-slate-300 text-[#f59e0b] focus:ring-[#f59e0b]/30 cursor-pointer accent-[#e69b00]">
                        <span class="font-medium">Ingat Saya</span>
                    </label>
                </div>

                {{-- Submit Button --}}
                <button
                    type="submit"
                    class="group relative w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#e69b00] via-[#f59e0b] to-[#e6b400] hover:from-[#f59e0b] hover:via-[#e6b400] hover:to-[#e6cc00] text-white font-bold text-sm tracking-wide shadow-xl shadow-[#e69b00]/40 hover:shadow-2xl hover:shadow-[#f59e0b]/60 transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer overflow-hidden"
                >
                    <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent transition-transform duration-700"></div>
                    <span class="relative flex items-center justify-center gap-2">
                        Masuk Akun
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-slate-500 relative z-10">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold text-[#e69b00] hover:text-[#f59e0b] transition-colors underline decoration-[#e6cc00]/40 hover:decoration-[#f59e0b] decoration-2">
                    Daftar Sekarang
                </a>
            </div>
        </div>
    </div>
</div>
@endsection