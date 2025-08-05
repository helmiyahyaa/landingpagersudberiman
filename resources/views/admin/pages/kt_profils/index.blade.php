@extends('layouts.admin')
@section('judul', 'Profil Index')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Manajemen KT Profil') }}</h1>

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
            <a href="{{ route('kt_profils.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i>
                Tambah KT Profil
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kt_profils as $index => $kt_profil)
                            <tr>
                                <td>{{ $kt_profils->firstItem() + $index }}</td>
                                <td class="font-weight-bold">{{ $kt_profil->nama }}</td>
                                <td class="text-center">
                                    <a href="{{ route('kt_profils.show', $kt_profil->id) }}" class="btn btn-info btn-circle btn-sm" title="Detail">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('kt_profils.edit', $kt_profil->id) }}" class="btn btn-primary btn-circle btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('kt_profils.destroy', $kt_profil->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                                <td colspan="3" class="text-center p-4">
                                    Data KT Profil belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Link Paginasi -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $kt_profils->links() }}
            </div>
        </div>
    </div>
@endsection
