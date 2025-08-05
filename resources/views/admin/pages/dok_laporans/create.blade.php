@extends('layouts.admin')
@section('judul', 'Dokumen Laporan Create')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tambah Dokumen Laporan Baru') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Dokumen Laporan</h6>
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

            <form action="{{ route('dok_laporans.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="judul">Judul <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul') }}" required>
                </div>

                <div class="form-group">
                    <label for="kt_laporans_id">Kategori <span class="small text-danger">*</span></label>
                    <select class="form-control" id="kt_laporans_id" name="kt_laporans_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoriLaporans as $id => $nama)
                            <option value="{{ $id }}" {{ old('kt_laporans_id') == $id ? 'selected' : '' }}>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="isi">Isi</label>
                    <textarea class="form-control" id="isi" name="isi" rows="10">{{ old('isi') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="foto">Foto (Opsional)</label>
                    <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*">
                    <small class="form-text text-muted">Format: jpeg, png, jpg, gif, svg. Maks 2MB.</small>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('dok_laporans.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('isi');
    </script>
@endpush
