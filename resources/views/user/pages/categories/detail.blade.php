{{-- resources/views/user/pages/categories/detail.blade.php --}}

{{-- Menggunakan layout utama 'layouts.app' --}}
@extends('layouts.app')

{{-- Mengubah nama seksi agar sesuai dengan @yield('content-user') di layout utama --}}
@section('content-user')
<main id="main">

    {{-- Bagian hero telah digabungkan ke Breadcrumbs Section di bawah.
         Jika 'sections.hero' Anda adalah bagian yang berbeda dan masih ingin ditampilkan,
         Anda bisa mengembalikannya, tetapi pastikan tidak ada tumpang tindih visual.
         Untuk saat ini, saya menghapusnya untuk menghindari duplikasi hero-like section. --}}
    {{-- @include('sections.hero') --}}

@include('includes.breadcrumb', [
    'title' => $category->nama
])
    <!-- ======= Category Detail Section ======= -->
    <section id="category-detail" class="category-detail py-5">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">
          <div class="col-lg-8">
            <article class="category-article">
              {{-- <h3 class="mb-4 text-primary">{{ Str::title(strtolower($category->nama)) }}</h3> --}}

              @if ($category->foto)
                <div class="category-image mb-4 text-center">
                  <img src="{{ $category->foto }}" alt="{{ $category->nama }}" class="img-fluid rounded shadow-sm" style="max-height: 500px; width: auto; object-fit: cover;">
                </div>
              @endif

              <div class="category-content mt-4 lead">
                {{-- Gunakan {!! !!} jika kolom 'isi' berisi konten HTML --}}
                @if ($category->isi)
                  {!! $category->isi !!}
                @else
                  <p class="text-muted fst-italic">Tidak ada konten yang tersedia untuk kategori ini.</p>
                @endif
              </div>

              <hr class="my-5">
            </article>
          </div>

        @include('includes.sidebar')
        </div>

      </div>
    </section><!-- End Category Detail Section -->

</main><!-- End #main -->
@endsection