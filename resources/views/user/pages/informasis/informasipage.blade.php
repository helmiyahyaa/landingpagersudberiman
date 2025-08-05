{{-- Baris WAJIB di paling atas --}}
@extends('layouts.app')

@section('content-user')

{{-- Breadcrumb ini akan secara dinamis menampilkan judul halaman --}}
{{-- (misal: "Laporan Informasi Publik" atau judul detail laporan) --}}
@include('includes.breadcrumb', [
    'title' => $judul
])

<main id="main">
    {{--
      Ini adalah logika utama.
      Controller akan mengirim variabel $view_type untuk menentukan bagian mana yang akan ditampilkan.
    --}}

    {{-- JIKA controller mengirim $view_type = 'detail' --}}
    @if (isset($view_type) && $view_type == 'detail')

        {{-- Maka kita akan memuat partial view untuk halaman detail --}}
        @include('user.pages.dok_laporans.detail_laporan', ['laporan' => $laporan])

    {{-- JIKA controller mengirim $view_type = 'list' --}}
    @elseif (isset($view_type) && $view_type == 'list')

        {{--
          PERBAIKAN: Menggunakan get_defined_vars() untuk meneruskan semua variabel
          yang tersedia dari controller (seperti $semua_konten, $data_kategori, dll.)
          ke dalam partial view secara dinamis.
        --}}
        @include($partial_view, get_defined_vars())

    @endif
</main>
@endsection