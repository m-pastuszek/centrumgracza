@extends('layouts.app')

@section('page_title', 'Strona Główna')
@section('meta_description'){{ setting('site.description') }} @endsection
@section('meta_keywords')Centrum Gracza, serwis dla graczy, informacje, gry, zwiastuny, najnowsze gry, baza gier, gry na konsole, PC @endsection
@section('author', 'Centrum Gracza')
@section('other_metas')
    <meta property="og:image" content="https://centrum-gracza.pl/storage/other/Centrum_Gracza.jpeg">
@endsection

@section('additional_css')

@endsection
@section('additional_js')
    <script type="application/ld+json">
        {
          "@context": "https://schema.org",
          "@type": "Organization",
          "url": "https://www.centrum-gracza.pl/",
          "logo": "https://www.centrum-gracza.pl/storage/{{ str_replace('\\', '/', setting('site.favicon')) }}",
          "email": "redakcja(at)centrum-gracza.pl",
          "description": "{{ setting('site.description') }}",
          "sameAs": [
            "{{ setting('site.facebook') }}",
            "{{ setting('site.twitter') }}",
            "{{ setting('site.instagram') }}"
          ]
        }
    </script>
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Centrum Gracza",
            "item": "https://centrum-gracza.pl/"
        }]
        }
    </script>
@endsection

