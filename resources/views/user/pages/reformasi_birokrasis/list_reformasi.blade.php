{{--
  Ini adalah partial view untuk menampilkan daftar Regulasi.
  File ini akan dimuat oleh 'informasipage.blade.php'.
--}}
<section class="py-5">
    <div class="container">
        {{-- Judul halaman ini diambil dari konfigurasi di controller --}}
        <h2 class="mb-4 text-center fw-bold">{{ $judul }}</h2>

        <div class="table-responsive shadow rounded-3 p-3 bg-white">
            <table id="informasiTable" class="table table-hover table-striped align-middle mb-0">
                <thead>
                    <tr>
                      <th>No</th>
                      <th>Judul</th>
                      <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop melalui data regulasi yang dikirim dari controller ($semua_konten) --}}
                    @forelse ($semua_konten as $index => $birokrasi)
                        <td>{{ $index + 1 }}</td>
                            <td class="fw-semibold">{{ $birokrasi->judul }}</td>
                            <td class="text-center">
                                <a href="{{ $birokrasi->link }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary">
                                    Lihat Dokumen
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">
                                Belum ada data birokrasi yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>