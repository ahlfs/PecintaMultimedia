@extends('layouts.app')

@section('title', 'Masuk - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 overflow-hidden bg-white">
    <!-- Background Accents dengan palet kuning yang lebih menyala -->
    <div class="absolute top-10 left-10 w-96 h-96 bg-gradient-to-br from-[#e6cc00]/20 to-[#f59e0b]/15 rounded-full blur-3xl pointer-events-none animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-[500px] h-[500px] bg-gradient-to-tl from-[#e6b400]/25 to-[#e69b00]/10 rounded-full blur-3xl pointer-events-none animate-pulse"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-[#e6cc00]/5 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-4xl w-full bg-white rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row z-10 animate-fade-in-up relative">
        <!-- Glowing orange border effect yang lebih kuat dan glossy -->
        <div class="absolute -inset-1.5 bg-gradient-to-r from-[#f59e0b] via-[#e69b00] to-[#e6b400] rounded-3xl opacity-70 blur-xl animate-pulse"></div>
        <div class="absolute -inset-1 bg-gradient-to-r from-[#e6b400] via-[#f59e0b] to-[#e69b00] rounded-3xl opacity-50 blur-lg"></div>
        <div class="absolute -inset-0.5 bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#f59e0b] rounded-3xl opacity-30 blur-md"></div>
        
        <!-- Left Side: Aesthetic Showcase dengan palet kuning -->
        <div class="w-full md:w-1/2 bg-gradient-to-tr from-[#e69b00] via-[#f59e0b] to-[#e6b400] text-white p-12 flex flex-col justify-between relative overflow-hidden">
            <!-- Background floating glow kuning yang lebih intens -->
            <div class="absolute -right-20 -top-20 w-80 h-80 bg-[#e6cc00]/50 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -left-20 -bottom-20 w-60 h-60 bg-[#e5de00]/40 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-[#f59e0b]/30 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <!-- Logo dengan icon putih dan glow -->
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-xl shadow-white/30 hover:scale-110 transition-transform duration-300">
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

            <!-- Illustration / Staggered items visual mockup dengan efek glossy -->
            <div class="hidden md:flex flex-col gap-4 mt-8 relative z-10">
                <div class="bg-white/25 backdrop-blur-lg border-2 border-white/40 p-4 rounded-2xl flex items-center gap-3 hover:bg-white/35 hover:scale-105 hover:shadow-xl hover:shadow-white/20 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-white/40 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-thumbtack text-white text-lg drop-shadow"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold drop-shadow">Organisasikan Koleksi</p>
                        <p class="text-[10px] text-white/90 drop-shadow">Masukkan postingan ke folder khusus.</p>
                    </div>
                </div>
                <div class="bg-white/25 backdrop-blur-lg border-2 border-white/40 p-4 rounded-2xl flex items-center gap-3 ml-6 hover:bg-white/35 hover:scale-105 hover:shadow-xl hover:shadow-white/20 transition-all duration-300">
                    <div class="w-10 h-10 rounded-xl bg-white/40 backdrop-blur-sm flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-heart text-white text-lg drop-shadow"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold drop-shadow">Interaksi Real-Time</p>
                        <p class="text-[10px] text-white/90 drop-shadow">Sukai dan beri komentar instan.</p>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-xs text-white/80 relative z-10 drop-shadow">
                Tugas Akhir Kelompok 1 - Pemrograman Web
            </div>
        </div>

        <!-- Right Side: Login Form dengan border orange menyala dan glossy -->
        <div class="w-full md:w-1/2 p-8 sm:p-12 flex flex-col justify-center bg-white relative">
            <!-- Inner glossy effect yang lebih kuat -->
            <div class="absolute inset-0 bg-gradient-to-br from-[#e6cc00]/10 via-transparent to-[#f59e0b]/10 pointer-events-none"></div>
            <div class="absolute inset-0 bg-gradient-to-tl from-transparent via-white/30 to-white/50 pointer-events-none"></div>
            
            <div class="mb-8 relative z-10">
                <h3 class="text-2xl font-bold bg-gradient-to-r from-[#e69b00] via-[#f59e0b] to-[#e6b400] bg-clip-text text-transparent drop-shadow-sm">Selamat Datang Kembali!</h3>
                <p class="text-slate-500 text-sm mt-1">Masukkan akun Anda untuk melanjutkan penjelajahan.</p>
            </div>

            <form action="{{ url('/login') }}" method="POST" class="space-y-6 relative z-10">
                @csrf
                
                <!-- Email or Username input dengan efek glossy -->
                <div>
                    <label for="login" class="block text-sm font-semibold text-slate-700 mb-2">Username atau Email</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-white bg-gradient-to-br from-[#e69b00] to-[#f59e0b] rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg shadow-[#e69b00]/30 group-focus-within:from-[#f59e0b] group-focus-within:to-[#e6b400] group-focus-within:shadow-[#f59e0b]/50 transition-all duration-300"></i>
                        </div>
                        <input 
                            type="text" 
                            id="login" 
                            name="login" 
                            value="{{ old('login') }}" 
                            required 
                            placeholder="username atau email@domain.com"
                            class="w-full pl-14 pr-4 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#f59e0b]/30 focus:border-[#f59e0b] text-slate-800 placeholder-slate-400 transition-all duration-300 text-sm bg-gradient-to-br from-white to-slate-50/50 backdrop-blur-sm hover:border-[#e6cc00]/60 hover:shadow-md hover:shadow-[#e6cc00]/10 @error('login') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                        <!-- Glow effect on focus yang lebih kuat -->
                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-[#e6b400]/0 via-[#f59e0b]/0 to-[#e6cc00]/0 group-focus-within:from-[#e6b400]/10 group-focus-within:via-[#f59e0b]/15 group-focus-within:to-[#e6cc00]/10 transition-all duration-500 pointer-events-none blur-sm"></div>
                    </div>
                    @error('login')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Password input dengan efek glossy -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-sm font-semibold text-slate-700">Kata Sandi</label>
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-white bg-gradient-to-br from-[#e69b00] to-[#f59e0b] rounded-full w-8 h-8 flex items-center justify-center text-xs shadow-lg shadow-[#e69b00]/30 group-focus-within:from-[#f59e0b] group-focus-within:to-[#e6b400] group-focus-within:shadow-[#f59e0b]/50 transition-all duration-300"></i>
                        </div>
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            required 
                            placeholder="••••••••"
                            class="w-full pl-14 pr-14 py-3 rounded-xl border-2 border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#f59e0b]/30 focus:border-[#f59e0b] text-slate-800 placeholder-slate-400 transition-all duration-300 text-sm bg-gradient-to-br from-white to-slate-50/50 backdrop-blur-sm hover:border-[#e6cc00]/60 hover:shadow-md hover:shadow-[#e6cc00]/10 @error('password') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                        >
                        <!-- Show/Hide password button dengan efek glossy -->
                        <button 
                            type="button" 
                            onclick="togglePasswordVisibility()" 
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-white bg-gradient-to-br from-[#e69b00] to-[#f59e0b] hover:from-[#f59e0b] hover:to-[#e6b400] rounded-full w-8 h-8 flex items-center justify-center text-sm transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#f59e0b]/50 shadow-lg shadow-[#e69b00]/30 hover:shadow-xl hover:shadow-[#f59e0b]/50 hover:scale-110"
                        >
                            <i id="password-toggle-icon" class="fa-solid fa-eye"></i>
                        </button>
                        <!-- Glow effect on focus yang lebih kuat -->
                        <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-[#e6b400]/0 via-[#f59e0b]/0 to-[#e6cc00]/0 group-focus-within:from-[#e6b400]/10 group-focus-within:via-[#f59e0b]/15 group-focus-within:to-[#e6cc00]/10 transition-all duration-500 pointer-events-none blur-sm"></div>
                    </div>
                    @error('password')
                        <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                <!-- Remember Me dengan accent kuning -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-slate-600 cursor-pointer select-none group">
                        <input type="checkbox" name="remember" class="w-4.5 h-4.5 rounded border-2 border-slate-300 text-[#f59e0b] focus:ring-[#f59e0b]/30 cursor-pointer accent-[#e69b00] hover:border-[#e6cc00] transition-colors">
                        <span class="group-hover:text-[#e69b00] transition-colors font-medium">Ingat Saya</span>
                    </label>
                </div>

                <!-- Submit Button dengan efek glow orange yang sangat menyala -->
                <button 
                    type="submit" 
                    class="group relative w-full py-3.5 px-6 rounded-xl bg-gradient-to-r from-[#e69b00] via-[#f59e0b] to-[#e6b400] hover:from-[#f59e0b] hover:via-[#e6b400] hover:to-[#e6cc00] text-white font-bold text-sm tracking-wide shadow-xl shadow-[#e69b00]/40 hover:shadow-2xl hover:shadow-[#f59e0b]/60 transition-all duration-300 transform hover:-translate-y-1 cursor-pointer overflow-hidden border-2 border-white/20"
                >
                    <!-- Shine effect yang lebih kuat -->
                    <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full bg-gradient-to-r from-transparent via-white/30 to-transparent transition-transform duration-700"></div>
                    <!-- Glow effect yang lebih intens -->
                    <div class="absolute inset-0 bg-gradient-to-r from-[#e6cc00]/0 via-[#f59e0b]/0 to-[#e6b400]/0 group-hover:from-[#e6cc00]/30 group-hover:via-[#f59e0b]/40 group-hover:to-[#e6b400]/30 blur-xl transition-all duration-500"></div>
                    <!-- Inner glow -->
                    <div class="absolute inset-0.5 bg-gradient-to-r from-white/10 to-transparent rounded-xl"></div>
                    <span class="relative flex items-center justify-center gap-2 drop-shadow-lg">
                        Masuk Akun
                        <i class="fa-solid fa-arrow-right group-hover:translate-x-2 transition-transform duration-300"></i>
                    </span>
                </button>
            </form>

            <div class="mt-8 text-center text-sm text-slate-500 relative z-10">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-bold bg-gradient-to-r from-[#e69b00] via-[#f59e0b] to-[#e6b400] bg-clip-text text-transparent hover:from-[#f59e0b] hover:via-[#e6b400] hover:to-[#e6cc00] transition-all duration-300 underline decoration-[#e6cc00]/40 hover:decoration-[#f59e0b] decoration-2 hover:scale-105 inline-block">
                    Daftar Sekarang
                </a>
            </div>
        </div>

    </div>
</div>

<script>
function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('password-toggle-icon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}
</script>
@endsection