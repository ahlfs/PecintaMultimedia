@extends('layouts.app')

@section('title', 'Edit Profil - GudangMeme')

@section('content')
<div class="relative min-h-[calc(100vh-140px)] py-12 px-4 sm:px-6 lg:px-8 bg-slate-50">
    <!-- Background glow shapes -->
    <div class="absolute top-20 left-10 w-80 h-80 bg-brand-accent-light/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-20 right-10 w-96 h-96 bg-brand-accent/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-3xl mx-auto z-10 relative animate-fade-in-up">
        
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('feed') }}" class="p-2 rounded-xl bg-white hover:bg-slate-100 border border-slate-200/60 shadow-sm text-slate-600 hover:text-brand-primary transition-all">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-brand-primary tracking-tight">Pengaturan Profil</h1>
                <p class="text-slate-500 text-sm mt-0.5">Kelola informasi publik, foto profil, dan keamanan akun Anda.</p>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-3xl border border-slate-100 shadow-xl overflow-hidden">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Profile Photo Section -->
                <div class="p-8 sm:p-10 border-b border-slate-100 bg-slate-50/40">
                    <h3 class="text-base font-bold text-slate-800 mb-4">Foto Profil</h3>
                    <div class="flex flex-col sm:flex-row items-center gap-6">
                        <!-- Photo Preview Container -->
                        <div class="relative group">
                            <img 
                                id="profile-preview" 
                                src="{{ $user->profile_photo ? asset($user->profile_photo) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=293681&color=fff&bold=true&size=150' }}" 
                                alt="Foto Profil Preview" 
                                class="w-32 h-32 rounded-3xl object-cover border-4 border-white shadow-md transition-transform duration-300 group-hover:scale-[1.02]"
                            >
                            <label for="profile_photo" class="absolute bottom-1 right-1 bg-brand-accent hover:bg-brand-accent/95 text-white p-2 rounded-xl shadow-lg cursor-pointer transition-all hover:scale-110">
                                <i class="fa-solid fa-camera"></i>
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
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold text-brand-accent bg-brand-accent/10 mb-2">Unggah Foto Baru</span>
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
                    <h3 class="text-base font-bold text-slate-800 mb-2 border-b border-slate-100 pb-2">Informasi Pribadi</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Full Name -->
                        <div>
                            <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Lengkap</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-signature text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name', $user->name) }}" 
                                    required
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('name') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
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
                                    <i class="fa-solid fa-at text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                                </div>
                                <input 
                                    type="text" 
                                    id="username" 
                                    name="username" 
                                    value="{{ old('username', $user->username) }}" 
                                    required
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('username') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
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
                                <i class="fa-solid fa-envelope text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                            </div>
                            <input 
                                type="email" 
                                id="email" 
                                name="email" 
                                value="{{ old('email', $user->email) }}" 
                                required
                                class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('email') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
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
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('bio') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
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
                <div class="p-8 sm:p-10 space-y-6 bg-slate-50/20 border-t border-slate-100">
                    <div>
                        <h3 class="text-base font-bold text-slate-800">Ubah Kata Sandi</h3>
                        <p class="text-xs text-slate-500 mt-0.5">Biarkan kosong jika Anda tidak ingin mengganti kata sandi saat ini.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Kata Sandi Baru</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fa-solid fa-lock text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password" 
                                    name="password" 
                                    placeholder="Kata sandi baru"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm @error('password') border-red-300 focus:ring-red-100 focus:border-red-500 @enderror"
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
                                    <i class="fa-solid fa-circle-check text-slate-400 group-focus-within:text-brand-accent transition-colors"></i>
                                </div>
                                <input 
                                    type="password" 
                                    id="password_confirmation" 
                                    name="password_confirmation" 
                                    placeholder="Ulangi kata sandi baru"
                                    class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:ring-4 focus:ring-brand-accent/10 focus:border-brand-accent text-slate-800 placeholder-slate-400 transition-all text-sm"
                                >
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit and Cancel Section -->
                <div class="px-8 py-6 sm:px-10 bg-slate-50 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-end gap-3">
                    <a 
                        href="{{ route('feed') }}" 
                        class="w-full sm:w-auto text-center px-6 py-3 rounded-xl border border-slate-200 bg-white hover:bg-slate-100 text-slate-700 font-bold text-sm transition-all"
                    >
                        Batalkan
                    </a>
                    <button 
                        type="submit" 
                        class="w-full sm:w-auto px-8 py-3 rounded-xl bg-brand-primary hover:bg-brand-primary/95 text-white font-bold text-sm shadow-md shadow-brand-primary/10 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 cursor-pointer"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
@endsection
