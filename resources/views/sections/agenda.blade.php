<div>
    @if(isset($agendas) && $agendas->isNotEmpty())
        <div class="agenda-list">
            @foreach($agendas as $agenda)
                <div class="agenda-item-wrapper">
                    <!-- The clickable vertical card -->
                    <div class="agenda-item" data-target="agenda-detail-{{ $loop->index }}">
                        <div class="agenda-arrow">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.172 12l-4.95-4.95 1.414-1.414L16 12l-6.364 6.364-1.414-1.414z" fill="currentColor"/></svg>
                        </div>
                        <div class="agenda-title-vertical">
                            <h3>{{ $agenda->judul }}</h3>
                        </div>
                        <div class="agenda-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                    </div>

                    <!-- The hidden detail card -->
                    <div class="agenda-detail-card" id="agenda-detail-{{ $loop->index }}">
                        <div class="detail-card-body">
                            <div class="detail-card-image">
                                <img src="https://images.unsplash.com/photo-1505373877841-8d25f7d46678?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80" alt="Gambar {{ $agenda->judul }}">
                            </div>
                            <div class="detail-card-content">
                                <h2>{{ $agenda->judul }}</h2>
                                <p>{{ Str::limit(strip_tags($agenda->isi), 150) }}</p>
                                <ul>
                                    <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 15.172l9.192-9.193 1.414 1.414L10 18l-6.364-6.364 1.414-1.414z" fill="currentColor"/></svg> Informasi Terverifikasi</li>
                                    <li><svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10 15.172l9.192-9.193 1.414 1.414L10 18l-6.364-6.364 1.414-1.414z" fill="currentColor"/></svg> Diperbarui Secara Berkala</li>
                                </ul>
                            </div>
                        </div>
                        <div class="detail-card-footer">
                             <a href="{{-- route('agenda.show', $agenda->slug) --}}" class="detail-btn">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>Saat ini belum ada agenda yang tersedia.</p>
    @endif
</div>