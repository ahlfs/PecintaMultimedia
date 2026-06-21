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

    <!-- Tailwind CSS CDN (with brand palette customization) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            primary: '#293681',
                            accent: '#4274D9',
                            'accent-light': '#95CCDD',
                            'bg-light': '#D0E7E6',
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

    @stack('styles')
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col selection:bg-brand-accent/20 selection:text-brand-primary" data-session-success="{{ session('success') }}" data-session-error="{{ session('error') }}">

    <!-- Glassmorphic Navbar -->
    <nav class="sticky top-4 mx-auto max-w-7xl w-[95%] sm:w-[92%] z-50 glassmorphism rounded-2xl border border-white/40 shadow-xl transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-18">
                <!-- Logo & Brand -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('feed') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-brand-primary flex items-center justify-center shadow-lg shadow-brand-primary/20">
                            <i class="fa-solid fa-images text-white text-lg"></i>
                        </div>
                        <span class="font-chewy text-2xl md:text-3xl text-brand-primary tracking-wide">Gudang<span class="text-brand-accent">Meme</span></span>
                    </a>
                </div>

                <!-- Navigation Links (Only visible if authenticated or on feed) -->
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('feed') }}" class="font-semibold {{ request()->routeIs('feed') ? 'text-brand-accent' : 'text-slate-600 hover:text-brand-primary' }} transition-colors">
                        <i class="fa-solid fa-compass mr-1"></i> Eksplorasi
                    </a>
                    @if(isset($authUser))
                        <a href="{{ route('collections.index') }}" class="font-semibold {{ request()->routeIs('collections.*') ? 'text-brand-accent' : 'text-slate-600 hover:text-brand-primary' }} transition-colors">
                            <i class="fa-solid fa-folder-open mr-1"></i> Koleksi Saya
                        </a>
                        <a href="#" class="font-semibold text-slate-600 hover:text-brand-primary transition-colors">
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
                                <img src="{{ $authUser->profile_photo ? asset($authUser->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($authUser->name).'&background=293681&color=fff&bold=true' }}" 
                                     alt="Profile photo" 
                                     class="w-10 h-10 rounded-xl object-cover border border-slate-200 shadow-sm group-hover:scale-105 transition-all">
                                <div class="hidden lg:flex flex-col text-left">
                                    <span class="text-sm font-bold text-slate-800 group-hover:text-brand-primary transition-colors leading-none mb-0.5">{{ $authUser->name }}</span>
                                    <span class="text-xs text-slate-500 font-medium leading-none">@ {{ $authUser->username }}</span>
                                </div>
                            </a>
                            
                            <!-- Profile Edit Shortcut -->
                            <a href="{{ route('profile.edit') }}" title="Edit Profil" class="p-2 rounded-xl text-slate-500 hover:text-brand-primary hover:bg-slate-100/50 transition-all">
                                <i class="fa-solid fa-gear text-lg"></i>
                            </a>

                            <!-- Logout Button -->
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" title="Keluar" class="p-2 rounded-xl text-red-500 hover:text-red-600 hover:bg-red-50/50 transition-all cursor-pointer">
                                    <i class="fa-solid fa-right-from-bracket text-lg"></i>
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Guest Buttons -->
                        <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-brand-primary px-4 py-2 text-sm transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-white bg-brand-accent hover:bg-brand-accent/90 font-semibold text-sm transition-all duration-300 shadow-md shadow-brand-accent/15 hover:shadow-lg">
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

    <!-- Footer -->
    <footer class="bg-brand-primary text-white pt-12 pb-8 mt-12 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 border-b border-white/10 pb-8 mb-8">
                <!-- Brand logo -->
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-images text-brand-primary text-sm"></i>
                    </div>
                    <span class="font-chewy text-2xl text-white tracking-wide">Gudang<span class="text-brand-accent-light">Meme</span></span>
                </div>
                <div class="flex flex-wrap justify-center gap-6 text-sm text-slate-300">
                    <a href="{{ route('feed') }}" class="hover:text-white transition-colors">Feed Eksplorasi</a>
                    <a href="{{ isset($authUser) ? route('profile.edit') : route('login') }}" class="hover:text-white transition-colors">Pengaturan Profil</a>
                    <a href="https://github.com" target="_blank" class="hover:text-white transition-colors">Repositori</a>
                </div>
            </div>
            <div class="flex flex-col sm:flex-row items-center justify-between text-xs text-slate-400 gap-4">
                <p>&copy; {{ date('Y') }} GudangMeme. Tugas Besar Pemrograman Web Kelompok 1.</p>
                <p class="flex items-center gap-1">Dibuat dengan <i class="fa-solid fa-heart text-red-500"></i> & Laravel</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
