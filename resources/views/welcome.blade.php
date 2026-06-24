<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
               YELLOW GLOWING THEME - LANDING PAGE
               ============================================ */
            
            /* Glowing Navbar Border Effect */
            .navbar-glow {
                position: relative;
                background: rgba(255, 255, 255, 0.75);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border: 1px solid rgba(230, 180, 0, 0.25);
                box-shadow: 
                    0 0 30px rgba(230, 155, 0, 0.15),
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
            
            .nav-link-yellow:hover::after {
                width: 80%;
            }
            
            .nav-link-yellow:hover {
                color: #e69b00 !important;
                text-shadow: 0 0 10px rgba(230, 155, 0, 0.3);
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
            .footer-yellow div,
            .footer-yellow h4,
            .footer-yellow li,
            .footer-yellow ul {
                color: #ffffff !important;
            }
            
            .footer-yellow a:hover {
                color: #fff4cc !important;
                text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            }
            
            /* CTA Section Gradient */
            .cta-gradient-yellow {
                background: linear-gradient(135deg, #e69b00 0%, #d48a00 30%, #e6b400 60%, #e6cc00 100%);
                position: relative;
                overflow: hidden;
            }
            
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
            
            /* Feature Card Glow */
            .feature-card-yellow:hover {
                border-color: rgba(230, 180, 0, 0.4) !important;
                box-shadow: 
                    0 10px 40px rgba(230, 155, 0, 0.15),
                    0 0 20px rgba(230, 180, 0, 0.1);
            }
            
            /* Step Number Glow */
            .step-number-glow {
                background: linear-gradient(135deg, #e69b00 0%, #e6b400 100%);
                box-shadow: 
                    0 4px 15px rgba(230, 155, 0, 0.4),
                    0 0 20px rgba(230, 180, 0, 0.2);
                transition: all 0.3s ease;
            }
            
            .step-number-glow:hover {
                box-shadow: 
                    0 6px 25px rgba(230, 155, 0, 0.6),
                    0 0 35px rgba(230, 180, 0, 0.4);
                transform: scale(1.1);
            }
            
            /* Search Bar Focus Glow */
            .search-glow:focus {
                box-shadow: 
                    0 0 0 4px rgba(230, 180, 0, 0.15),
                    0 0 30px rgba(230, 155, 0, 0.2),
                    0 20px 40px rgba(0, 0, 0, 0.1);
            }
            
            /* Selection Color */
            ::selection {
                background: rgba(230, 180, 0, 0.25) !important;
                color: #e69b00 !important;
            }
            
            /* Background Glow Shapes */
            .bg-glow-yellow-landing-1 {
                background: radial-gradient(circle, rgba(230, 180, 0, 0.12) 0%, transparent 70%);
            }
            
            .bg-glow-yellow-landing-2 {
                background: radial-gradient(circle, rgba(230, 155, 0, 0.1) 0%, transparent 70%);
            }
            
            /* Icon container glow */
            .icon-container-yellow {
                background: linear-gradient(135deg, rgba(230, 155, 0, 0.1) 0%, rgba(230, 180, 0, 0.15) 100%);
                transition: all 0.3s ease;
            }
            
            .icon-container-yellow:hover {
                background: linear-gradient(135deg, #e69b00 0%, #e6b400 100%);
                box-shadow: 0 4px 20px rgba(230, 155, 0, 0.4);
            }
            
            /* How it works section bg */
            .how-it-works-bg {
                background: linear-gradient(180deg, rgba(255, 244, 204, 0.3) 0%, rgba(255, 250, 230, 0.5) 100%);
            }
        </style>
    </head>
    <body class="bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col">
        
        <!-- Glassmorphic Navbar with Yellow Glow -->
        <nav class="sticky top-4 mx-auto max-w-7xl w-[95%] sm:w-[92%] z-50 navbar-glow rounded-2xl transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 md:h-18">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl logo-icon-glow flex items-center justify-center">
                            <i class="fa-solid fa-images text-white text-lg"></i>
                        </div>
                        <span class="font-chewy text-2xl md:text-3xl tracking-wide">
                            <span class="text-gradient-yellow">Gudang</span><span class="text-gradient-yellow">Meme</span>
                        </span>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center gap-8">
                        <a href="{{ route('feed') }}" class="font-medium text-slate-600 nav-link-yellow">Eksplorasi</a>
                        <a href="#features" class="font-medium text-slate-600 nav-link-yellow">Fitur</a>
                        <a href="#how-it-works" class="font-medium text-slate-600 nav-link-yellow">Cara Kerja</a>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('feed') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-white btn-gradient-yellow font-semibold text-sm shadow-lg shadow-[#e69b00]/25">
                                    Masuk ke Feed
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="font-semibold text-slate-600 nav-link-yellow px-4 py-2 text-sm">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-white btn-gradient-yellow font-semibold text-sm shadow-lg shadow-[#e69b00]/25">
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
            <div class="absolute top-0 right-0 -z-10 w-96 h-96 bg-glow-yellow-landing-1 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -z-10 w-80 h-80 bg-glow-yellow-landing-2 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Centered Headline, Subheadline and Floating Search Bar -->
            <div class="max-w-4xl mx-auto px-4 text-center z-20 animate-fade-in-up">
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-gradient-yellow tracking-tight leading-tight mb-4">
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
                        class="search-glow w-full pl-12 pr-28 py-4 rounded-full border-2 border-slate-200 bg-white/95 backdrop-blur-md focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] shadow-xl shadow-slate-200/40 text-slate-800 placeholder-slate-400 transition-all text-sm sm:text-base hover:border-[#e6cc00]/50"
                    >
                    <button 
                        type="submit" 
                        class="absolute right-2 top-2 bottom-2 px-6 btn-gradient-yellow text-white rounded-full font-bold text-sm shadow-lg shadow-[#e69b00]/25"
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
                    <a href="{{ route('feed') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-white btn-gradient-yellow font-bold shadow-xl shadow-[#e69b00]/30">
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
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gradient-yellow tracking-tight">
                        Mengapa Memilih Platform Kami?
                    </h2>
                    <p class="text-lg text-slate-600 mt-4">
                        Didesain khusus untuk mempermudah alur kreasi dan berbagi gambar secara modern, cepat, dan reaktif.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <!-- Feature 1 -->
                    <div class="feature-card-yellow group relative overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 hover:bg-white p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl icon-container-yellow flex items-center justify-center mb-6">
                            <i class="fa-solid fa-folder-plus text-[#e69b00] text-xl group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gradient-yellow mb-3">📌 Kustomisasi Collection Tanpa Batas</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Kelompokkan postingan kesukaanmu, meme terfavorit, atau referensi desain ke dalam Collection pribadi atau publik. Atur privasimu sendiri dengan satu klik.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="feature-card-yellow group relative overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 hover:bg-white p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl icon-container-yellow flex items-center justify-center mb-6">
                            <i class="fa-solid fa-bolt text-[#e6b400] text-xl group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gradient-yellow mb-3">⚡ Interaksi Real-Time yang Responsif</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Rasakan pengalaman menjelajah yang super mulus tanpa reload halaman. Berikan likes dan diskusikan ide di kolom komentar secara instan berkat dukungan teknologi Livewire.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="feature-card-yellow group relative overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 hover:bg-white p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl icon-container-yellow flex items-center justify-center mb-6">
                            <i class="fa-solid fa-table-cells text-[#e6cc00] text-xl group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gradient-yellow mb-3">🧱 Desain Masonry Grid yang Estetik</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Nikmati tampilan feed yang dinamis, bersih, dan memanjakan mata. Layout grid adaptif kami memastikan setiap foto and meme tampil dalam proporsi terbaiknya, baik di desktop maupun smartphone.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- "How It Works" Section -->
        <section id="how-it-works" class="py-20 md:py-28 how-it-works-bg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-gradient-yellow tracking-tight">
                        Mulai Langkah Kreatifmu dalam 3 Tahap Mudah:
                    </h2>
                    <p class="text-lg text-slate-600 mt-4">
                        Hanya butuh beberapa detik untuk mulai menjadi bagian dari komunitas visual sharing kami.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Step 1 -->
                    <div class="relative bg-white rounded-3xl p-8 shadow-md border border-slate-100 hover:shadow-xl hover:shadow-[#e6b400]/10 transition-all duration-300">
                        <div class="absolute -top-6 left-8 w-12 h-12 rounded-2xl step-number-glow text-white flex items-center justify-center font-extrabold text-lg">
                            01
                        </div>
                        <h3 class="text-xl font-bold text-gradient-yellow mt-4 mb-3">Buat Akun & Profilmu</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Daftar dengan cepat, lengkapi bio, dan pasang foto profil terbaikmu untuk mulai membangun persona visualmu secara aman.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative bg-white rounded-3xl p-8 shadow-md border border-slate-100 hover:shadow-xl hover:shadow-[#e6b400]/10 transition-all duration-300">
                        <div class="absolute -top-6 left-8 w-12 h-12 rounded-2xl step-number-glow text-white flex items-center justify-center font-extrabold text-lg">
                            02
                        </div>
                        <h3 class="text-xl font-bold text-gradient-yellow mt-4 mb-3">Unggah & Temukan Konten</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Unggah karya visual atau meme andalanmu langsung dari perangkat. Tambahkan tag dan deskripsi menarik agar mudah ditemukan oleh pengguna lain.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative bg-white rounded-3xl p-8 shadow-md border border-slate-100 hover:shadow-xl hover:shadow-[#e6b400]/10 transition-all duration-300">
                        <div class="absolute -top-6 left-8 w-12 h-12 rounded-2xl step-number-glow text-white flex items-center justify-center font-extrabold text-lg">
                            03
                        </div>
                        <h3 class="text-xl font-bold text-gradient-yellow mt-4 mb-3">Simpan & Organisasikan</h3>
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
                <div class="relative overflow-hidden rounded-[2.5rem] cta-gradient-yellow text-white px-8 py-16 md:p-20 shadow-2xl shadow-[#e69b00]/30 text-center">
                    
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
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-yellow text-[#e69b00] hover:bg-yellow/95 font-bold text-base transition-all duration-300 shadow-xl hover:scale-[1.05] btn-glow-yellow">
                            Daftar Akun Baru
                            <i class="fa-solid fa-user-plus ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer with Yellow Gradient - All Text White -->
        <footer class="footer-yellow pt-16 pb-12 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
                    
                    <!-- Brand Section -->
                    <div class="md:col-span-5 flex flex-col items-start">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-sm flex items-center justify-center shadow-md border border-white/30">
                                <i class="fa-solid fa-images text-white text-sm"></i>
                            </div>
                            <span class="font-chewy text-2xl tracking-wide">GudangMeme</span>
                        </div>
                        <p class="text-sm leading-relaxed max-w-sm mb-4 opacity-90">
                            Platform interaktif berbagi dan menyimpan inspirasi visual, foto estetik, hingga meme terlucu kelompok Anda.
                        </p>
                        <p class="text-xs opacity-80">
                            &copy; {{ date('Y') }} GudangMeme. Hak Cipta Dilindungi.
                        </p>
                    </div>

                    <!-- Links Section -->
                    <div class="md:col-span-3">
                        <h4 class="font-bold text-sm tracking-wider uppercase mb-4 opacity-90">Akses Cepat</h4>
                        <ul class="space-y-2.5 text-sm">
                            <li><a href="{{ route('feed') }}" class="transition-colors">Eksplorasi Feed</a></li>
                            <li><a href="#features" class="transition-colors">Fitur Utama</a></li>
                            <li><a href="#how-it-works" class="transition-colors">Cara Kerja</a></li>
                            <li><a href="{{ route('login') }}" class="transition-colors">Halaman Masuk</a></li>
                        </ul>
                    </div>

                    <!-- Team Section -->
                    <div class="md:col-span-4">
                        <h4 class="font-bold text-sm tracking-wider uppercase mb-4 opacity-90">Tim Pengembang (Kelompok 1)</h4>
                        <ul class="space-y-2 text-xs">
                            <li class="flex justify-between border-b border-white/10 pb-1">
                                <span class="font-medium">Muhamad Alamsyah A. F. (Ketua)</span>
                                <span class="opacity-70">241110014</span>
                            </li>
                            <li class="flex justify-between border-b border-white/10 pb-1">
                                <span class="font-medium">Afriza Marshal Verdiasta</span>
                                <span class="opacity-70">241110057</span>
                            </li>
                            <li class="flex justify-between border-b border-white/10 pb-1">
                                <span class="font-medium">Muhammad Alfiano Akmal Zen</span>
                                <span class="opacity-70">241110053</span>
                            </li>
                            <li class="flex justify-between border-b border-white/10 pb-1">
                                <span class="font-medium">Handika Wijaksono</span>
                                <span class="opacity-70">241110095</span>
                            </li>
                            <li class="flex justify-between border-b border-white/10 pb-1">
                                <span class="font-medium">Rizqy Naufal Pradana</span>
                                <span class="opacity-70">241110088</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>

    </body>
</html>