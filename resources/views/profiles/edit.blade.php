@extends('layouts.app')

@section('page_title', 'Edycja konta')
@section('other_metas')
    <meta name="robots" content="noindex" />
@endsection

@section('content')

    @include('profiles.partials.navbar')

    <section class="py-5">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-darken-danger">
                    Podczas aktualizacji Twoich danych wystąpił błąd. Sprawdź wprowadzone dane.
                </div>
            @endif


        @if(Session::has('message'))
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-darken-' . $msg))
                        <div class="alert alert-darken-{{ $msg }}" role="alert">{{ Session::get('message') }}</div>
                    @endif
                @endforeach
            @endif
            <form action="{{ route('user.profile-update') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card mb-5">
                    <div class="card-body d-flex align-items-md-center">
                        <div class="avatar-badge avatar-change transparent mr-3 mr-md-4">
                            <img src="/storage/{{ $user->profile->avatar }}" alt="">
                        </div>
                        <div class="form">
                            <div class="custom-file custom-file-btn d-block mb-1">
                                <input type="file" class="custom-file-input d-none" id="avatar" name="avatar">
                                <label class="custom-file-label position-relative" for="avatar">
                                    <span class="btn btn-primary">Zmień zdjęcie profilowe</span>
                                </label>
                            </div>
                            <small class="d-block mt-3 form-text">Użyj obrazu o wymiarach co najmniej 180 na 180 pikseli w formacie .jpg lub .png</small>
                        </div>
                    </div>
                </div>

                <h5 class="font-weight-bold font-size-md text-uppercase mb-4 pb-1">Informacje</h5>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="first_name">Imię</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="first_name" name="first_name" value="{{ old('first_name', $user['first_name'] ?? '') }}" placeholder="Wprowadź swoje imię">
                        @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="last_name">Nazwisko</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="last_name" name="last_name" value="{{ old('last_name', $user['last_name'] ?? '') }}" placeholder="Wprowadź swoje nazwisko">
                        @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="email">Adres e-mail</label>
                        <div class="input-group">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user['email'] ?? '') }}" placeholder="Wprowadź swój oficjalny adres e-mail">
                        </div>
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-6">
                        <label for="birth_date">Data urodzenia</label>
                        <div class="input-group">
                            <input type="date" class="form-control datepicker flatpickr-input @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', $user->profile['birth_date'] ?? '') }}" placeholder="Wybierz datę urodzenia">
                        </div>
                        @error('birth_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-6">
                        <label for="gender">Płeć</label>
                        <select class="custom-select @error('gender') is-invalid @enderror" id="gender" name="gender">
                            <option disabled>— Wybierz płeć —</option>
                            <option value="male" @if($user->profile['gender'] == 'male') selected="selected" @endif>Mężczyzna</option>
                            <option value="female" @if($user->profile['gender'] == 'female') selected="selected" @endif>Kobieta</option>
                            <option value="unset" @if($user->profile['gender'] == 'unset') selected="selected" @endif>Nie chcę podawać</option>
                        </select>
                        @error('gender')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <hr/>

                <h5 class="font-weight-bold font-size-md text-uppercase mb-4 pb-1">Linki społecznościowe</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="facebook_url">Link do Facebooka</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-light btn-icon border-right-0" data-toggle=""><i class="ya ya-facebook"></i></button>
                                </div>
                                <input type="text" class="form-control pl-2 @error('facebook_url') is-invalid @enderror" id="facebook_url" name="facebook_url" value="{{ old('facebook_url', $user->profile['facebook_url'] ?? '') }}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light btn-icon border-left-0" data-toggle="tooltip" title="" data-original-title="Wprowadź link do konta na Facebooku"><i class="ya ya-help-circle"></i></button>
                                </div>
                            </div>
                            @error('facebook_url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="twitter_url">Nazwa użytkownika (Twitter)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-light btn-icon border-right-0" data-toggle=""><i class="ya ya-twitter"></i></button>
                                </div>
                                <input type="text" class="form-control @error('twitter_url') is-invalid @enderror" id="twitter_url" name="twitter_url" value="{{ old('twitter_url', $user->profile['twitter_url'] ?? '') }}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light btn-icon border-left-0" data-toggle="tooltip" title="" data-original-title="Dodaj nazwę użytkownika na Twitterze"><i class="ya ya-help-circle"></i></button>
                                </div>
                            </div>
                            @error('twitter_url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="instagram_url">Nazwa użytkownika (Instagram)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-light btn-icon border-right-0" data-toggle=""><i class="ya ya-instagram"></i></button>
                                </div>
                                <input type="text" class="form-control @error('instagram_url') is-invalid @enderror" id="instagram_url" name="instagram_url" value="{{ old('instagram_url', $user->profile['instagram_url'] ?? '') }}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light btn-icon border-left-0" data-toggle="tooltip" title="" data-original-title="Dodaj nazwę użytkownika na Instagramie"><i class="ya ya-help-circle"></i></button>
                                </div>
                            </div>
                            @error('instagram_url')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="twitch_url">Nazwa użytkownika (Twitch)</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-light btn-icon border-right-0" data-toggle=""><i class="ya ya-twitch"></i></button>
                                </div>
                                <input type="text" class="form-control @error('twitch_url') is-invalid @enderror" id="twitch_url" name="twitch_url" value="{{ old('twitch_url', $user->profile['twitch_url'] ?? '') }}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light btn-icon border-left-0" data-toggle="tooltip" title="" data-original-title="Dodaj nazwę użytkownika na Twitchu"><i class="ya ya-help-circle"></i></button>
                                </div>
                                @error('twitch_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="website_url">Strona internetowa</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-light btn-icon border-right-0" data-toggle=""><i class="ya ya-world"></i></button>
                                </div>
                                <input type="text" class="form-control @error('website_url') is-invalid @enderror" id="website_url" name="website_url" value="{{ old('website_url', $user->profile['website_url'] ?? '') }}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-light btn-icon border-left-0" data-toggle="tooltip" title="" data-original-title="Dodaj link do strony internetowej"><i class="ya ya-help-circle"></i></button>
                                </div>
                                @error('website_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <hr/>

                <h5 class="font-weight-bold font-size-md text-uppercase mb-4 pb-1">O mnie</h5>

                <div class="form-group mb-0">
                    <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="5">{{ old('bio', $user->profile['bio'] ?? '') }}</textarea>
                    <small class="form-text text-muted">Opisz swoją osobę. Ten opis będzie widoczny na podstronie "<a href="{{ route('o-nas') }}">O nas</a>".</small>
                    @error('bio')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-icon-left mt-4"><i class="ya ya-save"></i> Aktualizuj profil</button>
            </form>
        </div>
    </section>



@endsection

@section('additional_js')

    <script>
        $(".datepicker").flatpickr({
            allowInput: true,
            locale: "pl",
            // Maksymalna data urodzenia (minimum 10 lat wstecz)
            maxDate: "{{ Carbon::now()->subYears(10)->format('Y-m-d') }}"
        });
    </script>

@endsection
