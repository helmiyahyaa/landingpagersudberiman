@extends('layouts.admin')
@section('judul', 'Reformasi Birokrasi Edit')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Reformasi Birokrasi') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Edit Reformasi Birokrasi: {{ $reformasiBirokrasi->judul }}</h6>
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

            <form action="{{ route('reformasi_birokrasis.update', $reformasiBirokrasi->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Kolom Utama -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="judul">Judul<span class="small text-danger">*</span></label>
                            <input type="text" class="form-control" id="judul" name="judul" 
                                   value="{{ old('judul', $reformasiBirokrasi->judul) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="isi">Isi</label>
                            <textarea class="form-control" id="isi" name="isi" rows="6">{{ old('isi', $reformasiBirokrasi->isi) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="link">Link (Opsional)</label>
                            <input type="url" class="form-control" id="link" name="link" 
                                   value="{{ old('link', $reformasiBirokrasi->link) }}"
                                   placeholder="Contoh: https://contoh.com/reformasi-birokrasi">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('reformasi_birokrasis.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
