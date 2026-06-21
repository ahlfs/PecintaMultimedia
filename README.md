# [Nama Project]

Project ini merupakan tugas kuliah untuk mata kuliah Pemrograman Web yang berfokus pada pengembangan aplikasi web berbagi foto/gambar yang terinspirasi oleh Pinterest.com.

## Anggota Kelompok

Berikut adalah daftar anggota kelompok pengembang project ini:

1. **Muhamad Alamsyah Ahlul Firdaus** (Ketua)
   - **NIM:** 241110014
2. **Afriza Marshal Verdiasta**
   - **NIM:** 241110057
3. **Muhammad Alfiano Akmal Zen**
   - **NIM:** 241110053
4. **Handika Wijaksono**
   - **NIM:** 241110095
5. **Rizqy Naufal Pradana**
   - **NIM:** 241110088

---

# Product Requirement Document (PRD) - Pinterest-like Collection & Post Sharing

## 1. Ringkasan Eksekutif & Tujuan
Tujuan dari project ini adalah membangun sebuah platform web berbagi visual yang memungkinkan pengguna untuk menemukan, mengunggah, menyimpan, dan mengorganisasi gambar atau foto meme ke dalam collection melalui postingan (post). Aplikasi ini terinspirasi dari **Pinterest.com** dengan penyesuaian fungsionalitas utama yang disederhanakan untuk kebutuhan penyimpanan dan pengelompokan foto dalam collection.

