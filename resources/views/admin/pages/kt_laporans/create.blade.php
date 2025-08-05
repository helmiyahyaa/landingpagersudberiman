@extends('layouts.admin')
@section('judul', 'Dokumen Laporan Create')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tambah kt_laporan Baru') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir kt_laporan</h6>
        </div>
        <div class="card-body">

            <!-- Menampilkan Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger border-left-danger" role="alert">
                    <ul class="pl-4 my-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Pastikan form memiliki enctype untuk upload file --}}
            <form action="{{ route('kt_laporans.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama">nama kt_laporan <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                </div>
                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('kt_laporans.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>
@endsection