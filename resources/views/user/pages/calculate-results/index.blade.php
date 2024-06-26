<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.head')
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">

        @include('sidenav')

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
                    @if ($criterias->isEmpty() && $alternatives->isEmpty())
                        <p>Perhitungan belum ada</p>
                    @else
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col">
                                        <h6>Normalisasi Matrik</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table">
                                    @include('user.pages.calculate-results.normalization-matrix')
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col">
                                        <h6>Normalisasi Bobot</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table">
                                    @include('user.pages.calculate-results.normalization-weight')
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col">
                                        <h6>Nilai Utility Measure dan Regret Measure</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table">
                                    @include('user.pages.calculate-results.value-measure')
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col">
                                        <h6>Hasil Perhitungan</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table">
                                    @include('user.pages.calculate-results.value-result')
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        {{-- Start Modal --}}

        @include('user.pages.input-matrix.modal.addmatrik')

        {{-- End Modal --}}

        {{-- Start Footer --}}

        @include('user.layouts.footer')

        {{-- End Footer --}}
        </div>
    </main>
    <!--   Core JS Files   -->
    @include('user.layouts.script')
</body>

</html>
