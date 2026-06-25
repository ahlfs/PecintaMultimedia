<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller
{
    /**
     * Tampilkan daftar koleksi milik pengguna yang sedang masuk.
     */
    public function index()
    {
        $collections = Collection::where('user_id', session('user_id'))
            ->withCount('posts')
            ->with(['posts' => function ($query) {
                $query->latest()->limit(3);
            }])
            ->latest()
            ->paginate(9);

        return view('collections.index', compact('collections'));
    }

    /**
     * Tampilkan form pembuatan koleksi baru.
     */
    public function create()
    {
        return view('collections.create');
    }

    /**
     * Simpan koleksi baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_private' => 'nullable|boolean',
        ], [
            'name.required' => 'Nama koleksi wajib diisi.',
            'name.max' => 'Nama koleksi maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        Collection::create([
            'user_id' => session('user_id'),
            'name' => $request->name,
            'description' => $request->description,
            'is_private' => $request->has('is_private') ? true : false,
        ]);

        return redirect()->route('collections.index')->with('success', 'Koleksi baru berhasil dibuat!');
    }

    /**
     * Tampilkan detail koleksi beserta post di dalamnya.
     */
    public function show(Collection $collection)
    {

        // Jika koleksi rahasia dan bukan milik pengguna saat ini, batalkan akses (403)
        if ($collection->is_private && $collection->user_id != session('user_id')) {
            abort(403, 'Akses ditolak. Koleksi ini bersifat rahasia.');
        }

        $posts = $collection->posts()->latest()->paginate(12);

        return view('collections.show', compact('collection', 'posts'));
    }

    /**
     * Tampilkan form edit koleksi.
     */
    public function edit(Collection $collection)
    {

        // Validasi kepemilikan
        if ($collection->user_id != session('user_id')) {
            abort(403, 'Akses ditolak. Anda bukan pemilik koleksi ini.');
        }

        return view('collections.edit', compact('collection'));
    }

    /**
     * Update data koleksi di database.
     */
    public function update(Request $request, Collection $collection)
    {

        // Validasi kepemilikan
        if ($collection->user_id != session('user_id')) {
            abort(403, 'Akses ditolak. Anda bukan pemilik koleksi ini.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'is_private' => 'nullable|boolean',
        ], [
            'name.required' => 'Nama koleksi wajib diisi.',
            'name.max' => 'Nama koleksi maksimal 255 karakter.',
            'description.max' => 'Deskripsi maksimal 1000 karakter.',
        ]);

        $collection->update([
            'name' => $request->name,
            'description' => $request->description,
            'is_private' => $request->has('is_private') ? true : false,
        ]);

        return redirect()->route('collections.index')->with('success', 'Koleksi berhasil diperbarui!');
    }

    /**
     * Hapus koleksi beserta relasi post di dalamnya (cascading).
     */
    public function destroy(Collection $collection)
    {

        // Validasi kepemilikan
        if ($collection->user_id != session('user_id')) {
            abort(403, 'Akses ditolak. Anda bukan pemilik koleksi ini.');
        }

        $collection->delete();

        return redirect()->route('collections.index')->with('success', 'Koleksi berhasil dihapus.');
    }
}
