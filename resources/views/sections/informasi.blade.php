        <!-- Informasi Section -->
        <section class="awards-section">
            <div class="container" >
                <div class="row align-items-center">
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <div class="awards-content" data-aos="fade-right" data-aos-delay="100">
                            <h2>Informasi</h2>
                            <p>Temukan berbagai informasi resmi yang kami sediakan untuk mendukung transparansi dan
                                pelayanan publik.</p>

                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="splide" id="informasi-slider" aria-label="Informasi Carousel">
                            <div class="splide__track" data-aos="fade-left" data-aos-delay="100">
                                <ul class="splide__list">
                                    {{-- Ganti bagian <li> lama Anda dengan yang ini --}}

                                    @foreach ($informasis as $informasi)
                                        <li class="splide__slide">
                                            {{-- Tambahkan tag <a> yang membungkus seluruh kartu --}}
                                            <a href="{{ $informasi->link ?? '#' }}" class="card-link-wrapper"
                                                style="text-decoration: none; color: inherit;"> {{-- Menambahkan style agar tidak ada garis bawah --}}

                                                <div class="award-card">
                                                    <div class="award-logo">
                                                        <i class="{{ $informasi->icon }}"></i>
                                                    </div>
                                                    <h5 class="award-title">{{ $informasi->judul }}</h5>

                                                    {{-- Anda juga bisa mengaktifkan kembali bagian ini jika diperlukan --}}
                                                    @if ($informasi->isi)
                                                        <p class="award-institute">{{ $informasi->isi }}</p>
                                                    @endif
                                                </div>

                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Informasi Section -->