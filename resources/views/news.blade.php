@push('styles')
    <style>
        .pagination-custom a {
            display: inline-block;
            padding: 6px 12px;
            color: #333;
            text-decoration: none;
        }

        .pagination-custom a.active {
            background-color: #007bff;
            color: white;
        }

        .pagination-custom a:hover {
            background-color: #007bff;
            color: white;
        }

        .pagination-custom span {
            display: inline-block;
            padding: 6px 12px;
            color: #aaa;
        }
    </style>
@endpush

@extends('layouts.app')

@section('title', $berita->title ?? 'Berita')

@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url({{ asset('snapsaga-o-olHg9yqec-unsplash.jpg') }});">
        <div class="container position-relative">
            <h2>{{ 'Berita' }}</h2>
        </div>
    </div>
    <!-- Blog Posts 2 Section -->
    <section id="blog-posts-2" class="blog-posts-2 section">

        <div class="container">
            <div class="row gy-4">
                @if ($news->count())
                    @foreach ($news as $berita)
                        <div class="col-lg-4 col-md-6">
                            <article class="position-relative h-100">
                                <div class="post-img position-relative overflow-hidden">
                                    <img src="{{ asset('storage/' . $berita->thumbnail) }}"
                                        style="height: 300px; width: 100%; object-fit: cover;" alt="{{ $berita->title }}">
                                </div>
                                <div class="meta d-flex align-items-end">
                                    <span
                                        class="post-date"><span>{{ $berita->created_at->format('d') }}</span>{{ $berita->created_at->translatedFormat('F') }}</span>
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-person"></i> <span
                                            class="ps-2">{{ $berita->user->name ?? 'Tidak diketahui' }}</span>
                                    </div>
                                </div>
                                <div class="post-content d-flex flex-column">
                                    <h3 class="post-title">{{ $berita->title }}</h3>
                                    <a href="{{ url('berita/' . $berita->slug) }}"
                                        class="readmore stretched-link"><span>Baca
                                            Selengkapnya</span><i class="bi bi-arrow-right"></i></a>
                                </div>
                            </article>
                        </div>
                    @endforeach
                @else
                    <p>Tidak ada berita tersedia.</p>
                @endif
            </div>
        </div>
    </section><!-- /Blog Posts 2 Section -->

    <section id="blog-pagination" class="blog-pagination section">

        <div class="container">
            <div class="d-flex justify-content-center">
                <ul class="pagination-custom d-flex list-unstyled gap-2">
                    {{-- Previous Page Link --}}
                    @if ($news->onFirstPage())
                        <li><span class="text-muted"><i class="bi bi-chevron-left"></i></span></li>
                    @else
                        <li><a href="{{ $news->previousPageUrl() }}"><i class="bi bi-chevron-left"></i></a></li>
                    @endif

                    {{-- Pagination Elements --}}
                    @php
                        $window = 2; // Jumlah halaman yang ditampilkan di kiri dan kanan halaman aktif
                        $start = max($news->currentPage() - $window, 1);
                        $end = min($news->currentPage() + $window, $news->lastPage());

                        // Tambahkan ... di awal jika perlu
                        if ($start > 1) {
                            echo '<li><a href="' . $news->url(1) . '">1</a></li>';
                            if ($start > 2) {
                                echo '<li><span class="text-muted">...</span></li>';
                            }
                        }

                        // Tampilkan halaman dalam window
                        for ($i = $start; $i <= $end; $i++) {
                            if ($i == $news->currentPage()) {
                                echo '<li><a href="' . $news->url($i) . '" class="active">' . $i . '</a></li>';
                            } else {
                                echo '<li><a href="' . $news->url($i) . '">' . $i . '</a></li>';
                            }
                        }

                        // Tambahkan ... di akhir jika perlu
                        if ($end < $news->lastPage()) {
                            if ($end < $news->lastPage() - 1) {
                                echo '<li><span class="text-muted">...</span></li>';
                            }
                            echo '<li><a href="' .
                                $news->url($news->lastPage()) .
                                '">' .
                                $news->lastPage() .
                                '</a></li>';
                        }
                    @endphp

                    {{-- Next Page Link --}}
                    @if ($news->hasMorePages())
                        <li><a href="{{ $news->nextPageUrl() }}"><i class="bi bi-chevron-right"></i></a></li>
                    @else
                        <li><span class="text-muted"><i class="bi bi-chevron-right"></i></span></li>
                    @endif
                </ul>
            </div>
        </div>
    </section>
@endsection
