<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <title>@yield('title', 'GudangMeme - Simpan & Berbagi Inspirasi Visual')</title>

    <!-- Google Fonts (Outfit, Averia Libre, Chewy, Comic Relief) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Chewy&family=Comic+Relief:wght@400;700&family=Outfit:wght@100..900&display=swap" rel="stylesheet">

    <!-- Icons (FontAwesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom CSS Fallbacks for animations and glassmorphism styling -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    <!-- Custom JS File containing alerts and toggles -->
    <script src="{{ asset('assets/js/custom.js') }}" defer></script>

    <!-- Vite: CSS (Tailwind v4) & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
    @stack('styles')
</head>
<body class="bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col" data-session-success="{{ session('success') }}" data-session-error="{{ session('error') }}">

    <!-- Glassmorphic Navbar with Soft Yellow Glow -->
    <nav class="sticky top-4 mx-auto max-w-[1600px] w-[95%] sm:w-[92%] z-50 navbar-glow rounded-2xl transition-all duration-300" x-data="{ mobileSearchOpen: false }">
        <div class="max-w-[1600px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 md:h-18 gap-4 w-full">
                <!-- Logo & Brand (Left) -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <a href="{{ route('feed') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 rounded-xl logo-icon-glow flex items-center justify-center bg-white overflow-hidden p-1">
                            <img src="{{ asset('assets/images/icons/gudangmeme-icon.png') }}" alt="Logo" class="w-full h-full object-contain">
                        </div>
                        <span class="font-chewy text-2xl md:text-3xl tracking-wide hidden sm:inline">
                            <span class="text-gradient-yellow">Gudang</span><span class="text-gradient-yellow">Meme</span>
                        </span>
                    </a>
                </div>

                <!-- Search Box (Center) -->
                <div 
                    class="flex-grow max-w-xl relative hidden md:block group"
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
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none z-10">
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
                        <!-- Mobile Search Toggle Button -->
                        <button 
                            @click="mobileSearchOpen = !mobileSearchOpen" 
                            type="button"
                            class="md:hidden p-2.5 rounded-xl text-base nav-icon-glow transition-all focus:outline-none cursor-pointer" 
                            :class="mobileSearchOpen ? 'active' : 'text-slate-600'"
                            title="Cari Meme"
                        >
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>

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

            <!-- Mobile Search Bar (Toggleable) -->
            <div 
                x-show="mobileSearchOpen"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -translate-y-2"
                x-transition:enter-end="opacity-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 translate-y-0"
                x-transition:leave-end="opacity-0 -translate-y-2"
                class="md:hidden pb-4 pt-1"
                style="display: none;"
            >
                <div 
                    class="relative w-full group"
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
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none z-10">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 text-sm group-focus-within:text-[#e69b00] transition-colors"></i>
                    </div>
                    <input 
                        type="text" 
                        @input.debounce.300ms="handleSearch($event)"
                        value="{{ request('search') }}"
                        placeholder="Cari meme..."
                        class="search-glow block w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 bg-white/80 backdrop-blur-sm placeholder-slate-400 text-slate-800 focus:outline-none transition-all text-xs shadow-sm hover:border-[#e6cc00]/50"
                    >
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