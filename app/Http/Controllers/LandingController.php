<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\BannerLink;
use App\Models\Berita;
use App\Models\Categories;
use App\Models\DokLaporan;
use App\Models\Galeri;
use App\Models\Informasi;
use App\Models\KtLaporan;
use App\Models\ktZis;
use App\Models\Layanan;
use App\Models\Pengumuman;
use App\Models\Polling;
use App\Models\DataProfil;
use App\Models\ReformasiBirokrasi;
use App\Models\Regulasi;
use App\Models\Slider;
use App\Models\UploadVideo;
use App\Models\User;
use App\Models\ZonaIntegritas;

class LandingController extends Controller
{
    /* Menampilkan halaman utama (homepage) dengan data ringkasan. */
    public function index()
    {
        $data = [
            'beritas' => Berita::latest()->take(5)->get(),
            'agendas' => Agenda::latest()->take(6)->get(),
            'pengumumans' => Pengumuman::latest()->take(4)->get(),
            'layanans' => Layanan::latest()->take(6)->get(),
            'informasis' => Informasi::latest()->take(6)->get(),
            'bannerLinks' => BannerLink::where('status', 'aktif')->latest()->take(8)->get(),
        ];

        return view('welcome', $data);
    }

    /**
     * Method dinamis untuk halaman daftar yang seragam (Berita, Agenda, Pengumuman).
     *
     * @param string $jenis
     */

    // Menampilkan Daftar Konten Sesuai Kategori
    public function listKonten($jenis)
    {
        $modelMap = [
            'berita'      => Berita::class,
            'agenda'      => Agenda::class,
            'pengumuman'  => Pengumuman::class,
        ];

        if (!array_key_exists($jenis, $modelMap)) {
            abort(404);
        }

        $model = $modelMap[$jenis];
        $judul = ucfirst($jenis);
        $semua_konten = $model::latest()->paginate(9);

        // View ini digunakan untuk ketiga jenis konten di atas
        return view('user.pages.contents.content', compact('judul', 'semua_konten'));
    }

    /**
     * Menampilkan daftar Laporan dengan data spesifiknya.
     */
    private $contentTypes = [
            'data_laporan' => [
                'model' => DokLaporan::class,
                'view' => 'user.pages.dok_laporans.list_laporan',
                'title' => 'Laporan Informasi Publik',
            ],
            'regulasi' => [
                'model' => Regulasi::class,
                'view' => 'user.pages.regulasis.list_regulasi',
                'title' => 'Regulasi',
            ],
            'reformasi-birokrasi' => [ // Menggunakan tanda hubung agar cocok dengan URL umum
                'model' => ReformasiBirokrasi::class,
                'view' => 'user.pages.reformasi_birokrasis.list_reformasi',
                'title' => 'Reformasi Birokrasi',
            ],
            'zona-integritas' => [ // Menggunakan tanda hubung
                'model' => ZonaIntegritas::class,
                'view' => 'user.pages.zona_integritas.list_zi',
                'title' => 'Zona Integritas',
                'with' => ['ktZis'],
                'extra_data' => [
                    'data_kategori' => [ktZis::class, 'orderBy', ['nama', 'desc']],
                ]
            ],
        ];


    /**
     * Menampilkan daftar item dari satu kategori berdasarkan parameter dari URL.
     * Fungsi ini akan menangani link dari navbar dinamis Anda.
     */
    public function showList($param)
    {
        // Cek apakah parameter (misal: 'data_laporan') ada di konfigurasi kita.
        if (!array_key_exists($param, $this->contentTypes)) {
            abort(404, 'Kategori informasi tidak ditemukan.');
        }

        $config = $this->contentTypes[$param];
        $modelClass = $config['model'];
        $query = $modelClass::query();

        // Eager load relasi jika didefinisikan di config
        if (isset($config['with'])) {
            $query->with($config['with']);
        }

        $semua_konten = $query->get();
        // Siapkan data untuk dikirim ke view utama
        $data = [
            'judul' => $config['title'],
            'semua_konten' => $semua_konten,
            'partial_view' => $config['view'],
            'view_type' => 'list', // Flag untuk view utama
        ];

    if (isset($config['extra_data'])) {
        foreach ($config['extra_data'] as $key => $extra) {
            $className = $extra[0]; // e.g. 'App\Models\ktZis'
            $methodName = $extra[1]; // e.g. 'getCategories'
            $params = $extra[2] ?? []; // Array of parameters
            
            $data[$key] = $className::$methodName(...$params)->get();
        }
    }

        // Kirim data ke view utama yang kemudian akan memuat partial view yang benar
        return view('user.pages.informasis.informasipage', $data);
    }


    /**
     * Menampilkan halaman detail dari sebuah konten berdasarkan slug-nya.
     */
    public function showDetail($slug)
    {
        // Asumsi: semua halaman detail menggunakan model DokLaporan.
        // Jika model lain juga punya detail, logika ini perlu diperluas.
        $detailModel = DokLaporan::class;
        $detail_konten = $detailModel::where('slug', $slug)->firstOrFail();

        $data = [
            'judul' => $detail_konten->judul,
            'laporan' => $detail_konten,
            'view_type' => 'detail' // Flag untuk view utama
        ];

        return view('user.pages.informasis.informasipage', $data);
    }

    /**
     * Menampilkan detail layanan berdasarkan slug.
     */
    public function showLayananDetail($slug)
    {
        // Cari layanan berdasarkan slug
        $layanan = Layanan::where('slug', $slug)->firstOrFail();

        // Data yang akan dikirim ke view
        $data = [
            'judul' => $layanan->judul, // Judul layanan
            'layanan' => $layanan, // Data layanan lengkap
            'sidebarData' => $this->getSidebarData(), // Data sidebar (opsional)
        ];
        // Return view detail layanan
        return view('user.pages.layanans.show', $data);
    }

