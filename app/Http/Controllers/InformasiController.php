<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Import Validator

class InformasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informasis = Informasi::latest()->paginate(10);
        return view('admin.pages.informasis.index', compact('informasis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.informasis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi ditempatkan langsung di dalam controller
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:informasis,judul',
            'isi'   => 'nullable|string',
            'link'  => 'nullable|string|max:255',
            'icon'  => 'required|string|max:255',
        ]);

        // Jika validasi gagal, kembali dengan error
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Informasi::create($request->all());

        return redirect()->route('informasis.index')
            ->with('success', 'Informasi berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Informasi $informasi)
    {
        return view('admin.pages.informasis.show', compact('informasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Informasi $informasi)
    {
        return view('admin.pages.informasis.edit', compact('informasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Informasi $informasi)
    {
        // Validasi untuk update
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:informasis,judul,' . $informasi->id,
            'isi'   => 'nullable|string',
            'link'  => 'nullable|string|max:255',
            'icon'  => 'required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $informasi->update($request->all());

        return redirect()->route('informasis.index')
            ->with('success', 'Informasi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Informasi $informasi)
    {
        $informasi->delete();

        return redirect()->route('informasis.index')
            ->with('success', 'Informasi berhasil dihapus.');
    }

    public function landing()
{
    $informasis = Informasi::latest()->take(6)->get(); // Ambil 6 data terbaru
    return view('welcome', compact('informasis')); // Ganti 'landing' dengan nama view kamu
}

}