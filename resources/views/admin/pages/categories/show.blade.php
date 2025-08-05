@extends('layouts.admin')
@section('judul', 'Categories Show')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Kategori') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $category->nama }}</h6>
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali
                    </a>
                </div>

                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9">{{ $category->nama }}</dd>

                        <dt class="col-sm-3">Slug</dt>
                        <dd class="col-sm-9">{{ $category->slug }}</dd>

                        <dt class="col-sm-3">Parent</dt>
                        <dd class="col-sm-9">
                            {{ $category->parent ? $category->parent->nama : '-' }}
                        </dd>

                        <dt class="col-sm-3">Status</dt>
                        <dd class="col-sm-9 text-capitalize">{{ $category->status }}</dd>

                        <dt class="col-sm-3">Isi</dt>
                        <dd class="col-sm-9">{!! $category->isi ?? '-' !!}</dd>

                        <dt class="col-sm-3">Foto</dt>
                        <dd class="col-sm-9">
                            @if ($category->foto)
                                <img src="{{ $category->foto }}" alt="Foto Kategori" style="max-height: 150px;">
                            @else
                                <span class="text-muted">Tidak ada foto</span>
                            @endif
                        </dd>
                    </dl>

                    <p class="text-muted small mt-4">
                        Dibuat pada: {{ $category->created_at->format('d F Y H:i') }}<br>
                        Diperbarui pada: {{ $category->updated_at->format('d F Y H:i') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
