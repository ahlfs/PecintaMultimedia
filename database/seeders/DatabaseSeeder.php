<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Collection;
use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

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
        $colProgrammer = Collection::updateOrCreate(
            ['user_id' => $testUser->id, 'name' => 'Meme Programmer Lucu'],
            [
                'description' => 'Koleksi meme pemrograman, error debugging, dan kehidupan developer.',
                'is_private' => false,
            ]
        );

        $colDesign = Collection::updateOrCreate(
            ['user_id' => $testUser->id, 'name' => 'Desain Antarmuka Modern'],
            [
                'description' => 'Referensi desain UI/UX, gradasi warna, dan layout web estetik.',
                'is_private' => false,
            ]
        );

        $colSecret = Collection::updateOrCreate(
            ['user_id' => $testUser->id, 'name' => 'Koleksi Rahasiaku'],
            [
                'description' => 'Folder privat berisi meme receh dan ide rahasia.',
                'is_private' => true,
            ]
        );

        // 3. Buat Folder public/uploads/memes jika belum ada
        if (!File::isDirectory(public_path('uploads/memes'))) {
            File::makeDirectory(public_path('uploads/memes'), 0755, true);
        }

        // Definisi list post yang ingin dibuat
        $postsData = [
            // Programmer memes
            [
                'title' => 'Ketika Code Berhasil Run Pertama Kali',
                'description' => 'Momen langka ketika code langsung berhasil jalan tanpa error kompiler.',
                'collection' => $colProgrammer,
                'width' => 400,
                'height' => 300,
                'picsum_id' => 10,
            ],
            [
                'title' => 'Detak Jantung Saat Git Push --force',
                'description' => 'Siapa yang butuh kafein kalau kamu bisa melakukan push force langsung ke branch main?',
                'collection' => $colProgrammer,
                'width' => 400,
                'height' => 500,
                'picsum_id' => 20,
            ],
            [
                'title' => 'Mencari Titik Koma yang Hilang',
                'description' => '3 jam debugging hanya untuk menemukan satu titik koma (;) yang terlupakan.',
                'collection' => $colProgrammer,
                'width' => 400,
                'height' => 400,
                'picsum_id' => 30,
            ],
            [
                'title' => 'Ngopi Dulu Baru Debugging',
                'description' => 'Mug kopi kesayangan yang selalu menemani malam-malam penuh bug.',
                'collection' => $colProgrammer,
                'width' => 400,
                'height' => 600,
                'picsum_id' => 60,
            ],
            [
                'title' => 'StackOverflow Adalah Penyelamatku',
                'description' => 'Mengcopy code tanpa tahu cara kerjanya adalah keahlian utama kami.',
                'collection' => $colProgrammer,
                'width' => 400,
                'height' => 350,
                'picsum_id' => 50,
            ],

            // Design memes/posts
            [
                'title' => 'Inspirasi Palet Warna Gradasi HSL',
                'description' => 'Gradien warna lembut yang sangat cocok digunakan untuk landing page kekinian.',
                'collection' => $colDesign,
                'width' => 400,
                'height' => 450,
                'picsum_id' => 100,
            ],
            [
                'title' => 'Desain Glassmorphic untuk Aplikasi Dashboard',
                'description' => 'Eksperimen styling efek kaca buram (glassmorphism) yang transparan dan elegan.',
                'collection' => $colDesign,
                'width' => 400,
                'height' => 550,
                'picsum_id' => 120,
            ],
            [
                'title' => 'Tipografi Minimalis untuk Website Portofolio',
                'description' => 'Perpaduan font Sans-serif modern dengan serif klasik untuk estetika visual yang premium.',
                'collection' => $colDesign,
                'width' => 400,
                'height' => 400,
                'picsum_id' => 150,
            ],
            [
                'title' => 'Inspirasi Tata Letak Halaman Landing Page',
                'description' => 'Wireframe tata letak bersih, minimalis, dan sangat berfokus pada conversion rate.',
                'collection' => $colDesign,
                'width' => 400,
                'height' => 650,
                'picsum_id' => 180,
            ],
            [
                'title' => 'Contoh Desain Tombol Interaktif Baru',
                'description' => 'Animasi hover tombol micro-interaction dengan glow effect.',
                'collection' => $colDesign,
                'width' => 400,
                'height' => 320,
                'picsum_id' => 200,
            ],

            // Secret memes/posts
            [
                'title' => 'Ide Bisnis Miliaran (Rahasia Jangan Dibuka!)',
                'description' => 'Dokumen rahasia berisi rencana startup penjualan kopi online berbasis AI.',
                'collection' => $colSecret,
                'width' => 400,
                'height' => 480,
                'picsum_id' => 250,
            ],
            [
                'title' => 'Rencana Liburan Impian Akhir Tahun',
                'description' => 'Daftar destinasi wisata alam tersembunyi yang ingin saya kunjungi saat libur semester.',
                'collection' => $colSecret,
                'width' => 400,
                'height' => 580,
                'picsum_id' => 300,
            ],
            [
                'title' => 'Resep Rahasia Mie Instan Terenak di Dunia',
                'description' => 'Kombinasi bumbu khusus mie instan kuah susu yang sangat creamy dan lezat.',
                'collection' => $colSecret,
                'width' => 400,
                'height' => 420,
                'picsum_id' => 350,
            ],
        ];

        foreach ($postsData as $index => $p) {
            // Kita coba buat atau update post berdasarkan title
            $post = Post::where('title', $p['title'])->first();

            if (!$post) {
                // Download file gambar dummy dari Picsum secara lokal
                $filename = 'seeded_meme_' . ($index + 1) . '_' . $p['picsum_id'] . '.jpg';
                $localPath = 'uploads/memes/' . $filename;
                $fullPath = public_path($localPath);

                // Cek jika file belum ada secara lokal sebelum men-download-nya
                if (!File::exists($fullPath)) {
                    $url = "https://picsum.photos/id/{$p['picsum_id']}/{$p['width']}/{$p['height']}";
                    $imageContent = @file_get_contents($url);
                    if ($imageContent) {
                        File::put($fullPath, $imageContent);
                    } else {
                        // Jika gagal, download picsum random tanpa ID
                        $fallbackUrl = "https://picsum.photos/{$p['width']}/{$p['height']}";
                        $fallbackContent = @file_get_contents($fallbackUrl);
                        if ($fallbackContent) {
                            File::put($fullPath, $fallbackContent);
                        } else {
                            // Touch empty file if offline
                            File::put($fullPath, '');
                        }
                    }
                }

                $post = Post::create([
                    'user_id' => $testUser->id,
                    'title' => $p['title'],
                    'description' => $p['description'],
                    'image_path' => $localPath,
                ]);
            }

            // Sambungkan ke koleksi (Many-to-Many)
            $post->collections()->syncWithoutDetaching([$p['collection']->id]);
        }
    }
}
