<?php

namespace App\Http\Controllers;

use App\Models\ZonaIntegritas;
use App\Models\KtZis; // Pastikan model ini ada dan sesuai
use Illuminate\Http\Request;

class ZonaIntegritasController extends Controller
{
    /**
     * Menampilkan daftar sumber daya.
     */
    public function index()
    {
        // Mengambil semua data ZonaIntegritas dengan relasi ktZis
        // Diurutkan berdasarkan yang terbaru dan diberi paginasi
        $zonaIntegrita = ZonaIntegritas::with('ktZis')->latest()->paginate(10);
        
        // Sesuaikan path view jika berbeda
        return view('admin.pages.zona_integritas.index', compact('zonaIntegrita')); 
    }

    /**
     * Menampilkan formulir untuk membuat sumber daya baru.
     */
    public function create()
    {
        // Mengambil semua data kategori untuk ditampilkan di dropdown form
        $kategori = KtZis::all(); 
        
        // Sesuaikan path view jika berbeda
        return view('admin.pages.zona_integritas.create', compact('kategori')); 
    }

    /**
     * Menyimpan sumber daya yang baru dibuat di penyimpanan.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255|unique:zis,judul',
            'isi' => 'nullable|string',
            'link' => 'nullable|url',
            'kt_zis' => 'required|exists:kt_zis,id', // Pastikan tabel kt_zis ada
        ]);

        // Membuat data baru. Slug akan terisi otomatis oleh model.
        ZonaIntegritas::create($validatedData);

        // Arahkan kembali ke halaman index dengan pesan sukses
        return redirect()->route('zona_integritas.index')->with('success', 'Data Zona Integritas berhasil ditambahkan.');
    }

    /**
     * Menampilkan sumber daya yang ditentukan.
     * Menggunakan Route Model Binding dengan slug.
     */
    public function show(ZonaIntegritas $zonaIntegrita) // Nama variabel harus camelCase dari nama route resource
    {
        // Sesuaikan path view untuk tampilan publik jika berbeda
        return view('admin.pages.zona_integritas.show', compact('zonaIntegrita')); 
    }

    /**
     * Menampilkan formulir untuk mengedit sumber daya yang ditentukan.
     */
    public function edit(ZonaIntegritas $zonaIntegrita)
    {
        $kategori = KtZis::all();
        
        // Sesuaikan path view jika berbeda
        return view('admin.pages.zona_integritas.edit', compact('zonaIntegrita', 'kategori')); 
    }

    /**
     * Memperbarui sumber daya yang ditentukan di penyimpanan.
     */
    public function update(Request $request, ZonaIntegritas $zonaIntegrita)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255|unique:zis,judul,' . $zonaIntegrita->id,
            'isi' => 'nullable|string',
            'link' => 'nullable|url',
            'kt_zis' => 'required|exists:kt_zis,id',
        ]);

        // Update data. Jika judul berubah, slug akan otomatis diperbarui oleh model.
        $zonaIntegrita->update($validatedData);

        return redirect()->route('zona_integritas.index')->with('success', 'Data Zona Integritas berhasil diperbarui.');
    }

    /**
     * Menghapus sumber daya yang ditentukan dari penyimpanan.
     */
    public function destroy(ZonaIntegritas $zonaIntegrita)
    {
        $zonaIntegrita->delete();
        
        return redirect()->route('zona_integritas.index')->with('success', 'Data Zona Integritas berhasil dihapus.');
    }
}
