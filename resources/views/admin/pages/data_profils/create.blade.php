@extends('layouts.admin')
@section('judul', 'Profil Create')
@section('content-admin')
<h1 class="h3 mb-4 text-gray-800">Tambah Data Profil</h1>

<div class="card shadow mb-4">
    <div class="card-header">Formulir Data Profil</div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('data_profils.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" name="judul" value="{{ old('judul') }}" required>
            </div>

            <div class="form-group">
                <label for="kt_profils_id">Kategori Profil</label>
            <select name="kt_profils_id" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                @endforeach
            </select>

            </div>

            <div class="form-group">
                <label for="isi">Isi</label>
                <textarea name="isi" class="form-control" rows="6">{{ old('isi') }}</textarea>
            </div>

            <div class="form-group">
                <label for="foto">Foto (Opsional)</label>
                <input type="file" name="foto" class="form-control-file">
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('data_profils.index') }}" class="btn btn-secondary mr-2">Batal</a>
                <button type="submit" class="btn btn-dark">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
