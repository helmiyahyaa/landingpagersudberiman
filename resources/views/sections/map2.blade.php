{{-- File: resources/views/landing/struktur.blade.php --}}

<section class="team-section">
    <div class="container">
        <h2 class="section-title">Struktur Pejabat</h2>

        @if($profils->isNotEmpty())
            <div class="team-grid">
                @foreach($profils as $profil)
                    <div class="official-card">
                        <div class="official-info">
                            <h3 class="official-name">{{ $profil->judul }}</h3>
                            <p class="official-position">{{ $profil->kategori->nama ?? 'Jabatan tidak tersedia' }}</p>
                        </div>
                        <div class="official-image">
                            <img src="{{ asset('storage/' . $profil->foto) }}" alt="Foto {{ $profil->judul }}">
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="text-align: center; color: #6c757d;">Data pejabat belum tersedia.</p>
        @endif
    </div>
</section>

{{-- Pastikan file CSS untuk section ini sudah dimuat di layout utama Anda --}}