    /**
     * Menampilkan halaman detail dari sebuah Berita.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function showBeritaDetail($slug)
    {
        // 1. Cari berita di database berdasarkan slug-nya.
        //    Gunakan firstOrFail() untuk otomatis menampilkan halaman 404 jika tidak ditemukan.
        $berita = Berita::where('slug', $slug)->firstOrFail();

        // 2. Siapkan data yang akan dikirim ke view.
        $data = [
            'judul' => $berita->judul, // Judul untuk tab browser atau header halaman.
            'berita' => $berita, // Data berita lengkap untuk ditampilkan di view.
            'sidebarData' => $this->getSidebarData(), // Mengambil data untuk sidebar.
        ];
        
        // 3. Tampilkan view khusus untuk detail berita dengan data di atas.
        //    Pastikan path 'berita.show' ini sudah benar.
        return view('user.pages.beritas.show', $data);
    }

    /**
     * Menampilkan halaman detail dari sebuah Berita.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View
     */
    public function showPengumumanDetail($slug)
    {
        // 1. Cari pengumuman di database berdasarkan slug-nya.
        //    Gunakan firstOrFail() untuk otomatis menampilkan halaman 404 jika tidak ditemukan.
        $pengumuman = Pengumuman::where('slug', $slug)->firstOrFail();

        // 2. Siapkan data yang akan dikirim ke view.
        $data = [
            'judul' => $pengumuman->judul, // Judul untuk tab browser atau header halaman.
            'pengumuman' => $pengumuman, // Data pengumuman lengkap untuk ditampilkan di view.
            'sidebarData' => $this->getSidebarData(), // Mengambil data untuk sidebar.
        ];

        // 3. Tampilkan view khusus untuk detail pengumuman dengan data di atas.
        //    Pastikan path 'pengumuman.show' ini sudah benar.
        return view('user.pages.pengumumans.show', $data);
    }

    /**
     * Menampilkan detail kategori berdasarkan slug atau link.
     * Metode ini menangani baik slug maupun link yang mungkin ada di database.
     *
     * @param string $slugOrLink
     * @return \Illuminate\View\View
     */
    public function showBySlug($slugOrLink)
    {
        $category = Categories::where('slug', $slugOrLink)->first();

        if (!$category) {
            $cleanedLink = ltrim($slugOrLink, '/');
            $category = Categories::where('link', $slugOrLink)->orWhere('link', '/' . $cleanedLink)->first();
        }

        if (!$category) {
            abort(404, 'Kategori tidak ditemukan.');
        }

        $data = [
            'category' => $category,
            'sidebarData' => $this->getSidebarData(),
        ];

        return view('user.pages.categories.detail', $data);
    }


    /**
     * Menampilkan halaman detail dari sebuah konten.
     */
    public function showContentDetail($jenis, $slug)
    {
        $modelMap = [
            'berita'      => Berita::class,
            'agenda'      => Agenda::class,
            'pengumuman'  => Pengumuman::class,
            'layanan'     => Layanan::class,
            'informasi'   => Informasi::class,
            'profil'      => DataProfil::class,
            'laporan'     => DokLaporan::class,
            'zi'          => ZonaIntegritas::class,
        ];

        $viewMap = [
            'berita'      => 'beritas.detail_berita',
            'agenda'      => 'agendas.detail-agenda',
            'pengumuman'  => 'pengumumen.detail_pengumuman',
            'informasi'   => 'informasis.detail_informasi',
            // Tambahkan path view detail lainnya di sini
        ];

        if (!array_key_exists($jenis, $modelMap)) {
            abort(404, 'Jenis konten tidak ditemukan.');
        }

        $model = $modelMap[$jenis];
        $item = $model::where('slug', $slug)->firstOrFail();

        return view($viewMap[$jenis], [
            'item' => $item,
            'sidebarData' => $this->getSidebarData()
        ]);
    }



    


    /**
     * Menampilkan daftar profil berdasarkan kategori (ID).
     */
    public function listProfilByKategori($kategoriId)
    {
        $data_profil = DataProfil::where('kt_profils_id', $kategoriId)->orderBy('id', 'desc')->get();
        return view('profils.list_profil', compact('data_profil'));
    }

    /**
     * Menampilkan halaman polling dengan hasil.
     */
    public function vote()
    {
        $data_polling = Polling::all();

        $hasil = [
            'a' => $data_polling->sum('a'),
            'b' => $data_polling->sum('b'),
            'c' => $data_polling->sum('c'),
            'd' => $data_polling->sum('d'),
        ];

        return view('pollings.front', [
            'data_polling' => $data_polling,
            'hasil' => $hasil,
            'sidebarData' => $this->getSidebarData()
        ]);
    }

    /**
     * Menangani pencarian (contoh untuk Zona Integritas).
     */
    public function pencarian(Request $request)
    {
        $request->validate(['kategori_nama' => 'required|string']);
        $kategoriNama = $request->input('kategori_nama');

        $data = ZonaIntegritas::whereHas('ktZis', function ($query) use ($kategoriNama) {
            $query->where('nama', $kategoriNama);
        })->get();

        return view('zona_integritas.list-zi', compact('data'));
    }
    
    /**
     * Helper privat untuk mengambil data sidebar agar tidak duplikasi.
     */
        private function getSidebarData()
    {
        return [
            'beritas' => Berita::latest()->take(6)->get(),
            'pengumumans' => Pengumuman::latest()->take(6)->get(),
            'layanans' => Layanan::latest()->take(6)->get(),
        ];
    }
}