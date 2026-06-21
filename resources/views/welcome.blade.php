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
    </head>
    <body class="bg-slate-50 font-sans text-slate-800 antialiased min-h-screen flex flex-col selection:bg-brand-accent/20 selection:text-brand-primary">
        
        <!-- Glassmorphic Navbar -->
        <nav class="sticky top-4 mx-auto max-w-7xl w-[95%] sm:w-[92%] z-50 glassmorphism rounded-2xl border border-white/40 shadow-xl transition-all duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16 md:h-18">
                    <!-- Logo -->
                    <div class="flex-shrink-0 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-brand-primary flex items-center justify-center shadow-lg shadow-brand-primary/20">
                            <i class="fa-solid fa-images text-white text-lg"></i>
                        </div>
                        <span class="font-chewy text-2xl md:text-3xl text-brand-primary tracking-wide">Gudang<span class="text-brand-accent">Meme</span></span>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden md:flex items-center gap-8">
                        <a href="{{ route('feed') }}" class="font-medium text-slate-600 hover:text-brand-primary transition-colors">Eksplorasi</a>
                        <a href="#features" class="font-medium text-slate-600 hover:text-brand-primary transition-colors">Fitur</a>
                        <a href="#how-it-works" class="font-medium text-slate-600 hover:text-brand-primary transition-colors">Cara Kerja</a>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex items-center gap-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('feed') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-white bg-brand-primary hover:bg-brand-primary/95 font-semibold text-sm transition-all duration-300 shadow-md shadow-brand-primary/10 hover:shadow-lg">
                                    Masuk ke Feed
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-brand-primary px-4 py-2 text-sm transition-colors">
                                    Masuk
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-5 py-2.5 rounded-xl text-white bg-brand-accent hover:bg-brand-accent/90 font-semibold text-sm transition-all duration-300 shadow-md shadow-brand-accent/15 hover:shadow-lg">
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
            <!-- Background Gradients -->
            <div class="absolute top-0 right-0 -z-10 w-96 h-96 bg-brand-accent/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -z-10 w-80 h-80 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Centered Headline, Subheadline and Floating Search Bar -->
            <div class="max-w-4xl mx-auto px-4 text-center z-20 animate-fade-in-up">
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-brand-primary tracking-tight leading-tight mb-4">
                    Tempat Terbaik Menyimpan & Berbagi Inspirasi Visual Kamu.
                </h1>
                
                <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto mb-8">
                    Jelajahi ribuan ide, foto estetik, hingga meme terlucu dalam satu platform interaktif. Organisasikan kreativitasmu ke dalam kustom Collection dengan mudah dan cepat.
                </p>
                
                <!-- Floating Search Pill -->
                <form action="{{ route('feed') }}" method="GET" class="w-full max-w-2xl mx-auto relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                    </div>
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari meme, foto estetik, referensi desain..." 
                        class="w-full pl-12 pr-28 py-4 rounded-full border border-slate-200 bg-white/95 backdrop-blur-md focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent shadow-xl shadow-slate-200/40 text-slate-800 placeholder-slate-400 transition-all text-sm sm:text-base"
                    >
                    <button 
                        type="submit" 
                        class="absolute right-2 top-2 bottom-2 px-6 bg-brand-accent hover:bg-brand-accent/90 text-white rounded-full font-bold text-sm transition-all duration-300 shadow-md shadow-brand-accent/20 hover:scale-[1.02]"
                    >
                        Cari
                    </button>
                </form>
            </div>

            <!-- Massive Staggered Masonry Meme Grid -->
            <div class="relative w-full max-h-[550px] overflow-hidden mt-12 z-10 px-4 sm:px-6 lg:px-8">
                
                <div class="columns-2 sm:columns-3 md:columns-4 lg:columns-5 xl:columns-6 gap-4 max-w-[1600px] mx-auto">
                    
                    <!-- Grid Card items using meme images -->
                    <!-- Row 1/2 Column 1 -->
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme1.jpg') }}" alt="Meme 1" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>
                    
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme7.jpg') }}" alt="Meme 7" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Column 2 -->
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme2.jpg') }}" alt="Meme 2" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme8.jpg') }}" alt="Meme 8" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Column 3 -->
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme3.jpg') }}" alt="Meme 3" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme9.jpg') }}" alt="Meme 9" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Column 4 -->
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme4.jpg') }}" alt="Meme 4" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme10.jpg') }}" alt="Meme 10" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Column 5 -->
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme5.jpg') }}" alt="Meme 5" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme6.jpg') }}" alt="Meme 6" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                    <!-- Extra looped memes for dense wall appearance on wide screens -->
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float-delayed">
                        <img src="{{ asset('assets/images/meme/meme11.jpg') }}" alt="Meme 2 repeat" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="break-inside-avoid mb-4 group relative overflow-hidden rounded-2xl border border-slate-200/50 bg-white shadow-sm hover:shadow-lg hover:scale-[1.02] transition-all duration-300 animate-float">
                        <img src="{{ asset('assets/images/meme/meme12.jpg') }}" alt="Meme 4 repeat" class="w-full object-cover rounded-2xl group-hover:scale-105 transition-transform duration-500">
                    </div>

                </div>

                <!-- White Fading Gradient Shadow at Grid Bottom -->
                <div class="absolute bottom-0 left-0 right-0 h-44 bg-gradient-to-t from-slate-50 via-slate-50/95 to-transparent flex items-end justify-center pb-8 z-20">
                    <!-- Pill Button Show All -->
                    <a href="{{ route('feed') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full text-white bg-brand-accent hover:bg-brand-accent/95 font-bold shadow-xl shadow-brand-accent/25 hover:scale-105 transition-all duration-300 transform">
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
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-primary tracking-tight">
                        Mengapa Memilih Platform Kami?
                    </h2>
                    <p class="text-lg text-slate-600 mt-4">
                        Didesain khusus untuk mempermudah alur kreasi dan berbagi gambar secara modern, cepat, dan reaktif.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    
                    <!-- Feature 1 -->
                    <div class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 hover:bg-white hover:border-brand-accent/30 p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-brand-primary/10 flex items-center justify-center mb-6 group-hover:bg-brand-primary transition-colors duration-300">
                            <i class="fa-solid fa-folder-plus text-brand-primary text-xl group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-brand-primary mb-3">📌 Kustomisasi Collection Tanpa Batas</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Kelompokkan postingan kesukaanmu, meme terfavorit, atau referensi desain ke dalam Collection pribadi atau publik. Atur privasimu sendiri dengan satu klik.
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 hover:bg-white hover:border-brand-accent/30 p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-brand-accent/10 flex items-center justify-center mb-6 group-hover:bg-brand-accent transition-colors duration-300">
                            <i class="fa-solid fa-bolt text-brand-accent text-xl group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-brand-primary mb-3">⚡ Interaksi Real-Time yang Responsif</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Rasakan pengalaman menjelajah yang super mulus tanpa reload halaman. Berikan likes dan diskusikan ide di kolom komentar secara instan berkat dukungan teknologi Livewire.
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group relative overflow-hidden rounded-3xl border border-slate-100 bg-slate-50/50 hover:bg-white hover:border-brand-accent/30 p-8 shadow-sm hover:shadow-lg transition-all duration-300">
                        <div class="w-14 h-14 rounded-2xl bg-brand-accent-light/10 flex items-center justify-center mb-6 group-hover:bg-brand-accent-light transition-colors duration-300">
                            <i class="fa-solid fa-table-cells text-brand-accent-light text-xl group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <h3 class="text-xl font-bold text-brand-primary mb-3">🧱 Desain Masonry Grid yang Estetik</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Nikmati tampilan feed yang dinamis, bersih, dan memanjakan mata. Layout grid adaptif kami memastikan setiap foto and meme tampil dalam proporsi terbaiknya, baik di desktop maupun smartphone.
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- "How It Works" Section -->
        <section id="how-it-works" class="py-20 md:py-28 bg-brand-bg-light/40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-brand-primary tracking-tight">
                        Mulai Langkah Kreatifmu dalam 3 Tahap Mudah:
                    </h2>
                    <p class="text-lg text-slate-600 mt-4">
                        Hanya butuh beberapa detik untuk mulai menjadi bagian dari komunitas visual sharing kami.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Step 1 -->
                    <div class="relative bg-white rounded-3xl p-8 shadow-md border border-slate-100">
                        <div class="absolute -top-6 left-8 w-12 h-12 rounded-2xl bg-brand-accent text-white flex items-center justify-center font-extrabold text-lg shadow-lg shadow-brand-accent/30">
                            01
                        </div>
                        <h3 class="text-xl font-bold text-brand-primary mt-4 mb-3">Buat Akun & Profilmu</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Daftar dengan cepat, lengkapi bio, dan pasang foto profil terbaikmu untuk mulai membangun persona visualmu secara aman.
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div class="relative bg-white rounded-3xl p-8 shadow-md border border-slate-100">
                        <div class="absolute -top-6 left-8 w-12 h-12 rounded-2xl bg-brand-primary text-white flex items-center justify-center font-extrabold text-lg shadow-lg shadow-brand-primary/30">
                            02
                        </div>
                        <h3 class="text-xl font-bold text-brand-primary mt-4 mb-3">Unggah & Temukan Konten</h3>
                        <p class="text-slate-600 leading-relaxed">
                            Unggah karya visual atau meme andalanmu langsung dari perangkat. Tambahkan tag dan deskripsi menarik agar mudah ditemukan oleh pengguna lain.
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div class="relative bg-white rounded-3xl p-8 shadow-md border border-slate-100">
                        <div class="absolute -top-6 left-8 w-12 h-12 rounded-2xl bg-brand-accent-light text-brand-primary flex items-center justify-center font-extrabold text-lg shadow-lg shadow-brand-accent-light/30">
                            03
                        </div>
                        <h3 class="text-xl font-bold text-brand-primary mt-4 mb-3">Simpan & Organisasikan</h3>
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
                <div class="relative overflow-hidden rounded-[2.5rem] bg-gradient-to-tr from-brand-primary via-brand-primary to-slate-900 text-white px-8 py-16 md:p-20 shadow-2xl text-center">
                    
                    <!-- Decorative shapes -->
                    <div class="absolute top-0 left-0 w-80 h-80 bg-brand-accent/20 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
                    <div class="absolute bottom-0 right-0 w-80 h-80 bg-brand-accent-light/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

                    <div class="relative z-10 max-w-3xl mx-auto">
                        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight mb-6">
                            Siap untuk Mengorganisasi Inspirasimu?
                        </h2>
                        <p class="text-lg md:text-xl text-slate-200 mb-8 max-w-2xl mx-auto">
                            Gabung sekarang secara gratis dan mulailah menyusun koleksi visual unikmu hari ini.
                        </p>
                        <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-8 py-4 rounded-2xl bg-brand-accent hover:bg-brand-accent/90 text-white font-bold text-base transition-all duration-300 shadow-lg shadow-brand-accent/25 hover:scale-[1.02]">
                            Daftar Akun Baru
                            <i class="fa-solid fa-user-plus ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-brand-primary text-white pt-16 pb-12 mt-auto border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
                    
                    <!-- Brand Section -->
                    <div class="md:col-span-5 flex flex-col items-start">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shadow-md">
                                <i class="fa-solid fa-images text-brand-primary text-sm"></i>
                            </div>
                            <span class="font-chewy text-2xl text-white tracking-wide">Gudang<span class="text-brand-accent-light">Meme</span></span>
                        </div>
                        <p class="text-slate-300 text-sm leading-relaxed max-w-sm mb-4">
                            Platform interaktif berbagi dan menyimpan inspirasi visual, foto estetik, hingga meme terlucu kelompok Anda.
                        </p>
                        <p class="text-slate-400 text-xs">
                            &copy; {{ date('Y') }} GudangMeme. Hak Cipta Dilindungi.
                        </p>
                    </div>

                    <!-- Links Section -->
                    <div class="md:col-span-3">
                        <h4 class="font-bold text-sm tracking-wider uppercase text-brand-accent-light mb-4">Akses Cepat</h4>
                        <ul class="space-y-2.5 text-sm text-slate-300">
                            <li><a href="{{ route('feed') }}" class="hover:text-white transition-colors">Eksplorasi Feed</a></li>
                            <li><a href="#features" class="hover:text-white transition-colors">Fitur Utama</a></li>
                            <li><a href="#how-it-works" class="hover:text-white transition-colors">Cara Kerja</a></li>
                            <li><a href="{{ route('login') }}" class="hover:text-white transition-colors">Halaman Masuk</a></li>
                        </ul>
                    </div>

                    <!-- Team Section -->
                    <div class="md:col-span-4">
                        <h4 class="font-bold text-sm tracking-wider uppercase text-brand-accent-light mb-4">Tim Pengembang (Kelompok 1)</h4>
                        <ul class="space-y-2 text-xs text-slate-300">
                            <li class="flex justify-between border-b border-white/5 pb-1">
                                <span class="font-medium">Muhamad Alamsyah A. F. (Ketua)</span>
                                <span class="text-slate-400">241110014</span>
                            </li>
                            <li class="flex justify-between border-b border-white/5 pb-1">
                                <span class="font-medium">Afriza Marshal Verdiasta</span>
                                <span class="text-slate-400">241110057</span>
                            </li>
                            <li class="flex justify-between border-b border-white/5 pb-1">
                                <span class="font-medium">Muhammad Alfiano Akmal Zen</span>
                                <span class="text-slate-400">241110053</span>
                            </li>
                            <li class="flex justify-between border-b border-white/5 pb-1">
                                <span class="font-medium">Handika Wijaksono</span>
                                <span class="text-slate-400">241110095</span>
                            </li>
                            <li class="flex justify-between pb-1">
                                <span class="font-medium">Rizqy Naufal Pradana</span>
                                <span class="text-slate-400">241110088</span>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </footer>

    </body>
</html>
