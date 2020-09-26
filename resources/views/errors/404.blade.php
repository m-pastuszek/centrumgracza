@extends('layouts.app')
@section('page_title', '404 — Strony nie znaleziono')
@section('content')

    <section class="bg-image text-center py-8 px-4 px-md-0" ya-style="background-color: #252525">
        <img class="background" src="/storage/other/carl-raw-457982.jpg" alt="">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <h1 class="display-0 font-weight-black text-white mb-0">404</h1>
                    <p class="text-light mb-4">Niestety nie mogliśmy odnaleźć strony z takim adresem.</p>
                    <form class="mb-5" action="{{ route('search') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-inline border-0 shadow-none" name="q" placeholder="Szukaj...">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-light border-0"><i class="ya ya-search m-0"></i></button>
                            </div>
                        </div>
                    </form>
                    <a class="btn btn-primary btn-rounded btn-lg" href="{{ route('index') }}">Wróć na główną</a>
                    <a class="btn btn-outline-light btn-rounded btn-lg mt-2 mt-sm-0 ml-sm-2" href="{{ route('kontakt') }}">Skontaktuj się z nami</a>
                </div>
            </div>
        </div>
    </section>

@endsection
