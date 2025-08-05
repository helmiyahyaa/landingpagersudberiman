@extends('layouts.admin')
@section('judul', 'Berita Create')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tambah Berita Baru') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Berita</h6>
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
            <form action="{{ route('beritas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="judul">Judul Berita <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                </div>

                {{-- Textarea untuk 'isi' yang akan diubah menjadi CKEditor --}}
                <div class="form-group">
                    <label for="isi">Isi</label>
                    <textarea class="form-control" id="isi" name="isi" rows="10">{{ old('isi') }}</textarea>
                </div>
                
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal') }}">
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('beritas.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>

            </form>
        </div>
    </div>
@endsection