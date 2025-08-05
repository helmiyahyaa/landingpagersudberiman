  <section class="py-5">
    <div class="container">
      <h2 class="mb-4 text-center fw-bold">Laporan Informasi Publik</h2>

      <div class="table-responsive shadow rounded-3 p-3 bg-white">
        <table id="informasiTable" class="table table-hover table-striped align-middle mb-0">
          <thead>
            <tr>
              <th>No</th>
              <th>Judul</th>
              <th>Isi Singkat</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($semua_konten as $index => $zi)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td class="fw-semibold">{{ $zi->judul }}</td>
                <td>{{ Str::limit(strip_tags($zi->isi), 80, '...') }}</td>
                <td>
                                <a href="{{ $zi->link }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-primary">
                                    Lihat Dokumen
                                </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </section>