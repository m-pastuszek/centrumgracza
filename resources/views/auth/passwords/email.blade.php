@extends('layouts.app')
@section('page_title', 'Resetowanie hasła')
@section('content')

    <section class="px-2 px-md-0 py-md-7" ya-style="background-color: #464242">
        <img class="background" src="/storage/other/login-bg.jpg" alt="">
        <div class="container">
            <div class="row py-lg-7">
                <div class="col-md-5 mx-auto">
                    <div class="card mb-0">
                        <div class="card-header">
                            <h5 class="card-title">Resetowanie hasła</h5>
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

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <p class="lead">Wyślemy na Twoją skrzynkę mailową link umożliwiający Ci zresetowanie hasła.</p>


                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ya ya-email"></i></span>
                                    </div>
                                    <input type="email" class="form-control" name="email" placeholder="Wprowadź swój adres e-mail" value="{{ old('email') }}" required autofocus>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Resetuj hasło</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
