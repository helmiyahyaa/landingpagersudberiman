@extends('layouts.admin')
@section('judul', 'Agenda Edit')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Agenda') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-dark">Formulir Edit Agenda: {{ $agenda->judul }}</h6>
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

            <form action="{{ route('agendas.update', $agenda->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul Agenda <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul" name="judul" value="{{ old('judul', $agenda->judul) }}" required>
                </div>

                <div class="form-group">
                    <label for="isi">Deskripsi</label>
                    <textarea class="form-control" id="isi" name="isi" rows="4">{{ old('isi', $agenda->isi) }}</textarea>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('agendas.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-dark">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection