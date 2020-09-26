@extends('layouts.app')
@section('page_title', 'Recenzje')
@section('meta_description', setting('seo.reviews_meta_description'))
@section('meta_keywords', setting('seo.reviews_meta_keywords'))
@section('additional_css')

@endsection
@section('additional_js')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Centrum Gracza",
            "item": "https://centrum-gracza.pl/"
        },{
            "@type": "ListItem",
            "position": 2,
            "name": "Recenzje",
            "item": "https://centrum-gracza.pl/recenzje"
        }]
        }
    </script>
@endsection

@section('content')

    <section class="bg-image bg-dark py-5 py-lg-7 px-4 px-lg-0" ya-style="background-color: #343538">
        <img class="background" src="/storage/{{ $reviews[0]->image }}" alt="{{ $reviews[0]->name }}">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-8 mx-auto">
                    <div class="easypiechart mx-auto mb-4" data-percent="{{ $reviews[0]->rating }}" data-scale-color="#e3e3e3" data-bar-color="#5eb404"><span class="easypiechart-text">{{ $reviews[0]->rating }}%</span></div>
                    <div class="mx-auto p-3">
                        <span class="badge badge-pill badge-danger">NOWA RECENZJA</span>
                    </div>
                    <h1 class="display-5 text-white font-weight-bold">{{ $reviews[0]->name }}</h1>
                    <p class="text-light">{{ $reviews[0]->excerpt }}</p>
                    <a class="btn btn-primary btn-shadow btn-rounded btn-lg mt-3 mt-sm-4" href="/recenzja/{{ $reviews[0]->slug }}" role="button">Przeczytaj recenzję</a>
                </div>
            </div>
        </div>
    </section>

    <section class="border-bottom-dashed">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <form class="form-inline w-100" method="get" action="{{ route('search') }}">
                    <h5 class="h6 text-uppercase font-weight-bold mb-0 pl-1 d-block"><i class="ya ya-star-add mr-2"></i> Recenzje</h5>
                    <div class="input-group mr-auto ml-md-4 mb-2 mb-md-0 mt-3 mt-md-0">
                        <input type="text" name="q" class="form-control form-control-inline" placeholder="Szukaj recenzji...">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-light border-left-0"><i class="ya ya-search m-0"></i></button>
                        </div>
                    </div>
                </form>
                <!-- end form -->
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    @foreach($reviews as $review)

                    <div class="post post-medium post-review">
                        <div class="post-thumbnail img-thumbnail rounded">
                            <a href="{{ route('review', ['slug' => $review->slug]) }}">
                                <img class="post-img rounded lazyload" data-src="/storage/{{ $review->game->box_image }}" alt="{{ $review->name }}">
                            </a>
                        </div>
                        <div class="post-body">
                            <div class="d-flex align-items-start">
                                <h2 class="post-title h3"><a href="{{ route('review', ['slug' => $review->slug]) }}">{{ $review->game->name }}</a></h2>
                                <span class="badge
                                    @if ($review->rating <= '45') badge-danger
                                    @elseif ($review->rating < '69') badge-warning
                                    @elseif ($review->rating >= '70') badge-success
                                    @endif ml-2">
                                        @php
                                            // Dzielenie oceny ze skali 1-100 do skali 1-10
                                            $percent = $review->rating;
                                            $stars = $percent / 10;
                                            print($stars);
                                    @endphp
                                </span>
                            </div>
                            <div class="post-meta">
                                <span class="post-meta-item"><i class="ya ya-calendar"></i> {{ Carbon::createFromTimestamp(strtotime($review->published_at))->toPolishString() }}</span>
                                <span class="post-meta-item"><i class="ya ya-user"></i> <a href="{{ route('redaktor', ['username' => $review->author->username]) }}">{{ $review->author->FullName }}</a></span>
                            </div>
                            <p>{{ $review->excerpt }}</p>
                            <div class="btn-group">
                                @foreach( $review->game->platforms as $platform )
                                    <a class="btn btn-default btn-xs">{{ $platform->abbreviation }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="pagination-results m-t-30">
                        <nav aria-label="Nawigacja stroną">
                            {{ $reviews->render() }}
                        </nav>
                    </div>

                </div>
                <div class="col-lg-3">
                    <div class="widget">
                        <div class="widget-header">Polub nas na Facebooku</div>
                        {!! setting('site.facebook_widget') !!}
                    </div>

                    <div class="widget widget-list">
                        <div class="widget-header">Najnowsze artykuły</div>
                            @foreach($articles as $article)
                            <div class="media">
                                <a class="img-cover" href="/artykul/{{ $article->slug }}">
                                    <img src="{{ Voyager::image($article->thumbnail('small')) }}" alt="{{ $article->name }}">
                                </a>
                                <div class="media-body">
                                    <h6><a href="/artykul/{{ $article->slug }}" title="">{{ Str::limit($article->name, 50, '...') }}</a></h6>
                                    <div class="font-size-sm font-weight-semibold text-muted">{{ Carbon::createFromTimestamp(strtotime($article->published_at))->diffForHumans() }}</div>
                                </div>
                            </div>
                            @endforeach
                        <a class="btn btn-outline btn-block btn-sm mt-2" href="/aktualnosci" role="button">Przejdź do aktualności</a>
                    </div>

                    @if(!empty(setting('site.ad')))
                        <div class="widget">
                            <h5 class="widget-header">Reklama</h5>
                            {!! setting('site.ad') !!}
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection