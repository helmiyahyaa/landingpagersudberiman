<?php

namespace App\Http\Controllers;

use App\Models\KtProfil;
use Illuminate\Http\Request;

class KtProfilController extends Controller
{
    public function index()
    {
        $kt_profils = KtProfil::paginate(10);
        return view('admin.pages.kt_profils.index', compact('kt_profils'));
    }

    public function create()
    {
        return view('admin.pages.kt_profils.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        KtProfil::create($request->all());

        return redirect()->route('kt_profils.index')
            ->with('success', 'Kategori Profil berhasil ditambahkan');
    }

    public function show(KtProfil $ktProfil)
    {
        return view('admin.pages.kt_profils.show', compact('ktProfil'));
    }

    public function edit(KtProfil $ktProfil)
    {
        return view('admin.pages.kt_profils.edit', compact('ktProfil'));
    }

    public function update(Request $request, KtProfil $ktProfil)
    {
        $request->validate([
            'nama' => 'required|string|max:255'
        ]);

        $ktProfil->update($request->all());

        return redirect()->route('kt_profils.index')
            ->with('success', 'Kategori Profil berhasil diperbarui');
    }

    public function destroy(KtProfil $ktProfil)
    {
        $ktProfil->delete();

        return redirect()->route('kt_profils.index')
            ->with('success', 'Kategori Profil berhasil dihapus');
    }
}