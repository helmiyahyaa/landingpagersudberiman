@extends('layouts.admin')
@section('judul', 'Profil Index')
@section('content-admin')
<h1 class="h3 mb-4 text-gray-800">{{ __('Manajemen Data Profil') }}</h1>

@if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <a href="{{ route('data_profils.create') }}" class="btn btn-dark">
            <i class="fas fa-plus mr-1"></i> Tambah Profil
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Foto</th>
                        <th>Isi</th>
                        <th>Slug</th>
                        <th>Kategori</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dataProfils as $index => $dataProfil)
                        <tr>
                            <td>{{ $dataProfils->firstItem() + $index }}</td>
                            <td>{{ $dataProfil->judul }}</td>
                            <td class="text-center">
                                @if ($dataProfil->foto)
                                    <img src="{{ asset('storage/' . $dataProfil->foto) }}" alt="Foto" width="60" class="img-thumbnail">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{!! Str::limit(strip_tags($dataProfil->isi), 60) !!}</td>
                            <td>{{ $dataProfil->slug }}</td>
                            <td>{{ $dataProfil->kategori->nama ?? '-' }}</td>
                            <td class="text-center">
                                <a href="{{ route('data_profils.show', $dataProfil->id) }}" class="btn btn-info btn-circle btn-sm" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('data_profils.edit', $dataProfil->id) }}" class="btn btn-dark btn-circle btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('data_profils.destroy', $dataProfil->id) }}" method="POST" class="d-inline delete-form" onsubmit="return confirm('Yakin hapus data ini?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-circle btn-sm" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7" class="text-center">Data belum tersedia.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex justify-content-center">
            {{ $dataProfils->links() }}
        </div>
    </div>
</div>
@endsection
