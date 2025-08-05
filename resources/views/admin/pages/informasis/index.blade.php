@extends('layouts.admin')
@section('judul', 'Informasi Create')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Manajemen Informasi') }}</h1>

    <!-- Pesan Sukses -->
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
            <a href="{{ route('informasis.create') }}" class="btn btn-dark">
                <i class="fas fa-plus mr-1"></i>
                Tambah Informasi
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ikon</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($informasis as $index => $informasi)
                            <tr>
                                <td>{{ $informasis->firstItem() + $index }}</td>
                                <td class="font-weight-bold">{{ $informasi->icon }}</td>
                                <td class="font-weight-bold">{{ $informasi->judul }}</td>
                                <td>{{ Str::limit($informasi->isi, 70) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('informasis.show', $informasi->id) }}" class="btn btn-info btn-circle btn-sm" title="Detail">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('informasis.edit', $informasi->id) }}" class="btn btn-dark btn-circle btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('informasis.destroy', $informasi->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                                <td colspan="5" class="text-center p-4">
                                    Data Informasi belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Link Paginasi -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $informasis->links() }}
            </div>
        </div>
    </div>
@endsection