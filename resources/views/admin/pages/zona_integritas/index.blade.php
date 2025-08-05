@extends('layouts.admin')
@section('judul', 'Zona Integritas Index')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Zona Integritas') }}</h1>

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
            {{-- PERBAIKAN: Nama route disesuaikan dengan standar resource (pakai tanda hubung) --}}
            <a href="{{ route('zona_integritas.create') }}" class="btn btn-dark">
                <i class="fas fa-plus mr-1"></i>
                Tambah Zona Integritas
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
                            <th>Kategori</th> {{-- PERBAIKAN: Mengganti 'Periode' menjadi 'Kategori' --}}
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- PERBAIKAN #1: Menggunakan variabel $zonaIntegrita yang dikirim dari controller --}}
                        @forelse ($zonaIntegrita as $index => $item)
                            <tr>
                                {{-- PERBAIKAN #2: Menggunakan $zonaIntegrita untuk paginasi --}}
                                <td>{{ $zonaIntegrita->firstItem() + $index }}</td>
                                <td class="font-weight-bold">{{ $item->judul }}</td>
                                <td>{{ Str::limit($item->isi, 70) }}</td>
                                <td><a href="{{ $item->link }}" target="_blank" rel="noopener noreferrer">{{ Str::limit($item->link, 20) }}</a></td>
                                {{-- PERBAIKAN #3: Menampilkan nama kategori dari relasi. Ganti 'nama' jika nama kolomnya berbeda --}}
                                <td>{{ $item->ktZis->nama ?? 'Tidak ada kategori' }}</td>
                                <td class="text-center">
                                    {{-- PERBAIKAN #4: Menggunakan $item (bukan ->id) agar Laravel otomatis memakai slug --}}
                                    <a href="{{ route('zona_integritas.show', $item) }}" class="btn btn-info btn-circle btn-sm" title="Detail">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    <a href="{{ route('zona_integritas.edit', $item) }}" class="btn btn-dark btn-circle btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('zona_integritas.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
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
                                <td colspan="6" class="text-center p-4"> {{-- colspan disesuaikan menjadi 6 --}}
                                    Data Zona Integritas belum tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Link Paginasi -->
            <div class="mt-4 d-flex justify-content-center">
                {{-- PERBAIKAN #5: Menggunakan $zonaIntegrita untuk links() --}}
                {{ $zonaIntegrita->links() }}
            </div>
        </div>
    </div>
@endsection