@extends('layouts.admin')
@section('judul', 'Profil Show')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail KT Profil') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $ktProfil->nama }}</h6>
                    <a href="{{ route('kt_profils.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9">{{ $ktProfil->nama }}</dd>
                    </dl>

                    <p class="text-muted small mt-4">
                        Dibuat pada: {{ $ktProfil->created_at->format('d F Y') }}<br>
                        Diperbarui pada: {{ $ktProfil->updated_at->format('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
