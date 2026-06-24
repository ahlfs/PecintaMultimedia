<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'GudangMeme - Simpan & Berbagi Inspirasi Visual')</title>

    <!-- Google Fonts (Outfit, Averia Libre, Chewy, Comic Relief) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Chewy&family=Comic+Relief:wght@400;700&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Icons (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            primary: '#e69b00',
                            accent: '#e6b400',
                            'accent-light': '#e6cc00',
                            'bg-light': '#fff4cc',
                        }
                    },
                    fontFamily: {
                        sans: ['Outfit', 'Comic Relief', 'Averia Libre', 'Chewy', 'sans-serif'],
                        chewy: ['Chewy', 'cursive'],
                        averia: ['Averia Libre', 'serif'],
                        comic: ['Comic Relief', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS Fallbacks -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js') }}" defer></script>

    <!-- Vite Scripts -->
    @vite(['resources/js/app.js'])

    {{-- ============================================================
         CUSTOM CSS - HANYA UNTUK KEYFRAMES & PSEUDO-ELEMENTS
         yang tidak bisa di-replace oleh Tailwind
         ============================================================ --}}
    <style>
        /* Selection Color */
        ::selection {
            background: rgba(230, 180, 0, 0.25) !important;
            color: #e69b00 !important;
        }

        /* Navbar Glow - Animated Gradient Border */
        .navbar-glow {
            position: relative;
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(230, 180, 0, 0.25);
            box-shadow: 0 0 30px rgba(230, 155, 0, 0.15),
                        0 0 60px rgba(230, 180, 0, 0.08),
                        inset 0 1px 0 rgba(255, 255, 255, 0.8);
        }

        .navbar-glow::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, #e69b00, #e6b400, #e6cc00, #e5de00, #e6b400, #e69b00);
            border-radius: inherit;
            z-index: -1;
            filter: blur(15px);
            opacity: 0.5;
            animation: navbarGlow 8s linear infinite;
            background-size: 400% 400%;
        }

        @keyframes navbarGlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Button Shine Effect */
        .btn-glow-yellow::before,
        .btn-gradient-yellow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }

        .btn-glow-yellow:hover::before,
        .btn-gradient-yellow:hover::before {
            left: 100%;
        }

        /* Nav Link Underline Animation */
        .nav-link-yellow {
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-link-yellow::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 50%;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #e69b00, #e6cc00);
            transition: all 0.3s ease;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        .nav-link-yellow:hover::after,
        .nav-link-yellow.active::after {
            width: 80%;
        }

        /* Footer Top Border Glow */
        .footer-yellow::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
        }
    </style>

    @stack('styles')
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col" data-session-success="{{ session('success') }}" data-session-error="{{ session('error') }}">

    <!-- Glassmorphic Navbar with Yellow Glow -->
    <nav class="sticky top-4 mx-auto max-w-7xl w-[95%] sm:w-[92%] z-50 navbar-glow rounded-2xl transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-18">
                <!-- Logo & Brand -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('feed') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] shadow-[0_4px_15px_rgba(230,155,0,0.4),0_0_20px_rgba(230,180,0,0.2)] hover:shadow-[0_6px_25px_rgba(230,155,0,0.6),0_0_35px_rgba(230,180,0,0.4)] hover:scale-105 transition-all duration-300 flex items-center justify-center">
                            <i class="fa-solid fa-images text-white text-lg"></i>
                        </div>
                        <span class="font-chewy text-2xl md:text-3xl tracking-wide">
                            <span class="bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent">Gudang</span><span class="bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent">Meme</span>
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('feed') }}" class="font-semibold nav-link-yellow {{ request()->routeIs('feed') ? 'text-brand-primary active' : 'text-slate-600 hover:text-[#e69b00] hover:[text-shadow:0_0_10px_rgba(230,155,0,0.3)]' }} transition-colors">
                        <i class="fa-solid fa-compass mr-1"></i> Eksplorasi
                    </a>
                    @if(isset($authUser))
                        <a href="{{ route('collections.index') }}" class="font-semibold nav-link-yellow {{ request()->routeIs('collections.*') ? 'text-brand-primary active' : 'text-slate-600 hover:text-[#e69b00] hover:[text-shadow:0_0_10px_rgba(230,155,0,0.3)]' }} transition-colors">
                            <i class="fa-solid fa-folder-open mr-1"></i> Koleksi Saya
                        </a>
                        <a href="#" class="font-semibold text-slate-600 nav-link-yellow hover:text-[#e69b00] hover:[text-shadow:0_0_10px_rgba(230,155,0,0.3)] transition-colors">
                            <i class="fa-solid fa-circle-plus mr-1"></i> Unggah Post
                        </a>
                    @endif
                </div>

                <!-- CTA / Auth Buttons -->
                <div class="flex items-center gap-4">
                    @if(isset($authUser))
                        <!-- User Menu (Authenticated) -->
                        <div class="flex items-center gap-3">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 group">
                                <img src="{{ $authUser->profile_photo ? asset($authUser->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($authUser->name).'&background=e69b00&color=fff&bold=true' }}"
                                     alt="Profile photo"
                                     class="w-10 h-10 rounded-xl object-cover border-2 border-[#e6b400]/40 shadow-sm hover:shadow-[0_0_20px_rgba(230,155,0,0.4)] hover:scale-105 transition-all">
                                <div class="hidden lg:flex flex-col text-left">
                                    <span class="text-sm font-bold text-slate-800 group-hover:text-[#e69b00] transition-colors leading-none mb-0.5">{{ $authUser->name }}</span>
                                    <span class="text-xs text-slate-500 font-medium leading-none">@ {{ $authUser->username }}</span>
                                </div>
                            </a>

                            <!-- Profile Edit Shortcut -->
                            <a href="{{ route('profile.edit') }}" title="Edit Profil" class="p-2 rounded-xl text-slate-500 hover:text-[#e69b00] hover:[text-shadow:0_0_10px_rgba(230,155,0,0.4)] hover:bg-[#e6b400]/8 transition-all">
                                <i class="fa-solid fa-gear text-lg"></i>
                            </a>

                            <!-- Logout Button -->
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" title="Keluar" class="p-2 rounded-xl text-red-500 hover:text-red-600 hover:bg-red-500/10 hover:shadow-[0_0_15px_rgba(239,68,68,0.2)] transition-all cursor-pointer">
                                    <i class="fa-solid fa-right-from-bracket text-lg"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Guest Buttons -->
                        <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-[#e69b00] hover:[text-shadow:0_0_10px_rgba(230,155,0,0.3)] px-4 py-2 text-sm transition-colors nav-link-yellow">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-white bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] hover:shadow-[0_0_30px_rgba(230,155,0,0.5),0_0_60px_rgba(230,180,0,0.3)] hover:-translate-y-0.5 font-semibold text-sm shadow-lg shadow-[#e69b00]/25 transition-all duration-300 relative overflow-hidden btn-gradient-yellow">
                            Daftar
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer with Yellow Gradient -->
    <footer class="relative overflow-hidden bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] pt-12 pb-8 mt-12 text-white footer-yellow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-b border-white/20 pb-8 mb-8">
                <!-- Brand logo -->
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-md border border-white/30">
                        <i class="fa-solid fa-images text-white text-sm"></i>
                    </div>
                    <span class="font-chewy text-2xl tracking-wide text-white">GudangMeme</span>
                </div>
                <div class="flex flex-wrap justify-center gap-6 text-sm">
                    <a href="{{ route('feed') }}" class="text-white hover:text-[#fff4cc] hover:[text-shadow:0_0_10px_rgba(255,255,255,0.5)] transition-all">Feed Eksplorasi</a>
                    <a href="{{ isset($authUser) ? route('profile.edit') : route('login') }}" class="text-white hover:text-[#fff4cc] hover:[text-shadow:0_0_10px_rgba(255,255,255,0.5)] transition-all">Pengaturan Profil</a>
                    <a href="https://github.com" target="_blank" class="text-white hover:text-[#fff4cc] hover:[text-shadow:0_0_10px_rgba(255,255,255,0.5)] transition-all">Repositori</a>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center justify-between text-xs gap-4 opacity-90 text-white">
                <p class="text-white">&copy; {{ date('Y') }} GudangMeme. Tugas Besar Pemrograman Web Kelompok 1.</p>
                <p class="flex items-center gap-1 text-white">Dibuat dengan <i class="fa-solid fa-heart text-red-300"></i> & Laravel</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>