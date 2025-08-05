@extends('layouts.admin')
@section('judul', 'Profil Edit')
@section('content-admin')
    <h1 class="h3 mb-4 text-gray-800">Edit Data Profil</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Edit Profil: <strong>{{ $dataProfil->judul }}</strong></h6>
        </div>
        <div class="card-body">

            {{-- Tampilkan Error Validasi --}}
            @if ($errors->any())
                <div class="alert alert-danger border-left-danger">
                    <ul class="mb-0 pl-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('data_profils.update', $dataProfil->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul Profil <span class="text-danger">*</span></label>
                    <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                        value="{{ old('judul', $dataProfil->judul) }}" required>
                    @error('judul')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="kt_profils_id">Kategori Profil <span class="text-danger">*</span></label>
                    <select name="kt_profils_id" class="form-control @error('kt_profils_id') is-invalid @enderror" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}" {{ old('kt_profils_id', $dataProfil->kt_profils_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kt_profils_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="isi">Isi Profil <span class="text-danger">*</span></label>
                    <textarea name="isi" class="form-control @error('isi') is-invalid @enderror" rows="5">{{ old('isi', $dataProfil->isi) }}</textarea>
                    @error('isi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Tampilkan foto lama jika ada --}}
                @if ($dataProfil->foto)
                    <div class="mb-3">
                        <label>Foto Saat Ini:</label><br>
                        <img src="{{ asset('storage/' . $dataProfil->foto) }}" alt="Foto Profil" width="120" class="img-thumbnail">
                    </div>
                @endif

                <div class="form-group">
                    <label for="foto">Foto Baru (Opsional)</label>
                    <input type="file" name="foto" class="form-control-file @error('foto') is-invalid @enderror">
                    @error('foto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('data_profils.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
