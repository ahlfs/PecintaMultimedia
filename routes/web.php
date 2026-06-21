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
    Route::get('/collections/{id}', [CollectionController::class, 'show'])->name('collections.show');
    Route::get('/collections/{id}/edit', [CollectionController::class, 'edit'])->name('collections.edit');
    Route::put('/collections/{id}', [CollectionController::class, 'update'])->name('collections.update');
    Route::delete('/collections/{id}', [CollectionController::class, 'destroy'])->name('collections.destroy');
    
    // CRUD Post
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    Route::post('/posts/{id}/save', [PostController::class, 'saveToCollection'])->name('posts.save-to-collection');
    
    // Placeholder feed yang menggunakan layout app untuk kemudahan testing
    Route::get('/feed', function () {
        return view('feed');
    })->name('feed');
});
