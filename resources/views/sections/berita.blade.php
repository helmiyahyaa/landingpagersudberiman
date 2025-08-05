        <!-- Berita Section -->
            <div class="container blogs-grid">
                {{-- Loop melalui koleksi $beritas dari controller Anda --}}
                @foreach ($beritas as $index => $berita)
                    {{-- Tentukan kartu pertama sebagai "large" --}}
                    <div class="blog-card @if ($index === 0) large @endif" data-aos="fade-up"
                        data-aos-delay="{{ ($index + 1) * 100 }}">
                        @if ($berita->foto)
                            <div class="card-image"
                                style="background-image: url('{{ asset('storage/' . $berita->foto) }}');">
                            </div>
                        @endif
                        <div class="card-content">
                            <div class="card-date">
                                @if ($berita->date)
                                    {{ $berita->date->format('d M Y') }}
                                @else
                                    Tanggal tidak tersedia
                                @endif
                            </div>
                            <div class="card-title">{{ $berita->judul }}</div>
                            {{-- Tampilkan ringkasan jika diperlukan --}}
                            {{-- <p class="card-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 100, '...') }}</p> --}}

                            {{-- Tentukan link "Baca Selengkapnya" atau panah --}}
                            @if ($index === 0)
                                <a href="{{ url('/berita/' . $berita->slug) }}" class="read-more">
                                    Baca Selengkapnya <span class="arrow-circle">→</span>
                                </a>
                            @else
                                <a href="{{ url('/berita/' . $berita->slug) }}" class="arrow-top-right">↗</a>
                            @endif
                        </div>
                    </div>
                @endforeach

                {{-- Jika tidak ada berita, tampilkan pesan --}}
                @if ($beritas->isEmpty())
                    <p>Belum ada berita yang tersedia.</p>
                @endif
            </div>
        <!-- /Berita Section -->