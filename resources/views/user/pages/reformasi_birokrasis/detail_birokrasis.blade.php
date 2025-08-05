

    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9">

                    <article class="blog-post">
                        {{-- Judul Laporan --}}
                        <h2 class="fw-bold mb-2">{{ $laporan->judul }}</h2>

                        {{-- Meta informasi seperti tanggal --}}
                        <p class="blog-post-meta text-secondary">
                            Dipublikasikan pada {{ $laporan->created_at->translatedFormat('d F Y') }}
                        </p>

                        <hr>

                        {{-- Isi Laporan --}}
                        {{-- Menggunakan {!! !!} agar tag HTML di dalam isi (jika ada) bisa dirender --}}
                        <div class="isi-laporan">
                            {!! $laporan->isi !!}
                        </div>

                        <hr>

                        {{-- Tombol untuk kembali ke daftar laporan --}}
                        <a href="{{ url()->previous() }}" class="btn btn-outline-primary mt-4">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                    </article>

                </div>
            </div>
        </div>
    </section>
