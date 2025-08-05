@extends('layouts.admin')
@section('judul', 'Zona Integritas Show')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Zona Integritas') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $zonaIntegrita->judul }}</h6>
                    <a href="{{ route('zona_integritas.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul</dt>
                        <dd class="col-sm-9">{{ $zonaIntegrita->judul }}</dd>
                        
                        <dt class="col-sm-3">Kategori</dt>
                        <dd class="col-sm-9">
                            {{ $zonaIntegrita->ktZis->nama ?? 'Tidak ada kategori' }}
                        </dd>

                        <dt class="col-sm-3">Isi</dt>
                        <dd class="col-sm-9">{!! nl2br(e($zonaIntegrita->isi)) !!}</dd>

                        @if($zonaIntegrita->link)
                        <dt class="col-sm-3">Link</dt>
                        <dd class="col-sm-9">
                            <a href="{{ $zonaIntegrita->link }}" target="_blank" rel="noopener noreferrer">
                                {{ $zonaIntegrita->link }}
                            </a>
                        </dd>
                        @endif
                    </dl>
                
                    <p class="text-muted small mt-4">
                        Dibuat pada: {{ $zonaIntegrita->created_at->translatedFormat('d F Y H:i') }}<br>
                        Diperbarui pada: {{ $zonaIntegrita->updated_at->translatedFormat('d F Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection