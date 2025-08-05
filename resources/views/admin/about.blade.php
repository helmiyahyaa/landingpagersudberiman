@extends('layouts.admin')
@section('judul', 'About')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">About</h1>
    <div class="row justify-content-center">

        <div class="col-lg-6">

            <div class="card shadow mb-4">

                <div class="card-profile-image mt-4" style="display: flex; justify-content: center;">
                    <img src="{{ asset('assets/img/logo.png') }}" class="rounded-circle" alt="user-image" width="80" height="80">
                </div>

                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Selamat Datang di Admin Dashboard <br> RSUD Beriman Balikpapan</h5>
                            <p>Kami berkomitmen untuk memberikan pelayanan kesehatan yang paripurna, profesional, dan berkualitas bagi seluruh masyarakat Kota Balikpapan dan sekitarnya.</p>
                            <p>Sistem informasi ini dirancang untuk mempermudah akses terhadap layanan dan informasi kesehatan dari rumah sakit kami. Kesehatan dan kepuasan Anda adalah prioritas utama kami.</p>
                            <a href="https://github.com/aleckrh/laravel-sb-admin-2" target="_blank" class="btn btn-github">
                                <i class="fab fa-github fa-fw"></i> Go to repository
                            </a>
                        </div>

                </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <h5 class="font-weight-bold">Credits</h5>
                            <p>PDE RSUD BERIMAN BALIKPAPAN</p>
                            <p>Version: 2.0.0</p>
                            <p>Last Updated: Agustus 2025</p>
                            <p>Developed by: Helmi Nadilla Yahya</p>
                            <p>Note: Segara Lapor Ke Unit PDE Jika Ada Masalah</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
