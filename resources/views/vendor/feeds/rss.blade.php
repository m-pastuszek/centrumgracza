@extends('layouts.app')
@section('page_title')Kanały internetowe RSS @endsection
@section('meta_description')Jeżeli chcesz na bieżąco śledzić nasz serwis, wykorzystaj możliwości kanałów informacyjnych RSS. @endsection
@section('meta_keywords')Kanały internetowe RSS, RSS, Centrum Gracza @endsection

@section('content')

    <nav class="bg-white border-bottom" aria-label="breadcrumb">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Centrum Gracza</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kanały internetowe RSS</li>
            </ol>
        </div>
    </nav>

    <section class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <h2 class="display-4 mb-0" style="text-align: center"><span ya-svg="rss"></span> | Kanały internetowe RSS</h2>
                    <p class="lead m-4">Jeżeli chcesz na bieżąco śledzić nasz serwis, wykorzystaj możliwości kanałów informacyjnych RSS. </p>
                    <a class="btn btn-outline-primary btn-rounded btn-lg" href="/rss/news.xml">Artykuły</a>
                    <a class="btn btn-outline-primary btn-rounded btn-lg ml-2" href="/rss/reviews.xml">Recenzje</a>
                    <hr/>
                    <p class="lead m-4">Zainstaluj mobilną aplikację <a rel="nofollow" href="https://feedly.com/i/welcome">Feedly</a>, dodaj nasz serwis i bądź na bieżąco gdziekolwiek jesteś.</p>

                </div>
            </div>
        </div>
    </section>
@endsection