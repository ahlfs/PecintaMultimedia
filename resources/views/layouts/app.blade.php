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

    <!-- Tailwind CSS CDN (with brand palette customization - Yellow Theme) -->
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

    <!-- Custom CSS Fallbacks for animations and glassmorphism styling -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- Custom JS File containing alerts and toggles -->
    <script src="{{ asset('assets/js/custom.js') }}" defer></script>

    <!-- Vite Scripts (for JS reactivity if needed) -->
    @vite(['resources/js/app.js'])

    <style>
        /* ============================================
           YELLOW GLOWING THEME - GLOBAL STYLES
           ============================================ */
        
        /* Glowing Navbar Border Effect - SOFT VERSION */
        .navbar-glow {
            position: relative;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(230, 180, 0, 0.15);
            box-shadow: 
                0 0 20px rgba(230, 155, 0, 0.08),
                0 0 40px rgba(230, 180, 0, 0.04),
                inset 0 1px 0 rgba(255, 255, 255, 0.9);
        }
        
        .navbar-glow::before {
            content: '';
            position: absolute;
            top: -1px;
            left: -1px;
            right: -1px;
            bottom: -1px;
            background: linear-gradient(45deg, #e69b00, #e6b400, #e6cc00, #e5de00, #e6b400, #e69b00);
            border-radius: inherit;
            z-index: -1;
            filter: blur(8px);
            opacity: 0.25;
            animation: navbarGlow 8s linear infinite;
            background-size: 400% 400%;
        }
        
        @keyframes navbarGlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Button Glow Effect - Yellow */
        .btn-glow-yellow {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .btn-glow-yellow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: left 0.5s;
        }
        
        .btn-glow-yellow:hover::before {
            left: 100%;
        }
        
        .btn-glow-yellow:hover {
            box-shadow: 
                0 0 25px rgba(230, 155, 0, 0.5),
                0 0 50px rgba(230, 180, 0, 0.3);
            transform: translateY(-2px);
        }
        
        .btn-glow-yellow:active {
            transform: translateY(0);
        }
        
        /* Gradient Button (Primary CTA) */
        .btn-gradient-yellow {
            background: linear-gradient(135deg, #e69b00 0%, #e6b400 50%, #e6cc00 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
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
        
        .btn-gradient-yellow:hover::before {
            left: 100%;
        }
        
        .btn-gradient-yellow:hover {
            background: linear-gradient(135deg, #e6b400 0%, #e6cc00 50%, #e5de00 100%);
            box-shadow: 
                0 0 30px rgba(230, 155, 0, 0.5),
                0 0 60px rgba(230, 180, 0, 0.3);
            transform: translateY(-2px);
        }
        
        /* Logo Icon Glow */
        .logo-icon-glow {
            background: linear-gradient(135deg, #e69b00 0%, #e6b400 50%, #e6cc00 100%);
            box-shadow: 
                0 4px 15px rgba(230, 155, 0, 0.4),
                0 0 20px rgba(230, 180, 0, 0.2);
            transition: all 0.3s ease;
        }
        
        .logo-icon-glow:hover {
            box-shadow: 
                0 6px 25px rgba(230, 155, 0, 0.6),
                0 0 35px rgba(230, 180, 0, 0.4);
            transform: scale(1.05);
        }
        
        /* Gradient Text */
        .text-gradient-yellow {
            background: linear-gradient(135deg, #e69b00 0%, #e6b400 50%, #e6cc00 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Navigation Link Hover Glow */
        .nav-icon-glow:hover {
            color: #e69b00 !important;
            text-shadow: 0 0 10px rgba(230, 155, 0, 0.3);
            background: rgba(230, 180, 0, 0.08) !important;
        }
        
        .nav-icon-glow.active {
            color: #e69b00 !important;
            background: rgba(230, 180, 0, 0.12) !important;
            text-shadow: 0 0 10px rgba(230, 155, 0, 0.4);
        }
        
        /* Footer with Yellow Gradient */
        .footer-yellow {
            background: linear-gradient(135deg, #e69b00 0%, #e6b400 50%, #e6cc00 100%);
            position: relative;
            overflow: hidden;
        }
        
        .footer-yellow::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.6), transparent);
        }
        
        /* Footer - All text white */
        .footer-yellow, 
        .footer-yellow *, 
        .footer-yellow a, 
        .footer-yellow p, 
        .footer-yellow span, 
        .footer-yellow div {
            color: #ffffff !important;
        }
        
        .footer-yellow a:hover {
            color: #fff4cc !important;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
        
        /* Selection Color */
        ::selection {
            background: rgba(230, 180, 0, 0.25) !important;
            color: #e69b00 !important;
        }
        
        /* User avatar hover glow */
        .avatar-glow:hover {
            box-shadow: 0 0 20px rgba(230, 155, 0, 0.4);
            transform: scale(1.05);
            border-color: #e6b400 !important;
        }
        
        /* Search box focus glow */
        .search-glow:focus {
            border-color: #e6b400 !important;
            box-shadow: 
                0 0 0 4px rgba(230, 180, 0, 0.15),
                0 0 20px rgba(230, 155, 0, 0.15);
        }
    </style>

    @livewireStyles
    @stack('styles')
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col" data-session-success="{{ session('success') }}" data-session-error="{{ session('error') }}">

    <!-- Glassmorphic Navbar with Soft Yellow Glow -->
    <nav class="sticky top-4 mx-auto max-w-[1600px] w-[95%] sm:w-[92%] z-50 navbar-glow rounded-2xl transition-all duration-300">
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-18 gap-4 w-full">
                <!-- Logo & Brand (Left) -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('feed') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-xl logo-icon-glow flex items-center justify-center">
                            <i class="fa-solid fa-images text-white text-lg"></i>
                        </div>
                        <span class="font-chewy text-2xl md:text-3xl tracking-wide hidden sm:inline">
                            <span class="text-gradient-yellow">Gudang</span><span class="text-gradient-yellow">Meme</span>
                        </span>
                    </a>
                </div>

                <!-- Search Box (Center) -->
                <div 
                    class="flex-grow max-w-xl relative"
                    x-data="{
                        handleSearch(e) {
                            const query = e.target.value;
                            if (window.location.pathname !== '/feed') {
                                window.location.href = '/feed?search=' + encodeURIComponent(query);
                            } else {
                                this.$dispatch('search-updated', { value: query });
                            }
                        }
                    }"
                >
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm group-focus-within:text-[#e69b00] transition-colors"></i>
                    </div>
                    <input 
                        type="text" 
                        @input.debounce.300ms="handleSearch($event)"
                        value="{{ request('search') }}"
                        placeholder="Cari meme..."
                        class="search-glow block w-full pl-10 pr-4 py-2 rounded-xl border border-slate-200 bg-white/80 backdrop-blur-sm placeholder-slate-400 text-slate-800 focus:outline-none transition-all text-xs shadow-sm hover:border-[#e6cc00]/50"
                    >
                </div>

                <!-- Navigation Links & Profile (Right) -->
                <div class="flex items-center gap-2 sm:gap-4">
                    <!-- Nav Icons -->
                    <div class="flex items-center gap-1 sm:gap-2">
                        <a href="{{ route('feed') }}" class="p-2.5 rounded-xl text-base nav-icon-glow {{ request()->routeIs('feed') ? 'active' : 'text-slate-600' }} transition-all" title="Eksplorasi">
                            <i class="fa-solid fa-compass"></i>
                        </a>
                        @if(isset($authUser))
                            <a href="{{ route('collections.index') }}" class="p-2.5 rounded-xl text-base nav-icon-glow {{ request()->routeIs('collections.*') ? 'active' : 'text-slate-600' }} transition-all" title="Koleksi Saya">
                                <i class="fa-solid fa-folder-open"></i>
                            </a>
                            <a href="{{ route('posts.create') }}" class="p-2.5 rounded-xl text-base nav-icon-glow {{ request()->routeIs('posts.create') ? 'active' : 'text-slate-600' }} transition-all" title="Unggah Post">
                                <i class="fa-solid fa-circle-plus"></i>
                            </a>
                        @endif
                    </div>

                    <!-- Profile Circle Avatar -->
                    @if(isset($authUser))
                        <div class="flex items-center pl-2 border-l border-slate-200/60">
                            <a href="{{ route('profile.show') }}" class="flex items-center group" title="Profil & Pengaturan">
                                <img src="{{ $authUser->profile_photo ? asset($authUser->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($authUser->name).'&background=e69b00&color=fff&bold=true' }}" 
                                     alt="Profile photo" 
                                     class="w-10 h-10 rounded-full object-cover border-2 {{ request()->routeIs('profile.show') ? 'border-[#e6b400] shadow-[0_0_15px_rgba(230,180,0,0.4)]' : 'border-slate-200' }} shadow-sm avatar-glow transition-all">
                            </a>
                        </div>
                    @else
                        <!-- Guest Buttons -->
                        <div class="flex items-center gap-1 pl-2 border-l border-slate-200/60">
                            <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-[#e69b00] px-3 py-2 text-xs transition-colors nav-icon-glow">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-4 py-2 rounded-xl text-white btn-gradient-yellow font-semibold text-xs shadow-lg shadow-[#e69b00]/25">
                                Daftar
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content Wrapper -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer with Yellow Gradient - All Text White -->
    <footer class="footer-yellow pt-12 pb-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-b border-white/20 pb-8 mb-8">
                <!-- Brand logo -->
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-md border border-white/30">
                        <i class="fa-solid fa-images text-white text-sm"></i>
                    </div>
                    <span class="font-chewy text-2xl tracking-wide">GudangMeme</span>
                </div>
                <div class="flex flex-wrap justify-center gap-6 text-sm">
                    <a href="{{ route('feed') }}" class="transition-colors">Feed Eksplorasi</a>
                    <a href="{{ isset($authUser) ? route('profile.show') : route('login') }}" class="transition-colors">Profil Saya</a>
                    <a href="https://github.com" target="_blank" class="transition-colors">Repositori</a>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center justify-between text-xs gap-4 opacity-90">
                <p>&copy; {{ date('Y') }} GudangMeme. Tugas Besar Pemrograman Web Kelompok 1.</p>
                <p class="flex items-center gap-1">Dibuat dengan <i class="fa-solid fa-heart text-red-300"></i> & Laravel</p>
            </div>
        </div>
    </footer>

    @livewireScripts
    @stack('scripts')
</body>
</html>