        <!-- Services Section -->
        <section id="services" class="services section">
            <div class="container blogs-header" data-aos="fade-right">
                <h1>Jelajahi Berbagai
                    <br>Layanan Unggulan Kami
                </h1>
                <a href="#" class="view-all-button v2">
                    View All <span class="arrow">→</span>
                </a>
            </div>
            {{-- <div class="container section-title" data-aos="fade-up">
                <h2>Layanan Kami</h2>
                <p>Kami menyediakan berbagai layanan unggulan untuk Anda</p>
            </div> --}}

            <div class="container">
                <div class="row gy-4">

                    {{-- Looping ini langsung menggunakan data dari database Anda --}}
                    @foreach ($layanans as $index => $layanan)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 50 }}">
                            {{-- Kelas "service-item" dari kode Anda tetap digunakan --}}
                            <div class="service-item">

                                {{-- Tautan ini membuat seluruh kartu dapat di-klik --}}
                                <a href="{{ route('layanan.detail', $layanan->slug) }}" class="stretched-link"></a>

                                {{-- Ikon latar belakang (bisa dibuat dinamis) --}}
                                <i class="{{ $layanan->icon_class ?? 'bi bi-heart-pulse' }} card-bg-icon"></i>

                                <div class="main-icon">
                                    {{-- Ikon utama (bisa dibuat dinamis) --}}
                                    <i class="{{ $layanan->icon_class ?? 'bi bi-heart-pulse' }}"></i>
                                </div>

                                <h3>{{ $layanan->judul }}</h3>

                                <p>
                                    {{-- Deskripsi dari database Anda --}}
                                    {{ $layanan->subjek1 ?? 'Deskripsi layanan unggulan untuk menjaga kesehatan Anda.' }}
                                </p>

                                <div class="card-footer-custom">
                                    {{-- Contoh data dinamis lain jika ada --}}
                                    <span class="doctor-count">
                                        <i class="bi bi-circle-fill"></i> Selengkapnya
                                    </span>
                                    <div class="arrow-link"><i class="bi bi-arrow-up-right"></i></div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    {{-- Akhir dari area looping --}}

                </div>
            </div>

        </section><!-- End Services Section -->