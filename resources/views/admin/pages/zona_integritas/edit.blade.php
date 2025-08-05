@extends('layouts.admin')
@section('judul', 'Zona Integritas Edit')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Zona Integritas') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Edit Zona Integritas: {{ $zonaIntegrita->judul }}</h6>
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

            <form action="{{ route('zona_integritas.update', $zonaIntegrita) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Kolom Utama -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="judul">Judul<span class="small text-danger">*</span></label>
                            <input type="text" class="form-control" id="judul" name="judul" 
                                   value="{{ old('judul', $zonaIntegrita->judul) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="kt_zis">Kategori<span class="small text-danger">*</span></label>
                            <select class="form-control" id="kt_zis" name="kt_zis" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategori as $kategoriItem)
                                    <option value="{{ $kategoriItem->id }}" 
                                        {{ old('kt_zis', $zonaIntegrita->kt_zis) == $kategoriItem->id ? 'selected' : '' }}>
                                        {{ $kategoriItem->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="isi">Isi<span class="small text-danger">*</span></label>
                            <textarea class="form-control" id="isi" name="isi" rows="6" required>{{ old('isi', $zonaIntegrita->isi) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="link">Link (Opsional)</label>
                            <input type="url" class="form-control" id="link" name="link" 
                                   value="{{ old('link', $zonaIntegrita->link) }}"
                                   placeholder="Contoh: https://contoh.com/zona-integritas">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('zona_integritas.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection