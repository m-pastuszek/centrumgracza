@extends('layouts.app')
@section('page_title', 'Kontakt')

@section('content')
    <section class="overflow-hidden py-8 px-3 px-md-0" data-parallax="scroll" data-image-src="/storage/pages/contact.jpg">
        <div class="overlay" ya-style="background-color: #36373a;opacity: .9"></div>
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <h2 class="display-3 text-white mb-3">Skontaktuj się z nami</h2>
                    <p class="h5 font-weight-light text-light mb-0">Odpowiemy tak szybko, jak to możliwe.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="py-lg-6">
        <div class="container">
            <div class="row">
                <div class="col-11 col-md-8 text-center mx-auto mb-4">
                    <i class="ya ya-email icon"></i>
                    <h2 class="display-3">Kontakt z Redakcją</h2>
                    <p class="lead">Masz jakieś pytania lub chciałbyś do nas dołączyć? Napisz do nas na:</p>
                    <h4><a href="mailto:redakcja@centrum-gracza.pl">redakcja@centrum-gracza.pl</a></h4>
                    <hr/>
                    <i class="ya ya-flag icon"></i>
                    <h3 class="display-4">Zgłoszenie błędu</h3>
                    <p class="lead">Widzisz jakiś błąd lub masz jakąś propozycję zmiany na naszym Portalu? Napisz do naszego Webmastera!</p>
                    <h4><a href="mailto:webmaster@centrum-gracza.pl">webmaster@centrum-gracza.pl</a></h4>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-primary py-0">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="promo py-4">
                        <h2 class="promo-title h4 mr-4">Rekrutacja trwa — dołącz do nas <i class="ya ya-heart" style="color: #BF3030"></i></h2>
                        <a class="btn btn-outline-light mt-3 mt-lg-0" href="/dolacz-do-nas" target="_blank" role="button">Sprawdź szczegóły <i class="fas fa-info"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection