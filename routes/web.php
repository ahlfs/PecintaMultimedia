<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return 'Halaman Login (Belum diimplementasikan)';
})->name('login');

Route::get('/register', function () {
    return 'Halaman Register (Belum diimplementasikan)';
})->name('register');

Route::get('/feed', function () {
    return 'Halaman Feed (Belum diimplementasikan)';
})->name('feed');