@section('content')

    <section class="pt-0 pt-md-2 px-md-2 border-bottom">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-11 mx-auto px-xs-0">
                    <div class="owl-carousel" ya-carousel="autowidth: true;dots: false;margin: 8;items: 2; autoplay: true; autoplaySpeed: 5">
                        @foreach($sliders as $slider)
                            <div class="owl-img owl-img-md owl-width-md lazyload">
                                <a href="{{ route('article', ['slug' => $slider->article->slug]) }}">
                                    <img class="lazyload" data-src="/storage/{{ $slider->article->image }}" alt="{{ $slider->article->name }}">
                                </a>
                                <div class="owl-caption owl-caption-bottom">
                                    <h1 class="owl-title"><a href="{{ route('article', ['slug' => $slider->article->slug]) }}">{{ $slider->article->name }}</a></h1>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 py-md-6 border-bottom bg-light">
        <div class="container">
            <div class="row">
                <div class="col-11 col-md-8 text-center mx-auto mb-4">
                    <i class="ya ya-ranking icon"></i>
                    <h2 class="font-weight-bold font-size-lg">Niedawno dodane recenzje</h2>
                    <p class="lead">Nowa produkcja? Sprawdź, czy warto kupić, czy może lepiej unikać.</p>
                </div>
            </div>
            <div class="row">
                @foreach($reviews as $review)
                    <div class="col-md-4">
                        <div class="card card-sm">
                            <a class="card-img card-img-lg" href="{{ route('review', ['slug' => $review->slug]) }}">
                                <img class="card-img-top lazyload" src="/storage/{{ $review->image }}" alt="{{ $review->name }}">
                            </a>
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a href="{{ route('review', ['slug' => $review->slug]) }}">{{ Str::limit($review->name, 80, '...') }}</a>
                                </h5>
                                <p class="card-tex font-size-md mb-0">{{ Str::limit($review->excerpt, 150, '...') }}</p>
                            </div>
                            <div class="card-footer">
                                <span><i class="ya ya-calendar"></i> {{ Carbon::createFromTimestamp(strtotime($review->published_at))->toPolishString() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center">
                <a class="btn btn-outline-primary btn-lg mt-3" href="{{ route('reviews' )}}" role="button">Przejdź do recenzji</a>
            </div>
        </div>
    </section>



    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    @foreach($articles as $article)
                        <div class="post post-medium">
                            <div class="post-thumbnail">
                                <img class="post-img lazyload" data-src="{{ Voyager::image($article->thumbnail('medium')) }}" alt="{{ $article->name }}">
                            </div>
                            <div class="post-body">
                                <h2 class="post-title h4"><a href="{{ route('article', ['slug' => $article->slug]) }}">{{ $article->name }}</a></h2>
                                <div class="post-meta">
                                    <span class="post-meta-item"><i class="ya ya-calendar"></i> {{ Carbon::createFromTimestamp(strtotime($article->published_at))->toPolishString() }}</span>
                                    <span class="post-meta-item"><i class="ya ya-user"></i> <a href="{{ route('redaktor', ['username' => $article->author->username]) }}">{{ $article->author->FullName }}</a></span>
                                </div>
                                <p>{{ Str::limit($article->excerpt, 300, '...') }}</p>
                            </div>
                        </div>
                    @endforeach
                    <div class="text-center">
                        <a class="btn btn-outline-dark btn-lg" href="/aktualnosci" role="button">Przejdź do aktualności</a>
                    </div>
                </div>
                <div class="col-md-3 border-left">
                    <div class="widget widget-games">
                        <h5 class="widget-header">TOP 5 Nadchodzących gier</h5>
                        @foreach($topGames as $topGame)
                            <a href="{{ route('game', ['slug' => $topGame->game->slug]) }}" style="background-image: url('/storage/{{ str_replace('\\', '/', $topGame->game->background_image) }}')">
                                <span class="img-overlay"></span>
                                <div class="widget-block">
                                    <div class="count">{{ $topGame->place }}</div>
                                    <div class="description">
                                        <h5 class="title">{{ $topGame->game->name }}</h5>
                                        <span class="date">{{ Carbon::createFromTimestamp(strtotime($topGame->game->release_date))->isoFormat('YYYY') }}</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="widget">
                        <h5 class="widget-header">Polub nas na Facebooku</h5>
                        {!! setting('site.facebook_widget') !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 py-lg-6 border-top bg-light">
        <div class="container">
            <div class="row">
                <div class="col-11 col-md-8 col-md-8 mx-auto text-center mb-4">
                    <i class="ya ya-player icon"></i>
                    <h2 class="font-size-lg">Ostatnio dodane materiały wideo</h2>
                </div>
            </div>
            <div class="row row-md">
                @foreach($videos as $video)
                    @php

                        $video_id = $video->id;
                        $seconds = config('settings.cache_seconds');

                        $apiVideo = Cache::remember('youtube.video.' . $video_id, $seconds, function() use ($video_id) {
                            $video = App\Models\Video::where('id', $video_id)->firstOrFail();
                            $apiVideo = Youtube::getLocalizedVideoInfo($video->youtube_video_id, 'pl');

                            return $apiVideo;
                        });

                        $description = $apiVideo->snippet->description;
                        $videoDuration = $apiVideo->contentDetails->duration;
                        $duration = new DateInterval($videoDuration);
                    @endphp

                    <div class="col-md-4 card-group mb-4">
                        <div class="card card-sm">
                            <a class="card-img card-img-sm" href="{{ route('video', ['slug' => $video->slug]) }}">
                                <img class="lazyload" data-src="https://i.ytimg.com/vi/{{ $apiVideo->id }}/maxresdefault.jpg" alt="{{ $apiVideo->snippet->title }}">
                                <div class="card-meta">
                                    <span>{{ $duration->format('%I:%S') }}</span>
                                </div>
                            </a>
                            <div class="card-body">
                                <h6 class="card-title"><a href="{{ route('video', ['slug' => $video->slug]) }}">{{ $video->name }}</a></h6>
                                <p class="card-text font-size-md">{{ Str::limit($description, 150, '...') }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-md-4">
                <a class="btn btn-outline-primary btn-lg mt-3" href="{{ route('videos' )}}" role="button">Przejdź do filmów</a>
            </div>
        </div>
    </section>

    @php

        $video_id = $featured_video[0]->video->id;
        $seconds = config('settings.cache_seconds');

        $apiVideo = Cache::remember('youtube.video.' . $video_id, $seconds, function() use ($video_id) {
            $video = App\Models\Video::where('id', $video_id)->firstOrFail();
            $apiVideo = Youtube::getLocalizedVideoInfo($video->youtube_video_id, 'pl');

            return $apiVideo;
        });


        $videoDuration = $apiVideo->contentDetails->duration;
        $duration = new DateInterval($videoDuration);
        $videoTitle = $apiVideo->snippet->localized->title;
    @endphp

    <section class="bg-image py-0 py-lg-3 py-xl-6" ya-style="background-color: #2e2f2f">
        <img class="background lazyload" src="https://img.youtube.com/vi/{{ $apiVideo->id }}/maxresdefault.jpg" alt="{{ $videoTitle }}">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 mx-auto">
                    <div ya-embed="https://www.youtube.com/watch?v={{ $apiVideo->id }}" ya-title="{{ $videoTitle }}" ya-length="{{ $duration->format('%I:%S') }}">
                        <img src="https://img.youtube.com/vi/{{ $apiVideo->id }}/maxresdefault.jpg" alt="{{ $videoTitle }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
