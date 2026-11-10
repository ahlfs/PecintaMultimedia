<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\PostController;

// Halaman Utama / Landing Page
Route::get('/', function () {
    return view('welcome');
});

// Route khusus Tamu (Guest)
Route::middleware(['manual.guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    // Google Authentication Routes
    Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
});

// Route khusus Pengguna Masuk (Authenticated)
Route::middleware(['manual.auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // CRUD Collection
    Route::get('/collections', [CollectionController::class, 'index'])->name('collections.index');
    Route::get('/collections/create', [CollectionController::class, 'create'])->name('collections.create');
    Route::post('/collections', [CollectionController::class, 'store'])->name('collections.store');
    Route::get('/collections/{collection}/edit', [CollectionController::class, 'edit'])->name('collections.edit');
    Route::put('/collections/{collection}', [CollectionController::class, 'update'])->name('collections.update');
    Route::delete('/collections/{collection}', [CollectionController::class, 'destroy'])->name('collections.destroy');
    
    // CRUD Post
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{post}/save', [PostController::class, 'saveToCollection'])->name('posts.save-to-collection');
});

// Route Publik (Tanpa Login)
Route::get('/feed', function () {
    return view('feed');
})->name('feed');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
Route::get('/profile/{username?}', [ProfileController::class, 'show'])->name('profile.show');
Route::get('/collections/{collection}', [CollectionController::class, 'show'])->name('collections.show');

// Temporary Sync Route
Route::post('/sync-memes-secret', function (\Illuminate\Http\Request $request) {
    if ($request->input('key') !== 'PecintaMultimedia2026SyncKey') {
        abort(403);
    }
    
    $file = $request->file('bundle');
    $zip = new \ZipArchive;
    if ($zip->open($file->getRealPath()) === TRUE) {
        $zip->extractTo(public_path('uploads/memes'));
        $zip->close();
    }
    
    $user = \App\Models\User::first();
    if (!$user) {
        return response()->json(['error' => 'No user found']);
    }
    
    $memes = [
        ['file' => 'seeded_meme_1_10.jpg', 'title' => 'Ketika Deadline Tugas Tinggal 5 Menit'],
        ['file' => 'seeded_meme_2_20.jpg', 'title' => 'Ekspektasi vs Realita Pemrograman Web'],
        ['file' => 'seeded_meme_3_30.jpg', 'title' => 'Ngoding Sampai Subuh tapi Error Titik Koma'],
        ['file' => 'seeded_meme_4_60.jpg', 'title' => 'Saat Ditanya Dosen Perkembangan Proyek'],
        ['file' => 'seeded_meme_5_50.jpg', 'title' => 'Teman Sekelompok Tiba-Tiba Menghilang'],
        ['file' => 'seeded_meme_6_100.jpg', 'title' => 'Git Push Sukses Tanpa Conflict Rasanya...'],
        ['file' => 'seeded_meme_7_120.jpg', 'title' => 'Deploy Server Pertama Kali'],
        ['file' => 'seeded_meme_8_150.jpg', 'title' => 'Meme Santai di Akhir Pekan'],
        ['file' => 'seeded_meme_9_180.jpg', 'title' => 'Belajar Coding Lewat Tutorial India'],
        ['file' => 'seeded_meme_10_200.jpg', 'title' => 'Gudang Meme Karya Anak Bangsa'],
        ['file' => 'seeded_meme_11_250.jpg', 'title' => 'Koleksi Meme Terbaik 2026'],
        ['file' => 'seeded_meme_12_300.jpg', 'title' => 'Ketika Fitur Baru Akhirnya Jalan'],
        ['file' => 'seeded_meme_13_350.jpg', 'title' => 'Hidup Mahasiswa Teknik Informatika'],
    ];
    
    $created = 0;
    foreach ($memes as $m) {
        $path = 'uploads/memes/' . $m['file'];
        if (file_exists(public_path($path))) {
            $slug = \Illuminate\Support\Str::slug($m['title']) . '-' . rand(100, 999);
            \App\Models\Post::firstOrCreate(
                ['image_path' => $path],
                [
                    'user_id' => $user->id,
                    'title' => $m['title'],
                    'slug' => $slug,
                    'description' => 'Meme seru di Gudang Meme!',
                ]
            );
            $created++;
        }
    }
    
    return response()->json(['status' => 'success', 'synced' => $created]);
});
