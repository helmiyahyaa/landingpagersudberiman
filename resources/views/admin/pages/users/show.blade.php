@extends('layouts.admin')
@section('judul', 'Users Show')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail User') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $user->name }}</h6>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <dl class="row">
                        <dt class="col-sm-3">Nama</dt>
                        <dd class="col-sm-9">{{ $user->name }}</dd>

                        <dt class="col-sm-3">Username</dt>
                        <dd class="col-sm-9">{{ $user->username }}</dd>

                        <dt class="col-sm-3">Email</dt>
                        <dd class="col-sm-9">{{ $user->email }}</dd>

                        <dt class="col-sm-3">Level</dt>
                        <dd class="col-sm-9">{{ $user->level }}</dd>
                    </dl>
                    <p class="text-muted small mt-4">
                        Dibuat pada: {{ $user->created_at->format('d F Y') }}<br>
                        Diperbarui pada: {{ $user->updated_at->format('d F Y') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection