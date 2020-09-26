@extends('layouts.app')
@section('page_title', '500 — Wewnętrzny błąd serwera')
@section('content')

    <section class="bg-image text-center py-8 px-4 px-md-0" ya-style="background-color: #252525">
        <img class="background" src="/storage/other/carl-raw-457982.jpg" alt="">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-8 mx-auto">
                    <h1 class="display-0 font-weight-black text-white mb-0">500</h1>
                    <p class="text-light mb-4 lead">Serwer napotkał niespodziewane trudności, które uniemożliwiły zrealizowanie żądania.</p>
                    <a class="btn btn-primary btn-rounded btn-lg" href="{{ route('index') }}">Wróć na główną</a>
                    <a class="btn btn-outline-light btn-rounded btn-lg mt-2 mt-sm-0 ml-sm-2" href="{{ route('kontakt') }}">Skontaktuj się z nami</a>
                </div>
            </div>
        </div>
    </section>

@endsection