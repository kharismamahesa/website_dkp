@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url({{ asset('snapsaga-o-olHg9yqec-unsplash.jpg') }});">
        <div class="container position-relative">
            <h2>{{ 'Struktur Organisasi' }}</h2>
        </div>
    </div>
    <section id="contact" class="contact section">

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
                                    {{-- Changed to button that triggers modal --}}
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-{{ $bidang->id }}"
                                        class="text-decoration-none">
                                        <h5 class="text-success fw-semibold">{{ $bidang->name }}</h5>
                                    </a>
                                    <p class="text-muted mb-0">
                                        {{ $bidang->position }}
                                        <br>
                                        <strong>({{ $bidang->head ?? 'Kepala Bidang belum ditentukan' }})</strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Modal for each department --}}
                        <div class="modal fade" id="modal-{{ $bidang->id }}" tabindex="-1"
                            aria-labelledby="modalLabel-{{ $bidang->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-success" id="modalLabel-{{ $bidang->id }}">
                                            {{ $bidang->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($bidang->subDepartments && $bidang->subDepartments->count() > 0)
                                            <div class="row g-4">
                                                @foreach ($bidang->subDepartments as $sub)
                                                    <div class="col-md-6">
                                                        <div class="card border-success h-100">
                                                            <div class="card-body">
                                                                <h6 class="card-title text-success">{{ $sub->name }}
                                                                </h6>
                                                                <p class="card-text text-muted mb-0">
                                                                    {{ $sub->position }}
                                                                    <br>
                                                                    <strong>{{ $sub->head ?? 'Belum ditentukan' }}</strong>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @else
                                            <div class="alert alert-success mb-0">
                                                Belum ada sub bidang yang tersedia.
                                            </div>
                                        @endif
                                    </div>
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

    </section>
@endsection
