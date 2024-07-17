<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.layouts.head')
    <style>
        .table-container {
            overflow-x: auto;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            /* Menyembunyikan overflow agar tidak muncul scrollbar */
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
            @include('admin.layouts.sidebar')
            {{-- End Sidebar --}}
        </div>

    </aside>
    <main class="main-content position-relative border-radius-lg">
        <!-- Navbar -->
        @include('admin.layouts.navbar')
        <!-- End Navbar -->

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <h6>Detail Alternatif</h6>
                                </div>
                            </div>
                        </div>

                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <!-- Start Form -->
                                    <form>
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label for="alternative_code" class="form-label">Kode Alternatif</label>
                                            <input type="text" name="alternative_code" id="alternative_code"
                                                class="form-control" placeholder="Masukkan Kode Alternatif"
                                                value="{{ $alternative->alternative_code }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="alternative_name" class="form-label">Nama Alternatif</label>
                                            <input type="text" name="alternative_name" id="alternative_name"
                                                class="form-control" placeholder="Masukkan Nama Alternatif"
                                                value="{{ $alternative->alternative_name }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Deskripsi</label>
                                            <input type="text" name="description" id="description"
                                                class="form-control" placeholder="Masukkan Deskripsi"
                                                value="{{ $alternative->description }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="location" class="form-label">Link Lokasi</label>
                                            <input type="text" name="location" id="location"
                                                class="form-control" placeholder="Masukkan Link Lokasi"
                                                value="{{ $alternative->location }}" disabled>
                                        </div>
                                        <div class="mb-3">
                                            <label for="image" class="form-label">Foto</label>
                                            <br>
                                            <img src="{{ asset('storage/' . $alternative->image) }}"
                                                alt="Alternative Image" class="img-thumbnail"
                                                style="max-width: 500px; margin-top: 10px;" disabled>
                                        </div>
                                        <a href="{{ route('admin.alternatives.index') }}" class="btn btn-danger">Kembali</a>
                                    </form>
                                    <!-- End Form -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('admin.layouts.footer')
        {{-- End Footer --}}
    </main>

    <!--   Core JS Files   -->
    @include('admin.layouts.script')
</body>

</html>
