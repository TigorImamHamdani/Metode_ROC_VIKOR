<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}"
            href="{{ route('admin.dashboard.index') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.alternatives.index') ? 'active' : '' }}"
            href="{{ route('admin.alternatives.index') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Alternatif</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.criterias.index') ? 'active' : '' }}"
            href="{{ route('admin.criterias.index') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kriteria</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.input-matrix.index') ? 'active' : '' }}" href="{{ route('admin.input-matrix.index') }}">
            <div
                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Input Matrik Awal</span>
        </a>
    </li>
</ul>
