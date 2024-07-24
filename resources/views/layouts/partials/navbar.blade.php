<nav class="navbar navbar-expand-lg sticky-top" style="background-color: whitesmoke; border-bottom: 2px grey solid;">
    <div class="container">
        <div class="d-flex justify-content-between w-100">
            <div class="d-flex align-items-center">
                @auth
                    <a class="navbar-brand text-black" style="font-weight: bold;" href="{{ route('home.index') }}">Galan Library</a>
                @else
                    <a href="/"><img src="{{ asset('logo.png') }}" alt="Book Illustration" width='50px'></a>
                    <p class="text-black mb-0 ms-3" style="font-weight: bold; font-size: 24px;">Galan Library</p>
                @endauth
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                @auth
                    <ul class="navbar-nav me-auto">
                        @if(!auth()->user()->hasRole('administrator'))
                            <li class="nav-item">
                                <a class="nav-link-2" style="padding-left: 30px" href="{{ route('page.survey') }}">Survei Kepuasan</a>
                            </li>
                        @endif
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        @if(!auth()->user()->hasRole('administrator'))
                            <li class="nav-item">
                                <a class="nav-link flex items-center" href="{{ route('wishlist.index') }}">
                                    <span class="material-symbols-outlined fs-2 me-2 text-grey">
                                        favorite
                                    </span>
                                </a>
                            </li>
                        @endif
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
                    </ul>
                @else
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/" style="color: gray;">Beranda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#Profile-Sekolah" style="color: gray;">Tentang Kami</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}" style="color: gray;">Login</a>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</nav>
