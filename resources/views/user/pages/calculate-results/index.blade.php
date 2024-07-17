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

    <script>
        let refreshCount = localStorage.getItem('refreshCount') || 0;

        if (refreshCount < 3) {
            localStorage.setItem('refreshCount', ++refreshCount);
            setTimeout(() => {
                location.reload();
            }, 10);
        } else {
            localStorage.removeItem('refreshCount');
        }
    </script>
</head>

<body>
    @include('user.layouts.header')
    <!-- End Header -->
    <div style="height: 30px;"></div>

    <main id="main">
        <section>
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-12">
                        <div class="section-header">
                            <h2>Hasil Rekomendasi </h2>
                            <p>Berikut adalah hasil rekomendasi pantai yang ada di Malang berdasarkan preferensi Anda.
                            </p>
                        </div>
                        @if ($criterias->isEmpty() && $alternatives->isEmpty())
                            <p>Perhitungan belum ada</p>
                        @else
                            @include('user.pages.calculate-results.normalization-matrix')

                            @include('user.pages.calculate-results.normalization-weight')

                            @include('user.pages.calculate-results.value-measure')

                            @include('user.pages.calculate-results.value-result')
                        @endif
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('user.layouts.footer')
    <!-- End Footer -->

    <!-- Vendor JS Files -->
    @include('user.layouts.script')
</body>

</html>
