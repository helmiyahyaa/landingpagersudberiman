@extends('layouts.admin')
@section('judul', 'Categories Create')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Tambah Kategori Baru') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Tambah Kategori</h6>
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

            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="nama">Nama Kategori <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                </div>

                <div class="form-group">
                    <label for="slug">Slug (Opsional)</label>
                    <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}">
                </div>

                <div class="form-group">
                    <label for="parent_menu">Parent Kategori</label>
                    <select name="parent_menu" id="parent_menu" class="form-control">
                        <option value="">-- Tidak Ada --</option>
                        @foreach ($parentCategories as $parent)
                            <option value="{{ $parent->id }}" {{ old('parent_menu') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="status">Status <span class="small text-danger">*</span></label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="isi">Isi</label>
                    <textarea class="form-control" id="isi" name="isi" rows="6">{{ old('isi') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="foto">Foto (Opsional)</label>
                    <input type="file" class="form-control-file" id="foto" name="foto">
                    <small class="form-text text-muted">Format: jpeg, png, jpg, gif, svg. Maks 2MB.</small>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('categories.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan</button>
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
