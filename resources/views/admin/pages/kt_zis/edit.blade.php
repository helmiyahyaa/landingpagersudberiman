@extends('layouts.admin')
@section('judul', 'Kategori ZIS Edit')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Kategori ZIS') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit: {{ $ktZi->nama }}</h6>
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

            {{-- PERBAIKAN ADA DI BARIS INI --}}
            <form action="{{ route('kt_zis.update', $ktZi->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama Kategori ZIS <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $ktZi->nama) }}" required>
                </div>

                <hr>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('kt_zis.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection