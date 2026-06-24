<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Collection;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Tampilkan form pembuatan post baru.
     */
    public function create()
    {
        $collections = Collection::where('user_id', session('user_id'))
            ->latest()
            ->get();

        return view('posts.create', compact('collections'));
    }

    /**
     * Simpan post baru ke database beserta file gambarnya.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'collection_ids' => 'nullable|array',
            'collection_ids.*' => 'exists:collections,id',
        ], [
            'title.required' => 'Judul postingan wajib diisi.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
            'image.required' => 'Gambar wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Buat folder uploads/memes jika belum ada
        if (!File::isDirectory(public_path('uploads/memes'))) {
            File::makeDirectory(public_path('uploads/memes'), 0755, true);
        }

        // Upload berkas gambar
        $file = $request->file('image');
        $filename = 'meme_' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/memes'), $filename);
        $imagePath = 'uploads/memes/' . $filename;

        // Simpan data post
        $post = Post::create([
            'user_id' => session('user_id'),
            'title' => $request->title,
            'description' => $request->description,
            'image_path' => $imagePath,
        ]);

        // Hubungkan ke collections (Many-to-Many) yang dimiliki pengguna saat ini
        if ($request->has('collection_ids')) {
            $userCollectionIds = Collection::where('user_id', session('user_id'))->pluck('id')->toArray();
            $validCollectionIds = array_intersect($request->collection_ids, $userCollectionIds);
            $post->collections()->sync($validCollectionIds);
        }

        return redirect()->route('feed')->with('success', 'Meme baru berhasil diunggah!');
    }

    /**
     * Tampilkan detail postingan beserta form simpan ke koleksi.
     */
    public function show(Post $post)
    {
        $post->load(['user', 'collections']);

        // Ambil daftar koleksi milik pengguna saat ini untuk form "Simpan ke Koleksi"
        $collections = Collection::where('user_id', session('user_id'))
            ->latest()
            ->get();

        return view('posts.show', compact('post', 'collections'));
    }

    /**
     * Tampilkan form edit postingan.
     */
    public function edit(Post $post)
    {
        // Validasi kepemilikan post
        if ($post->user_id !== session('user_id')) {
            abort(403, 'Akses ditolak. Anda bukan pemilik postingan ini.');
        }

        $collections = Collection::where('user_id', session('user_id'))
            ->latest()
            ->get();

        $postCollectionIds = $post->collections->pluck('id')->toArray();

        return view('posts.edit', compact('post', 'collections', 'postCollectionIds'));
    }

    /**
     * Perbarui data postingan di database.
     */
    public function update(Request $request, Post $post)
    {

        // Validasi kepemilikan post
        if ($post->user_id !== session('user_id')) {
            abort(403, 'Akses ditolak. Anda bukan pemilik postingan ini.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'collection_ids' => 'nullable|array',
            'collection_ids.*' => 'exists:collections,id',
        ], [
            'title.required' => 'Judul postingan wajib diisi.',
            'title.max' => 'Judul maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $post->title = $request->title;
        $post->description = $request->description;

        // Tangani jika ada berkas gambar baru yang diunggah
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari penyimpanan
            if ($post->image_path && File::exists(public_path($post->image_path))) {
                File::delete(public_path($post->image_path));
            }

            // Simpan gambar baru
            $file = $request->file('image');
            $filename = 'meme_' . uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/memes'), $filename);
            $post->image_path = 'uploads/memes/' . $filename;
        }

        $post->save();

        // Hubungkan ke collections (Many-to-Many) yang dimiliki pengguna saat ini
        $userCollectionIds = Collection::where('user_id', session('user_id'))->pluck('id')->toArray();
        $validCollectionIds = array_intersect($request->input('collection_ids', []), $userCollectionIds);
        $post->collections()->sync($validCollectionIds);

        return redirect()->route('posts.show', $post)->with('success', 'Postingan berhasil diperbarui!');
    }

    /**
     * Hapus postingan beserta berkas gambarnya secara fisik.
     */
    public function destroy(Post $post)
    {

        // Validasi kepemilikan post
        if ($post->user_id !== session('user_id')) {
            abort(403, 'Akses ditolak. Anda bukan pemilik postingan ini.');
        }

        // Hapus file fisik gambar jika ada
        if ($post->image_path && File::exists(public_path($post->image_path))) {
            File::delete(public_path($post->image_path));
        }

        $post->delete();

        return redirect()->route('feed')->with('success', 'Postingan berhasil dihapus.');
    }

    /**
     * Simpan post ke satu atau beberapa koleksi milik pengguna saat ini (tanpa mengganggu kepemilikan user lain).
     */
    public function saveToCollection(Request $request, Post $post)
    {

        $request->validate([
            'collection_ids' => 'nullable|array',
            'collection_ids.*' => 'exists:collections,id',
        ]);

        $userCollections = Collection::where('user_id', session('user_id'))->get();
        $selectedIds = $request->input('collection_ids', []);

        foreach ($userCollections as $collection) {
            $hasPost = $collection->posts()->where('post_id', $post->id)->exists();
            $shouldHavePost = in_array($collection->id, $selectedIds);

            if ($shouldHavePost && !$hasPost) {
                $collection->posts()->attach($post->id);
            } elseif (!$shouldHavePost && $hasPost) {
                $collection->posts()->detach($post->id);
            }
        }

        return redirect()->route('posts.show', $post->slug)->with('success', 'Koleksi penyimpanan post berhasil diperbarui!');
    }
}
