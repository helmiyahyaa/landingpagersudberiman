@extends('layouts.app')
@section('judul', 'Beranda')
@section('content-user')


@include('sections.hero')
@include('sections.about')
@include('sections.services')
@include('sections.appointment')
@include('sections.informasi')
        <!-- Berita Section -->
        <section id="berita" class="berita blogs-section light-background">
            <div class="container blogs-header " data-aos="fade-up" data-aos-delay="150">
                <h1>Ikuti Perkembangan Dengan
                    <br>Berita Terkini Kami
                </h1>
                <a href="#" class="view-all-button">
                    View All <span class="arrow">→</span>
                </a>
            </div>
            @include('sections.berita')
        </section>

        <!-- /Berita Section -->

                <!-- Pengumuman Section -->
        <section id="pengumuman" class="featured-services section">
            <div class="container">
                    <!-- Section Title -->
                <div class="container blogs-header " data-aos="fade-up" data-aos-delay="150">
                    <h1>Ikuti Perkembangan Dengan
                        <br>Berita Terkini Kami
                    </h1>
                    <a href="#" class="view-all-button">
                        View All <span class="arrow">→</span>
                    </a>
                </div>
                @include('sections.pengumuman')
        </section>


<section class="agenda-section" data-aos="fade-up" data-aos-delay="100">
    <header class="agenda-header" data-aos="fade-up" data-aos-delay="100">
        <h1>Agenda Rutin Yang Diselenggarakan<br> di Lingkungan RSUD Beriman Balikpapan</h1>
    </header>
    @include('sections.agenda')
</section>

    </div>    
      @include('sections.bannerlink') 
    <div> 
    <header class="agenda-header" data-aos="fade-up" data-aos-delay="100">
        <h1>Galeri Kegiatan dan Dokumentasi<br>RSUD Beriman Balikpapan</h1>
    </header>
    @include('sections.galeri')

    </div>

        <div> 
    <header class="agenda-header" data-aos="fade-up" data-aos-delay="100">
        <h1>Hubungi dan Temui Kami<br> di RSUD Beriman Balikpapan</h1>
    </header>
    @include('sections.contact')
    </div>

@include('sections.map2')


@endsection 