<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage; // Pastikan Storage di-import
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Menampilkan daftar berita.
     * Termasuk fungsionalitas untuk melihat data yang sudah di-soft delete (trashed).
     */
    public function index(Request $request)
    {
        if ($request->query('status') === 'trashed') {
            // Hanya tampilkan data yang ada di "tong sampah"
            $beritas = Berita::onlyTrashed()->latest()->paginate(10);
        } else {
            // Tampilkan data yang aktif (tidak di-soft delete)
            $beritas = Berita::latest()->paginate(10);
        }

        return view('admin.pages.beritas.index', compact('beritas'));
    }

    /**
     * Menampilkan form untuk membuat berita baru.
     */
    public function create()
    {
        return view('admin.pages.beritas.create');
    }

    /**
     * Menyimpan berita baru ke database.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:beritas,judul',
            'isi'   => 'nullable|string',
            'foto'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date'  => 'nullable|date', // 'date' atau 'tanggal' sesuaikan dengan nama kolom di form & db
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->except('foto'); // Ambil semua input kecuali foto
        $input['slug'] = Str::slug($request->judul);

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/berita_fotos');
            $input['foto'] = basename($path);
        }

        Berita::create($input);

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil dibuat.');
    }

    /**
     * Menampilkan detail satu berita.
     */
    public function show(Berita $berita)
    {
        return view('admin.pages.beritas.show', compact('berita'));
    }

    /**
     * Menampilkan form untuk mengedit berita.
     */
    public function edit(Berita $berita)
    {
        return view('admin.pages.beritas.edit', compact('berita'));
    }

    /**
     * Memperbarui data berita di database.
     */
    public function update(Request $request, Berita $berita)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:beritas,judul,' . $berita->id,
            'isi'   => 'nullable|string',
            'foto'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'date'  => 'nullable|date',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->except('foto');
        $input['slug'] = Str::slug($request->judul);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($berita->foto) {
                Storage::delete('public/berita_fotos/' . $berita->foto);
            }
            $path = $request->file('foto')->store('public/berita_fotos');
            $input['foto'] = basename($path);
        }

        $berita->update($input);

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Melakukan soft delete pada berita (memindahkan ke "tong sampah").
     */
    public function destroy(Berita $berita)
    {
        $berita->delete(); // Ini akan melakukan soft delete
        return redirect()->route('beritas.index')->with('success', 'Berita berhasil dipindahkan ke tong sampah.');
    }

    /**
     * Mengembalikan data berita dari "tong sampah".
     */
    public function restore($id)
    {
        $berita = Berita::onlyTrashed()->findOrFail($id);
        $berita->restore();

        return redirect()->route('beritas.index')->with('success', 'Berita berhasil dikembalikan.');
    }

    /**
     * Menghapus data berita dan foto terkait secara permanen.
     */
    public function forceDelete($id)
    {
        $berita = Berita::onlyTrashed()->findOrFail($id);
        
        // Hapus foto terkait jika ada
        if ($berita->foto) {
            Storage::delete('public/berita_fotos/' . $berita->foto);
        }

        // Hapus data dari database secara permanen
        $berita->forceDelete();

        return redirect()->route('beritas.index', ['status' => 'trashed'])->with('success', 'Berita berhasil dihapus permanen.');
    }
}