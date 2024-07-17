<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Impact Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('impact/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('impact/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Raleway:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('impact/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('impact/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('impact/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('impact/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('impact/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('impact/assets/css/main.css') }}" rel="stylesheet">
</head>
<style>
    .img-fluid-custom {
        border-radius: 10px;
    }

    .larger-image {
        max-width: 100%;
        /* Ensure the image is responsive */
        width: 500px;
        /* Set a larger width for the image */
    }

    .transparent-text {
        opacity: 0.7;
    }

    .card-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }

    .card-body {
        padding: 20px;
    }

    .form-label {
        font-weight: bold;
    }

    .btn-visit {
        width: 100px;
    }

    .footer-info {
        margin-bottom: 20px;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links ul li {
        display: inline;
        margin: 0 10px;
    }

    .footer-links ul li a {
        text-decoration: none;
        color: #000;
        transition: color 0.3s;
    }

    .footer-links ul li a:hover {
        color: #007bff;
    }

    @media (max-width: 767px) {

        .card-header,
        .card-body {
            padding: 15px;
        }

        .btn-visit {
            width: 100%;
        }

        .larger-image {
            width: 100%;
        }
    }
</style>

<body>
    <header id="header" class="header d-flex align-items-center">

        <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
            <a href="{{ route('user.home.index') }}" class="logo d-flex align-items-center">
                <h1>SI VIRO<span>.</span></h1>
            </a>
            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="{{ route('user.home.index') }}"><strong>Beranda</strong></a></li>
                    <li><a href="{{ route('user.home.index') }}"><strong>Tentang</strong></a></li>
                    <li><a href="{{ route('user.home.index') }}"><strong>Detail</strong></a></li>
                    <li><a href="{{ route('user.home.index') }}"><strong>Kriteria</strong></a></li>
                    <li><a href="{{ route('user.weight.index') }}">Cari Rekomendasi</a></li>
                    <li class="dropdown">
                        <a href="#" data-bs-toggle="dropdown">
                            <span>Akun</span>
                            <i class="bi bi-chevron-down dropdown-indicator"></i>
                        </a>
                        <ul class="dropdown-menu">
                            @guest
                                <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                                <li><a class="dropdown-item" href="{{ route('register-view') }}">Register</a></li>
                            @else
                                <li><a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a></li>
                                <form id="logout-form" action="{{ route('logout') }}" style="display: none;">
                                    @csrf
                                </form>
                            @endguest
                        </ul>
                </ul>
            </nav>
            <!-- .navbar -->

            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->
    <!-- End Header -->
    <main>
        <div class="container mt-4 py-5">
            <div class="row mb-4 justify-content-center">
                <div class="col-md-8">
                    <div class="text-center mb-4">
                        <p class="font-weight-bold">
                            Berikan Penilaian Anda Setelah Mengunjungi {{ $alternatives->alternative_name }}
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-md-6 text-center d-flex flex-column align-items-center">
                            <img src="{{ asset('storage/' . $alternatives->image) }}"
                                class="img-fluid img-fluid-custom larger-image mb-3" alt="Gambar">
                            <p class="font-weight-bold transparent-text ">
                                {{ $alternatives->description }}
                            </p>
                        </div>
                        <div class="col-md-5">
                            <form
                                action="{{ route('user.alternative-values.update', ['alternative_id' => $alternatives->id]) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                @foreach ($criterias as $criteria)
                                    <div class="mb-3">
                                        <label for="value{{ $criteria->id }}"
                                            class="form-label">{{ $criteria->criteria_name }}</label>
                                        <select name="values[{{ $criteria->id }}]" id="value{{ $criteria->id }}"
                                            class="form-select" required>
                                            <option value="">Beri Nilai</option>
                                            <option value="1">1 - Sangat Buruk</option>
                                            <option value="2">2 - Buruk</option>
                                            <option value="3">3 - Cukup</option>
                                            <option value="4">4 - Baik</option>
                                            <option value="5">5 - Sangat Baik</option>
                                        </select>
                                        @error('values.' . $criteria->id)
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                @endforeach

                                <div class="d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary btn-visit">Simpan</button>
                                    {{-- <a href="{{ route('user.home.index') }}" class="btn btn-danger btn-visit">Kembali ke Home</a> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="container text-center">
            <div class="row gy-2 justify-content-center">
                <div class="col-lg-5 col-md-12 footer-info">
                    <a href="{{ route('user.home.index') }}"
                        class="logo d-flex align-items-center justify-content-center">
                        <span>SI VIRO</span>
                    </a>
                    <p>SI VIRO adalah sistem informasi yang dirancang khusus untuk memberikan rekomendasi pantai terbaik
                        di Kabupaten Malang.</p>
                </div>
            </div>
        </div>

        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-12 footer-links">
                    <ul class="d-flex justify-content-center">
                        <li></li>
                        <li><a href="{{ route('user.home.index') }}"><strong>Beranda</strong></a></li>
                        <li><a href="{{ route('user.home.index') }}"><strong>Tentang</strong></a></li>
                        <li><a href="{{ route('user.home.index') }}"><strong>Detail</strong></a></li>
                        <li><a href="{{ route('user.home.index') }}"><strong>Kriteria</strong></a></li>
                        <li><a href="{{ route('user.weight.index') }}"><strong>Cari Rekomandasi</strong></a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container mt-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Impact</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/impact-bootstrap-business-website-template/ -->
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('impact/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('impact/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('impact/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('impact/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('impact/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('impact/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('impact/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('impact/assets/js/main.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @php
        $messageType = '';
        $message = '';

        if (Session::get('success')) {
            $messageType = 'success';
            $message = Session::get('success');
        } elseif (Session::get('failed')) {
            $messageType = 'error'; // SweetAlert2 uses 'error' for failure messages
            $message = Session::get('failed');
        }
    @endphp

    @if ($message)
        <script>
            Swal.fire({
                title: '{{ $messageType === 'success' ? 'Success' : 'Error' }}',
                text: '{{ $message }}',
                icon: '{{ $messageType }}', // This will show the correct icon
                confirmButtonText: 'OK'
            });
        </script>
    @endif


</body>

</html>
