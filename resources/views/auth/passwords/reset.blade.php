@extends('layouts.app')
@section('page_title', 'Resetowanie hasła')
@section('content')

    <section class="px-2 px-md-0 py-md-7" ya-style="background-color: #464242">
        <img class="background" src="/storage/other/login-bg.jpg" alt="">
        <div class="container">
            <div class="row py-lg-7">
                <div class="col-lg-7 mx-auto">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h4 class="card-title"><i class="fa fa-sign-in"></i> Resetowanie hasła</h4>
                        </div>
                        <div class="card-body p-3">

                            @if (session('status'))
                                <div class="alert alert-darken-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-darken-danger" role="alert">
                                        {{ $error }}
                                    </div>
                                @endforeach
                            @endif

                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="form-group row">
                                    <label for="email" class="col-md-4 col-form-label text-md-right">Adres e-mail</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Hasło</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Powtórz hasło</label>

                                    <div class="col-md-6">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-block">Resetuj hasło
                                        <i class="fas fa-unlock-alt"></i></button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection