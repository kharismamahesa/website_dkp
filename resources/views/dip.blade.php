@extends('layouts.app')

@section('title', 'Daftar Informasi Publik')

@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url({{ asset('snapsaga-o-olHg9yqec-unsplash.jpg') }});">
        <div class="container position-relative">
            <h1>Daftar Informasi Publik</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="content">

                    @foreach ($dip_categories as $category)
                        <h5 class="mt-5">{{ $category->name }}</h5>

                        @if ($category->dip_documents->count() > 0)
                            <table class="table table-bordered table-striped">
                                <thead class="table-success">
                                    <tr>
                                        <th>Dokumen</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($category->dip_documents as $index => $document)
                                        <tr>
                                            <td>{{ $document->name }}</td>
                                            <td>
                                                @if ($document->source_type === 'file' && $document->document)
                                                    <a href="{{ asset('storage/' . $document->document) }}"
                                                        class="btn btn-sm btn-success" download>
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                @elseif ($document->source_type === 'link' && $document->external_link)
                                                    <a href="{{ $document->external_link }}" class="btn btn-sm btn-success"
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
            </div>

            @include('layouts.sidebar')

        </div>
    </div>
@endsection
