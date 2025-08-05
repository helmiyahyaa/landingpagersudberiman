<?php

namespace App\Http\Controllers;

use App\Models\ReformasiBirokrasi;
use Illuminate\Http\Request;

class ReformasiBirokrasiController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     */
    public function index()
    {
        $data = ReformasiBirokrasi::latest()->paginate(10);

        return view('admin.pages.reformasi_birokrasis.index', compact('data'));
    }

    /**
     * Menampilkan formulir untuk membuat sumber daya baru.
     */
    public function create()
    {
        return view('admin.pages.reformasi_birokrasis.create');
    }

    /**
     * Menyimpan sumber daya yang baru dibuat di penyimpanan.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255|unique:reformasi_birokrasis,judul',
            'isi' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        ReformasiBirokrasi::create($validatedData);

        return redirect()->route('reformasi_birokrasis.index')->with('success', 'Data Reformasi Birokrasi berhasil ditambahkan.');
    }

    /**
     * Menampilkan sumber daya yang ditentukan.
     */
    public function show(ReformasiBirokrasi $reformasiBirokrasi)
    {
        return view('admin.pages.reformasi_birokrasis.show', compact('reformasiBirokrasi'));
    }

    /**
     * Menampilkan formulir untuk mengedit sumber daya yang ditentukan.
     */
    public function edit(ReformasiBirokrasi $reformasiBirokrasi)
    {
        return view('admin.pages.reformasi_birokrasis.edit', compact('reformasiBirokrasi'));
    }

    /**
     * Memperbarui sumber daya yang ditentukan di penyimpanan.
     */
    public function update(Request $request, ReformasiBirokrasi $reformasiBirokrasi)
    {
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255|unique:reformasi_birokrasis,judul,' . $reformasiBirokrasi->id,
            'isi' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        $reformasiBirokrasi->update($validatedData);

        return redirect()->route('reformasi_birokrasis.index')->with('success', 'Data Reformasi Birokrasi berhasil diperbarui.');
    }

    /**
     * Menghapus sumber daya yang ditentukan dari penyimpanan.
     */
    public function destroy(ReformasiBirokrasi $reformasiBirokrasi)
    {
        $reformasiBirokrasi->delete();

        return redirect()->route('reformasi_birokrasis.index')->with('success', 'Data Reformasi Birokrasi berhasil dihapus.');
    }
}
