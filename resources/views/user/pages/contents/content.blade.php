{{-- Baris WAJIB di paling atas --}}
@extends('layouts.app')

@section('content-user')

@include('includes.breadcrumb', [
    'title' => $judul
])

    <main id="main">
        <section class="content-section">
            <div class="container py-5" data-aos="fade-up">

                {{-- Logika untuk memuat section yang sesuai tetap sama --}}
                @if ($judul === 'Agenda')
                    @include('sections.agenda', ['agendas' => $semua_konten])

                @elseif ($judul === 'Berita')
                    @include('sections.berita', ['beritas' => $semua_konten])

                @elseif ($judul === 'Pengumuman')
                    @include('sections.pengumuman', ['pengumumans' => $semua_konten])
                @endif
                <div class="mt-4 d-flex justify-content-center">
                    {{ $semua_konten->links() }}
                </div>
            </div>
                            
        </section>
    </main>
@endsection