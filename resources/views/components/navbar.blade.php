<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            The Aulab Post
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar" aria-controls="mainNavbar"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                {{-- Link pubblici --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                       href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('articles.*') ? 'active' : '' }}"
                       href="{{ route('articles.index') }}">Articoli</a>
                </li>

                {{-- Link visibili SOLO se loggati --}}
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                           href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>

                    @if(auth()->user()->is_revisor)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('revisor.*') ? 'active' : '' }}"
                               href="{{ route('revisor.dashboard') }}">
                                Dashboard Revisore
                            </a>
                        </li>
                    @endif

                    @if(auth()->user()->is_admin)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.*') ? 'active' : '' }}"
                               href="{{ route('admin.revisor_requests') }}">
                                Admin Panel
                            </a>
                        </li>
                    @endif
                @endauth
            </ul>

            {{-- Sezione destra: Login / Registrati oppure Logout --}}
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}"
                           href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('register') ? 'active' : '' }}"
                           href="{{ route('register') }}">Registrati</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-danger ms-2">Logout</button>
                        </form>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
