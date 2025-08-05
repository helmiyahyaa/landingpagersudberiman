@extends('layouts.admin')
@section('judul', 'Regulasi Show')
@section('content-admin')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Regulasi') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $regulasi->judul }}</h6>
                    <a href="{{ route('regulasis.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul</dt>
                        <dd class="col-sm-9">{{ $regulasi->judul }}</dd>

                        <dt class="col-sm-3">Link</dt>
                        <dd class="col-sm-9">
                            <a href="{{ $regulasi->link }}" target="_blank">{{ $regulasi->link }}</a>
                        </dd>
                    </dl>

                    <p class="text-muted small mt-4">
                        Dibuat pada: {{ $regulasi->created_at->format('d F Y H:i') }}<br>
                        Diperbarui pada: {{ $regulasi->updated_at->format('d F Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection