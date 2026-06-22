<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman profil pengguna (Instagram-style).
     */
    public function show($id = null)
    {
        $targetUserId = $id ?? session('user_id');
        if (!$targetUserId) {
            return redirect()->route('login');
        }
        $isOwner = ((int)$targetUserId === (int)session('user_id'));

        $user = User::withCount([
            'posts',
            'collections' => function ($query) use ($isOwner) {
                if (!$isOwner) {
                    $query->where('is_private', false);
                }
            }
        ])->findOrFail($targetUserId);
        
        // Fetch user's own posts
        $posts = $user->posts()->latest()->get();
        
        // Fetch user's collections
        $collectionsQuery = $user->collections();
        if (!$isOwner) {
            $collectionsQuery->where('is_private', false);
        }
        $collections = $collectionsQuery
            ->withCount('posts')
            ->with(['posts' => function ($query) {
                $query->latest()->limit(3);
            }])
            ->latest()
            ->get();
        
        // Fetch user's liked posts
        $likedPosts = Post::whereHas('likes', function ($query) use ($targetUserId) {
            $query->where('user_id', $targetUserId);
        })->with(['user'])->latest()->get();
        
        $likesCount = $likedPosts->count();

        return view('profile.show', compact('user', 'posts', 'collections', 'likedPosts', 'likesCount', 'isOwner'));
    }

    /**
     * Tampilkan halaman edit profil.
     */
    public function edit()
    {
        $user = User::findOrFail(session('user_id'));
        return view('profile.edit', compact('user'));
    }

    /**
     * Update data profil pengguna.
     */
    public function update(Request $request)
    {
        $user = User::findOrFail(session('user_id'));

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:255|alpha_dash|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'bio' => 'nullable|string|max:500',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password' => 'nullable|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.unique' => 'Username sudah digunakan oleh orang lain.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar untuk pengguna lain.',
            'bio.max' => 'Bio tidak boleh lebih dari 500 karakter.',
            'profile_photo.image' => 'File harus berupa gambar.',
            'profile_photo.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'profile_photo.max' => 'Ukuran gambar maksimal 2MB.',
            'password.min' => 'Password baru minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        // Tangani unggah foto profil
        if ($request->hasFile('profile_photo')) {
            // Hapus foto lama jika ada
            if ($user->profile_photo && File::exists(public_path($user->profile_photo))) {
                File::delete(public_path($user->profile_photo));
            }

            $file = $request->file('profile_photo');
            $filename = 'profile_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Buat direktori jika belum ada
            if (!File::isDirectory(public_path('uploads/profile-pictures'))) {
                File::makeDirectory(public_path('uploads/profile-pictures'), 0755, true);
            }

            $file->move(public_path('uploads/profile-pictures'), $filename);
            $user->profile_photo = 'uploads/profile-pictures/' . $filename;
        }

        // Perbarui data dasar
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->bio = $request->bio;

        // Perbarui password jika diisi
        if ($request->filled('password')) {
            $user->password = Hash::driver('argon2id')->make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil Anda berhasil diperbarui!');
    }
}
