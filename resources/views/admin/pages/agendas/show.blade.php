@extends('layouts.admin')
@section('judul', 'Agenda Show')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Agenda') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $agenda->judul }}</h6>
                    <a href="{{ route('agendas.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Judul</dt>
                        <dd class="col-sm-9">{{ $agenda->judul }}</dd>

                        <dt class="col-sm-3">Tanggal</dt>
                        <dd class="col-sm-9">{{ \Carbon\Carbon::parse($agenda->tanggal)->format('d-m-Y') }}</dd>

                        <dt class="col-sm-3">Deskripsi</dt>
                        <dd class="col-sm-9">{!! nl2br(e($agenda->isi)) !!}</dd>
                    </dl>
                    <p class="text-muted small mt-4">
                        Dibuat pada: {{ $agenda->created_at->format('d F Y') }}<br>
                        Diperbarui pada: {{ $agenda->updated_at->format('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection