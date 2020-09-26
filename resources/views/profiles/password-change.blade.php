@extends('layouts.app')

@section('page_title', 'Zmiana hasła')

@section('other_metas')
    <meta name="robots" content="noindex" />
@endsection

@section('content')

    @include('profiles.partials.navbar')

    <section class="border-top-dashed py-5">
        <div class="container">

            @if ($errors->any())
                <div class="alert alert-darken-danger">
                    Podczas aktualizacji Twojego hasła wystąpił błąd. Sprawdź wprowadzone dane.
                </div>
            @endif

            @if(Session::has('message'))
                @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                    @if(Session::has('alert-darken-' . $msg))
                        <div class="alert alert-darken-{{ $msg }}" role="alert">{{ Session::get('message') }}</div>
                    @endif
                @endforeach
            @endif

            <form action="{{ route('user.password-update') }}" method="post">
                @csrf
                <h5 class="font-weight-bold font-size-md text-uppercase mb-4 pb-1">Zmiana hasła</h5>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="old_password">Aktualne hasło</label>
                            <input type="password" class="form-control @error('old_password') is-invalid @enderror" id="old_password" name="old_password" placeholder="Wprowadź hasło">
                            @error('old_password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-md-2">
                            <label for="password">Nowe hasło</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Wprowadź nowe hasło" autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                            <label for="password_confirmation">Potwierdź hasło</label>
                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Potwierdź nowe hasło">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-lg btn-danger btn-icon-left mt-4"><i class="ya ya-unlock"></i> Zmień hasło</button>
            </form>
            <!-- end form -->
        </div>
    </section>

@endsection
