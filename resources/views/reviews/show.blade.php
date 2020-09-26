@extends('layouts.app')
@section('page_title'){{ $review->name }} @endsection
@section('meta_description'){{ $review->meta_description }}@endsection
@section('meta_keywords'){{ $review->meta_keywords }}@endsection
@section('meta_author'){{ $review->author->FullName }}}@endsection
@section('other_metas')
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $review->name }}"/>
<meta property="og:image" content="https://centrum-gracza.pl/storage/{{ str_replace('\\', '/', $review->image) }}">
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
        },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $review->name }}",
            "item": "{{ route('review', ['slug' => $review->slug]) }}"
        }]
        }
    </script>
    <script type="application/ld+json">

        {
        "@context":"http://schema.org/",
        "@type": "Review",
        "headline": "{{ $review->name }}",
        "reviewBody": "{{ $review->meta_description }}",
        "image": "https://centrum-gracza.pl/storage/{{ str_replace('\\', '/', $review->image) }}",
        "itemReviewed": {
            "@type": "Game",
            "name": "{{ $review->game->name }}",
            "datePublished": "{{ $review->game->release_date }}"},
        "reviewRating": {
            "@type": "Rating",
            "bestRating": "10",
            "ratingValue": "
                @php
                    $percent = $review->rating;
                    $stars = $percent / 10;
                    print($stars);
                @endphp
                ",
            "worstRating": "1"},
        "author": {
            "@type": "Person",
            "name": "{{ $review->author->FullName }}"
                    },
        "publisher": {
            "@type": "Organization",
            "name": "Centrum Gracza",
            "logo": {
                "@type": "ImageObject",
                "url": "https://www.centrum-gracza.pl/storage/{{ str_replace('\\', '/', setting('site.favicon')) }}"}
            },
        "datePublished": "{{ \Carbon\Carbon::createFromTimestamp(strtotime($review->published_at))->format('Y-m-d\Th:m:s+00:00') }}",
        "dateModified": "{{ \Carbon\Carbon::createFromTimestamp(strtotime($review->updated_at))->format('Y-m-d\Th:m:s+00:00') }}"
        }
    </script>
@endsection
@section('content')


    <section class="bg-image bg-dark py-5 py-lg-7 px-4 px-lg-0" ya-style="background-color: #343538">
        <img class="background" src="/storage/{{ $review->image }}" alt="">
        <div class="container">
            <div class="row align-items-center text-center">
                <div class="col-md-8 mx-auto">
                    <div class="easypiechart mx-auto mb-4" data-percent="{{ $review->rating }}" data-scale-color="#e3e3e3" data-bar-color="#5eb404"><span class="easypiechart-text">{{ $review->rating }}%</span></div>
                    <h1 class="display-5 text-white font-weight-bold">{{ $review->name }}</h1>
                    &nbsp;<a href="javascript:void(0)" class="mb-2 mt-2 badge badge-{{ $review->platform->badge }}" style="text-decoration: none;">{{ $review->platform->name }}</a>
                    <p class="text-light">{{ $review->excerpt }}</p>
                    <div class="d-flex d-sm-block flex-column mt-3 mt-sm-4 pt-3">
                        <a class="btn btn-success btn-rounded btn-lg" href="/gra/{{ $review->game->slug }}" role="button">Zobacz grę w bazie <i class="ya ya-bold-right"></i></a>
                        @auth
                            <a class="btn btn-outline-primary btn-shadow btn-rounded btn-lg mt-2 mt-sm-0 ml-sm-2" href="/admin/reviews/{{ $review->id }}/edit"role="button">Edytuj recenzję <i class="ya ya-edit"></i></a>
                        @endauth
                    </div>
                </div>
            </div>
            <div class="row align-items-center text-center">
                <div class="col-md-4 mx-auto">
                    <div class="d-flex d-sm-block flex-column mt-3 mt-sm-4 pt-3">
                        <a class="avatar-card" href="/redaktor/{{ $review->author->username }}">
                            <div>
                                <div class="avatar-title">{{ $review->author->FullName }}</div>
                                <span class="post-meta-item">{{ Carbon::createFromTimestamp(strtotime($review->published_at))->diffForHumans() }}</span>
                            </div>
                            <img src="/storage/{{ $review->author->profile->avatar }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="post post-single">
                        <div class="post-body">
                            <p class="lead">{{ $review->excerpt }}</p>
                            {!! $review->body !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="review bg-dark py-5 py-lg-7 px-1 px-md-0">
        <img class="background" src="/storage/{{ $review->image }}" alt="{{ $review->name }}">
        <div class="container">
            <div class="row text-center text-md-left">
                <div class="col-md-10 order-2 order-md-1">
                    <h1 class="text-white mb-3">Podsumowanie</h1>
                    <p class="text-light pr-md-5 mb-5">{{ $review->ending }}</p>
                </div>
                <div class="col-md-2 d-flex d-md-block justify-content-center order-1 order-md-2 mb-4 mb-md-0">
                    <a class="easypiechart" href="/recenzja/{{ $review->slug }}" data-percent="{{ $review->rating }}" data-scale-color="#e3e3e3" data-bar-color="#5eb404"><span class="easypiechart-text">{{ $review->rating }}%</span></a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="progress-text font-weight-light text-light">
                        <p>Rozgrywka</p>
                        <p class="ml-auto">{{ $review->gameplay }}%</p>
                    </div>
                    <div class="progress progress-sm progress-loaded">
                        <div class="progress-bar bg-success" style="width: 0" role="progressbar" aria-valuenow="{{ $review->gameplay }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="progress-text font-weight-light text-light mt-3">
                        <p>Grafika</p>
                        <p class="ml-auto">{{ $review->graphics }}%</p>
                    </div>
                    <div class="progress progress-sm progress-loaded">
                        <div class="progress-bar bg-warning" style="width: 0" role="progressbar" aria-valuenow="{{ $review->graphics }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <div class="progress-text font-weight-light text-light mt-3">
                        <p>Muzyka i dialogi</p>
                        <p class="ml-auto">{{ $review->sounds }}%</p>
                    </div>
                    <div class="progress progress-sm progress-loaded">
                        <div class="progress-bar bg-danger" style="width: 0" role="progressbar" aria-valuenow="{{ $review->sounds }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                <div class="col-lg-6 mt-5 mt-lg-0">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="review-positive font-weight-light ml-0 ml-lg-4">
                                <h5>Plusy:</h5>
                                {!! $review->positives !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="review-negative font-weight-light mt-4 mt-md-0">
                                <h5>Minusy:</h5>
                                {!! $review->negatives !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-lg-5 px-1 px-md-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div id="comments" class="anchor comments">
                        <div id="disqus_thread"></div>
                        <script>

                            var disqus_config = function () {
                                this.page.url = "{{ Request::url() }}";  // Replace PAGE_URL with your page's canonical URL variable
                                this.page.identifier = "{{ 'video.' . $review->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                            };

                            (function() { // DON'T EDIT BELOW THIS LINE
                                var d = document, s = d.createElement('script');
                                s.src = 'https://centrum-gracza.disqus.com/embed.js';
                                s.setAttribute('data-timestamp', +new Date());
                                (d.head || d.body).appendChild(s);
                            })();
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
