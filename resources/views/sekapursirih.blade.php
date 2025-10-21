@extends('layouts.app')

@section('title', 'Sekapur Sirih')

@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url({{ asset('snapsaga-o-olHg9yqec-unsplash.jpg') }});">
        <div class="container position-relative">
            <h1>Sekapur Sirih</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <p>
                            Di era globalisasi ini, kebutuhan akan komunikasi dan informasi untuk mewadahi kepentingan
                            masyarakat dan instansi sangat tinggi. Website ini dimaksudkan sebagai sarana publikasi untuk
                            memberikan Informasi dan gambaran Dinas Kelautan dan Perikanan Provinsi Riau dalam melaksanakan
                            kegiatan - kegiatan di bidang kelautan dan perikanan. Melalui keberadaan website ini kiranya
                            masyarakat dapat mengetahui seluruh informasi tentang Kebijakan tentang Potensi dan Pengelolaan
                            Kelautan dan Perikanan Provinsi Riau.
                        </p>
                        <p>
                            Kritik dan saran terhadap kekurangan dan kesalahan yang ada sangat kami harapkan guna
                            penyempurnaan
                            Website ini dimasa datang. Semoga Website ini memberikan manfaat bagi kita semua.
                        </p>

                        <p>
                            Wassalamu 'alaikum Wr. Wb.
                        </p>
                        <p>
                            Terima kasih atas kunjungan Anda
                        </p>
                        <br>
                        <p>
                            Kepala Dinas Kelautan dan Perikanan Prov. Riau
                        </p>
                    </div>
                </section>
            </div>

            @include('layouts.sidebar')

        </div>
    </div>
@endsection
