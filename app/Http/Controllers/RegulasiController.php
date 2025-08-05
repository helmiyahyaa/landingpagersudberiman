<?php

namespace App\Http\Controllers;

use App\Models\Regulasi;
use Illuminate\Http\Request;

class RegulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // RegulasiController.php
    public function index()
    {
        $regulasis = Regulasi::paginate(10); // Ubah dari get() ke paginate()
        return view('admin.pages.regulasis.index', compact('regulasis'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.regulasis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'required|url|max:255',
        ]);

        Regulasi::create($request->only(['judul', 'link']));

        return redirect()->route('regulasis.index')
            ->with('success', 'Regulasi berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Regulasi $regulasi)
    {
        return view('admin.pages.regulasis.show', compact('regulasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regulasi $regulasi)
    {
        return view('admin.pages.regulasis.edit', compact('regulasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Regulasi $regulasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'required|url|max:255',
        ]);

        $regulasi->update($request->only(['judul', 'link']));

        return redirect()->route('regulasis.index')
            ->with('success', 'Regulasi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regulasi $regulasi)
    {
        $regulasi->delete();

        return redirect()->route('regulasis.index')
            ->with('success', 'Regulasi berhasil dihapus');
    }

    /**
     * Restore soft deleted resource.
     */
    public function restore($id)
    {
        Regulasi::withTrashed()->find($id)->restore();

        return redirect()->route('regulasis.index')
            ->with('success', 'Regulasi berhasil dipulihkan');
    }
}