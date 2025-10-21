<header id="header" class="header d-flex align-items-center position-relative">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

        <a href="{{ url('/') }}" class="logo align-items-center">
            <img src="{{ asset('dkp_logo.png') }}" alt="DKP Prov riau">
            <!-- <h1 class="sitename">DKP Riau</h1>  -->
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li class="dropdown">
                    <a href="#"><span>Profil</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="{{ route('sekapursirih') }}">Sekapur Sirih</a></li>
                        <li><a href="{{ route('visimisi') }}">Visi dan Misi</a></li>
                        <li><a href="{{ route('strukturorganisasi') }}">Struktur Organisasi</a></li>
                        <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
                        <li><a href="{{ route('tugasdanfungsi') }}">Tugas dan Fungsi</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('berita') }}">Berita</a></li>
                <li><a href="https://ppid.riau.go.id/dip/12/dkp" target="_blank">PPID</a></li>
                <li class="dropdown">
                    <a href="#"><span>Informasi Publik</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        {{-- <li><a href="#">Agenda</a></li> --}}
                        {{-- <li><a href="#">Pengumuman</a></li> --}}
                        <li><a href="{{ route('regulasi') }}">Regulasi</a></li>
                        <li><a href="{{ route('dip') }}">DIP</a></li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#"><span>Layanan</span>
                        <i class="bi bi-chevron-down toggle-dropdown"></i>
                    </a>
                    <ul>
                        <li><a href="{{ route('pengaduan') }}">Pengaduan</a></li>
                        <li><a href="https://lapor.go.id/">SP4N Lapor</a></li>
                    </ul>
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

    </div>
</header>
