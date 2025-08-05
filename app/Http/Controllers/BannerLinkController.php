<?php

namespace App\Http\Controllers;

use App\Models\BannerLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BannerLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $bannerLinks = BannerLink::latest()->paginate(10);
        return view('admin.pages.banner_links.index', compact('bannerLinks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('admin.pages.banner_links.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'nullable|url',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:aktif,tidak-aktif',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/banner_fotos');
            $data['foto'] = basename($path);
        }

        BannerLink::create($data);

        return redirect()->route('badmin.pages.banner_links.index')
                         ->with('success', 'Banner Link created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BannerLink  $bannerLink
     * @return \Illuminate\View\View
     */
    public function show(BannerLink $bannerLink): View
    {
        return view('admin.pages.banner_links.show', compact('bannerLink'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BannerLink  $bannerLink
     * @return \Illuminate\View\View
     */
    public function edit(BannerLink $bannerLink): View
    {
        return view('admin.pages.banner_links.edit', compact('bannerLink'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BannerLink  $bannerLink
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, BannerLink $bannerLink): RedirectResponse
    {
        // Validate the request
        $request->validate([
            'judul' => 'required|string|max:255',
            'link' => 'nullable|url',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:aktif,tidak-aktif',
        ]);

        $data = $request->all();

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old photo if it exists
            if ($bannerLink->foto) {
                Storage::delete('public/banner_fotos/' . $bannerLink->foto);
            }
            $path = $request->file('foto')->store('public/banner_fotos');
            $data['foto'] = basename($path);
        }

        $bannerLink->update($data);

        return redirect()->route('banner_links.index')
                         ->with('success', 'Banner Link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BannerLink  $bannerLink
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(BannerLink $bannerLink): RedirectResponse
    {
        // Delete the photo file
        if ($bannerLink->foto) {
            Storage::delete('public/banner_fotos/' . $bannerLink->foto);
        }
        
        // Soft delete the record
        $bannerLink->delete();

        return redirect()->route('banner_links.index')
                         ->with('success', 'Banner Link deleted successfully.');
    }
}
