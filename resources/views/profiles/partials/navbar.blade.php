<section class="overflow-hidden py-0" data-parallax="scroll"
         data-image-src="/storage/{{ $user->profile->background }}">
    <div class="overlay" ya-style="background-color: #36373a;opacity: .9"></div>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1 class="text-white py-7 mb-0 mt-3">@yield('page_title')</h1>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex align-items-center">
                <div class="nav-scroll">
                    <div class="nav nav-list nav-light">
                        <a class="nav-item nav-link" href="{{ route('user.profile-edit') }}">Ogólne</a>
                        <a class="nav-item nav-link" href="{{ route('user.password-change') }}">Zmiana hasła</a>
                        <!-- TODO: Ustawienia personalizacji użytkownika (zmiana zdjęcia w tle)
                        <a class="nav-item nav-link" href="#">Personalizacja</a>
                        -->
                    </div>
                </div>
                <a class="btn btn-outline-light btn-icon-left ml-auto mb-3 d-none d-md-inline" href="{{ route('user.profile') }}"><i class="ya ya-bold-left"></i> Powrót do profilu</a>
            </div>
        </div>
    </div>
</section>