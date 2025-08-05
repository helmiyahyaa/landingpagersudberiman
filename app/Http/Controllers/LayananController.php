<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::select('id', 'judul', 'subjek1', 'foto')->latest()->paginate(10);
        return view('admin.pages.layanans.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.pages.layanans.create');
    }

    public function store(Request $request)
    {
        // Tambahkan aturan validasi untuk semua kolom
        $validator = Validator::make($request->all(), [
            'judul'   => 'required|string|max:255|unique:layanans,judul',
            'subjek1' => 'nullable|string',
            'isi1'    => 'nullable|string',
            'subjek2' => 'nullable|string',
            'isi2'    => 'nullable|string',
            'subjek3' => 'nullable|string',
            'isi3'    => 'nullable|string',
            'subjek4' => 'nullable|string',
            'isi4'    => 'nullable|string',
            'subjek5' => 'nullable|string',
            'isi5'    => 'nullable|string',
            'subjek6' => 'nullable|string',
            'isi6'    => 'nullable|string',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->except('foto');

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/layanan_fotos');
            $input['foto'] = basename($path);
        }

        Layanan::create($input);

        return redirect()->route('layanans.index')->with('success', 'Layanan berhasil dibuat.');
    }

    public function show(Layanan $layanan)
    {
        return view('admin.pages.layanans.show', compact('layanan'));
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.pages.layanans.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        // Tambahkan aturan validasi untuk semua kolom
        $validator = Validator::make($request->all(), [
            'judul'   => 'required|string|max:255|unique:layanans,judul,' . $layanan->id,
            'subjek1' => 'nullable|string',
            'isi1'    => 'nullable|string',
            'subjek2' => 'nullable|string',
            'isi2'    => 'nullable|string',
            'subjek3' => 'nullable|string',
            'isi3'    => 'nullable|string',
            'subjek4' => 'nullable|string',
            'isi4'    => 'nullable|string',
            'subjek5' => 'nullable|string',
            'isi5'    => 'nullable|string',
            'subjek6' => 'nullable|string',
            'isi6'    => 'nullable|string',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input = $request->except('foto');

        if ($request->hasFile('foto')) {
            if ($layanan->foto) {
                Storage::delete('public/layanan_fotos/' . $layanan->foto);
            }
            $path = $request->file('foto')->store('public/layanan_fotos');
            $input['foto'] = basename($path);
        }

        $layanan->update($input);

        return redirect()->route('layanans.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        if ($layanan->foto) {
            Storage::delete('public/layanan_fotos/' . $layanan->foto);
        }
        $layanan->delete();
        return redirect()->route('layanans.index')->with('success', 'Layanan berhasil dihapus.');
    }

    public function landing()
{
    $layanans = \App\Models\Layanan::select('id', 'judul', 'subjek1', 'foto')->latest()->take(6)->get();
    return view('welcome', compact('layanans')); // <- ini penting
}
}