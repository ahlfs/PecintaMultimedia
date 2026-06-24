# Walkthrough: Fitur Livewire Home Feed & Tombol Suka (`LikeButton`)

Fitur interaktif Livewire Home Feed (`HomeFeed`) dengan masonry grid dan pencarian real-time (Baris 114) serta Livewire Tombol Suka (`LikeButton`) secara real-time (Baris 115) telah berhasil dikembangkan, diuji, dan divalidasi.

---

## 🛠️ Ringkasan Perubahan

### 1. Backend & Logika
*   **[NEW] [HomeFeed.php](file:///c:/PecintaMultimedia/app/Livewire/HomeFeed.php):**
    *   Mengatur pencarian real-time (instant search) berbasis `wire:model.live.debounce.300ms` dengan reset pagination otomatis (`updatingSearch`).
    *   Query pencarian yang handal mencakup pencarian kecocokan judul post, deskripsi, nama pembuat (`user.name`), dan username pembuat (`user.username`).
    *   Menerapkan **Caching** menggunakan `Cache::remember` selama 30 detik. Kunci cache dibedakan berdasarkan hash MD5 dari string pencarian dan halaman aktif untuk mendukung pagination yang cepat dan andal.
    *   Query dioptimalkan dengan memuat relasi eager-loading `user`, `likes`, `comments` serta counter `likes_count`, `comments_count`.
*   **[NEW] [LikeButton.php](file:///c:/PecintaMultimedia/app/Livewire/LikeButton.php):**
    *   Menangani tombol suka (like/unlike) secara real-time terintegrasi dengan tabel `likes` MySQL berdasarkan user ID dari session (`session('user_id')`).
    *   Memperbarui state tombol (`$isLiked`) dan jumlah suka (`$likesCount`) secara dinamis.

### 2. Tampilan / Views
*   **[NEW] [home-feed.blade.php](file:///c:/PecintaMultimedia/resources/views/livewire/home-feed.blade.php):**
    *   Menyediakan kolom input search responsif dengan loading spinner interaktif.
    *   Menerapkan **Masonry Grid Pinterest-like** menggunakan native CSS multi-column utility (`columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4`).
    *   Mengatur lazy loading gambar menggunakan atribut standar browser `loading="lazy"` agar performa pemuatan awal halaman optimal.
    *   Desain visual hover premium yang memunculkan overlay detail judul/deskripsi post, profil pembuat, dan jumlah interaksi.
    *   Menyediakan navigasi pagination bawaan.
*   **[NEW] [like-button.blade.php](file:///c:/PecintaMultimedia/resources/views/livewire/like-button.blade.php):**
    *   Tombol suka reaktif dengan transisi ikon hati (filled red vs outline slate) dan micro-interaction.
*   **[MODIFY] [feed.blade.php](file:///c:/PecintaMultimedia/resources/views/feed.blade.php):**
    *   Mengganti placeholder statis dengan memanggil komponen `@livewire('home-feed')`.
*   **[MODIFY] [show.blade.php](file:///c:/PecintaMultimedia/resources/views/posts/show.blade.php):**
    *   Mengganti tombol suka placeholder statis pada detail post dengan `@livewire('like-button', ['post' => $post])`.

### 3. Database & Seeding
*   **[MODIFY] [DatabaseSeeder.php](file:///c:/PecintaMultimedia/database/seeders/DatabaseSeeder.php):**
    *   Menambahkan pembuatan post meme uji coba dengan pengunduhan gambar bervariasi rasio dimensinya dari Picsum ke folder `public/uploads/memes`.
    *   Secara otomatis memetakan post tersebut ke dalam koleksi yang sesuai (`Meme Programmer Lucu`, `Desain Antarmuka Modern`, dan `Koleksi Rahasiaku`) milik Test User.

---

## 🧪 Hasil Verifikasi & Pengujian

### 1. Pengujian Otomatis
Sebuah suite pengujian fitur otomatis telah dibuat di **[LivewireFeedTest.php](file:///c:/PecintaMultimedia/tests/Feature/LivewireFeedTest.php)** untuk memvalidasi:
1.  Pemuatan rute `/feed` memuat komponen `HomeFeed` dengan sukses.
2.  Meme terunggah muncul di halaman feed.
3.  Filter pencarian instan Livewire menyaring data secara akurat.
4.  Interaksi tombol suka Livewire (`LikeButton`) menambah dan mengurangi jumlah suka di database serta state UI secara real-time.

Semua pengujian berjalan sukses:
```bash
php artisan test --filter=LivewireFeedTest

 PASS  Tests\Feature\LivewireFeedTest
✓ home feed renders successfully
✓ home feed shows all posts
✓ home feed filters posts by search
✓ like button toggles correctly

Tests:    4 passed (18 assertions)
Duration: 1.84s
```

### 2. Manual Verification
*   Database berhasil diisi dengan data meme uji coba beserta file fisiknya di folder `public/uploads/memes` menggunakan seeder baru.
*   Server lokal diaktifkan kembali pada `http://127.0.0.1:8000` dan siap digunakan.
