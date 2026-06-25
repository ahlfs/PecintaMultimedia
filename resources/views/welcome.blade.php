<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

        <title>GudangMeme - Berbagi & Simpan Inspirasi Visual</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Averia+Libre:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&family=Chewy&family=Comic+Relief:wght@400;700&display=swap" rel="stylesheet">

        <!-- Icons (FontAwesome) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            /* ============================================
               MINIMAL CUSTOM CSS - ONLY FOR KEYFRAMES & PSEUDO-ELEMENTS
               yang tidak bisa di-replace oleh Tailwind
               ============================================ */
            
            /* Selection Color */
            ::selection {
                background: rgba(230, 180, 0, 0.25) !important;
                color: #e69b00 !important;
            }
            
            /* Navbar Glow - Animated Gradient Border (SOFT VERSION) */
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
                filter: blur(6px);
                opacity: 0.2;
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
            
            .nav-link-yellow:hover::after {
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
            
            /* CTA Section Decorative Gradient */
            .cta-gradient-yellow::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                            radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
            }
            
            /* Float Animations for Grid Items */
            @keyframes float {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-10px); }
            }
            
            @keyframes float-delayed {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-8px); }
            }
            
            .animate-float {
                animation: float 3s ease-in-out infinite;
            }
            
            .animate-float-delayed {
                animation: float-delayed 3.5s ease-in-out infinite;
                animation-delay: 0.5s;
            }
            
            /* Fade In Up Animation */
            @keyframes fade-in-up {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            .animate-fade-in-up {
                animation: fade-in-up 0.8s ease-out forwards;
            }
        </style>
    </head>
    <body class="bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col">
        
        <!-- Glassmorphic Navbar with SOFT Yellow Glow -->
        <nav class="sticky top-4 mx-auto max-w-7xl w-[95%] sm:w-[92%] z-50 navbar-glow bg-white/85 backdrop-blur-[16px] border border-[#e6b400]/15 shadow-[0_0_20px_rgba(230,155,0,0.08),0_0_40px_rgba(230,180,0,0.04),inset_0_1px_0_rgba(255,255,255,0.9)] rounded-2xl transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 md:h-18">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white logo-icon-glow shadow-[0_4px_12px_rgba(230,155,0,0.3)] hover:shadow-[0_4px_15px_rgba(230,155,0,0.4)] hover:scale-105 transition-all duration-300 flex items-center justify-center overflow-hidden p-1 border border-[#e6b400]/20">
                            <img src="{{ asset('assets/images/icons/gudangmeme-icon.png') }}" alt="Logo" class="w-full h-full object-contain">
                        </div>
                        <span class="font-['Chewy'] text-2xl md:text-3xl tracking-wide">
                            <span class="bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent">Gudang</span><span class="bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent">Meme</span>
                        </span>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center gap-8">
                        <a href="{{ route('feed') }}" class="relative font-medium text-slate-600 nav-link-yellow hover:text-[#e69b00] transition-all duration-300">Eksplorasi</a>
                        <a href="#features" class="relative font-medium text-slate-600 nav-link-yellow hover:text-[#e69b00] transition-all duration-300">Fitur</a>
                        <a href="#how-it-works" class="relative font-medium text-slate-600 nav-link-yellow hover:text-[#e69b00] transition-all duration-300">Cara Kerja</a>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('feed') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-white bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] hover:shadow-[0_0_20px_rgba(230,155,0,0.4)] hover:-translate-y-0.5 font-semibold text-sm shadow-lg shadow-[#e69b00]/20 transition-all duration-300 relative overflow-hidden btn-gradient-yellow">
                                    Masuk ke Feed
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="relative font-semibold text-slate-600 nav-link-yellow hover:text-[#e69b00] transition-all duration-300 px-4 py-2 text-sm">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-white bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] hover:shadow-[0_0_20px_rgba(230,155,0,0.4)] hover:-translate-y-0.5 font-semibold text-sm shadow-lg shadow-[#e69b00]/20 transition-all duration-300 relative overflow-hidden btn-gradient-yellow">
                                        Mulai Eksplorasi
                                    </a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <!-- Pinterest-like Meme Hero Section -->
        <header class="relative overflow-hidden pt-12 bg-slate-50 flex flex-col items-center">
            <!-- Background Gradients with yellow palette -->
            <div class="absolute top-0 right-0 -z-10 w-96 h-96 bg-[radial-gradient(circle,rgba(230,180,0,0.12)_0%,transparent_70%)] rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -z-10 w-80 h-80 bg-[radial-gradient(circle,rgba(230,155,0,0.1)_0%,transparent_70%)] rounded-full blur-3xl pointer-events-none"></div>

            <!-- Centered Headline, Subheadline and Floating Search Bar -->
            <div class="max-w-4xl mx-auto px-4 text-center z-20 animate-fade-in-up">
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent tracking-tight leading-tight mb-4">
                    Tempat Terbaik Menyimpan & Berbagi Inspirasi Visual Kamu.
                </h1>
                
                <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto mb-8">
                    Jelajahi ribuan ide, foto estetik, hingga meme terlucu dalam satu platform interaktif. Organisasikan kreativitasmu ke dalam kustom Collection dengan mudah dan cepat.
                </p>
                
                <!-- Floating Search Pill -->
                <form action="{{ route('feed') }}" method="GET" class="w-full max-w-2xl mx-auto relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 group-focus-within:text-[#e69b00] transition-colors"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari meme, foto estetik, referensi desain..." 
                        class="w-full pl-12 pr-28 py-4 rounded-full border-2 border-slate-200 bg-white/95 backdrop-blur-md focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] shadow-xl shadow-slate-200/40 text-slate-800 placeholder-slate-400 transition-all text-sm sm:text-base hover:border-[#e6cc00]/50"
                    >
                    <button 
                        type="submit" 
                        class="absolute right-2 top-2 bottom-2 px-6 bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] text-white rounded-full font-bold text-sm shadow-lg shadow-[#e69b00]/25 transition-all duration-300 relative overflow-hidden btn-gradient-yellow"
                    >
                        Cari
                    </button>
                </form>
            </div>

            <!-- Massive Staggered Masonry Meme Grid -->
            <div class="relative w-full max-h-[550px] overflow-hidden mt-12 z-10 px-4 sm:px-6 lg:px-8">
                
                <div class="columns-2 sm:columns-3 md:columns-4 lg:columns-5 xl:columns-6 gap-4 max-w-[1600px] mx-auto">
                    
                    <!-- Grid Card items using meme images -->
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme1.jpg') }}" alt="Meme 1" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>
                    
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme7.jpg') }}" alt="Meme 7" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme2.jpg') }}" alt="Meme 2" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme8.jpg') }}" alt="Meme 8" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme3.jpg') }}" alt="Meme 3" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme9.jpg') }}" alt="Meme 9" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme4.jpg') }}" alt="Meme 4" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme10.jpg') }}" alt="Meme 10" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme5.jpg') }}" alt="Meme 5" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme6.jpg') }}" alt="Meme 6" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme11.jpg') }}" alt="Meme 2 repeat" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:shadow-[#e6b400]/20 hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme12.jpg') }}" alt="Meme 4 repeat" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                </div>

                <!-- White Fading Gradient Shadow at Grid Bottom -->
                <div class="absolute bottom-0 left-0 right-0 h-44 bg-gradient-to-t from-slate-50 via-slate-50/95 to-transparent flex items-end justify-center pb-8 z-20">
                    <!-- Pill Button Show All -->
                    <a href="{{ route('feed') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-white bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] hover:shadow-[0_0_30px_rgba(230,155,0,0.5),0_0_60px_rgba(230,180,0,0.3)] hover:-translate-y-0.5 font-bold shadow-xl shadow-[#e69b00]/30 transition-all duration-300 relative overflow-hidden btn-gradient-yellow">
                        Lihat Semua Meme
                        <i class="fa-solid fa-arrow-down-long animate-bounce text-sm"></i>
                    </a>
                </div>

            </div>
        </header>

        <!-- Value Proposition Section -->
        <section id="features" class="py-20 md:py-28 bg-white border-y border-slate-200/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl sm:text-4xl font-extrabold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent tracking-tight">
                        Mengapa Memilih Platform Kami?
                    </h2>
                    <p class="text-lg text-slate-600 mt-4">
                        Didesain khusus untuk mempermudah alur kreasi dan berbagi gambar secara modern, cepat, dan reaktif.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <!-- Feature 1 -->
                    <div class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 hover:bg-white hover:border-[#e6b400]/40 hover:shadow-[0_10px_40px_rgba(230,155,0,0.15),0_0_20px_rgba(230,180,0,0.1)] p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#e69b00]/10 to-[#e6b400]/15 hover:bg-gradient-to-br hover:from-[#e69b00] hover:to-[#e6b400] hover:shadow-[0_4px_20px_rgba(230,155,0,0.4)] flex items-center justify-center mb-6 transition-all duration-300">
                            <i class="fa-solid fa-folder-plus text-[#e69b00] text-xl group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent mb-3">📌 Kustomisasi Collection Tanpa Batas</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Kelompokkan postingan kesukaanmu, meme terfavorit, atau referensi desain ke dalam Collection pribadi atau publik. Atur privasimu sendiri dengan satu klik.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 hover:bg-white hover:border-[#e6b400]/40 hover:shadow-[0_10px_40px_rgba(230,155,0,0.15),0_0_20px_rgba(230,180,0,0.1)] p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#e69b00]/10 to-[#e6b400]/15 hover:bg-gradient-to-br hover:from-[#e69b00] hover:to-[#e6b400] hover:shadow-[0_4px_20px_rgba(230,155,0,0.4)] flex items-center justify-center mb-6 transition-all duration-300">
                            <i class="fa-solid fa-bolt text-[#e6b400] text-xl group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent mb-3">⚡ Interaksi Real-Time yang Responsif</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Rasakan pengalaman menjelajah yang super mulus tanpa reload halaman. Berikan likes dan diskusikan ide di kolom komentar secara instan berkat dukungan teknologi Livewire.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 hover:bg-white hover:border-[#e6b400]/40 hover:shadow-[0_10px_40px_rgba(230,155,0,0.15),0_0_20px_rgba(230,180,0,0.1)] p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#e69b00]/10 to-[#e6b400]/15 hover:bg-gradient-to-br hover:from-[#e69b00] hover:to-[#e6b400] hover:shadow-[0_4px_20px_rgba(230,155,0,0.4)] flex items-center justify-center mb-6 transition-all duration-300">
                            <i class="fa-solid fa-table-cells text-[#e6cc00] text-xl group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent mb-3">🧱 Desain Masonry Grid yang Estetik</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Nikmati tampilan feed yang dinamis, bersih, dan memanjakan mata. Layout grid adaptif kami memastikan setiap foto and meme tampil dalam proporsi terbaiknya, baik di desktop maupun smartphone.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- "How It Works" Section -->
        <section id="how-it-works" class="py-20 md:py-28 bg-gradient-to-b from-[#fff4cc]/30 to-[#fffae6]/50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl sm:text-4xl font-extrabold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent tracking-tight">
                        Mulai Langkah Kreatifmu dalam 3 Tahap Mudah:
                    </h2>
                    <p class="text-lg text-slate-600 mt-4">
                        Hanya butuh beberapa detik untuk mulai menjadi bagian dari komunitas visual sharing kami.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Step 1 -->
                    <div class="relative bg-white rounded-3xl p-8 shadow-md border border-slate-100 hover:shadow-xl hover:shadow-[#e6b400]/10 transition-all duration-300">
                        <div class="absolute -top-6 left-8 w-12 h-12 rounded-2xl bg-gradient-to-br from-[#e69b00] to-[#e6b400] shadow-[0_4px_15px_rgba(230,155,0,0.4),0_0_20px_rgba(230,180,0,0.2)] hover:shadow-[0_6px_25px_rgba(230,155,0,0.6),0_0_35px_rgba(230,180,0,0.4)] hover:scale-110 text-white flex items-center justify-center font-extrabold text-lg transition-all duration-300">
                            01
                        </div>
                        <h3 class="text-xl font-bold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent mt-4 mb-3">Buat Akun & Profilmu</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Daftar dengan cepat, lengkapi bio, dan pasang foto profil terbaikmu untuk mulai membangun persona visualmu secara aman.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative bg-white rounded-3xl p-8 shadow-md border border-slate-100 hover:shadow-xl hover:shadow-[#e6b400]/10 transition-all duration-300">
                        <div class="absolute -top-6 left-8 w-12 h-12 rounded-2xl bg-gradient-to-br from-[#e69b00] to-[#e6b400] shadow-[0_4px_15px_rgba(230,155,0,0.4),0_0_20px_rgba(230,180,0,0.2)] hover:shadow-[0_6px_25px_rgba(230,155,0,0.6),0_0_35px_rgba(230,180,0,0.4)] hover:scale-110 text-white flex items-center justify-center font-extrabold text-lg transition-all duration-300">
                            02
                        </div>
                        <h3 class="text-xl font-bold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent mt-4 mb-3">Unggah & Temukan Konten</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Unggah karya visual atau meme andalanmu langsung dari perangkat. Tambahkan tag dan deskripsi menarik agar mudah ditemukan oleh pengguna lain.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative bg-white rounded-3xl p-8 shadow-md border border-slate-100 hover:shadow-xl hover:shadow-[#e6b400]/10 transition-all duration-300">
                        <div class="absolute -top-6 left-8 w-12 h-12 rounded-2xl bg-gradient-to-br from-[#e69b00] to-[#e6b400] shadow-[0_4px_15px_rgba(230,155,0,0.4),0_0_20px_rgba(230,180,0,0.2)] hover:shadow-[0_6px_25px_rgba(230,155,0,0.6),0_0_35px_rgba(230,180,0,0.4)] hover:scale-110 text-white flex items-center justify-center font-extrabold text-lg transition-all duration-300">
                            03
                        </div>
                        <h3 class="text-xl font-bold bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] bg-clip-text text-transparent mt-4 mb-3">Simpan & Organisasikan</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Menemukan konten yang menarik saat scrolling? Cukup simpan konten tersebut langsung ke dalam salah satu Collection milikmu sendiri.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="py-16 md:py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-br from-[#e69b00] via-[#d48a00] to-[#e6cc00] text-white px-8 py-16 md:p-20 shadow-2xl shadow-[#e69b00]/30 text-center cta-gradient-yellow">
                    
                    <!-- Decorative shapes -->
                    <div class="absolute top-0 left-0 w-80 h-80 bg-white/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
                    <div class="absolute bottom-0 right-0 w-80 h-80 bg-[#e6cc00]/20 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

                    <div class="relative z-10 max-w-3xl mx-auto">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-6 drop-shadow-lg">
                            Siap untuk Mengorganisasi Inspirasimu?
                        </h2>
                        <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl mx-auto drop-shadow">
                            Gabung sekarang secara gratis dan mulailah menyusun koleksi visual unikmu hari ini.
                        </p>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-white text-[#e69b00] hover:bg-white/95 font-bold text-base transition-all duration-300 shadow-xl hover:scale-105 relative overflow-hidden btn-glow-yellow hover:shadow-[0_0_25px_rgba(230,155,0,0.5),0_0_50px_rgba(230,180,0,0.3)] hover:-translate-y-0.5">
                            Daftar Akun Baru
                            <i class="fa-solid fa-user-plus ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer with Yellow Gradient - All Text White -->
        <footer class="relative overflow-hidden bg-gradient-to-br from-[#e69b00] via-[#e6b400] to-[#e6cc00] pt-16 pb-12 mt-auto text-white footer-yellow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
                    
                    <!-- Brand Section -->
                    <div class="md:col-span-5 flex flex-col items-start">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-md border border-white/30">
                                <i class="fa-solid fa-images text-white text-sm"></i>
                            </div>
                            <span class="font-['Chewy'] text-2xl tracking-wide text-white">GudangMeme</span>
                        </div>
                        <p class="text-sm leading-relaxed max-w-sm mb-4 opacity-90 text-white">
                            Platform interaktif berbagi dan menyimpan inspirasi visual, foto estetik, hingga meme terlucu kelompok Anda.
                        </p>
                        <p class="text-xs opacity-80 text-white">
                            &copy; {{ date('Y') }} GudangMeme. Hak Cipta Dilindungi.
                        </p>
                    </div>

                    <!-- Links Section -->
                    <div class="md:col-span-3">
                        <h4 class="font-bold text-sm tracking-wider uppercase mb-4 opacity-90 text-white">Akses Cepat</h4>
                        <ul class="space-y-2.5 text-sm">
                            <li><a href="{{ route('feed') }}" class="text-white hover:text-[#fff4cc] transition-all">Eksplorasi Feed</a></li>
                            <li><a href="#features" class="text-white hover:text-[#fff4cc] transition-all">Fitur Utama</a></li>
                            <li><a href="#how-it-works" class="text-white hover:text-[#fff4cc] transition-all">Cara Kerja</a></li>
                            <li><a href="{{ route('login') }}" class="text-white hover:text-[#fff4cc] transition-all">Halaman Masuk</a></li>
                        </ul>
                    </div>

                    <!-- Team Section -->
                    <div class="md:col-span-4">
                        <h4 class="font-bold text-sm tracking-wider uppercase mb-4 opacity-90 text-white">Tim Pengembang (Kelompok 1)</h4>
                        <ul class="space-y-2 text-xs">
                            <li class="flex justify-between border-b border-white/10 pb-1">
                                <span class="font-medium text-white">Muhamad Alamsyah A. F. (Ketua)</span>
                                <span class="opacity-70 text-white">241110014</span>
                            </li>
                            <li class="flex justify-between border-b border-white/10 pb-1">
                                <span class="font-medium text-white">Afriza Marshal Verdiesta</span>
                                <span class="opacity-70 text-white">241110057</span>
                            </li>
                            <li class="flex justify-between border-b border-white/10 pb-1">
                                <span class="font-medium text-white">Muhammad Alfiano Akmal Zen</span>
                                <span class="opacity-70 text-white">241110053</span>
                            </li>
                            <li class="flex justify-between border-b border-white/10 pb-1">
                                <span class="font-medium text-white">Handika Wijaksono</span>
                                <span class="opacity-70 text-white">241110095</span>
                            </li>
                            <li class="flex justify-between border-b border-white/10 pb-1">
                                <span class="font-medium text-white">Rizqy Naufal Pradana</span>
                                <span class="opacity-70 text-white">241110088</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>

    </body>
</html>