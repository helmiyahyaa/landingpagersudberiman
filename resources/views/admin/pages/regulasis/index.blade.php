@extends('layouts.admin')
@section('judul', 'Regulasi Index')
@section('content-admin')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Manajemen Regulasi') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('regulasis.create') }}" class="btn btn-dark">
                <i class="fas fa-plus mr-1"></i>
                Tambah Regulasi
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Link</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($regulasis as $index => $regulasi)
                        <tr>
                            <td>{{ $regulasis->firstItem() + $index }}</td>
                            <td class="font-weight-bold">{{ $regulasi->judul }}</td>
                            <td><a href="{{ $regulasi->link }}" target="_blank">{{ Str::limit($regulasi->link, 30) }}</a></td>
                            <td class="text-center">
                                <a href="{{ route('regulasis.show', $regulasi->id) }}" class="btn btn-info btn-circle btn-sm" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('regulasis.edit', $regulasi->id) }}" class="btn btn-dark btn-circle btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('regulasis.destroy', $regulasi->id) }}" method="POST" class="d-inline delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-circle btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center p-4">
                                Data regulasi belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $regulasis->links() }}
            </div>
        </div>
    </div>
@endsection