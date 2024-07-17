<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <a href="{{ route('user.home.index') }}" class="logo d-flex align-items-center">
            <h1>SI VIRO<span>.</span></h1>
        </a>
        {{-- startnavbar --}}
        @include('user.layouts.navbar')
        <!-- .navbar -->
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
</header>

<style>
    .carousel-image {
        height: 400px;
        object-fit: cover;
    }

    .icon i {
        font-size: 2.5rem;
        color: #f85a40;
    }
</style>

