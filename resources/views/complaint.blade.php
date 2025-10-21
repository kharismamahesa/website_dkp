@extends('layouts.app')

@section('title', 'Pengaduan')

@section('content')
    <div class="page-title dark-background" data-aos="fade"
        style="background-image: url({{ asset('snapsaga-o-olHg9yqec-unsplash.jpg') }});">
        <div class="container position-relative">
            <h2>{{ 'Pengaduan' }}</h2>
        </div>
    </div>
    <section id="contact" class="contact section">

        <div class="container" data-aos="fade">

            <div class="row gy-5 gx-lg-5 mt-4 mb-4">

                <div class="col-lg-4">

                    <div class="info">
                        <h3>Dinas Kelautan dan Perikanan Provinsi Riau</h3>

                        <div class="info-item d-flex">
                            <i class="bi bi-geo-alt flex-shrink-0"></i>
                            <div>
                                <h4>Alamat:</h4>
                                <p>Jl. Pattimura No.6, Cinta Raja, Kec. Sail, Kota Pekanbaru, RIAU, 28127</p>
                            </div>
                        </div>
                        <div class="info-item d-flex">
                            <i class="bi bi-envelope flex-shrink-0"></i>
                            <div>
                                <h4>Email:</h4>
                                <p>dkp@riau.go.id</p>
                            </div>
                        </div>
                        <div class="info-item d-flex">
                            <i class="bi bi-phone flex-shrink-0"></i>
                            <div>
                                <h4>Telepon:</h4>
                                <p>(0761) 23191</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <form id="complaintForm" role="form" class="php-email-form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" placeholder="Nama Anda" required>
                            </div>
                            <div class="col-md-6 form-group mt-3 mt-md-0">
                                <input type="email" class="form-control" name="email" placeholder="Email Anda">
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="message" placeholder="Pesan Pengaduan" required></textarea>
                        </div>
                        <div class="text-center"><button type="submit">Kirim Pengaduan</button></div>
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="mb-0" data-aos="fade-up">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d498.70753963120757!2d101.4536955!3d0.5099124!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d5aea0c27c2e5b%3A0x743c98c899c5bfa2!2sDinas%20Perikanan%20Dan%20Kelautan%20Provinsi%20Riau!5e0!3m2!1sid!2sid!4v1760531101647!5m2!1sid!2sid"
                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div> --}}
    </section>
@endsection



@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#complaintForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "{{ route('api.complaints.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('#complaintForm')[0].reset();
                        }
                    },
                    error: function(xhr) {
                        const res = xhr.responseJSON;
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: res?.message ||
                                'Terjadi kesalahan, silakan coba lagi.',
                        });
                    }
                });
            });
        });
    </script>
@endpush
