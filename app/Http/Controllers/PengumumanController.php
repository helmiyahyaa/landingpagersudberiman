<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumumans = Pengumuman::latest()->paginate(10);
        return view('admin.pages.pengumumans.index', compact('pengumumans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.pengumumans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:pengumumans,judul',
            'isi'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->only(['judul', 'isi']);
        $input['slug'] = Str::slug($request->judul);

        Pengumuman::create($input);

        return redirect()->route('pengumumans.index')->with('success', 'Pengumuman berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumuman $pengumuman)
    {
        return view('admin.pages.pengumumans.show', compact('pengumuman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pages.pengumumans.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255|unique:pengumumans,judul,' . $pengumuman->id,
            'isi'   => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->only(['judul', 'isi']);
        $input['slug'] = Str::slug($request->judul);

        $pengumuman->update($input);

        return redirect()->route('pengumumans.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('pengumumans.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
