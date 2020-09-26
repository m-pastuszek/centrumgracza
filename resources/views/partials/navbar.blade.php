<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Menu nawigacji">
            <i class="ya ya-bar"></i>
        </button>
        <a class="navbar-brand" style="color:#718DA5" href="/">Centrum Gracza</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="/aktualnosci"
                                        aria-haspopup="true" aria-expanded="false">Aktualności</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reviews') }}"
                                        aria-haspopup="true" aria-expanded="false">Recenzje</a></li>
                <li class="nav-item dropdown">
                    <a href class="nav-link dropdown-toggle" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">Publicystyka</a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="/felietony">Felietony</a>
                        <a class="dropdown-item" href="/poradniki">Poradniki</a>
                        <a class="dropdown-item" href="/technologie">Technologie</a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="/esport"
                                        aria-haspopup="true" aria-expanded="false">eSport</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('games') }}"
                                        aria-haspopup="true" aria-expanded="false">Gry</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('videos') }}"
                                        aria-haspopup="true" aria-expanded="false">Filmy</a></li>
            </ul>
        </div>
        <!-- END NAV -->

        <form class="navbar-search" action="{{ route('search') }}" method="get">
            <div class="container">
                <input class="form-control mr-sm-2" type="search" placeholder="Szukaj..." aria-label="Szukaj" name="q" >
                <i class="ya ya-times search-close"></i>
            </div>
        </form>

        <!-- END Search -->
        <ul class="navbar-nav navbar-right flex-row d-flex align-items-center">
            @auth
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown-toggle-none py-0" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="avatar avatar-xs rounded-circle mr-xl-2" src="/storage/{{ Auth::user()->profile->avatar }}" alt="">
                        <span class="d-none d-xl-inline-block">{{ Auth::user()->username }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="ya ya-user"></i> Moje konto</a>

                        <a class="dropdown-item" href="{{ route('user.profile-edit') }}"><i class="ya ya-gear"></i> Ustawienia</a>
                        @if (Auth::user()->can('browse_admin'))
                            <a class="dropdown-item" href="/admin"><i class="fas fa-user-secret"></i> Panel administracyjny</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();"><i class="ya ya-logout"></i> Wyloguj</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
            @endauth

            <li class="nav-item"><a class="nav-link toggle-search" href="#"><i class="ya ya-search"></i></a></li>
        </ul>
    </div>
</nav>