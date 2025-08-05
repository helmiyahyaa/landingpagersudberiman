@extends('layouts.admin')
@section('judul', 'Berita Edit')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Berita') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Edit Berita: {{ $berita->judul }}</h6>
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

            <form action="{{ route('beritas.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul Berita <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
                </div>

                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $berita->tanggal ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="isi">Isi</label>
                    <textarea class="form-control" id="isi" name="isi" rows="6">{{ old('isi', $berita->isi) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="foto">Foto</label>
                    @if($berita->foto)
                        <div class="mb-2">
                            <img src="{{ asset('storage/berita_fotos/' . $berita->foto) }}" alt="Foto Berita" style="max-width: 200px; border-radius: 0.5rem;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file" id="foto" name="foto">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('beritas.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection