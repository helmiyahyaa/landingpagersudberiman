{{--
  File: resources/views/layanans/index.blade.php
  Halaman ini telah diperbarui untuk menggunakan script SweetAlert2 yang terpusat.
--}}

@extends('layouts.admin')
@section('judul', 'Layanan')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Manajemen Layanan') }}</h1>

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
            <a href="{{ route('layanans.create') }}" class="btn btn-dark">
                <i class="fas fa-plus mr-1"></i>
                Tambah Layanan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Judul</th>
                            <th>Subjek 1</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($layanans as $index => $layanan)
                        <tr>
                            <td>{{ $layanans->firstItem() + $index }}</td>
                            <td>
                                @if($layanan->foto)
                                    <img src="{{ asset('storage/layanan_fotos/' . $layanan->foto) }}" alt="{{ $layanan->judul }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 0.5rem;">
                                @else
                                    <span class="text-muted">Tidak ada foto</span>
                                @endif
                            </td>
                            <td class="font-weight-bold">{{ $layanan->judul }}</td>
                            <td>{{ Str::limit($layanan->subjek1, 50) }}</td>
                            <td class="text-center">
                                <a href="{{ route('layanans.show', $layanan->id) }}" class="btn btn-info btn-circle btn-sm" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('layanans.edit', $layanan->id) }}" class="btn btn-dark btn-circle btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                {{-- Pastikan form memiliki class .delete-form --}}
                                <form action="{{ route('layanans.destroy', $layanan->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                                Data Layanan belum tersedia.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Link Paginasi -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $layanans->links() }}
            </div>
        </div>
    </div>
@endsection

