@extends('layouts.admin')
@section('judul', 'Dokumen Laporan Edit')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Edit Dokumen Laporan') }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Dokumen Laporan: {{ $dokLaporan->judul }}</h6>
        </div>
        <div class="card-body">

            <!-- Menampilkan Error Validasi -->
            @if ($errors->any())
                <div class="alert alert-danger border-left-danger" role="alert">
                    <ul class="pl-4 my-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Tambahkan id pada form untuk referensi JavaScript --}}
            <form action="{{ route('dok_laporans.update', $dokLaporan->id) }}" method="POST" enctype="multipart/form-data" id="edit-form">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="judul">Judul <span class="small text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul" name="judul" 
                           value="{{ old('judul', $dokLaporan->judul) }}" required>
                </div>

                <div class="form-group">
                    <label for="kt_laporans_id">Kategori <span class="small text-danger">*</span></label>
                    <select class="form-control" id="kt_laporans_id" name="kt_laporans_id" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoriLaporans as $id => $nama)
                            <option value="{{ $id }}" {{ old('kt_laporans_id', $dokLaporan->kt_laporans_id) == $id ? 'selected' : '' }}>
                                {{ $nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="isi">Isi</label>
                    {{-- Textarea ini akan menjadi target CKEditor --}}
                    <textarea class="form-control" id="isi" name="isi" rows="6">{{ old('isi', $dokLaporan->isi) }}</textarea>
                </div>

                <div class="form-group">
                    <label for="foto">Foto (Opsional)</label>
                    @if ($dokLaporan->foto)
                        <div class="mb-2">
                            <img src="{{ Storage::url($dokLaporan->foto) }}" alt="Foto {{ $dokLaporan->judul }}" style="max-width: 200px;">
                        </div>
                    @endif
                    <input type="file" class="form-control-file" id="foto" name="foto" accept="image/*">
                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <hr>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('dok_laporans.index') }}" class="btn btn-secondary mr-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- PERUBAHAN #1: Gunakan CDN untuk CKEditor 5 Classic Build --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        // Deklarasikan variabel editor di luar agar bisa diakses nanti
        let editorInstance;

        // PERUBAHAN #2: Inisialisasi CKEditor 5
        ClassicEditor
            .create(document.querySelector('#isi'))
            .then(editor => {
                // Simpan instance editor ke variabel global
                editorInstance = editor;
            })
            .catch(error => {
                console.error(error);
            });

        // PERUBAHAN #3: (PENTING!) Update textarea sebelum form disubmit
        // CKEditor 5 tidak secara otomatis mengupdate textarea aslinya.
        document.getElementById('edit-form').addEventListener('submit', function(event) {
            if (editorInstance) {
                // Ambil data dari CKEditor dan masukkan ke dalam textarea
                const editorData = editorInstance.getData();
                document.querySelector('#isi').value = editorData;
            }
        });
    </script>
@endpush