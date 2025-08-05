@extends('layouts.admin')
@section('judul', 'Dokumen Laporan Show')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Dokumen Laporan') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $dokLaporan->judul }}</h6>
                    <a href="{{ route('dok_laporans.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul</dt>
                        <dd class="col-sm-9">{{ $dokLaporan->judul }}</dd>
                        
                        <dt class="col-sm-3">Kategori</dt>
                        <dd class="col-sm-9">
                            {{ $dokLaporan->ktLaporan->nama ?? 'Tidak ada kategori' }}
                        </dd>

                        <dt class="col-sm-3">Isi</dt>
                        <dd class="col-sm-9">{!! nl2br(e($dokLaporan->isi)) !!}</dd>

                        @if ($dokLaporan->foto)
                        <dt class="col-sm-3">Foto</dt>
                        <dd class="col-sm-9">
                            <img src="{{ Storage::url($dokLaporan->foto) }}" alt="{{ $dokLaporan->judul }}" class="img-fluid" style="max-width: 400px;">
                        </dd>
                        @endif
                    </dl>

                    <p class="text-muted small mt-4">
                        Dibuat pada: {{ $dokLaporan->created_at->translatedFormat('d F Y H:i') }}<br>
                        Diperbarui pada: {{ $dokLaporan->updated_at->translatedFormat('d F Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
