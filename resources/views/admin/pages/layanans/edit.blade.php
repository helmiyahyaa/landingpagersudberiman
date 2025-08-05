@extends('layouts.admin')
@section('judul', 'Layanan Edit')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Layanan') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Edit Layanan: {{ $layanan->judul }}</h6>
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

            <form action="{{ route('layanans.update', $layanan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Metode PUT untuk update --}}

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="judul">Judul Layanan<span class="small text-danger">*</span></label>
                            <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $layanan->judul) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="subjek1">Subjek 1</label>
                            <input type="text" class="form-control" id="subjek1" name="subjek1" value="{{ old('subjek1', $layanan->subjek1) }}">
                        </div>

                        <div class="form-group">
                            <label for="isi1">Isi 1</label>
                            <textarea class="form-control" id="isi1" name="isi1" rows="4">{{ old('isi1', $layanan->isi1) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="subjek2">Subjek 2</label>
                            <input type="text" class="form-control" id="subjek2" name="subjek2" value="{{ old('subjek2', $layanan->subjek2) }}">
                        </div>

                        <div class="form-group">
                            <label for="isi2">Isi 2</label>
                            <textarea class="form-control" id="isi2" name="isi2" rows="4">{{ old('isi2', $layanan->isi2) }}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="subjek3">Subjek 3</label>
                            <input type="text" class="form-control" id="subjek3" name="subjek3" value="{{ old('subjek3', $layanan->subjek3) }}">
                        </div>

                        <div class="form-group">
                            <label for="isi3">Isi 3</label>
                            <textarea class="form-control" id="isi3" name="isi3" rows="4">{{ old('isi3', $layanan->isi3) }}</textarea>
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="subjek4">Subjek 4</label>
                            <input type="text" class="form-control" id="subjek4" name="subjek4" value="{{ old('subjek4', $layanan->subjek4) }}">
                        </div>

                        <div class="form-group">
                            <label for="isi4">Isi 4</label>
                            <textarea class="form-control" id="isi4" name="isi4" rows="4">{{ old('isi4', $layanan->isi4) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="subjek5">Subjek 5</label>
                            <input type="text" class="form-control" id="subjek5" name="subjek5" value="{{ old('subjek5', $layanan->subjek5) }}">
                        </div>

                        <div class="form-group">
                            <label for="isi5">Isi 5</label>
                            <textarea class="form-control" id="isi5" name="isi5" rows="4">{{ old('isi5', $layanan->isi5) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="subjek6">Subjek 6</label>
                            <input type="text" class="form-control" id="subjek6" name="subjek6" value="{{ old('subjek6', $layanan->subjek6) }}">
                        </div>

                        <div class="form-group">
                            <label for="isi6">Isi 6</label>
                            <textarea class="form-control" id="isi6" name="isi6" rows="4">{{ old('isi6', $layanan->isi6) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="foto">Ganti Foto Utama (Opsional)</label>
                            <input type="file" class="form-control-file" id="foto" name="foto">
                            <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah foto.</small>
                            @if($layanan->foto)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/layanan_fotos/' . $layanan->foto) }}" alt="Foto saat ini" style="width: 150px; height: auto; border-radius: 0.5rem;">
                                    <p class="small text-muted mt-1">Foto saat ini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('layanans.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Update</button>
                </div>

            </form>
        </div>
    </div>
@endsection