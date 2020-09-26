@extends('layouts.maintenance')
@section('page_title', 'Przerwa techniczna')

@section('content')
    <section class="bg-image text-center h-calc-100 d-flex align-items-center px-3 px-md-0" ya-style="background-color: #333335">
        <img class="background" src="/storage/other/carl-raw-457982.jpg" alt="">

        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <h1 class="font-weight-black text-white text-uppercase display-title">Wracamy niebawem</h1>
                </div>

                <div class="col-lg-6 mx-auto">
                    <p class="mb-5 text-light">Nasz serwis jest czasowo niedostępny z powodu przeprowadzanych prac konserwacyjnych. Wracamy już niebawem!</p>

                    <p class="lead text-light"><em>Mieć fantazję nie znaczy coś sobie wymyślać. To znaczy tworzyć coś z tego, co istnieje. </em><br/><strong>~Tomasz Mann.</strong></p>

                    <a href="mailto:redakcja@centrum-gracza.pl" class="btn btn-outline-light btn-rounded btn-lg"><i class="ya ya-email"></i> Skontaktuj się z nami</a>
                    <div class="social-links mt-5">
                        <a href="{{ setting('site.facebook') }}" target="_blank" data-toggle="tooltip"><i class="ya ya-facebook"></i></a>
                        <a href="{{ setting('site.twitter') }}" target="_blank" data-toggle="tooltip"><i class="ya ya-twitter"></i></a>
                        <a href="{{ setting('site.instagram') }}" target="_blank" data-toggle="tooltip"><i class="ya ya-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection