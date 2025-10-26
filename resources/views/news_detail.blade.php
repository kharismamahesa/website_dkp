@extends('layouts.app')

@section('title', $berita->title ?? 'Detail Berita')

@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url({{ asset('snapsaga-o-olHg9yqec-unsplash.jpg') }});">
        <div class="container position-relative">
            <h2>{{ $berita->title ?? 'Detail Berita' }}</h2>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <section id="blog-details" class="blog-details section">
                    <div class="container">
                        <article class="article">
                            <div class="post-img">
                                <img src="{{ asset('storage/' . $berita->thumbnail) }}" class="img-fluid w-100"
                                    alt="{{ $berita->title }}">
                            </div>
                            <h2 class="title">
                                {{ $berita->title }}
                            </h2>
                            <div class="meta-top">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> 
                                        <a href="#">{{ $berita->user->name ?? '-' }}</a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i>
                                        <a href="#">
                                            <time datetime="2020-01-01">
                                                {{ \Carbon\Carbon::parse($berita->publish_date)->format('d M Y') }}
                                            </time>
                                        </a>  
                                    </li>
                                </ul>
                            </div>

                            <div class="content">
                                {!! $berita->content !!}
                            </div>
                        </article>

                    </div>
                </section>
            </div>

            @include('layouts.sidebar')

        </div>
    </div>
@endsection
