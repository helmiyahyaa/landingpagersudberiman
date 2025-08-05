<?php

namespace App\Http\Controllers;

use App\Models\DataProfil;
use App\Models\KtProfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataProfilController extends Controller
{
    public function index()
    {
        $dataProfils = DataProfil::with('kategori')->latest()->paginate(10); // ✅ pakai paginate
        return view('admin.pages.data_profils.index', compact('dataProfils'));
        
    }

    public function create()
    {
        $kategoris = KtProfil::all();
        return view('admin.pages.data_profils.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'kt_profils_id' => 'required|exists:kt_profils,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('profil_fotos', 'public');
        }

        DataProfil::create($data);

        return redirect()->route('data_profils.index')
            ->with('success', 'Data Profil berhasil ditambahkan');
    }

    public function show(DataProfil $dataProfil)
    {
        return view('admin.pages.data_profils.show', compact('dataProfil'));
    }

    public function edit(DataProfil $dataProfil)
    {
        $kategoris = KtProfil::all();
        return view('admin.pages.data_profils.edit', compact('dataProfil', 'kategoris'));
    }

    public function update(Request $request, DataProfil $dataProfil)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'required',
            'kt_profils_id' => 'required|exists:kt_profils,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($dataProfil->foto) {
                Storage::disk('public')->delete($dataProfil->foto);
            }
            $data['foto'] = $request->file('foto')->store('profil_fotos', 'public');
        }

        $dataProfil->update($data);

        return redirect()->route('data_profils.index')
            ->with('success', 'Data Profil berhasil diperbarui');
    }

    public function destroy(DataProfil $dataProfil)
    {
        if ($dataProfil->foto) {
            Storage::disk('public')->delete($dataProfil->foto);
        }

        $dataProfil->delete();

        return redirect()->route('data_profils.index')
            ->with('success', 'Data Profil berhasil dihapus');
    }
}