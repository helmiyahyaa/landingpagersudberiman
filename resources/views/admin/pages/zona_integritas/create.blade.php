@extends('layouts.admin')
@section('judul', 'Zona Integritas Create')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tambah Zona Integritas Baru') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Zona Integritas</h6>
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

            <form action="{{ route('zona_integritas.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="judul">Judul<span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul" name="judul" 
                           value="{{ old('judul') }}" required>
                </div>

                <div class="form-group">
                    <label for="kt_zis">Kategori<span class="small text-danger">*</span></label>
                    <select class="form-control" id="kt_zis" name="kt_zis" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}" {{ old('kt_zis') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="isi">Isi<span class="small text-danger">*</span></label>
                    <textarea class="form-control" id="isi" name="isi" rows="6" required>{{ old('isi') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="link">Link (Opsional)</label>
                    <input type="url" class="form-control" id="link" name="link" 
                           value="{{ old('link') }}" 
                           placeholder="Contoh: https://contoh.com/zona-integritas">
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('zona_integritas.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection