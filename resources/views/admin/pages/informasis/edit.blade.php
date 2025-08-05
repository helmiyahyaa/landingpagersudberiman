@extends('layouts.admin')
@section('judul', 'Informasi Edit')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Informasi') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Edit Informasi: {{ $informasi->judul }}</h6>
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

            <form action="{{ route('informasis.update', $informasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Kolom Utama -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="judul">Judul Informasi<span class="small text-danger">*</span></label>
                            <input type="text" class="form-control" id="judul" name="judul" 
                                   value="{{ old('judul', $informasi->judul) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="isi">Isi Informasi</label>
                            <textarea class="form-control" id="isi" name="isi" rows="6">{{ old('isi', $informasi->isi) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="link">Link (Opsional)</label>
                            <input type="url" class="form-control" id="link" name="link" 
                                   value="{{ old('link', $informasi->link) }}"
                                   placeholder="Contoh: https://contoh.com/informasi">
                        </div>

                        <div class="form-group">
                            <label for="icon">Icon<span class="small text-danger">*</span></label>
                            <input type="text" class="form-control" id="icon" name="icon" 
                                   value="{{ old('icon', $informasi->icon) }}" required
                                   placeholder="Contoh: fas fa-info-circle">
                            <small class="form-text text-muted">
                                Gunakan class icon dari Font Awesome. Contoh: fas fa-info-circle
                            </small>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('informasis.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Update Informasi</button>
                </div>
            </form>
        </div>
    </div>
@endsection