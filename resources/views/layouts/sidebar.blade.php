<div class="col-lg-4 sidebar">
    <div class="widgets-container">
        <div class="blog-author-widget widget-item">

            <div class="d-flex flex-column align-items-center">
                <div class="d-flex align-items-center w-100">
                    <img src="assets/img/blog/blog-author.jpg" class="rounded-circle flex-shrink-0" alt="">
                    <div>
                        <h4>Media Sosial</h4>
                        <div class="social-links">
                            <a href="https://www.facebook.com/perikanan.riau"><i class="bi bi-facebook"></i></a>
                            <a href="https://www.instagram.com/dkp_riau/"><i class="biu bi-instagram"></i></a>
                            <a href="https://www.youtube.com/@dkpprovinsiriau"><i class="bi bi-youtube"></i></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="recent-posts-widget-2 widget-item">

            <h3 class="widget-title">Berita Terakhir</h3>

            @if (isset($berita_semua) && $berita_semua->count())
                @foreach ($berita_semua as $berita)
                    <div class="post-item">
                        <h4><a href="{{ route('berita.detail', $berita->slug) }}">{{ $berita->title }}</a></h4>
                        <time datetime="2020-01-01">{{ $berita->created_at->format('d M Y') }}</time>
                    </div>
                @endforeach
            @endif

        </div>
    </div>
</div>
