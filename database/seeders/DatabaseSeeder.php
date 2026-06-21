<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Akun Uji Coba (Test Account)
        $testUser = User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'username' => 'testuser',
                'password' => Hash::make('password123'),
                'bio' => 'Ini adalah akun uji coba untuk mengeksplorasi aplikasi GudangMeme.',
                'profile_photo' => null,
            ]
        );

        // 2. Buat Beberapa Koleksi Awal untuk Akun Test
        Collection::updateOrCreate(
            ['user_id' => $testUser->id, 'name' => 'Meme Programmer Lucu'],
            [
                'description' => 'Koleksi meme pemrograman, error debugging, dan kehidupan developer.',
                'is_private' => false,
            ]
        );

        Collection::updateOrCreate(
            ['user_id' => $testUser->id, 'name' => 'Desain Antarmuka Modern'],
            [
                'description' => 'Referensi desain UI/UX, gradasi warna, dan layout web estetik.',
                'is_private' => false,
            ]
        );

        Collection::updateOrCreate(
            ['user_id' => $testUser->id, 'name' => 'Koleksi Rahasiaku'],
            [
                'description' => 'Folder privat berisi meme receh dan ide rahasia.',
                'is_private' => true,
            ]
        );
    }
}
