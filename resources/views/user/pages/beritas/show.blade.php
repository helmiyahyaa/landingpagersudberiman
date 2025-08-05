@extends('layouts.app')

@section('content-user')

@include('includes.breadcrumb', [
    'title' => 'Detail Berita',
    'items' => [
        ['title' => 'Berita', 'url' => url('/berita')],
        ['title' => Str::limit($berita->judul, 40), 'url' => null]
    ]
])

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mb-4">
            <article>
                <h1 class="mb-3">{{ $berita->judul }}</h1>

                <p class="text-muted">
                    <i class="bi bi-calendar-event me-2"></i>
                    Dipublikasikan pada {{ $berita->date->translatedFormat('d F Y') }}
                </p>

                @if($berita->foto)
                    {{-- BENAR --}}
                <img src="{{ asset($berita->foto) }}" alt="{{ $berita->judul }}" class="img-fluid mb-4 rounded shadow-sm">
                @endif  

                <div class="article-content">
                    {!! $berita->isi !!}
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </article>
        </div>

@include('includes.sidebar', [
            'sidebarData' => $sidebarData,
            'exclude' => $berita
        ])
    </div>
</div>

@endsection