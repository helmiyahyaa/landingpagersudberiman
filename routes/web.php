<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LayananController; 
use App\Http\Controllers\AgendaController; 
use App\Http\Controllers\BeritaController; 
use App\Http\Controllers\InformasiController; 
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');
Route::get('/categories/{slugOrLink}', [LandingController::class, 'showBySlug'])->name('categories.showBySlug');
Route::get('/konten/{jenis}', [LandingController::class, 'listKonten'])->name('konten.show');
// ...

// Route ini akan menangani SEMUA link dari dropdown navbar Anda.
// Contoh: /informasi/data_laporan, /informasi/regulasi, /informasi/zona-integritas
Route::get('/informasi/{param}', [LandingController::class, 'showList'])->name('informasi.list');

// Route ini KHUSUS untuk menampilkan halaman detail.
// Prefix '/detail' ditambahkan untuk memastikan tidak ada konflik dengan route di atas.
Route::get('/informasi/detail/{slug}', [LandingController::class, 'showDetail'])->name('informasi.show');
Route::get('/berita/{slug}', [LandingController::class, 'showBeritaDetail'])->name('berita.show');
Route::get('/pengumuman/{slug}', [LandingController::class, 'showPengumumanDetail'])->name('pengumuman.show');
Route::get('/layanan/{slug}', [LandingController::class, 'showLayananDetail'])->name('layanan.detail');
/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/  

Auth::routes();
    Route::get('/home', [HomeController::class, 'index'])->name('home');


 /*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/   
    
    Route::get('/about', function () {return view('admin.about');})->name('about');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('layanans', LayananController::class);
    Route::resource('informasis', InformasiController::class);
    Route::resource('categories', CategoriesController::class);
    Route::resource('zona_integritas', ZonaIntegritasController::class);
    Route::resource('reformasi_birokrasis', ReformasiBirokrasiController::class);
    Route::resource('regulasis', RegulasiController::class);
    Route::resource('kt_profils', KtProfilController::class);
    Route::resource('data_profils', DataProfilController::class);
    Route::resource('agendas', AgendaController::class);
    Route::resource('beritas', BeritaController::class);
    Route::resource('users', UserController::class);
    Route::resource('pengumumans', PengumumanController::class);
    Route::resource('kt_laporans', KtLaporanController::class);
    Route::resource('kt_zis', KtZisController::class);
    Route::resource('dok_laporans', DokLaporanController::class);
