@extends('layouts.admin')
@section('judul', 'Layanan Show')
@section('content-admin')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Detail Layanan') }}</h1>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-dark">{{ $layanan->judul }}</h6>
                    <a href="{{ route('layanans.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i>
                        Kembali
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Foto Utama -->
                        <div class="col-md-4 text-center">
                            @if($layanan->foto)
                                <img src="{{ asset('storage/layanan_fotos/' . $layanan->foto) }}" alt="Foto {{ $layanan->judul }}" class="img-fluid rounded mb-3" style="max-height: 300px;">
                            @else
                                <div class="img-fluid rounded mb-3 d-flex align-items-center justify-content-center bg-light" style="height: 300px; color: #888;">
                                    <span>Tidak ada foto</span>
                                </div>
                            @endif
                            <p class="text-muted small">Dibuat pada: {{ $layanan->created_at->format('d F Y') }}</p>
                            <p class="text-muted small">Diperbarui pada: {{ $layanan->updated_at->format('d F Y') }}</p>
                        </div>

                        <!-- Detail Konten (Dinamis) -->
                        <div class="col-md-8">
                            <dl class="row">
                                {{-- Logika untuk mencari subjek terakhir yang terisi --}}
                                @php
                                    $lastVisibleIndex = 0;
                                    for ($i = 6; $i >= 1; $i--) {
                                        if (!empty($layanan->{'subjek' . $i})) {
                                            $lastVisibleIndex = $i;
                                            break;
                                        }
                                    }
                                @endphp

                                {{-- Loop untuk menampilkan hanya subjek yang tidak kosong --}}
                                @for ($i = 1; $i <= 6; $i++)
                                    @php
                                        $subjekKey = 'subjek' . $i;
                                        $isiKey = 'isi' . $i;
                                    @endphp
                                    
                                    @if(!empty($layanan->$subjekKey))
                                        <dt class="col-sm-3">Subjek {{ $i }}</dt>
                                        <dd class="col-sm-9">{{ $layanan->$subjekKey }}</dd>
                                        <dt class="col-sm-3">Isi {{ $i }}</dt>
                                        <dd class="col-sm-9">{!! $layanan->$isiKey !!}</dd>
                                        
                                        {{-- Tambahkan garis pemisah jika bukan item terakhir yang tampil --}}
                                        @if ($i < $lastVisibleIndex)
                                            <hr class="col-12 my-3">
                                        @endif
                                    @endif
                                @endfor
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection