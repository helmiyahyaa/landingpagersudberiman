@extends('layouts.admin')
@section('judul', 'Reformasi Birokrasi Index')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Reformasi Birokrasi') }}</h1>

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
            <a href="{{ route('reformasi_birokrasis.create') }}" class="btn btn-dark">
                <i class="fas fa-plus mr-1"></i>
                Tambah Reformasi Birokrasi
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Isi</th>
                            <th>Link</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $index => $item)
                            <tr>
                                <td>{{ $data->firstItem() + $index }}</td>
                                <td class="font-weight-bold">{{ $item->judul }}</td>
                                <td>{{ Str::limit($item->isi, 70) }}</td>
                                <td>
                                    <a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer">
                                        {{ Str::limit($item->link, 20) }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('reformasi_birokrasis.show', $item->id) }}" class="btn btn-info btn-circle btn-sm" title="Detail">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('reformasi_birokrasis.edit', $item->id) }}" class="btn btn-dark btn-circle btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('reformasi_birokrasis.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                                    Data Reformasi Birokrasi belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Link Paginasi -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
