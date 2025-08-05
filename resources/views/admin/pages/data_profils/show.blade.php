@extends('layouts.admin')
@section('judul', 'Profil Show')
@section('content-admin')
<h1 class="h3 mb-4 text-gray-800">Detail Profil</h1>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="m-0 text-dark">{{ $dataProfil->judul }}</h6>
        <a href="{{ route('data_profils.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        @if ($dataProfil->foto)
            <img src="{{ asset('storage/' . $dataProfil->foto) }}" alt="Foto" class="img-fluid mb-3" style="max-height: 300px;">
        @endif

        <dl class="row">
            <dt class="col-sm-3">Judul</dt>
            <dd class="col-sm-9">{{ $dataProfil->judul }}</dd>

            <dt class="col-sm-3">Kategori</dt>
            <dd class="col-sm-9">{{ $dataProfil->kategori->nama ?? '-' }}</dd>

            <dt class="col-sm-3">Isi</dt>
            <dd class="col-sm-9">{!! nl2br(e($dataProfil->isi)) !!}</dd>

            <dt class="col-sm-3">Slug</dt>
            <dd class="col-sm-9">{{ $dataProfil->slug }}</dd>
        </dl>
    </div>
</div>
@endsection
