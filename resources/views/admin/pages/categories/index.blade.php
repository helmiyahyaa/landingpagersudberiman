@extends('layouts.admin')
@section('judul', 'Categories Index')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Manajemen Kategori') }}</h1>

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
            <a href="{{ route('categories.create') }}" class="btn btn-dark">
                <i class="fas fa-plus mr-1"></i>
                Tambah Kategori
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Parent</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $index => $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $index }}</td>
                                <td class="font-weight-bold">{{ $category->nama }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>
                                    <span class="badge badge-{{ $category->status === 'aktif' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($category->status) }}
                                    </span>
                                </td>
                                <td>{{ $category->parent?->nama ?? '-' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-circle btn-sm" title="Detail">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-dark btn-circle btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
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
                                <td colspan="6" class="text-center p-4">
                                    Data kategori belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginasi -->
            <div class="mt-4 d-flex justify-content-center">
                {{ $categories->links() }}
            </div>
        </div>
    </div>
@endsection
