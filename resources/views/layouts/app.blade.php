<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') - Dinas Kelautan dan Perikanan Provinsi Riau</title>
    <meta name="description" content="Portal Resmi Dinas Kelautan dan Perikanan Provinsi Riau">
    <meta name="keywords"
        content="DKP Riau, Dinas Kelautan dan Perikanan Riau, Kelautan dan Perikanan Riau, Dinas Perikanan Riau, Dinas Kelautan Riau">
    <!-- Favicons -->
    {{-- <link href="{{ assets/img/favicon.png }}" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> --}}
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    {{-- <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Marcellus:wght@400&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet"> --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Oxanium:wght@200..800&family=Permanent+Marker&display=swap"
        rel="stylesheet">
    <link href="{{ asset('agriculture/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('agriculture/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('agriculture/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('agriculture/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('agriculture/css/main.css') }}" rel="stylesheet">
    @stack('styles')
    <style>
        body,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        a,
        div {
            font-family: "Nunito", sans-serif !important;
        }

        h1,
        h2 {
            font-family: "Permanent Marker", cursive !important;
            /* font-family: "Oxanium", sans-serif !important; */
        }
    </style>
</head>

<body class="index-page">

    @include('layouts.menu')

    <main class="main">

        @yield('content')

    </main>

    @include('layouts.footer')

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>


</body>
<script src="{{ asset('agriculture/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('agriculture/vendor/php-email-form/validate.js') }}"></script>
<script src="{{ asset('agriculture/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('agriculture/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('agriculture/vendor/glightbox/js/glightbox.min.js') }}"></script>
@stack('scripts')
<script src="{{ asset('agriculture/js/main.js') }}"></script>

</html>
