<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
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
    <style>
        .img-fluid {
            border-radius: 10px;
        }

        .small-font {
            font-size: 0.8rem;
        }

        .extra-small-font {
            font-size: 0.7rem;
        }

        .tiny-font {
            font-size: 0.6rem;
        }

        .animated-image {
            animation-name: vertical-movement;
            animation-duration: 3s;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
        }

        @keyframes vertical-movement {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <!-- Start Header -->
    @include('user.layouts.header')
    <!-- End Header -->

    <div class="modal fade" id="aModal" tabindex="-1" role="dialog" aria-labelledby="aModalLabel"
        aria-hidden="true">
    </div>

    <!-- Modal -->
    <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p class="card-text tiny-font">*Klik diluar card untuk close</p>
                </div>
                <div class="modal-body text-center">
                    <img src="https://i0.wp.com/indiekraf.com/wp-content/uploads/2020/11/shifaaz-shamoon-Rl9l9mL6Pvs-unsplash.jpg?w=640&ssl=1"
                        class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
                    <p><strong>Apakah anda sudah pernah pergi ke pantai yang ada di Malang?</strong></p>
                    <button type="button" id="PernahBtn" class="btn btn-primary" data-dismiss="modal">
                        Pernah</button>
                    <a href="{{ route('user.weight.index') }}" class="btn btn-danger">Belum</a>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg justify-content-center" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container justify-content-center">
                        <br>
                        <h5 class="modal-title text-center font-weight-bold text-capitalize">Silahkan berikan penilai
                            terhadap pantai yang pernah anda kunjungi</h5>
                        <br>
                        <div class="row">
                            @foreach ($alternatives as $alternative)
                                <div class="col-md-4 mb-3">
                                    <div
                                        class="card h-100 d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset('storage/' . $alternative->image) }}"
                                            class="card-img-top img-fluid" alt="Gambar Pantai"
                                            style="max-height: 200px; object-fit: cover;">
                                        <div class="card-body text-center">
                                            <h5 class="card-title small-font">{{ $alternative->alternative_name }}</h5>
                                            <p class="card-text extra-small-font">{{ $alternative->description }}</p>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('user.alternative-values.edit', ['alternative_id' => $alternative->id]) }}"
                                                    class="btn btn-success btn-sm extra-small-font mr-2">Beri
                                                    Penilaian</a>
                                                <a href="{{ $alternative->location }}"
                                                    class="btn btn-primary btn-sm extra-small-font">Lihat Lokasi</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero"></section>
    <section id="hero" class="hero"></section>
    <section id="hero" class="hero">
        <div class="container position-relative">
            <div class="row gy-5" data-aos="fade-in">
                <div
                    class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                    <h2 class="font-weight-bold text-capitalize">
                        @auth
                            Selamat Datang {{ Auth::user()->name }} di <br> <span>SI VIRO</span>
                        @else
                            Selamat Datang di <br> <span>SI VIRO</span>
                        @endauth
                    </h2>
                    <p>Temukan pantai yang sempurna untuk liburan Anda dengan sistem informasi kami yang memberikan
                        rekomendasi pantai di Kabupaten Malang berdasarkan preferensi sesuai keinginan Anda!</p>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="{{ route('check.rankings') }}" class="btn-get-started">Cari Rekomendasi</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2">
                    <img src="https://bootstrapmade.com/demo/templates/FlexStart/assets/img/hero-img.png"
                        class="img-fluid animated-image" alt="" data-aos="zoom-out" data-aos-delay="100">
                </div>
            </div>
        </div>
    </section>
    <section id="hero" class="hero"></section>
    <section id="hero" class="hero"></section>

    <!-- End Hero Section -->

    <main id="main">
        <!-- ======= About Us Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Tentang</h2>
                    <p>SI VIRO adalah sistem informasi yang dirancang khusus untuk memberikan rekomendasi pantai terbaik
                        di Kabupaten Malang.</p>
                </div>
                <div class="row gy-2 justify-content-center px-xl-5">
                    <div class="col-lg-6">
                        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel"
                            data-bs-interval="3000">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="https://anomharya.com/wp-content/uploads/MALANG-PANTAI-NGUDEL-SUNSET-AERIAL-DJI_0102-Edit-181202.jpg.webp"
                                        class="d-block w-100 img-fluid rounded-4 mb-4 carousel-image" alt="Pantai 1">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://anomharya.com/wp-content/uploads/2016/07/27660323573_f80c2e4b6c_c-768x575.jpg.webp"
                                        class="d-block w-100 img-fluid rounded-4 mb-4 carousel-image" alt="Pantai 2">
                                </div>
                                <div class="carousel-item">
                                    <img src="https://static.promediateknologi.id/crop/0x0:0x0/0x0/webp/photo/p2/11/2023/07/22/23_Indonesia-2322039032.jpg"
                                        class="d-block w-100 img-fluid rounded-4 mb-4 carousel-image" alt="Pantai 3">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="content ps-0 ps-lg-5">
                            <p class="fst-italic">
                                SI VIRO hadir untuk membantu Anda menemukan pantai yang sesuai dengan keinginan dan
                                kebutuhan Anda, membuat liburan Anda lebih berkesan.
                            </p>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> Rekomendasi pantai yang dipersonalisasi.
                                </li>
                                <li><i class="bi bi-check-circle-fill"></i> Informasi pantai.</li>
                                <li><i class="bi bi-check-circle-fill"></i> Temukan pantai-pantai populer di Kabupaten
                                    Malang.</li>
                            </ul>
                            <p>SI VIRO, solusi ideal untuk menemukan pantai impian Anda di Kabupaten Malang. Dengan
                                sistem informasi kami, Anda dapat dengan mudah mendapatkan rekomendasi pantai terbaik
                                yang sesuai dengan preferensi liburan Anda. Temukan keindahan tersembunyi dan nikmati
                                momen tak terlupakan di pantai-pantai menakjubkan yang kami rekomendasikan khusus untuk
                                Anda!</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio sections-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header justify-content-center">
                    <h2>Detail Pantai</h2>
                    <p>Temukan keindahan alam yang tak terlupakan dengan mengunjungi pantai yang kami rekomendasikan
                        ini. Dari pasir putih yang lembut hingga deburan ombak yang menenangkan, pengalaman di sini akan
                        menjadi momen berharga dalam liburan Anda.</p>
                </div>

                <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry"
                    data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">
                    <div>
                        <ul class="portfolio-flters">
                            <li data-filter="*" class="filter-active">All</li>
                        </ul>
                    </div>

                    <div class="row gy-4 ">
                        @foreach ($alternatives as $alternative)
                            <div class="col-xl-4 col-md-6 portfolio-item">
                                <div class="portfolio-wrap text-center">
                                    <div class="image-wrapper">
                                        <a href="{{ asset('storage/' . $alternative->image) }}"
                                            data-gallery="portfolio-gallery-app" class="glightbox">
                                            <img src="{{ asset('storage/' . $alternative->image) }}"
                                                class="img-fluid" alt="">
                                        </a>
                                    </div>
                                    <div class="portfolio-info">
                                        <h4><a href="{{ $alternative->location }}"
                                                title="More Details">{{ $alternative->alternative_name }}</a></h4>
                                        <p>{{ $alternative->description }}</p>
                                        <br>
                                        <a href="{{ route('user.alternative-values.edit', ['alternative_id' => $alternative->id]) }}"
                                            class="btn btn-success btn-sm">Beri Penilaian </a>
                                        <a href="{{ $alternative->location }}" class="btn btn-primary btn-sm">Lihat
                                            Lokasi</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </section>
        <!-- End Portfolio Section -->

        <!-- ======= Criteria Section ======= -->
        <section id="criteria" class="criteria">
            <div class="section-header">
                <h2>Kriteria Penilaian</h2>
                <p>Kriteria ini digunakan dalam menentukan rekomendasi pantai di Kabupaten Malang yang ingin anda
                    kunjungi.</p>
            </div>

            <div class="icon-boxes position-relative">
                <div class="container position-relative">
                    <div class="row gy-6 mt-6 justify-content-center">
                        @foreach ($criterias as $criteria)
                            <div class="col-xl-3 col-md-6 mb-5" data-aos="fade-up" data-aos-delay="100">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body text-center">
                                        <div class="icon mb-3">
                                            @php
                                                $lastDigit = substr($criteria->id, -1);
                                            @endphp
                                            @switch($lastDigit)
                                                @case(0)
                                                    <i class="bi bi-globe-central-south-asia"></i>
                                                @break

                                                @case(1)
                                                    <i class="bi bi-globe-americas"></i>
                                                @break

                                                @case(2)
                                                    <i class="bi bi-globe-asia-australia"></i>
                                                @break

                                                @case(3)
                                                    <i class="bi bi-globe-europe-africa"></i>
                                                @break

                                                @case(4)
                                                    <i class="bi bi-globe-central-south-asia"></i>
                                                @break

                                                @case(5)
                                                    <i class="bi bi-globe-americas"></i>
                                                @break

                                                @case(6)
                                                    <i class="bi bi-globe-asia-australia"></i>
                                                @break

                                                @case(7)
                                                    <i class="bi bi-globe-europe-africa"></i>
                                                @break

                                                @case(8)
                                                    <i class="bi bi-globe-central-south-asia"></i>
                                                @break

                                                @case(9)
                                                    <i class="bi bi-globe-americas"></i>
                                                @break

                                                @default
                                                    <i class="bi bi-question-circle-fill"></i>
                                            @endswitch
                                        </div>
                                        <h4 class="card-title"><a href="#"
                                                class="stretched-link">{{ $criteria->criteria_name }}</a></h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <!-- Font Awesome CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
            integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMfQ4/2B4JG/0aG7q5U5f0k6f5R0W5F0k5G5F5k"
            crossorigin="anonymous">
        <!-- End Criteria Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('user.layouts.footer')

    @include('user.layouts.script')

</body>

</html>
