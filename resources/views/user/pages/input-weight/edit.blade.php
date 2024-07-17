<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.head')
    <style>
        .table-container {
            overflow-x: auto;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;

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
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
                target="_blank">
                <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">VIKOR ROC</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            {{-- Start Sidebar --}}
            @include('user.layouts.sidebar')
            {{-- End Sidebar --}}
        </div>

    </aside>
    <main class="main-content position-relative border-radius-lg">
        <!-- Navbar -->
        @include('user.layouts.navbar')
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <h6>Input Nilai Bobot</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <p class="text-uppercase text-xs font-weight-bolder">Panduan Pengisian</p>
                                    <p class=" text-secondary text-xs font-weight-bolder opacity-7">
                                        Skala Penilaian Bobot 1 sampai 100
                                        <br> Nilai bobot yang dimasukkan tidak boleh sama dengan kriteria yang lain.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <form action="{{ route('user.weight.update', $criteria->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="criteria_name" class="form-label">Nama</label>
                                            <input type="text" name="criteria_name" id="criteria_name"
                                                class="form-control" value="{{ $criteria->criteria_name }}" disabled>
                                        </div>

                                        <div class="mb-3">
                                            <label for="weight" class="form-label">Bobot</label>
                                            <input type="number" name="weight" id="weight" class="form-control"
                                                value="{{ $weightValue->weight }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                        <button type="button" onclick="history.back()"
                                            class="btn btn-danger">Kembali</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('user.layouts.footer')

            {{-- End Footer --}}
        </div>
    </main>
    <!--   Core JS Files   -->
    @include('user.layouts.script')

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
