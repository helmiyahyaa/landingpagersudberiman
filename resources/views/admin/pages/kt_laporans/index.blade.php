@extends('layouts.admin')
@section('judul', 'Dokumen Laporan Index')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Manajemen kt_laporan') }}</h1>

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
            <a href="{{ route('kt_laporans.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i>
                Tambah kt_laporan
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
                        @forelse ($kt_laporans as $index => $kt_laporan)
                        <tr>
                            <td>{{ $kt_laporans->firstItem() + $index }}</td>
                            <td class="font-weight-bold">{{ $kt_laporan->nama }}</td>
                            <td class="text-center">
                                <a href="{{ route('kt_laporans.show', $kt_laporan->id) }}" class="btn btn-info btn-circle btn-sm" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('kt_laporans.edit', $kt_laporan->id) }}" class="btn btn-primary btn-circle btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('kt_laporans.destroy', $kt_laporan->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                                Data kt_laporan belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Link Paginasi -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $kt_laporans->links() }}
            </div>
        </div>
    </div>
@endsection

