<ul class="navbar-nav">
    <li class="nav-item">
        {{-- <a class="nav-link {{ request()->routeIs('admin.criterias.index') ? 'active' : '' }}" href="{{ route('admin.criterias.index') }}"> --}}
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kriteria</span>
        </a>
    </li>
    <li class="nav-item">
        {{-- <a class="nav-link {{ request()->routeIs('admin.input-matrix.index') ? 'active' : '' }}" href="{{ route('admin.input-matrix.index') }}"> --}}
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Input Data awal</span>
        </a>
    </li>
    <li class="nav-item">
        {{-- <a class="nav-link {{ request()->routeIs('admin.result.index') ? 'active' : '' }}" href="{{ route('admin.result.index') }}"> --}}
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Hasil Hitung</span>
        </a>
    </li>
</ul>
