@extends('layouts.app')

@section('content-user')

@include('includes.breadcrumb', [
    'title' => 'Detail Pengumuman',
    'items' => [
        ['title' => 'Pengumuman', 'url' => url('/pengumuman')],
        ['title' => Str::limit($pengumuman->judul, 40), 'url' => null]
    ]
])

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8 mb-4">
            <article>
                <h1 class="mb-3">{{ $pengumuman->judul }}</h1>
                <div class="article-content">
                    {!! $pengumuman->isi !!}
                </div>

                <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </article>
        </div>

        @include('includes.sidebar', [
                    'sidebarData' => $sidebarData,
                    'exclude' => $pengumuman
                ])
    </div>
</div>

@endsection