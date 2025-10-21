@extends('layouts.app')

@section('title', 'Visi & Misi')

@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url({{ asset('snapsaga-o-olHg9yqec-unsplash.jpg') }});">
        <div class="container position-relative">
            <h1>Visi & Misi</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <div class="content">
                            <blockquote>
                                <h3 class="strong">Visi:</h3>
                                <p>
                                    Terwujudnya Riau yang Berdaya Saing, Sejahtera, Bermartabat dan Unggul
                                    di Indonesia (RIAU BERSATU)
                                </p>
                            </blockquote>
                            <blockquote>
                                <h3 class="strong">Misi:</h3>
                                <ol type="1" style="text-align: justify;">
                                    <li>Mewujudkan sumber daya manusia yang beriman, berkualitas dan berdaya saing global
                                        melalui pembangunan manusia seutuhnya.</li>
                                    <li>Mewujudkan pembangunan infrastruktur daerah yang merata, berwawasan lingkungan dan
                                        berkelanjutan.</li>
                                    <li>Mewujudkan pembangunan ekonomi yang inklusif, mandiri dan berdaya saing.</li>
                                    <li>Mewujudkan budaya Melayu sebagai payung negeri dan mengembangkan pariwisata yang
                                        berdaya saing.</li>
                                    <li>Mewujudkan tata kelola pemerintahan yang baik dan pelayanan publik yang prima
                                        berbasis teknologi informasi.</li>
                                </ol>
                            </blockquote>
                        </div>
                    </div>
                </section>
            </div>

            @include('layouts.sidebar')

        </div>
    </div>
@endsection
