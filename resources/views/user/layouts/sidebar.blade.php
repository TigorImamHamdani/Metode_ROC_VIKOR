<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.weight.index') ? 'active' : '' }}" href="{{ route('user.weight.index') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Skala Kepentingan</span>
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.input-matrix.index') ? 'active' : '' }}" href="{{ route('user.input-matrix.index') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Input Data Penilaian</span>
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user.result.index') ? 'active' : '' }}" href="{{ route('user.result.index') }}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Hasil Rekomendasi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link d-flex justify-content-center" href="{{ route('user.home.index') }}">
            <button type="button" class="btn btn-danger">Kembali ke Home</button>
        </a>
    </li>
</ul>
