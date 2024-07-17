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

        @include('sidenav')

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
                                    <h6>Data Alternatif</h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addAlternatifModal">Tambah Alternatif</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-container">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kode Alternatif</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Alternatif</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi</th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alternatives as $alternative)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-4 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">
                                                                {{ $alternative->alternative_code }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">
                                                        {{ $alternative->alternative_name }}</p>
                                                </td>
                                                <td class="align-middle" style="text-align: center;">
                                                    <div class="dropdown">
                                                        <button class="btn btn-link text-secondary mb-0 " type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.alternatives.show', $alternative->id) }}">Show</a>
                                                            </li>
                                                            <li><a class="dropdown-item"
                                                                    href="{{ route('admin.alternatives.edit', $alternative->id) }}">Edit</a>
                                                            </li>
                                                            <li>
                                                                <form
                                                                    action="{{ route('admin.alternatives.destroy', $alternative->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item"
                                                                        onclick="return confirm('Anda yakin ingin menghapus data ini?')">Delete</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Start Modal --}}

        @include('admin.pages.alternatives.modal.addalternative')

        {{-- @include('admin.pages.alternatives.modal.editalternative') --}}

        {{-- End Modal --}}

        {{-- Start Footer --}}

        @include('admin.layouts.footer')

        {{-- End Footer --}}
        </div>
    </main>
    <!--   Core JS Files   -->
    @include('admin.layouts.script')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @php
        $messageType = '';
        $message = '';

        if (Session::get('success')) {
            $messageType = 'success';
            $message = Session::get('success');
        } elseif (Session::get('failed')) {
            $messageType = 'error';
            $message = Session::get('failed');
        }
    @endphp

    @if ($message)
        <script>
            Swal.fire({
                title: '{{ $messageType === 'success' ? 'Success' : 'Error' }}',
                text: '{{ $message }}',
                icon: '{{ $messageType }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

</body>

</html>
