<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Proses login pengguna.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'Username atau Email wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cari user berdasarkan username atau email
        $user = User::where('username', $credentials['login'])
                    ->orWhere('email', $credentials['login'])
                    ->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Set session user_id secara manual
            session(['user_id' => $user->id]);
            session()->regenerate();

            return redirect()->route('feed')->with('success', 'Selamat datang kembali, ' . $user->name . '!');
        }

        return back()->withInput($request->only('login'))
                     ->with('error', 'Username/Email atau password salah.');
    }

    /**
     * Tampilkan halaman registrasi.
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Proses registrasi pengguna baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|min:3|max:255|unique:users,username|alpha_dash',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Buat user baru dengan hashing Argon2id eksplisit
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::driver('argon2id')->make($request->password),
        ]);

        // Set session user_id secara manual
        session(['user_id' => $user->id]);
        session()->regenerate();

        return redirect()->route('feed')->with('success', 'Registrasi berhasil! Selamat datang di GudangMeme.');
    }

    /**
     * Proses logout pengguna.
     */
    public function logout()
    {
        session()->forget('user_id');
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/')->with('success', 'Anda berhasil keluar.');
    }
}
