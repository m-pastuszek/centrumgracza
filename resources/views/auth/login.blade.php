@extends('layouts.app')
@section('page_title', 'Logowanie')
@section('other_metas')
    <meta name="robots" content="noindex" />
@endsection
@section('content')
    <section class="px-2 px-md-0 py-md-7" ya-style="background-color: #464242">
            <img class="background" src="/storage/other/login-bg.jpg" alt="">
            <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-6 col-lg-4 mx-auto">
                    <div class="card mb-0 border-0">
                        <div class="card-header">
                            <h5 class="card-title"><i class="ya ya-login"></i> Zaloguj się do swojego konta</h5>
                        </div>
                        <div class="card-body p-3">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf


                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif

                                <input type="email" id="email" name="email" value="{{ old('email') }}"  class="form-control mb-2 {{ $errors->has('email') ? ' has-danger' : '' }}" placeholder="Adres e-mail" required autofocus>
                                <input type="password" id="password" name="password" class="form-control mb-3 {{ $errors->has('email') ? ' has-danger' : '' }}" placeholder="Hasło" required>
                                <div class="form-group form-check custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">Pamiętaj mnie</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Zaloguj</button>
                                <small class="form-text text-muted forgot-password"><a href="{{ route('password.request') }}">Nie pamiętasz hasła?</a></small>

                            </form>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        </div>
    </section>
@endsection
