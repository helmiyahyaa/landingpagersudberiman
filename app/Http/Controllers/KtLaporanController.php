<?php

namespace App\Http\Controllers;

use App\Models\KtLaporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KtLaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Pastikan nama variabelnya adalah $kt_laporans
        $kt_laporans = KtLaporan::latest()->paginate(10);

        // Pastikan string di dalam compact juga 'kt_laporans'
        return view('admin.pages.kt_laporans.index', compact('kt_laporans'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // Mengembalikan view untuk membuat laporan baru
        return view('admin.pages.kt_laporans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:45|unique:kt_laporans,nama',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error dan input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Membuat data baru di database
        KtLaporan::create($request->only(['nama']));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kt_laporans.index')->with('success', 'Laporan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\KtLaporan  $ktLaporan
     * @return \Illuminate\View\View
     */
    public function show(KtLaporan $ktLaporan)
    {
        // Mengembalikan view untuk menampilkan detail laporan
        return view('admin.pages.kt_laporans.show', compact('ktLaporan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\KtLaporan  $ktLaporan
     * @return \Illuminate\View\View
     */
    public function edit(KtLaporan $ktLaporan)
    {
        // Mengembalikan view untuk mengedit laporan
        return view('admin.pages.kt_laporans.edit', compact('ktLaporan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KtLaporan  $ktLaporan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, KtLaporan $ktLaporan)
    {
        // Validasi input, pastikan nama unik kecuali untuk data itu sendiri
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:45|unique:kt_laporans,nama,' . $ktLaporan->id,
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dengan error dan input
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Memperbarui data laporan
        $ktLaporan->update($request->only(['nama']));

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kt_laporans.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KtLaporan  $ktLaporan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(KtLaporan $ktLaporan)
    {
        // Menghapus data (soft delete)
        $ktLaporan->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kt_laporans.index')->with('success', 'Laporan berhasil dihapus.');
    }
}