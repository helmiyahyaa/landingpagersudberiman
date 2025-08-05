@extends('layouts.admin')
@section('judul', 'Informasi Show')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Informasi') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $informasi->judul }}</h6>
                    <a href="{{ route('informasis.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul</dt>
                        <dd class="col-sm-9">{{ $informasi->judul }}</dd>
<br>
                        <dt class="col-sm-3">Ikon</dt>
                        <dd class="col-sm-9">
                            <i class="{{ $informasi->icon }} mr-2"></i>
                            <code>{{ $informasi->icon }}</code>
                        </dd>

                        <dt class="col-sm-3">Isi</dt>
                        <dd class="col-sm-9">{!! nl2br(e($informasi->isi)) !!}</dd>

                        @if($informasi->link)
                        <dt class="col-sm-3">Link</dt>
                        <dd class="col-sm-9">
                            <a href="{{ $informasi->link }}" target="_blank">{{ $informasi->link }}</a>
                        </dd>
                        @endif
                    </dl>
                    <p class="text-muted small mt-4">
                        Dibuat pada: {{ $informasi->created_at->format('d F Y') }}<br>
                        Diperbarui pada: {{ $informasi->updated_at->format('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection