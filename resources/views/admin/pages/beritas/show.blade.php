@extends('layouts.admin')
@section('judul', 'Berita Show')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Berita') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $berita->judul }}</h6>
                    <a href="{{ route('beritas.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul</dt>
                        <dd class="col-sm-9">{{ $berita->judul }}</dd>

                        <dt class="col-sm-3">Tanggal</dt>
                        <dd class="col-sm-9">
                            @if($berita->tanggal)
                                {{ \Carbon\Carbon::parse($berita->tanggal)->format('d-m-Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </dd>

                        <dt class="col-sm-3">Isi</dt>
                        <dd class="col-sm-9">{!! nl2br(e($berita->isi)) !!}</dd>

                        @if($berita->foto)
                        <dt class="col-sm-3">Foto</dt>
                        <dd class="col-sm-9">
                            <img src="{{ asset('storage/berita_fotos/' . $berita->foto) }}" alt="Foto Berita" style="max-width: 300px; border-radius: 0.5rem;">
                        </dd>
                        @endif
                    </dl>
                    <p class="text-muted small mt-4">
                        Dibuat pada: {{ $berita->created_at->format('d F Y') }}<br>
                        Diperbarui pada: {{ $berita->updated_at->format('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection