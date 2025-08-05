<?php

namespace App\Http\Controllers;

use App\Models\DokLaporan;
use App\Models\KtLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DokLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $dokLaporans = DokLaporan::with('ktLaporan')->latest()->paginate(10);
        return view('admin.pages.dok_laporans.index', compact('dokLaporans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Mengambil data kategori untuk dropdown
        $kategoriLaporans = KtLaporan::pluck('nama', 'id');
        return view('admin.pages.dok_laporans.create', compact('kategoriLaporans'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:dok_laporans,judul',
            'isi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kt_laporans_id' => 'required|integer|exists:kt_laporans,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->except('foto');
        
        // Handle file upload
        if ($request->hasFile('foto')) {
            // Simpan file ke storage/app/public/fotos dan dapatkan path-nya
            $path = $request->file('foto')->store('public/fotos');
            $input['foto'] = $path;
        }

        DokLaporan::create($input);

        return redirect()->route('dok_laporans.index')->with('success', 'Dokumen Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DokLaporan  $dokLaporan
     * @return \Illuminate\View\View
     */
    public function show(DokLaporan $dokLaporan)
    {
        return view('admin.pages.dok_laporans.show', compact('dokLaporan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DokLaporan  $dokLaporan
     * @return \Illuminate\View\View
     */
    public function edit(DokLaporan $dokLaporan)
    {
        $kategoriLaporans = KtLaporan::pluck('nama', 'id');
        return view('admin.pages.dok_laporans.edit', compact('dokLaporan', 'kategoriLaporans'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DokLaporan  $dokLaporan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, DokLaporan $dokLaporan)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:dok_laporans,judul,' . $dokLaporan->id,
            'isi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'kt_laporans_id' => 'required|integer|exists:kt_laporans,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->except('foto');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($dokLaporan->foto) {
                Storage::delete($dokLaporan->foto);
            }
            // Upload foto baru
            $path = $request->file('foto')->store('public/fotos');
            $input['foto'] = $path;
        }

        $dokLaporan->update($input);

        return redirect()->route('dok_laporans.index')->with('success', 'Dokumen Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DokLaporan  $dokLaporan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(DokLaporan $dokLaporan)
    {
        // Hapus file foto dari storage jika ada
        if ($dokLaporan->foto) {
            Storage::delete($dokLaporan->foto);
        }
        
        $dokLaporan->delete();

        return redirect()->route('dok_laporans.index')->with('success', 'Dokumen Laporan berhasil dihapus.');
    }
}
