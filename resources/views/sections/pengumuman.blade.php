
                <div class="row gy-4">
                    @foreach ($pengumumans as $pengumuman)
                        <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item position-relative">
                                {{-- <div class="icon"><i class="fas fa-bullhorn icon"></i></div> --}}
                                <h4>
                                    <a href="{{ route('pengumuman.show', $pengumuman->slug) }}"
                                        class="stretched-link">
                                        {{ Str::limit($pengumuman->judul, 30) }}
                                    </a>
                                </h4>
                                <p>{{ Str::limit(strip_tags($pengumuman->isi), 80) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
