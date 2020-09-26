@extends('layouts.app')

@section('page_title', 'O nas')
@section('meta_description', 'Oto Ci, bez których ten Serwis byłby bez żadnej zawartości. Dziękujemy, że jesteście z nami!')
@section('meta_keywords')Centrum Gracza, o nas, redakcja, zespół, centrum-gracza @endsection

@section('content')

    <section class="overflow-hidden py-8 px-3 px-md-0" data-parallax="scroll" data-image-src="/storage/pages/about-us.jpg">
        <div class="overlay" ya-style="background-color: #36373a;opacity: .9"></div>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="display-3 text-white mb-3">O nas</h2>
                    <p class="h5 font-weight-light text-light mb-0">Skupiamy się na informowaniu naszych Czytelników o nowych wiadomościach ze świata gier. Tworzymy także bazę aktualnych gier i zwiastunów, którą stale będziemy poszerzeać o nowe tytuły.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-lg-6">
        <div class="container">
            <div class="row">
                <div class="col-11 col-md-8 text-center mx-auto mb-4">
                    <i class="ya ya-users icon"></i>
                    <h2 class="display-3">Redakcja</h2>
                    <p class="lead">Oto Ci, bez których ten Serwis byłby bez żadnej zawartości. Dziękujemy, że jesteście z nami!</p>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container section-ourTeam">
            <div class="row">

                @foreach($editors as $editor)
                    <div class="col-md-4 col-sm-6">
                        <div class="our-team">
                            <div class="pic">
                                <img src="/storage/{{ $editor->profile->avatar }}" alt="Zdjęcie profilowe"/>
                                <ul class="social">
                                    <li><a @if(!is_null($editor->profile->facebook_url)) href="{{ $editor->profile->facebook_url }}" @endif target="_blank"><i class="ya ya-facebook"></i></a></li>
                                    <li><a @if(!is_null($editor->profile->twitter_url)) href="https://twitter.com/{{ $editor->profile->twitter_url }}" @endif target="_blank"><i class="ya ya-twitter"></i></a></li>
                                    <li><a href="mailto: {{ $editor->email }}"><i class="ya ya-email"></i></a></li>
                                    <li><a href="{{ route('redaktor', ['username' => $editor->username]) }}"><i class="fas fa-gamepad"></i></a></li>
                                </ul>
                            </div>
                            <div class="team-content">
                                <h3 class="title">{{ $editor->first_name }} {{ $editor->last_name }}</h3>
                                <small class="team-post">
                                    @if($editor->id == '1')
                                        WYDAWCA / REDAKTOR
                                    @else
                                        REDAKTOR
                                    @endif
                                </small>
                            </div>
                            <div class="team-layer">
                                <a href="{{ route('redaktor', ['username' => $editor->username]) }}">{{ $editor->FullName }}</a>
                                <span class="team-post">
                                    @if($editor->id == '1')
                                        WYDAWCA / REDAKTOR
                                    @else
                                        REDAKTOR
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="bg-primary py-0">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="promo py-4">
                        <h2 class="promo-title h4 mr-4">Chcesz dołączyć do naszego zespołu? Rekrutacja trwa!</h2>
                        <a class="btn btn-outline-light mt-3 mt-lg-0" href="/dolacz-do-nas" target="_blank" role="button">Sprawdź szczegóły <i class="fas fa-info"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection