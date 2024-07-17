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
</head>

<body>
    @include('user.layouts.header')
    <!-- End Header -->
    <div style="height: 60px;"></div>
    <main>
        <section>
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Cari Rekomendasi</h2>
                    <p>Mohon berikan nilai pada kriteria berikut sesuai preferensi Anda untuk menentukan rekomendasi pantai.</p>
                </div>

                <div class="row justify-content-center ">
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
                    <div class="col-md-5">
                        <form action="{{ route('user.weight.store') }}" method="POST">
                            @csrf
                            @foreach ($criterias as $criteria)
                                <div class="mb-3">
                                    <label for="value{{ $criteria->id }}" class="form-label"><strong>{{ $criteria->criteria_name }} : <span class="me-3 text-muted" id="value-{{ $criteria->id }}">50</span></strong></label>
                                    <div class="d-flex align-items-center">
                                        <p class="ms-3 text-mute d" style="font-size: 0.8rem;">Sangat Buruk</p>
                                        <input type="range" name="values[{{ $criteria->id }}]" id="value{{ $criteria->id }}" class="form-control-range w-100" min="1" max="100" step="1" value="50" oninput="updateValue({{ $criteria->id }})" required>
                                        <p class="ms-3 text-mute d" style="font-size: 0.8rem;">Sangat Baik</p>
                                    </div>
                                    @error('values.' . $criteria->id)
                                        <p class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                    @enderror
                                </div>
                            @endforeach

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary btn-visit">Lihat Hasil</button>
                            </div>
                        </form>

                        <script>
                            function updateValue(id) {
                                const slider = document.getElementById(`value${id}`);
                                const value = slider.value;
                                document.getElementById(`value-${id}`).textContent = value;
                            }
                        </script>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('user.layouts.footer')
    <!-- End Footer -->

    <!-- Vendor JS Files -->
    @include('user.layouts.script')

</body>

</html>
