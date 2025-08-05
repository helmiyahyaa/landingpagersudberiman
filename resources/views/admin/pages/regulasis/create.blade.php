@extends('layouts.admin')
@section('judul', 'Regulasi Create')
@section('content-admin')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tambah Regulasi Baru') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Regulasi</h6>
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

            <form action="{{ route('regulasis.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="judul">Judul Regulasi <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                </div>

                <div class="form-group">
                    <label for="link">Link Regulasi <span class="small text-danger">*</span></label>
                    <input type="url" class="form-control" id="link" name="link" value="{{ old('link') }}" required placeholder="https://example.com">
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('regulasis.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection