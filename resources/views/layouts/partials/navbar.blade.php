<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container col-lg-8">
        @auth
            <a class="navbar-brand" href="{{ route('home.index') }}">Aksara Library</a>
        @else
            <a class="navbar-brand" href="/">Aksara Library</a>
        @endauth
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            @auth
                <ul class="navbar-nav">
                    @can('fill.attendances')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('page.survey') }}">Survey Kepuasan</a>
                        </li>
                    @endcan
                    @can('access-scanner.attendances')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('page.attendance-scanner') }}">Scan QR Kehadiran</a>
                        </li>
                    @endcan
                </ul>
            @endauth
            <ul class="navbar-nav ms-auto">
                @auth
    
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropDown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ auth()->user()->pictureURL() }}" width="25" height="25"
                                class="user-picture rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="userDropDown">
                            <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form class="d-inline" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