## 2. Teknologi yang Digunakan (Tech Stack)
Aplikasi ini dikembangkan menggunakan kombinasi teknologi modern untuk menghasilkan aplikasi web yang interaktif, responsif, dan dinamis:
*   **Backend Framework:** Laravel (PHP) 12 - Menyediakan arsitektur MVC, ORM (Eloquent), routing, keamanan, dan manajemen basis data.
*   **Frontend Reaktivitas:** Livewire - Memungkinkan interaksi dinamis secara real-time tanpa perlu memuat ulang halaman (SPA-like experience) langsung dari sisi backend Laravel.
*   **Database:** MySQL - Untuk penyimpanan relasional data pengguna, collection, post, komentar, suka (like), dan relasi antar entitas.
*   **CSS Styling:** Tailwind CSS cdn - Dengan palette warna custom (#293681, #4274D9, #95CCDD, #D0E7E6) untuk desain antarmuka yang modern, responsif (mobile-friendly), estetik, dan cepat disesuaikan dengan utility classes.
*   **Alert & Notifikasi:** Sweetalert (SweetAlert2) - Untuk memberikan dialog konfirmasi (misalnya saat menghapus post atau collection) serta pop-up notifikasi sukses/gagal yang interaktif dan menarik.

## 3. Fitur Utama & Kebutuhan Fungsional

### A. Autentikasi & Manajemen Pengguna
*   **Registrasi & Login:** Pengguna dapat membuat akun baru menggunakan username, email, dan kata sandi, serta login ke sistem. Sistem autentikasi dibangun secara mandiri tanpa menggunakan library auth tambahan, dengan pengecekan username & password yang di-hash menggunakan **Argon2** (`PASSWORD_ARGON2ID`).
*   **Manajemen Profil:** Pengguna dapat mengedit informasi profil seperti nama tampilan, username, bio, dan foto profil.

### B. Manajemen Collection
*   **Pembuatan Collection:** Pengguna dapat membuat collection baru untuk mengelompokkan postingan foto dengan menyertakan nama collection, deskripsi, dan opsi privasi (Publik/Rahasia).
*   **Edit & Hapus Collection:** Pemilik collection dapat mengubah informasi collection atau menghapus collection miliknya beserta post di dalamnya dengan konfirmasi Sweetalert.

### C. Manajemen Post (Visual Content)
*   **Unggah & Pembuatan Post:** Pengguna dapat membuat postingan baru dengan mengunggah gambar/foto serta menyertakan:
    *   Judul Post
    *   Deskripsi (opsional)
    *   Pemilihan satu atau beberapa Collection tujuan penyimpanan (opsional)
    *   Kategori atau Tag (opsional)
*   **Detail Post:** Halaman detail untuk melihat gambar post secara penuh, pembuat post, deskripsi, daftar collection yang memuat post ini, tombol untuk menyimpan post ke collection pengguna lain, komentar, dan jumlah suka (likes).
*   **Edit & Hapus Post:** Pemilik post dapat mengubah judul, deskripsi, mengelola pilihan collection tempat post disimpan, atau menghapus post miliknya dengan konfirmasi Sweetalert.

### D. Interaksi & Sosial
*   **Sistem Suka (Likes):** Pengguna dapat memberikan tanda suka pada post untuk mengapresiasi karya pengguna lain.
*   **Kolom Komentar:** Pengguna dapat menulis dan menghapus komentar pada halaman detail post secara real-time (Livewire).

### E. Eksplorasi & Pencarian
*   **Home Feed Dinamis:** Halaman utama menampilkan post-post terbaru yang diunggah pengguna menggunakan tata letak grid masonry (*Masonry Layout*).
*   **Pencarian (Search Bar):** Pengguna dapat mencari post berdasarkan judul atau kategori tertentu.

## 4. Arsitektur Database (Rencana Skema)

Berikut adalah entitas utama yang direncanakan dalam database MySQL:
*   `users`: Menyimpan kredensial pengguna, profil, dan informasi dasar.
*   `collections`: Menyimpan informasi collection yang dibuat oleh pengguna (user_id, name, description, is_private).
*   `posts`: Menyimpan informasi gambar/foto yang diunggah serta detail post (user_id, title, description, image_path).
*   `collection_post`: Tabel pivot menghubungkan collection dan post (collection_id, post_id).
*   `comments`: Menyimpan komentar pengguna pada post (user_id, post_id, body).
*   `likes`: Menyimpan penanda suka pada post oleh pengguna (user_id, post_id).

## 5. Antarmuka Pengguna & UX (User Experience)
*   **Masonry Grid Layout:** Halaman beranda menggunakan grid dinamis yang menyesuaikan tinggi gambar post secara otomatis.
*   **Desain Responsif:** Tampilan yang optimal saat dibuka di perangkat mobile maupun desktop.
*   **Sweetalert Alerts:** Penggunaan dialog pop-up modern saat terjadi aksi krusial, seperti:
    *   Konfirmasi sebelum menghapus post atau collection.
    *   Notifikasi berhasil setelah login, mengunggah/membuat post, membuat collection, atau memberikan komentar.

## 6. Pembagian Tugas Antar Anggota

Berikut adalah pembagian peran dan tanggung jawab pengembangan fitur dalam project ini:

1. **Muhamad Alamsyah Ahlul Firdaus** (Ketua)
   - **Peran:** Backend Architect & Lead Developer
   - **Tugas:**
     - Merancang dan memigrasikan database (`users`, `collections`, `posts`, `collection_post`, `comments`, `likes`).
     - Mengembangkan sistem autentikasi manual menggunakan **Argon2** (`PASSWORD_ARGON2ID`) dan manajemen sesi berbasis custom middleware (`manual.auth`, `manual.guest`, `ShareAuthUser`).
     - Koordinasi integrasi kode antar anggota kelompok.
     - Membuat dan mendesain landing page aplikasi.

2. **Muhammad Alfiano Akmal Zen**
   - **Peran:** UI/UX Designer & Frontend Auth Developer
   - **Tugas:**
     - Mengintegrasikan styling dasar (Tailwind CDN, Outfit Google Font, Font-Awesome Icons, SweetAlert2) dengan kustomisasi palette warna brand.
     - Membuat template halaman master (`app.blade.php`).
     - Mendesain dan mengimplementasikan UI untuk halaman Login (`auth.login`), halaman Register (`auth.register`), dan Edit Profil (`profile.edit`).

3. **Handika Wijaksono**
   - **Peran:** Collection Module Developer
   - **Tugas:**
     - Mengembangkan controller dan logika CRUD untuk entitas `Collection` (`CollectionController`).
     - Mendesain dan mengimplementasikan UI untuk halaman daftar collection (`collections.index`), detail collection (`collections.show`), pembuatan collection (`collections.create`), dan edit collection (`collections.edit`).

4. **Rizqy Naufal Pradana**
   - **Peran:** Post Module & Upload Developer
   - **Tugas:**
     - Mengembangkan controller dan logika CRUD untuk entitas `Post` (`PostController`), termasuk penanganan unggah file gambar meme ke `public/uploads/posts`.
     - Mendesain dan mengimplementasikan UI untuk halaman detail post (`posts.show`) lengkap dengan form/modal untuk menyimpan post ke collection milik sendiri (relasi Many-to-Many).
     - Membuat halaman pembuatan post (`posts.create`) dan edit post (`posts.edit`).

5. **Afriza Marshal Verdiasta**
   - **Peran:** Livewire Interactive Features Developer
   - **Tugas:**
     - Mengembangkan komponen Livewire Home Feed (`HomeFeed`) dengan tata letak grid masonry dinamis dan fitur pencarian real-time (instant search).
     - Mengembangkan komponen Livewire Tombol Suka (`LikeButton`) untuk interaksi suka post secara real-time.
     - Mengembangkan komponen Livewire Kolom Komentar (`CommentsSection`) untuk interaksi menulis dan menghapus komentar post secara real-time.


## 7. Aturan Caching, Lazy Loading, & Pagination
*   **Caching:** Implementasikan caching (misalnya caching query database atau data statis) untuk mempercepat waktu respons aplikasi dan meminimalkan beban database.
*   **Lazy Loading:** Terapkan lazy loading pada aset gambar (misalnya pada layout masonry feed) untuk mengurangi waktu pemuatan halaman awal dan menghemat penggunaan bandwidth.
*   **Pagination:** Gunakan pagination untuk membatasi jumlah data yang ditampilkan sekaligus dalam satu halaman (misalnya pada halaman pencarian, beranda, atau collection) agar performa aplikasi tetap optimal.

## 8. Batasan
*   **Dilarang menggunakan, menambah, atau mengubah yang tidak ditentukan pada rancangan diatas**
