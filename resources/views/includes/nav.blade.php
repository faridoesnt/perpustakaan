<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark" data-aos="fade-down">
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="navbar-brand">
                Perpustakaan
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ (request()->is('/')) ? 'active' : '' }}">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a href="{{ route('peminjaman-home') }}" class="nav-link {{ (request()->is('peminjaman-buku')) ? 'active' : '' }}">Peminjaman</a>
                    </li>
                @endauth
            </ul>
            @guest
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Daftar</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Masuk</a>
                </li>
            </ul>
            @endguest

            @auth
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                            Halo, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            @can('petugas')
                                <a href="{{ route('admin-dashboard') }}" class="dropdown-item">Dasbor</a>
                                <div class="dropdown-divider"></div>
                            @endcan
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();" class="dropdown-item">Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>

                <!-- Mobile Menu -->
                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                        <a href="" class="nav-link"> Halo, {{ Auth::user()->name }} </a>
                    </li>
                    @can('petugas')
                        <li class="nav-item">
                            <a href="{{ route('admin-dashboard') }}" class="nav-link d-inline-block">Dasbor</a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="nav-link d-inline-block">Keluar
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>