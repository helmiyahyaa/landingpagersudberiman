<!-- Banner Link Section -->
<section id="banner-links" class="banner-links">
    <div class="container">
        <div class="row gy-4">
            @foreach ($bannerLinks as $banner)
                <div class="col-lg-3 col-md-4 col-6 d-flex align-items-stretch" data-aos="fade-up"
                    data-aos-delay="100">
                    <a href="{{ $banner->link ?? '#' }}" target="_blank" class="w-100">
                        <img src="{{ $banner->foto }}" alt="Banner" class="img-fluid">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- /Banner Link Section -->
