@extends('layouts.app')

@section('title', 'Halaman Utama')

@section('content')
    {{-- SECTION SLIDE --}}
    <section id="hero" class="hero section dark-background">
        <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

            @if (isset($slider_terakhir) && $slider_terakhir->count())
                @foreach ($slider_terakhir as $index => $slider)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}" class="d-block w-100">
                        <div class="carousel-container">
                            <h2 class="text-center">{{ $slider->title }}</h2>
                            <h4 class="text-center">{{ $slider->sub_title }}</h4>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="carousel-item active">
                    <img src="{{ asset('kantor_dkp.jpeg') }}" alt="Kantor DKP Riau">
                    <div class="carousel-container">
                        <h2 class="text-center">Dinas Kelautan dan Perikanan Provinsi Riau</h2>
                        <h4 class="text-center">Selamat Datang di Official Website Dinas Kelautan dan Perikanan Provinsi
                            Riau</h4>
                    </div>
                </div>
            @endif
            <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
            </a>
            <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
            </a>
            <ol class="carousel-indicators"></ol>
        </div>
    </section>

    {{-- SECTION BIDANG BIDANG --}}
    <section id="services" class="services section">
        <div class="container section-title">
            <h2>STRUKTUR ORGANISASI</h2>
            {{-- <p>Sub Heading</p> --}}
        </div>
        <div class="content">
            <div class="container">
                @if (isset($pimpinan) && $pimpinan)
                    <div class="row g-0 justify-content-center">
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-4">
                            <div class="card shadow border-0 w-100">
                                <div class="card-body text-center">
                                    <img src="{{ asset('storage/' . $pimpinan->photo) }}" alt="Kepala Dinas"
                                        class="img-fluid rounded-circle mb-3"
                                        style="width: 150px; height: 150px; object-fit: cover;">
                                    <a href="#" class="stretched-link text-decoration-none">
                                        <h5 class="text-success fw-semibold">Kepala</h5>
                                    </a>
                                    <p class="text-muted mb-0">
                                        {{ $pimpinan->position }}
                                        <br>
                                        <strong>( {{ $pimpinan->name }} )</strong>
                                        <br>
                                        NIP. {{ $pimpinan->nip }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row g-0 justify-content-center">
                        <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-4">
                            <div class="card shadow border-0 w-100">
                                <div class="card-body text-center">

                                    <a href="#" class="stretched-link text-decoration-none">
                                        <h5 class="text-success fw-semibold">Kepala</h5>
                                    </a>
                                    <p class="text-muted mb-0">
                                        Kepala Dinas
                                        <br>
                                        Nama Kepala Dinas
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="row g-0">
                    @if (isset($data_bidang) && $data_bidang->count())
                        @foreach ($data_bidang as $bidang)
                            <div class="col-lg-3 col-md-6 d-flex align-items-stretch mb-4">
                                <div class="card shadow border-0 w-100">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <i class="bi bi-bag-dash-fill h1 text-success"></i>
                                        </div>
                                        <a href="#" class="stretched-link text-decoration-none">
                                            <h5 class="text-success fw-semibold">{{ $bidang->name }}</h5>
                                        </a>
                                        <p class="text-muted mb-0">
                                            {{ $bidang->position }}
                                            <br>
                                            <strong>(&nbsp;{{ $bidang->head ?? 'Kepala Bidang belum ditentukan' }}&nbsp;)</strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-info text-center" role="alert">
                                Data bidang belum tersedia.
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

    {{-- SECTION BERITA --}}
    <section id="about" class="about section">
        <div class="content">
            <div class="container">
                <h2 class="content-title mb-4 text-center">
                    Berita
                </h2>
                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        @if (isset($berita_terakhir) && $berita_terakhir)
                            <img src="{{ asset('storage/' . $berita_terakhir->thumbnail) }}"
                                alt="{{ $berita_terakhir->title }}" class="img-fluid"
                                style="height:450px;object-fit:cover;width:100%;background-color:#222;">
                            <h5 class="m-0 h5 mt-3 text-white">{{ $berita_terakhir->title }}</h5>
                            <div class="d-flex align-items-center mt-2">
                                <i class="bi bi-calendar3 text-white-50 me-2"></i>
                                <small class="text-white-50">
                                    {{ \Carbon\Carbon::parse($berita_terakhir->created_at)->format('d M Y') }}
                                </small>
                            </div>
                            <p class="text-white opacity-75 mt-2" style="font-size: 0.95rem;">
                                {{ Str::limit(strip_tags($berita_terakhir->content), 150, '...') }}
                            </p>
                            <a href="{{ url('berita/' . $berita_terakhir->slug) }}"
                                class="btn btn-sm btn-outline-light mt-2">Baca Selengkapnya</a>
                        @else
                            <h5 class="m-0 h5 mt-3 text-white">Belum ada berita</h5>
                        @endif
                    </div>
                    <div class="col-lg-6 ml-auto">
                        <div class="row">
                            <div class="col-lg-12">
                                @if (isset($berita_lainnya) && $berita_lainnya->count())
                                    @foreach ($berita_lainnya as $berita)
                                        <div class="card mb-3 bg-transparent border-0">
                                            <div class="row g-0 align-items-start">
                                                <div class="col-4">
                                                    <img src="{{ asset('storage/' . $berita->thumbnail) }}"
                                                        alt="{{ $berita->title }}" class="img-fluid rounded"
                                                        style="height:150px;width:100%;object-fit:cover;">
                                                </div>
                                                <div class="col-8">
                                                    <div class="card-body py-2 px-3">
                                                        <h5 class="m-0 h5 text-white">{{ $berita->title }}</h5>
                                                        <div class="d-flex align-items-center mt-2">
                                                            <i class="bi bi-calendar3 text-white-50 me-2"></i>
                                                            <small class="text-white-50">
                                                                {{ \Carbon\Carbon::parse($berita->created_at)->format('d M Y') }}
                                                            </small>
                                                        </div>
                                                        <a href="{{ url('berita/' . $berita->slug) }}"
                                                            class="btn btn-sm btn-outline-light mt-2">Baca
                                                            Selengkapnya</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="text-white">Belum ada berita lainnya.</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION SALAM CBIB --}}
    <section id="about-3" class="about-3 section">
        <div class="container">
            <div class="row gy-4 justify-content-between align-items-center">
                <div class="col-lg-6 order-lg-2 position-relative">
                    <iframe class=" embed-responsive-item col-lg-12" style="width: 100%; height: 400px;"
                        src="https://www.youtube.com/embed/c2A0qo8WjGk?si=hEZ3HHWdkR4mvneP"></iframe>
                </div>
                <div class="col-lg-5 order-lg-1">
                    <h2 class="content-title mb-4">Salam CBIB</h2>
                    <p class="mb-4">
                        Cara Budidaya Ikan yang Baik, yaitu serangkaian prinsip dan standar yang bertujuan untuk
                        memastikan praktik budidaya ikan menghasilkan produk berkualitas tinggi, aman untuk
                        dikonsumsi, serta menjaga kesehatan ikan dan kelestarian lingkungan. Penerapan CBIB mencakup
                        aspek:
                    </p>
                    <ul class="list-unstyled list-check">
                        <li>sanitasi</li>
                        <li>penggunaan pakan dan obat ikan yang aman</li>
                        <li>pengelolaan lingkungan</li>
                        <li>manajemen yang baik untuk menjamin keamanan pangan</li>
                    </ul>

                    {{-- <p><a href="#" class="btn-cta">Get in touch</a></p> --}}
                </div>
            </div>
        </div>
    </section>

    <section id="services-2" class="services-2 section dark-background">
        <div class="container section-title">
            <h2>GALERI</h2>
            <p>Galeri Kegiatan Dinas Kelautan dan Perikanan Provinsi Riau</p>
        </div>
        <div class="services-carousel-wrap">
            <div class="container">
                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                                "loop": true,
                                "speed": 600,
                                "autoplay": {
                                "delay": 5000
                                },
                                "slidesPerView": "auto",
                                "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                                },
                                "navigation": {
                                "nextEl": ".js-custom-next",
                                "prevEl": ".js-custom-prev"
                                },
                                "breakpoints": {
                                "320": {
                                    "slidesPerView": 1,
                                    "spaceBetween": 40
                                },
                                "1200": {
                                    "slidesPerView": 3,
                                    "spaceBetween": 40
                                }
                                }
                            }
                    </script>
                    <button class="navigation-prev js-custom-prev">
                        <i class="bi bi-arrow-left-short"></i>
                    </button>
                    <button class="navigation-next js-custom-next">
                        <i class="bi bi-arrow-right-short"></i>
                    </button>
                    <div class="swiper-wrapper">
                        @if (isset($galeri) && $galeri->count())
                            @foreach ($galeri as $data_galeri)
                                <div class="swiper-slide">
                                    <div class="service-item">
                                        <div class="service-item-contents">
                                            <a href="#">
                                                <span class="service-item-category">Galeri</span>
                                                <h5 class="service-item-title">{{ $data_galeri->title }}</h5>
                                            </a>
                                        </div>
                                        <img src="{{ asset('storage/' . $data_galeri->image) }}"
                                            alt="{{ $data_galeri->title }}" class="img-fluid"
                                            style="height:250px;object-fit:cover;width:100%;">
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="swiper-slide">
                                <div class="service-item">
                                    <div class="service-item-contents">
                                        <a href="#">
                                            <span class="service-item-category">Galeri</span>
                                            <h5 class="service-item-title">Belum ada galeri</h5>
                                        </a>
                                    </div>
                                    <img src="{{ asset('snapsaga-o-olHg9yqec-unsplash.jpg') }}" alt="Image"
                                        class="img-fluid">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="recent-posts" class="recent-posts section">
        <div class="container section-title">
            <h2>AGENDA</h2>
            <p>Agenda Kegiatan Dinas Kelautan dan Perikanan Provinsi Riau</p>
        </div>
        <div class="container">
            <div class="row gy-5">

                <div class="d-flex justify-content-center mb-4">
                    <button class="btn btn-outline-success rounded-0 me-2 filter-btn active"
                        data-filter="all">Semua</button>
                    <button class="btn btn-outline-success rounded-0 me-2 filter-btn" data-filter="today">Hari
                        Ini</button>
                    <button class="btn btn-outline-success rounded-0 filter-btn" data-filter="tomorrow">Besok</button>
                </div>

                <div class="row" id="agenda-container">
                    @if (isset($agenda) && $agenda->count())
                        @foreach ($agenda as $item)
                            @php
                                $date = \Carbon\Carbon::parse($item->date);
                                $today = \Carbon\Carbon::today();
                                $tomorrow = \Carbon\Carbon::tomorrow();

                                $class = '';
                                if ($date->isToday()) {
                                    $class = 'today';
                                } elseif ($date->isTomorrow()) {
                                    $class = 'tomorrow';
                                } else {
                                    $class = 'other';
                                }
                            @endphp

                            <div class="col-xl-4 col-md-6 agenda-item {{ $class }} mb-4">
                                <div class="post-item position-relative h-100">
                                    <span class="post-date d-inline-block">
                                        {{ $date->format('d M Y') }} &nbsp;
                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $item->time)->format('H:i') }}
                                    </span>

                                    <div class="post-content d-flex flex-column">
                                        <h3 class="post-title">{{ $item->title }}</h3>
                                        <p>
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#agendaModal{{ $item->id }}">
                                                {{ $item->description }}
                                            </a>
                                        </p>
                                        <div class="meta d-flex align-items-center">
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-person"></i>
                                                <span class="ps-2 mb-3">{{ $item->officials }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- Modal Detail Agenda -->
                            <div class="modal fade" id="agendaModal{{ $item->id }}" tabindex="-1"
                                aria-labelledby="agendaModalLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content border-0 shadow">
                                        <div class="modal-header bg-success text-white">
                                            <h5 class="modal-title text-white" id="agendaModalLabel{{ $item->id }}">
                                                {{ $item->title }}</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 class="text-center">{{ $item->description }}</h5>
                                            <hr>
                                            <p><strong>Tanggal:</strong>
                                                {{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</p>
                                            <p><strong>Waktu:</strong>
                                                {{ \Carbon\Carbon::createFromFormat('H:i:s', $item->time)->format('H:i') }}
                                            </p>
                                            <p><strong>Lokasi:</strong> {{ $item->location }}</p>
                                            <p><strong>Pejabat Terkait:</strong> {{ $item->officials }}</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12">
                            <div class="alert alert-success text-center" role="alert">
                                Data agenda belum tersedia.
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </section>

    {{-- <section id="call-to-action" class="call-to-action section light-background">
        <div class="content">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h3>Subscribe To Our Newsletter</h3>
                        <p class="opacity-50">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Nesciunt, reprehenderit!
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <form action="forms/newsletter.php" class="form-subscribe php-email-form">
                            <div class="form-group d-flex align-items-stretch">
                                <input type="email" name="email" class="form-control h-100"
                                    placeholder="Enter your e-mail">
                                <input type="submit" class="btn btn-secondary px-4" value="Subcribe">
                            </div>
                            <div class="loading">Loading</div>
                            <div class="error-message"></div>
                            <div class="sent-message">
                                Your subscription request has been sent. Thank you!
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const filter = this.getAttribute('data-filter');
                const items = document.querySelectorAll('.agenda-item');
                items.forEach(item => {
                    item.style.display = 'none';
                    if (filter === 'all' || item.classList.contains(filter)) {
                        item.style.display = 'block';
                    }
                });
            });
        });
    </script>
@endpush
