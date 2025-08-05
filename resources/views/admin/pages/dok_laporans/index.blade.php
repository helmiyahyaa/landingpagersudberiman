@extends('layouts.admin')
@section('judul', 'Dokumen Laporan Index')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Manajemen Dokumen Laporan') }}</h1>

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
            <a href="{{ route('dok_laporans.create') }}" class="btn btn-primary">
                <i class="fas fa-plus mr-1"></i>
                Tambah Dokumen Laporan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Foto</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dokLaporans as $index => $dokLaporan)
                        <tr>
                            <td>{{ $dokLaporans->firstItem() + $index }}</td>
                            <td class="font-weight-bold">{{ $dokLaporan->judul }}</td>
                            <td>{{ $dokLaporan->ktLaporan ? $dokLaporan->ktLaporan->nama : '-' }}</td>
                            <td>
                                @if ($dokLaporan->foto)
                                    <img src="{{ Storage::url($dokLaporan->foto) }}" alt="Foto" style="max-width: 100px; max-height: 60px;">
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('dok_laporans.show', $dokLaporan->id) }}" class="btn btn-info btn-circle btn-sm" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('dok_laporans.edit', $dokLaporan->id) }}" class="btn btn-primary btn-circle btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('dok_laporans.destroy', $dokLaporan->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                                Data Dokumen Laporan belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Link Paginasi -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $dokLaporans->links() }}
            </div>
        </div>
    </div>
@endsection
