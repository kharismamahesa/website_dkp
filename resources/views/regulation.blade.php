@extends('layouts.app')

@section('title', 'Regulasi')

@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url({{ asset('snapsaga-o-olHg9yqec-unsplash.jpg') }});">
        <div class="container position-relative">
            <h1>Regulasi</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                @foreach ($regulation_categories as $category)
                    <h5 class="mt-5">{{ $category->name }}</h5>

                    @if ($category->regulations->count() > 0)
                        <table class="table table-bordered table-striped">
                            <thead class="table-success">
                                <tr>
                                    <th>Dokumen</th>
                                    <th>Download</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category->regulations as $index => $regulation)
                                    <tr>
                                        <td>{{ $regulation->title }}</td>
                                        <td>
                                            @if ($regulation->source_type === 'file' && $regulation->file_path)
                                                <a href="{{ asset('storage/' . $regulation->file_path) }}"
                                                    class="btn btn-sm btn-success" download>
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            @elseif ($regulation->source_type === 'link' && $regulation->external_link)
                                                <a href="{{ $regulation->external_link }}" class="btn btn-sm btn-success"
                                                    target="_blank" rel="noopener">
                                                    <i class="bi bi-download"></i>
                                                </a>
                                            @else
                                                <span class="text-muted">Tidak tersedia</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted fst-italic">Belum ada dokumen dalam kategori ini.</p>
                    @endif
                @endforeach
            </div>

            @include('layouts.sidebar')

        </div>
    </div>
@endsection
