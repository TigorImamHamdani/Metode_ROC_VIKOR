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
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col">
                                    <h6>Matrik Awal</h6>
                                </div>
                                <div class="col-auto">
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addMatrikModal">Input/Edit Nilai Alternatif </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kode Alternatif
                                            </th>
                                            @foreach ($criterias as $criteria)
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    {{ $criteria->criteria_code }}
                                                </th>
                                            @endforeach
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Aksi
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($alternatives as $alternative)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-3 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $alternative->alternative_code }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                @foreach ($criterias as $criteria)
                                                    <td>
                                                        @php
                                                            $alternative_value = $alternative
                                                                ->alternative_values()
                                                                ->where('criteria_id', $criteria->id)
                                                                ->first();
                                                        @endphp
                                                        @if ($alternative_value)
                                                            <h6 class="text-xs font-weight-bold mb-0">{{ $alternative_value->value }}</h6>
                                                        @else
                                                            <h6 class="text-xs font-weight-bold mb-0">-</h6>
                                                        @endif
                                                    </td>
                                                @endforeach
                                                <td class="align-middle" style="text-align: center;">
                                                    <div class="dropdown">
                                                        <button class="btn btn-link text-secondary mb-0 " type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                                        </button>
                                                        @foreach($alternative_values as $alternative_value)
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#">Show</a></li>
                                                            <li>
                                                                <form action="{{ route('user.alternative-values.destroy', $alternative_value->alternative_id) }}" method="post">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="dropdown-item">Delete</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    @endforeach
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <td>
                                            <div class="d-flex px-3 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">Nilai Maksimal</h6>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach ($criterias as $criteria)
                                            <td>
                                                <h6 class="text-xs font-weight-bold mb-0">
                                                    @php
                                                        $maxValue = \App\Models\AlternativeValue::where(
                                                            'criteria_id',
                                                            $criteria->id,
                                                        )->max('value');
                                                        echo $maxValue;
                                                    @endphp
                                                </h6>
                                            </td>
                                        @endforeach
                                        <tr>
                                            <td>
                                                <div class="d-flex px-3 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Nilai Minimal</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            @foreach ($criterias as $criteria)
                                                <td>
                                                    <h6 class="text-xs font-weight-bold mb-0">
                                                        @php
                                                            $minValue = \App\Models\AlternativeValue::where(
                                                                'criteria_id',
                                                                $criteria->id,
                                                            )->min('value');
                                                            echo $minValue;
                                                        @endphp
                                                    </h6>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
