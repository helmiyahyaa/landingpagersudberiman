@extends('layouts.admin')
@section('judul', 'Kategori ZIS Create')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tambah Kategori ZIS Baru') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Kategori ZIS</h6>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger border-left-danger" role="alert">
                    <ul class="pl-4 my-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('kt_zis.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Kategori ZIS <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                </div>

                <hr>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('kt_zis.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection