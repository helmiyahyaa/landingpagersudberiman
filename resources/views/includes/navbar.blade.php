@php
    use Illuminate\Support\Facades\Request;
@endphp
<header id="header" class="header sticky-top">
    <div class="topbar d-flex align-items-center ">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <div class="d-flex align-items-center">
                    <img src="{{ asset('assets/img/icon/icon-2.svg') }}" alt="Phone Icon" style="height: 45px;">
                    <div class="ms-3">
                        <span class="topbar-title">Kontak Kami</span>
                        <a href="tel:+155895548855" class="topbar-subtitle">+1 5589 55488 55</a>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-4">
                    <img src="{{ asset('assets/img/icon/icon-1.svg') }}" alt="Email Icon" style="height: 45px;">
                    <div class="ms-3">
                        <span class="topbar-title">Email Kami</span>
                        <a href="mailto:contact@example.com" class="topbar-subtitle">contact@example.com</a>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-4">
                    <img src="{{ asset('assets/img/icon/icon-3.svg') }}" alt="IGD Icon" style="height: 45px;">
                    <div class="ms-3">
                        <span class="topbar-title">IGD</span>
                        <a href="tel:+123456789" class="topbar-subtitle">24x7 Pelayanan</a>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-4">
                    <img src="{{ asset('assets/img/icon/icon-4.svg') }}" alt="Youtube Icon" style="height: 45px;">
                    <div class="ms-3">
                        <span class="topbar-title">Youtube</span>
                        <a href="https://www.youtube.com/your-channel" class="topbar-subtitle">RSUD Beriman Channel</a>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-4">
                    <img src="{{ asset('assets/img/icon/icon-5.svg') }}" alt="Instagram Icon" style="height: 45px;">
                    <div class="ms-3">
                        <span class="topbar-title">Instagram</span>
                        <a href="https://www.instagram.com/your-account" class="topbar-subtitle">@RSUD_Beriman</a>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-4">
                    <img src="{{ asset('assets/img/icon/icon-6.svg') }}" alt="Facebook Icon" style="height: 45px;">
                    <div class="ms-3">
                        <span class="topbar-title">Facebook</span>
                        <a href="https://www.facebook.com/your-page" class="topbar-subtitle">RSUD Beriman Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="branding d-flex align-items-center">
        <div class="container position-relative d-flex align-items-center justify-content-between">
            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('assets/img/logo.png') }}" alt="RSUD Beriman Logo">
                <h1 class="sitename">RSUD Beriman</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    {{-- BERANDA menu item --}}
                    <li><a class="nav-link scrollto {{ Request::is('/') ? 'active' : '' }}" href="/">BERANDA</a></li>
                    
                    @foreach ($menus as $menu)
                        @if ($menu->id != 0 && ($menu->nama) != 'jadwal' && $menu->status == 'aktif')
                            @php
                                // === PERBAIKAN LOGIKA LINK DI SINI ===
                                // Jika menu punya anak (parent), href HARUS '#'
                                // Jika tidak punya anak, baru buat link dari slug/link.
                                $isParent = $menu->children->count() > 0;
                                $menuHref = '#'; // Default untuk parent

                                if (!$isParent) {
                                    if (!empty($menu->link)) {
                                        $menuHref = $menu->link;
                                    } elseif (!empty($menu->slug)) {
                                        $menuHref = '/categories/' . $menu->slug;
                                    }
                                }

                                // Logika untuk highlight menu aktif
                                $isActive = false;
                                if (!$isParent && $menuHref !== '#') {
                                    $isActive = Request::is(ltrim($menuHref, '/')) || Request::is(ltrim($menuHref, '/') . '/*');
                                } elseif ($isParent) {
                                    foreach ($menu->children as $child) {
                                        $childHref = !empty($child->link) ? $child->link : '/categories/' . $child->slug;
                                        if (Request::is(ltrim($childHref, '/')) || Request::is(ltrim($childHref, '/') . '/*')) {
                                            $isActive = true; break;
                                        }
                                        if (isset($child->children) && $child->children->count() > 0) {
                                            foreach ($child->children as $subChild) {
                                                $subChildHref = !empty($subChild->link) ? $subChild->link : '/categories/' . $subChild->slug;
                                                if (Request::is(ltrim($subChildHref, '/')) || Request::is(ltrim($subChildHref, '/') . '/*')) {
                                                    $isActive = true; break;
                                                }
                                            }
                                        }
                                        if ($isActive) break;
                                    }
                                }
                            @endphp

                            @if ($isParent)
                                <li class="dropdown {{ $isActive ? 'active' : '' }}">
                                    <a href="#"> {{-- Href dipaksa '#' untuk parent --}}
                                        <span>{{ ($menu->nama) }}</span>
                                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                                    </a>
                                    <ul>
                                        @foreach ($menu->children as $child)
                                            @if ($child->status == 'aktif')
                                                @php
                                                    $isChildParent = isset($child->children) && $child->children->count() > 0;
                                                    $childHref = '#'; // Default untuk child parent
                                                    if (!$isChildParent) {
                                                        $childHref = !empty($child->link) ? $child->link : '/categories/' . $child->slug;
                                                    }

                                                    $isChildActive = false;
                                                    if (!$isChildParent) {
                                                        $isChildActive = Request::is(ltrim($childHref, '/')) || Request::is(ltrim($childHref, '/') . '/*');
                                                    } else {
                                                        foreach ($child->children as $subChild) {
                                                            $subChildHref = !empty($subChild->link) ? $subChild->link : '/categories/' . $subChild->slug;
                                                            if (Request::is(ltrim($subChildHref, '/')) || Request::is(ltrim($subChildHref, '/') . '/*')) {
                                                                $isChildActive = true; break;
                                                            }
                                                        }
                                                    }
                                                @endphp

                                                @if ($isChildParent)
                                                    <li class="dropdown-submenu {{ $isChildActive ? 'active' : '' }}">
                                                        <a href="#"> {{-- Href dipaksa '#' untuk parent level 2 --}}
                                                            <span>{{ ($child->nama) }}</span>
                                                            <i class="bi bi-chevron-down toggle-dropdown"></i>
                                                        </a>
                                                        <ul>
                                                            @foreach ($child->children as $subChild)
                                                                @if ($subChild->status == 'aktif')
                                                                    @php
                                                                        $subChildHref = !empty($subChild->link) ? $subChild->link : '/categories/' . $subChild->slug;
                                                                    @endphp
                                                                    <li>
                                                                        <a href="{{ $subChildHref }}" class="{{ Request::is(ltrim($subChildHref, '/')) ? 'active' : '' }}">
                                                                            {{ ($subChild->nama) }}
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                @else
                                                    <li>
                                                        <a href="{{ $childHref }}" class="{{ $isChildActive ? 'active' : '' }}">
                                                            {{ ($child->nama) }}
                                                        </a>
                                                    </li>
                                                @endif
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $menuHref }}" class="{{ $isActive ? 'active' : '' }}">
                                        {{ ($menu->nama) }}
                                    </a>
                                </li>
                            @endif
                        @endif
                    @endforeach
                    
                    {{-- WHISTLEBLOWER menu item --}}
                    <li><a class="nav-link scrollto {{ Request::is('whistleblower') || Request::is('whistleblower/*') ? 'active' : '' }}" href="http://web.balikpapan.go.id/whistleblower" target="_blank">WHISTLEBLOWER</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </div>
</header>