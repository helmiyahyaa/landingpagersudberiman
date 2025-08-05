
@extends('layouts.app')

@section('content-user')

@include('includes.breadcrumb', [
    'title' => $layanan->judul
])
<div class="container my-5">
  <div class="row">
    <!-- Konten utama -->
    <div class="col-lg-8 mb-4">
        <h1>{{ $judul }}</h1>

        @if($layanan->foto)
            <img src="{{ asset('storage/' . $layanan->foto) }}" alt="{{ $layanan->judul }}" class="img-fluid mb-4 rounded shadow-sm">
        @endif

        @for ($i = 1; $i <= 6; $i++)
            @php
                $subjek = 'subjek' . $i;
                $isi = 'isi' . $i;
            @endphp

            @if (!empty($layanan->$subjek) && !empty($layanan->$isi))
                <h3 class="text-primary">{{ $layanan->$subjek }}</h3>
                <p>{{ $layanan->$isi }}</p>
            @endif
        @endfor

        <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">Kembali</a>
    </div>

@include('includes.sidebar', [
            'sidebarData' => $sidebarData,
            'exclude' => $layanan
        ])
  </div>
</div>

@endsection