<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

// Import model-model yang diperlukan untuk sidebar
use App\Models\Berita; // Asumsi nama model Anda untuk berita
use App\Models\Pengumuman; // Asumsi nama model Anda untuk pengumuman
use App\Models\Layanan; // Asumsi nama model Anda untuk layanan

class CategoriesController extends Controller
{
    /**
     * Menampilkan daftar semua kategori.
     */
    public function index()
    {
        $categories = Categories::latest()->paginate(10);
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Menampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        $parentCategories = Categories::where('parent_menu', 0)->orWhereNull('parent_menu')->get();
        return view('admin.pages.categories.create', compact('parentCategories'));
    }

    /**
     * Menyimpan kategori baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:categories',
            'parent_menu' => 'nullable|integer',
            'status' => 'required|string',
            'isi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $validated;

        $data['slug'] = $request->slug
            ? Str::slug($request->slug, '-')
            : Str::slug($request->nama, '-');

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('public/categories');
            $data['foto'] = Storage::url($path);
        }

        Categories::create($data);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail satu kategori (menggunakan route model binding).
     * Metode ini umumnya digunakan untuk route seperti /categories/{category}
     */
    public function show(Categories $category)
    {
        return view('admin.pages.categories.show', compact('category'));
    }

    /**
     * Menampilkan kategori berdasarkan slug atau link,
     * serta data untuk sidebar (berita, pengumuman, layanan).
     */





    /**
     * Menampilkan form untuk mengedit kategori.
     */
    public function edit(Categories $category)
    {
        $parentCategories = Categories::where('id', '!=', $category->id)
            ->where(function ($query) {
                $query->where('parent_menu', 0)->orWhereNull('parent_menu');
            })->get();

        return view('admin.pages.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Memperbarui data kategori.
     */
    public function update(Request $request, Categories $category)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
            'parent_menu' => 'nullable|integer',
            'status' => 'required|string',
            'isi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $validated;

        $data['slug'] = $request->slug
            ? Str::slug($request->slug, '-')
            : Str::slug($request->nama, '-');

        if ($request->hasFile('foto')) {
            if ($category->foto) {
                $oldPath = str_replace('/storage', 'public', $category->foto);
                Storage::delete($oldPath);
            }

            $path = $request->file('foto')->store('public/categories');
            $data['foto'] = Storage::url($path);
        }

        $category->update($data);

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Menghapus kategori (soft delete).
     */
    public function destroy(Categories $category)
    {
        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
