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
        .rating {
            display: flex;
            flex-direction: column;
        }

        .rating-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.5rem;
        }

        .rating-item .custom-label {
            margin-left: 0.5rem;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <!-- Header -->
    @include('user.layouts.header')
    <!-- End Header -->
    <main>
        <div style="height: 30px;"></div>
        <section id="portofolio" class="portofolio">
            <div class="container" data-aos="fade-up">
                <div class="section-header">
                    <h2>Beri Penilaian</h2>
                    Berikan Penilaian Anda Setelah Mengunjungi {{ $alternatives->alternative_name }}
                    </p>
                </div>

                <div class="row">
                    <div class="col-md-6 text-center d-flex flex-column align-items-center">
                        <div class="card">
                            <img src="{{ asset('storage/' . $alternatives->image) }}"
                                class="card-img-top img-fluid img-fluid-custom larger-image mb-3" alt="Gambar">
                            <div class="card-body">
                                <p class="card-text font-weight-bold transparent-text">{{ $alternatives->description }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form
                            action="{{ route('user.alternative-values.update', ['alternative_id' => $alternatives->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            @foreach ($criterias as $criteria)
                                <div class="mb-3">
                                    <label for="value{{ $criteria->id }}" class="form-label"><strong>Bagaimana dengan
                                            {{ $criteria->criteria_name }} di Pantai
                                            {{ $alternatives->alternative_name }}?</strong></label>
                                    <div class="rating" data-criteria-id="{{ $criteria->id }}">
                                        <div class="rating-item">
                                            <input type="radio" id="star5-{{ $criteria->id }}"
                                                name="values[{{ $criteria->id }}]" value="5" required />
                                            <label for="star5-{{ $criteria->id }}" class="custom-label"
                                                data-title="Sangat Baik">
                                                <i class="fas fa-star"></i>
                                                <small>Sangat Baik</small>
                                            </label>
                                        </div>
                                        <div class="rating-item">
                                            <input type="radio" id="star4-{{ $criteria->id }}"
                                                name="values[{{ $criteria->id }}]" value="4" />
                                            <label for="star4-{{ $criteria->id }}" class="custom-label"
                                                data-title="Baik">
                                                <i class="fas fa-star"></i>
                                                <small>Baik</small>
                                            </label>
                                        </div>
                                        <div class="rating-item">
                                            <input type="radio" id="star3-{{ $criteria->id }}"
                                                name="values[{{ $criteria->id }}]" value="3" />
                                            <label for="star3-{{ $criteria->id }}" class="custom-label"
                                                data-title="Cukup">
                                                <i class="fas fa-star"></i>
                                                <small>Cukup</small>
                                            </label>
                                        </div>
                                        <div class="rating-item">
                                            <input type="radio" id="star2-{{ $criteria->id }}"
                                                name="values[{{ $criteria->id }}]" value="2" />
                                            <label for="star2-{{ $criteria->id }}" class="custom-label"
                                                data-title="Buruk">
                                                <i class="fas fa-star"></i>
                                                <small>Buruk</small>
                                            </label>
                                        </div>
                                        <div class="rating-item">
                                            <input type="radio" id="star1-{{ $criteria->id }}"
                                                name="values[{{ $criteria->id }}]" value="1" />
                                            <label for="star1-{{ $criteria->id }}" class="custom-label"
                                                data-title="Sangat Buruk">
                                                <i class="fas fa-star"></i>
                                                <small>Sangat Buruk</small>
                                            </label>
                                        </div>
                                    </div>
                                    @error('values.' . $criteria->id)
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary btn-visit">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('user.layouts.footer')
    <!-- End Footer -->

    @include('user.layouts.script')
</body>

</html>
