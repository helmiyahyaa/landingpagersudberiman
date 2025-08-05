{{-- File ini akan otomatis mengakses $sidebarData dari halaman induk.
     Kita hanya perlu memeriksa variabel $exclude yang kita kirimkan. --}}
<div class="col-lg-4">
    <div class="sidebar p-4 rounded" style="background-color: #f8f9fa;">
        <h4 class="sidebar-title text-primary mb-3">Berita Terbaru</h4>
        <ul class="list-unstyled">
            @forelse ($sidebarData['beritas'] as $item)
                {{-- Hanya tampilkan jika $exclude tidak ada, atau jika ID-nya tidak cocok --}}
                @if (!isset($exclude) || get_class($item) != get_class($exclude) || $item->id !== $exclude->id)
                    <li class="mb-2">
                        <a href="{{ url('/berita/' . $item->slug) }}" class="d-flex align-items-center text-decoration-none text-dark hover-effect">
                            <i class="bi bi-newspaper me-2"></i> {{ Str::limit($item->judul, 40) }}
                        </a>
                    </li>
                @endif
            @empty
                <li class="text-muted">Tidak ada berita terbaru.</li>
            @endforelse
        </ul>

        <hr class="my-4">

        <h4 class="sidebar-title text-primary mb-3">Pengumuman Terbaru</h4>
        <ul class="list-unstyled">
            @forelse ($sidebarData['pengumumans'] as $item)
                {{-- Hanya tampilkan jika $exclude tidak ada, atau jika ID-nya tidak cocok --}}
                @if (!isset($exclude) || get_class($item) != get_class($exclude) || $item->id !== $exclude->id)
                    <li class="mb-2">
                        <a href="{{ route('pengumumans.show', $item->id) }}" class="d-flex align-items-center text-decoration-none text-dark hover-effect">
                            <i class="bi bi-megaphone me-2"></i> {{ Str::limit($item->judul, 40) }}
                        </a>
                    </li>
                @endif
            @empty
                <li class="text-muted">Tidak ada pengumuman terbaru.</li>
            @endforelse
        </ul>

        <hr class="my-4">

        <h4 class="sidebar-title text-primary mb-3">Layanan Kami</h4>
        <ul class="list-unstyled">
            @forelse ($sidebarData['layanans'] as $layanan)
                <li class="mb-2">
                    <a href="{{ route('layanan.detail', $layanan->slug) }}" class="d-flex align-items-center text-decoration-none text-dark hover-effect">
                        <i class="{{ $layanan->icon_class ?? 'bi bi-hospital' }} me-2"></i> {{ Str::limit($layanan->judul, 40) }}
                    </a>
                </li>
            @empty
                <li class="text-muted">Tidak ada layanan yang tersedia.</li>
            @endforelse
        </ul>
    </div>
</div>