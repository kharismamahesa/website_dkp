<footer id="footer" class="footer dark-background">
    <div class="footer-top">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 col-md-6 footer-about">
                    <img src="{{ asset('riau.png') }}" style="width: 60px" alt="Prov Riau" class="mb-3">
                    <a href="{{ url('/') }}" class="logo d-flex align-items-center">
                        <span class="sitename">
                            Dinas Kelautan dan Perikanan
                            <br>Provinsi Riau
                        </span>
                    </a>
                    <div class="footer-contact pt-3 pb-3">
                        <p>Jl. Pattimura No.6</p>
                        <p>Cinta Raja, Kec. Sail, Kota Pekanbaru</p>
                        <p>RIAU, 28127</p>
                        <p class="mt-3"><strong>Telepon:</strong> <span>(0761) 23191</span></p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 footer-links">
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="{{ route('sejarah') }}">Sejarah</a></li>
                        <li><a href="{{ route('berita') }}">Berita</a></li>

                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 footer-links">
                    <h4>Layanan</h4>
                    <ul>
                        <li><a href="{{ route('pengaduan') }}">Pengaduan</a></li>
                        <li><a href="https://lapor.go.id/" target="_blank">SP4N Lapor</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright text-center">
        <div
            class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

            <div class="d-flex flex-column align-items-center align-items-lg-start">
                <div>
                    © Copyright <strong><span>IT Dinas Kelautan dan Perikanan Provinsi Riau</span></strong>. All
                    Rights Reserved
                </div>
                <div class="credits">Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    Distributed by <a href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>

            <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
                <a href="https://www.facebook.com/perikanan.riau"><i class="bi bi-facebook"></i></a>
                <a href="https://www.instagram.com/dkp_riau/"><i class="bi bi-instagram"></i></a>
                <a href="https://www.youtube.com/@dkpprovinsiriau"><i class="bi bi-youtube"></i></a>
            </div>

        </div>
    </div>

</footer>
