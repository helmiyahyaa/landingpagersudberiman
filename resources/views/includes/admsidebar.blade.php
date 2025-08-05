    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
            <div class="sidebar-brand-text mx-3">ADMIN RSUD BERIMAN</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{ Nav::isRoute('home') }}">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>{{ __('Dashboard') }}</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            {{ __('Settings') }}
        </div>

        <!-- Nav Item - Manajemen User (Dropdown) -->
        <li class="nav-item {{ Nav::isRoute('profile', 'users.index') }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="false" aria-controls="collapseUser">
                <i class="fas fa-fw fa-users-cog"></i>
                <span>{{ __('Manajemen User') }}</span>
            </a>
            <div id="collapseUser" class="collapse {{ Nav::isRoute('profile', 'users.index', 'show') }}" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Nav::isRoute('profile') }}" href="{{ route('profile') }}">{{ __('Profile') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('users.index') }}" href="{{ route('users.index') }}">{{ __('User') }}</a>
                </div>
            </div>
        </li>

                <!-- Nav Item - Konten (Dropdown) -->
        <li class="nav-item {{ Nav::isRoute('agendas.index', 'pengumumans.index', 'beritas.index') }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKonten" aria-expanded="false" aria-controls="collapseKonten">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Konten') }}</span>
            </a>
            <div id="collapseKonten" class="collapse {{ Nav::isRoute('agendas.index', 'pengumumans.index', 'beritas.index', 'show') }}" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Nav::isRoute('agendas.index') }}" href="{{ route('agendas.index') }}">{{ __('Agenda') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('pengumumans.index') }}" href="{{ route('pengumumans.index') }}">{{ __('Pengumuman') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('beritas.index') }}" href="{{ route('beritas.index') }}">{{ __('Berita') }}</a>
                </div>
            </div>
        </li>

        <!-- Menu (Dropdown) -->
        <li class="nav-item {{ Nav::isRoute('layanans.index', 'informasis.index', 'categories.index') }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenuTampilan" aria-expanded="false" aria-controls="collapseKonten">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Menu Tampilan') }}</span>
            </a>
            <div id="collapseMenuTampilan" class="collapse {{ Nav::isRoute('layanans.index', 'informasis.index', 'categories.index', 'show') }}" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Nav::isRoute('informasis.index') }}" href="{{ route('informasis.index') }}">{{ __('Informasi') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('layanans.index') }}" href="{{ route('layanans.index') }}">{{ __('Layanan') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('categories.index') }}" href="{{ route('categories.index') }}">{{ __('Kategori') }}</a>
                </div>
            </div>
        </li>   

        <!-- Menu (Dropdown) -->
        <li class="nav-item {{ Nav::isRoute('dok_laporans.index', 'data_profils.index', 'regulasis.index', 'reformasi_birokrasis.index', 'zona_integritas.index') }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataInformasi" aria-expanded="false" aria-controls="collapseKonten">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Data Informasi') }}</span>
            </a>
            <div id="collapseDataInformasi" class="collapse {{ Nav::isRoute('dok_laporans.index', 'data_profils.index', 'regulasis.index', 'reformasi_birokrasis.index', 'zona_integritas.index', 'show') }}" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Nav::isRoute('dok_laporans.index') }}" href="{{ route('dok_laporans.index') }}">{{ __('Laporan RSUD') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('data_profils.index') }}" href="{{ route('data_profils.index') }}">{{ __('Profil Pegawai') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('regulasis.index') }}" href="{{ route('regulasis.index') }}">{{ __('Regulasi') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('reformasi_birokrasis.index') }}" href="{{ route('reformasi_birokrasis.index') }}">{{ __('Reformasi Birokrasi') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('zona_integritas.index') }}" href="{{ route('zona_integritas.index') }}">{{ __('Zona Integritas') }}</a>

                </div>
            </div>
        </li>


        <!-- Menu (Dropdown) -->
        <li class="nav-item {{ Nav::isRoute('kt_laporans.index', 'kt_profils.index', 'kt_zis.index') }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataLainnya" aria-expanded="false" aria-controls="collapseKonten">
                <i class="fas fa-fw fa-folder"></i>
                <span>{{ __('Data Lainnya') }}</span>
            </a>
            <div id="collapseDataLainnya" class="collapse {{ Nav::isRoute('kt_laporans.index', 'kt_profils.index', 'kt_zis.index', 'show') }}" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ Nav::isRoute('kt_laporans.index') }}" href="{{ route('kt_laporans.index') }}">{{ __('Kategori Laporan RSUD') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('kt_profils.index') }}" href="{{ route('kt_profils.index') }}">{{ __('Kategori Profil Pegawai') }}</a>
                    <a class="collapse-item {{ Nav::isRoute('kt_zis.index') }}" href="{{ route('kt_zis.index') }}">{{ __('Kategori Zona Integritas') }}</a>
                </div>
            </div>
        </li>
       <!-- Nav Item - About -->
        <li class="nav-item {{ Nav::isRoute('about') }}">
            <a class="nav-link" href="{{ route('about') }}">
                <i class="fas fa-fw fa-hands-helping"></i>
                <span>{{ __('About') }}</span>
            </a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->
