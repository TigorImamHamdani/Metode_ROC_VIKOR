<nav id="navbar" class="navbar">
    <ul>
        <li><a href="{{ route('user.home.index') }}">Beranda</a></li>
        <li><a href="#about">Tentang</a></li>
        <li><a href="#portfolio">Detail</a></li>
        <li><a href="#criteria">Kriteria</a></li>
        <li><a href="{{ route('user.weight.index') }}">Cari Rekomendasi</a></li>
        <li><a href="{{ route('user.result.index') }}">Hasil Rekomendasi</a></li>

        <li class="dropdown">
            <a href="#" data-bs-toggle="dropdown">
                <span>Akun</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
            </a>
            <ul class="dropdown-menu">
                @guest
                    <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                    <li><a class="dropdown-item" href="{{ route('register-view') }}">Register</a></li>
                @else
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a></li>
                    <form id="logout-form" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                @endguest
            </ul>
        </li>
    </ul>
</nav>
