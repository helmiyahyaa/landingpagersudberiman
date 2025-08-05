<?php

namespace App\Http\Controllers;

use App\Models\ktZis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KtZisController extends Controller
{
    /**
     * Menampilkan daftar semua kategori ZIS.
     */
    public function index()
    {
        $kt_zis = ktZis::latest()->paginate(10);
        // Mengarahkan ke view: resources/views/admin/pages/kt_zis/index.blade.php
        return view('admin.pages.kt_zis.index', compact('kt_zis'));
    }

    /**
     * Menampilkan form untuk membuat kategori ZIS baru.
     */
    public function create()
    {
        // Mengarahkan ke view: resources/views/admin/pages/kt_zis/create.blade.php
        return view('admin.pages.kt_zis.create');
    }

    /**
     * Menyimpan kategori ZIS yang baru dibuat.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:kt_zis,nama',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        ktZis::create($request->all());

        return redirect()->route('kt_zis.index')->with('success', 'Kategori ZIS berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu kategori ZIS.
     */
    public function show(ktZis $ktZi)
    {
        // Mengarahkan ke view: resources/views/admin/pages/kt_zis/show.blade.php
        return view('admin.pages.kt_zis.show', compact('ktZi'));
    }

    /**
     * Menampilkan form untuk mengedit kategori ZIS.
     */
    public function edit(ktZis $ktZi)
    {
        // Mengarahkan ke view: resources/views/admin/pages/kt_zis/edit.blade.php
        return view('admin.pages.kt_zis.edit', compact('ktZi'));
    }

    /**
     * Memperbarui kategori ZIS di database.
     */
    public function update(Request $request, ktZis $ktZi)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255|unique:kt_zis,nama,' . $ktZi->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $ktZi->update($request->all());

        return redirect()->route('kt_zis.index')->with('success', 'Kategori ZIS berhasil diperbarui.');
    }

    /**
     * Menghapus kategori ZIS dari database (soft delete).
     */
    public function destroy(ktZis $ktZi)
    {
        $ktZi->delete();
        return redirect()->route('kt_zis.index')->with('success', 'Kategori ZIS berhasil dihapus.');
    }
}