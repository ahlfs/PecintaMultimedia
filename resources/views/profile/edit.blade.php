@extends('layouts.app')

@section('title', 'Edit Profil - GudangMeme')

@section('content')
<style>
    /* Custom Yellow Palette Styles */
    .bg-brand-primary { background-color: #e69b00 !important; }
    .bg-brand-accent { background-color: #e6b400 !important; }
    .text-brand-primary { color: #e69b00 !important; }
    .text-brand-accent { color: #e6b400 !important; }
    .border-brand-primary { border-color: #e69b00 !important; }
    .border-brand-accent { border-color: #e6b400 !important; }
    .focus\\:ring-brand-accent\\/10:focus { --tw-ring-color: rgba(230, 180, 0, 0.1); }
    .focus\\:ring-brand-accent\\/20:focus { --tw-ring-color: rgba(230, 180, 0, 0.2); }
    .focus\\:border-brand-accent:focus { border-color: #e6b400; }
    .group-focus-within\\:text-brand-accent group-focus-within\:text-brand-accent { color: #e6b400; }
    .bg-brand-accent\\/10 { background-color: rgba(230, 180, 0, 0.1); }
    .bg-brand-accent\\/20 { background-color: rgba(230, 180, 0, 0.2); }
    .text-brand-accent\\/80 { color: rgba(230, 180, 0, 0.8); }
    
    /* Glowing border effect for main card */
    .glowing-border {
        position: relative;
        border: 1px solid rgba(230, 180, 0, 0.2);
        box-shadow: 0 0 40px rgba(230, 155, 0, 0.15), 
                    0 0 80px rgba(230, 180, 0, 0.1),
                    inset 0 1px 0 rgba(255, 255, 255, 0.6);
    }
    
    .glowing-border::before {
        content: '';
        position: absolute;
        top: -2px;
        left: -2px;
        right: -2px;
        bottom: -2px;
        background: linear-gradient(45deg, #e69b00, #e6b400, #e6cc00, #e5de00, #e6b400, #e69b00);
        border-radius: inherit;
        z-index: -1;
        filter: blur(20px);
        opacity: 0.4;
        animation: glowRotate 8s linear infinite;
        background-size: 400% 400%;
    }
    
    @keyframes glowRotate {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    /* Button glow effects */
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }
    
    .btn-glow-yellow:hover::before {
        left: 100%;
    }
    
    .btn-glow-yellow:hover {
        box-shadow: 0 0 30px rgba(230, 155, 0, 0.4),
                    0 0 60px rgba(230, 180, 0, 0.2);
        transform: translateY(-2px);
    }
    
    .btn-glow-yellow:active {
        transform: translateY(0);
    }
    
    /* Input focus glow */
    .input-glow-yellow:focus {
        box-shadow: 0 0 0 4px rgba(230, 180, 0, 0.1),
                    0 0 20px rgba(230, 155, 0, 0.15);
    }
    
    /* Background glow shapes with yellow */
    .bg-glow-yellow-1 {
        background: radial-gradient(circle, rgba(230, 155, 0, 0.08) 0%, transparent 70%);
    }
    
    .bg-glow-yellow-2 {
        background: radial-gradient(circle, rgba(230, 180, 0, 0.08) 0%, transparent 70%);
    }
    
    /* Gradient text */
    .text-gradient-yellow {
        background: linear-gradient(135deg, #e69b00 0%, #e6b400 50%, #e6cc00 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    /* Card section hover */
    .card-section-hover {
        transition: all 0.3s ease;
    }
    
    .card-section-hover:hover {
        box-shadow: 0 4px 20px rgba(230, 155, 0, 0.08);
    }
</style>

<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <!-- Background glow shapes with yellow palette -->
    <div class="absolute top-20 left-10 w-80 h-80 bg-glow-yellow-1 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-glow-yellow-2 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-3xl mx-auto z-10 relative animate-fade-in-up">
        
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('feed') }}" class="p-2 rounded-xl bg-white hover:bg-slate-50 border border-slate-200/60 shadow-sm text-slate-600 hover:text-[#e69b00] transition-all btn-glow-yellow">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-gradient-yellow tracking-tight">Pengaturan Profil</h1>
                <p class="text-slate-500 text-sm mt-0.5">Kelola informasi publik, foto profil, dan keamanan akun Anda.</p>
            </div>
        </div>

        <!-- Main Form Card with Glowing Border -->
        <div class="bg-white rounded-3xl glowing-border overflow-hidden">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Profile Photo Section -->
                <div class="p-8 sm:p-10 border-b border-slate-100 bg-gradient-to-b from-amber-50/30 to-white card-section-hover">
                    <h3 class="text-base font-bold text-slate-800 mb-4 flex items-center gap-2">
                        <span class="w-1 h-6 bg-gradient-to-b from-[#e69b00] to-[#e6cc00] rounded-full"></span>
                        Foto Profil
                    </h3>
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <!-- Photo Preview Container -->
                        <div class="relative group">
                            <div class="absolute -inset-1 bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-500"></div>
                            <img 
                                id="profile-preview" 
                                src="{{ $user->profile_photo ? asset($user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=e69b00&color=fff&bold=true&size=150' }}" 
                                alt="Foto Profil Preview" 
                                class="relative w-32 h-32 rounded-3xl object-cover border-4 border-white shadow-lg transition-transform duration-300 group-hover:scale-[1.02]"
                            >
                            <label for="profile_photo" class="absolute bottom-1 right-1 bg-gradient-to-br from-[#e69b00] to-[#e6b400] hover:from-[#e6b400] hover:to-[#e6cc00] text-white p-2.5 rounded-xl shadow-lg cursor-pointer transition-all hover:scale-110 btn-glow-yellow">
                                <i class="fa-solid fa-camera text-sm"></i>
                            </label>
                            <input 
                                type="file" 
                                id="profile_photo" 
                                name="profile_photo" 
                                accept="image/*" 
                                class="hidden" 
                                onchange="previewImage(event)"
                            >
                        </div>
                        <!-- Upload notes -->
                        <div class="text-center sm:text-left">
                            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold bg-gradient-to-r from-[#e69b00] to-[#e6b400] text-white mb-3 shadow-md">Unggah Foto Baru</span>
                            <p class="text-xs text-slate-500 max-w-xs leading-relaxed">
                                Pilih gambar berformat JPG, JPEG, PNG atau GIF dengan ukuran maksimal 2MB. Foto profil akan terlihat oleh pengguna lain di feed dan komentar.
                            </p>
                            @error('profile_photo')
                                <p class="text-xs text-red-500 mt-2 font-semibold flex items-center justify-center sm:justify-start gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="p-8 sm:p-10 space-y-6">
                    <h3 class="text-base font-bold text-slate-800 mb-2 border-b border-slate-100 pb-2 flex items-center gap-2">
                        <span class="w-1 h-6 bg-gradient-to-b from-[#e6b400] to-[#e6cc00] rounded-full"></span>
                        Informasi Pribadi
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-signature text-slate-400 group-focus-within:text-[#e6b400] transition-colors"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}" 
                                    required
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm input-glow-yellow @error('name') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                                >
                            </div>
                            @error('name')
                                <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Username -->
                        <div>
                            <label for="username" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Username</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-at text-slate-400 group-focus-within:text-[#e6b400] transition-colors"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="username" 
                                    name="username" 
                                    value="{{ old('username', $user->username) }}" 
                                    required
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm input-glow-yellow @error('username') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                                >
                            </div>
                            @error('username')
                                <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Alamat Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <i class="fa-solid fa-envelope text-slate-400 group-focus-within:text-[#e6b400] transition-colors"></i>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}" 
                                required
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm input-glow-yellow @error('email') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                            >
                        </div>
                        @error('email')
                            <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Bio -->
                    <div>
                        <label for="bio" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Bio Singkat</label>
                        <div class="relative group">
                            <textarea 
                                id="bio" 
                                name="bio" 
                                rows="4" 
                                placeholder="Ceritakan sedikit tentang dirimu atau meme kegemaranmu..."
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm input-glow-yellow @error('bio') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                            >{{ old('bio', $user->bio) }}</textarea>
                        </div>
                        @error('bio')
                            <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <!-- Password modification section -->
                <div class="p-8 sm:p-10 space-y-6 bg-gradient-to-b from-amber-50/20 to-white border-t border-slate-100">
                    <div>
                        <h3 class="text-base font-bold text-slate-800 flex items-center gap-2">
                            <span class="w-1 h-6 bg-gradient-to-b from-[#e6cc00] to-[#e5de00] rounded-full"></span>
                            Ubah Kata Sandi
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">Biarkan kosong jika Anda tidak ingin mengganti kata sandi saat ini.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-lock text-slate-400 group-focus-within:text-[#e6b400] transition-colors"></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Kata sandi baru"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm input-glow-yellow @error('password') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
                                >
                            </div>
                            @error('password')
                                <p class="text-xs text-red-500 mt-1.5 font-semibold flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-2xs"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Confirm New Password -->
                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Ulangi Kata Sandi Baru</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-circle-check text-slate-400 group-focus-within:text-[#e6b400] transition-colors"></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    placeholder="Ulangi kata sandi baru"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-[#e6b400]/20 focus:border-[#e6b400] text-slate-800 placeholder-slate-400 transition-all text-sm input-glow-yellow"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit and Cancel Section -->
                <div class="px-8 py-6 sm:px-10 bg-gradient-to-r from-amber-50/50 to-white border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <!-- Logout button on the left -->
                    <div class="w-full sm:w-auto">
                        <button 
                            type="button" 
                            onclick="confirmLogout(event)"
                            class="w-full sm:w-auto px-6 py-3 rounded-xl border border-red-200 bg-white hover:bg-red-50 text-red-500 font-bold text-sm transition-all flex items-center justify-center gap-2 cursor-pointer btn-glow-yellow hover:border-red-300"
                        >
                            <i class="fa-solid fa-right-from-bracket"></i> Keluar Akun
                        </button>
                    </div>

                    <!-- Cancel and Save on the right -->
                    <div class="flex flex-col sm:flex-row items-center gap-3 w-full sm:w-auto justify-end">
                        <a 
                            href="{{ route('feed') }}" 
                            class="w-full sm:w-auto text-center px-6 py-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 text-slate-700 font-bold text-sm transition-all btn-glow-yellow"
                        >
                            Batalkan
                        </a>
                        <button 
                            type="submit" 
                            class="w-full sm:w-auto px-8 py-3 rounded-xl bg-gradient-to-r from-[#e69b00] via-[#e6b400] to-[#e6cc00] hover:from-[#e6b400] hover:via-[#e6cc00] hover:to-[#e5de00] text-white font-bold text-sm shadow-lg shadow-[#e69b00]/25 hover:shadow-[#e69b00]/40 transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer btn-glow-yellow"
                        >
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
            
            <!-- Outside Logout Form to prevent nested forms -->
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>

    </div>
</div>

@push('scripts')
<script>
    function confirmLogout(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin ingin keluar?',
            text: "Anda harus masuk kembali untuk mengakses feed dan koleksi Anda.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e69b00', // Yellow primary
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal',
            customClass: {
                popup: 'rounded-3xl',
                confirmButton: 'rounded-xl px-5 py-2.5 font-bold bg-gradient-to-r from-[#e69b00] to-[#e6b400] hover:from-[#e6b400] hover:to-[#e6cc00] text-white shadow-lg',
                cancelButton: 'rounded-xl px-5 py-2.5 font-bold'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
@endpush
@endsection