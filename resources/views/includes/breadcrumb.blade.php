<section class="breadcrumbs d-flex align-items-center justify-content-center text-center position-relative"
         style="background-image: url('{{ asset($background ?? 'assets/img/hero-bg2.png') }}'); background-size: cover; background-position: center; min-height: 350px;">
  <div class="container position-relative" data-aos="fade-in">
    <h1 class="display-4 fw-bold mb-3 text-white">{{ $title }}</h1>

    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center mb-0 text-white custom-breadcrumb">
        <li class="breadcrumb-item">
          <a href="/" class="text-white text-decoration-none">Beranda</a>
        </li>
        <li class="breadcrumb-item active text-white fw-semibold" aria-current="page">
          {{ $title }}
        </li>
      </ol>
    </nav>
  </div>
</section>
