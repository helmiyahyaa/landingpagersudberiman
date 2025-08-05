@extends('layouts.admin')
@section('judul', 'Reformasi Birokrasi Show')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Reformasi Birokrasi') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $reformasiBirokrasi->judul }}</h6>
                    <a href="{{ route('reformasi_birokrasis.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul</dt>
                        <dd class="col-sm-9">{{ $reformasiBirokrasi->judul }}</dd>

                        <dt class="col-sm-3">Isi</dt>
                        <dd class="col-sm-9">{!! nl2br(e($reformasiBirokrasi->isi)) !!}</dd>

                        @if($reformasiBirokrasi->link)
                            <dt class="col-sm-3">Link</dt>
                            <dd class="col-sm-9">
                                <a href="{{ $reformasiBirokrasi->link }}" target="_blank" rel="noopener noreferrer">
                                    {{ $reformasiBirokrasi->link }}
                                </a>
                            </dd>
                        @endif
                    </dl>

                    <p class="text-muted small mt-4">
                        Dibuat pada: {{ $reformasiBirokrasi->created_at->translatedFormat('d F Y H:i') }}<br>
                        Diperbarui pada: {{ $reformasiBirokrasi->updated_at->translatedFormat('d F Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
