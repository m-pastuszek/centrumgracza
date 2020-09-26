@extends('layouts.app')
@section('page_title'){{ $game->name }} @endsection
@section('meta_description'){{ $game->meta_description }}@endsection
@section('meta_keywords'){{ $game->meta_keywords }}, zwiastun, data premiery, fabuła, wymagania sprzętowe, platformy, opis gry, premiera @endsection
@section('other_metas')
<meta property="og:image" content="https://centrum-gracza.pl/storage/{{ str_replace('\\', '/', $game->background_image) }}"/>
@endsection

@section('additional_js')
    <script>
        $(function() {
            $('.easypiechart').easyPieChart();
        });
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
        },{
            "@type": "ListItem",
            "position": 2,
            "name": "Baza gier",
            "item": "https://centrum-gracza.pl/gry"
        },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $game->name }}",
            "item": "{{ route('game', ['slug' => $game->slug]) }}"
        }]
        }
    </script>

@endsection

@section('content')

    <section class="bg-image bg-dark py-5 py-lg-7 px-4 px-lg-0" ya-style="background-color: #343538">
        <img class="background" src="/storage/{{ $game->background_image }}" alt="{{ $game->name }} - Background">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8 order-2 order-md-2 text-center text-md-left">
                    <div class="row">
                        <div class="col-md-3 d-none d-lg-block d-xl-block">
                            <a ya-lightbox href="/storage/{{ $game->box_image }}" role="button">
                                <img class="rounded" src="/storage/{{ $game->box_image }}" alt="{{ $game->name }} - Okładka / Cover"/>
                            </a>
                        </div>

                        <div class="col-md-9">
                            <h1 class="display-5 font-weight-bold text-white">{{ $game->name }}</h1>
                            <p class="text-light pr-md-5 pr-lg-0">{{ $game->excerpt }}</p>
                            <div class="d-flex d-sm-block flex-column mt-sm-4 pt-2">
                                <a class="btn btn-primary btn-shadow btn-rounded btn-lg" href="{{ $game->youtube_trailer }}" ya-lightbox role="button"><i class="ya ya-play d-none d-sm-inline mr-1"></i> Zobacz zwiastun</a>
                                @if(Carbon::createFromTimestamp(strtotime($game->release_date))->format('Y-m-d') <= Carbon::today()->format('Y-m-d'))
                                    <a class="btn btn-outline-warning btn-shadow btn-rounded btn-lg mt-2 mt-sm-0 ml-sm-2 " href="https://www.kinguin.net/listing/?active=1&hideUnavailable=0&phrase={{ $game->name }}&page=0&size=25&sort=relevancy%2CDESC&___store=kinguin_pl_polish&r=67250" role="button" target="_blank">
                                        Kup na Kinguin.net <i class="ya ya-shopping-cart d-none d-sm-inline mr-1"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if($game->review()->exists())
                <div class="col-md-4 order-1 order-md-2 d-flex align-items-md-center justify-content-center justify-content-md-end text-center mb-4 mb-md-0">
                    <div>
                        <p class="font-weight-semibold text-white d-none d-md-inline-block">Ocena Redakcji</p>
                        <a class="easypiechart" href="{{ route('review', ['slug' => $game->review->slug]) }}" data-percent="{{ $game->review->rating }}" data-scale-color="#e3e3e3" data-bar-color="#5eb404"><span class="easypiechart-text">{{ $game->review->rating }}%</span></a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>


    <section class="bg-white border-bottom py-0" ya-sticky>
        <div class="container">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <div class="nav-scroll">
                        <div class="nav nav-list" role="tablist">
                            <a class="nav-item nav-link active" href="#about" data-toggle="tab" role="tab" aria-controls="about">O grze</a>

                            @if(isset($articles) and $articles->count() > 0)
                                <a class="nav-item nav-link" href="#articles" data-toggle="tab" role="tab" aria-controls="articles">Artykuły (<span class="font-weight-bold">{{ $articles->total()}}</span>)</a>
                            @endif

                            <a class="nav-item nav-link" href="#gallery" data-toggle="tab" role="tab" aria-controls="gallery">Galeria zdjęć (<span class="font-weight-bold">{{ count($images) }}</span>)</a>

                            @if($videos->count() > 0)
                                <a class="nav-item nav-link" href="#videos" data-toggle="tab" role="tab" aria-controls="videos">Materiały wideo (<span class="font-weight-bold">{{ $videos->total() }}</span>)</a>
                            @endif

                            @if(!empty($game->minReq_os))
                                <a class="nav-item nav-link" href="#requirements" data-toggle="tab" role="tab" aria-controls="requirements">Wymagania sprzętowe</a>
                            @endif

                            @if($game->type_id == 1 && count($game->hasDlc) >= 1)
                                <a class="nav-item nav-link" href="#dlcs" data-toggle="tab" role="tab" aria-controls="dlcs">Dodatki i rozszerzenia</a>
                            @endif

                        </div>
                    </div>
                @auth
                    <div class="dropdown d-none d-xl-inline-block ml-auto">
                        <a class="btn btn-rounded btn-primary btn-icon-left" href="{{ route('voyager.games.edit', ['game' => $game->id ]) }}"><i class="ya ya-edit"></i> Edytuj grę</a>
                    </div>
                @endauth
                </div>

            </div>
        </div>
    </section>


    <div class="tab-content">
        <div class="tab-pane active" id="about" role="tabpanel">
            <section class="border-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 order-lg-1 order-2 mt-4">
                            <div class="col-11 col-md-8 text-center mx-auto mb-4">
                                <i class="fas fa-gamepad icon"></i>
                                <h2 class="font-weight-bold font-size-lg">O grze</h2>
                            </div>
                            <div class="post-body game-body">

                                {!! $game->body !!}

                            </div>
                        </div>

                        <div class="col-lg-4 order-lg-2 order-1">
                            <div class="widget widget-game" ya-style="background-color: #343538">
                                <img src="/storage/other/background.jpg" alt="" rel="nofollow">
                                <div class="widget-body">
                                    <h3 class="widget-title text-white">{{ $game->name }}</h3>
                                    @if(!is_null($game->polish_title))
                                        <p class="font-weight-light font-size-md">{{ $game->polish_title }}</p>
                                    @endif
                                    <p class="font-weight-light font-size-md">Data premiery: {{ Carbon::createFromTimestamp(strtotime($game->release_date))->toPolishString() }}</p>

                                    @if($game->type_id == 2)
                                        <p class="font-size-md">{{ $game->name }} jest rozszerzeniem gry <strong><a class="text-decoration-none" href="{{ route('game', ['slug' => $game->parentGame->slug]) }}">{{ $game->parentGame->name }}</a></strong>.</p>
                                    @endif

                                    <h6>Platformy:</h6>
                                    @foreach( $game->platforms as $platform )
                                        &nbsp;<a href="javascript:void(0)" class="badge badge-{{ $platform->badge }} mb-1" style="text-decoration: none;">{{ $platform->name }}</a>
                                    @endforeach

                                    <h6 class="mt-4">Producent</h6>
                                        @php
                                            $developers = $game->developers()->orderBy('name')->get();
                                        @endphp
                                        @foreach($developers as $developer)
                                            <a class="font-weight-light font-size-md text-decoration-none" href="{{ route('company', ['slug' => $developer->slug]) }}">{{ $developer->name }}</a>@if(!$loop->last),@endif
                                        @endforeach

                                    <h6 class="mt-4">Wydawca</h6>
                                        @php
                                            $publishers = $game->publishers()->orderBy('name')->get();
                                        @endphp
                                        @foreach($publishers as $publisher)
                                            <a class="font-weight-light font-size-md text-decoration-none" href="{{ route('company', ['slug' => $publisher->slug]) }}">{{ $publisher->name }}</a>@if(!$loop->last),@endif
                                        @endforeach

                                    @php
                                        $pol_publishers = $game->pol_publishers()->orderBy('name')->get();
                                    @endphp
                                    @if(count($pol_publishers) > 0)
                                    <h6 class="mt-4">Polski wydawca</h6>
                                        @foreach($pol_publishers as $pol_publisher)
                                            <a class="font-weight-light font-size-md text-decoration-none" href="{{ route('company', ['slug' => $pol_publisher->slug]) }}">{{ $pol_publisher->name }}</a>@if(!$loop->last),@endif
                                        @endforeach
                                    @endif

                                    @if(!empty($game->game_engine))
                                    <h6 class="mt-4">Silnik</h6>
                                    <a class="font-weight-light font-size-md text-decoration-none">{{ $game->game_engine }}</a>
                                    @endif

                                    <h6 class="mt-4">Gatunek</h6>
                                    @php
                                        $genres = $game->genres()->orderBy('name')->get();
                                    @endphp
                                    @foreach($genres as $genre)
                                        <a class="font-weight-light font-size-md text-decoration-none" data-container="body" data-toggle="popover" data-placement="right" title="Wiem więcej!" data-content="{{ $genre->description }}" href="javascript:void(0)">{{ $genre->name }}</a>@if(!$loop->last),@endif
                                    @endforeach

                                    <h6 class="mt-4">Tryby gry</h6>
                                    @php
                                        $modes = $game->modes()->orderBy('name')->get();
                                    @endphp
                                    @foreach($modes as $mode)
                                        <a class="font-weight-light font-size-md text-decoration-none" data-container="body" data-toggle="popover" data-placement="right" title="Wiem więcej!" data-content="{{ $mode->description }}" href="javascript:void(0)">{{ $mode->name }}</a>@if(!$loop->last),@endif
                                    @endforeach

                                    @php
                                        $perspectives = $game->perspectives()->orderBy('name')->get();
                                    @endphp
                                    @if(count($perspectives) == 1)
                                        <h6 class="mt-4">Perspektywa gry</h6>
                                        @foreach($perspectives as $perspective)
                                            <a class="font-weight-light font-size-md text-decoration-none"  data-container="body" data-toggle="popover" data-placement="right" title="Wiem więcej!" data-content="{{ $perspective->description }}" href="javascript:void(0)">{{ $perspective->name }}</a>
                                        @endforeach
                                    @elseif(count($perspectives) > 1)
                                        <h6 class="mt-4">Perspektywy gry</h6>
                                        @foreach($perspectives as $perspective)
                                            <a class="font-weight-light font-size-md text-decoration-none" data-container="body" data-toggle="popover" data-placement="right" title="Wiem więcej!" data-content="{{ $perspective->description }}" href="javascript:void(0)">{{ $perspective->name }}</a>@if(!$loop->last),@endif
                                        @endforeach
                                    @else

                                    @endif

                                    <a class="btn btn-outline-info btn-block mt-4" href="{{ $game->official_website }}" role="button" target="_blank" rel="nofollow">Strona oficjalna <i class="ya ya-link"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div class="tab-pane fade" id="gallery" role="tabpanel">
            <section class="pb-5 pt-4 pt-md-5">
                <div class="container">

                    <div class="col-11 col-md-8 text-center mx-auto mb-4">
                        <i class="ya ya-image icon"></i>
                        <h2 class="font-weight-bold font-size-lg">Galeria zdjęć</h2>
                    </div>

                    <div class="row">
                        @foreach($images as $image)
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <figure class="figure">
                                    <a href="/storage/{{$image}}" ya-lightbox rel="gallery">
                                        <img class="lazyload" data-src="/storage/{{$image}}" class="figure-img" alt="">
                                    </a>
                                </figure>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>

        @if(isset($videos))
            <div class="tab-pane fade" id="videos" role="tabpanel">
                <section class="pb-5 pt-4 pt-md-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-11 col-md-8 text-center mx-auto mb-4">
                                <i class="ya ya-player icon"></i>
                                <h2 class="font-weight-bold font-size-lg">Materiały wideo</h2>
                            </div>
                        </div>
                        <div class="row">

                            @foreach($videos as $video)

                                @php

                                    $id = $video->id;
                                    $seconds = config('settings.cache_seconds');

                                    $apiData = Cache::remember('youtube.video.' . $id, $seconds, function() use ($id) {
                                        $video = App\Models\Video::find($id);
                                        $apiData = Youtube::getLocalizedVideoInfo($video->youtube_video_id, 'pl');

                                        return $apiData;
                                    });

                                @endphp
                                @if (empty($apiData))
                                    <div class="col-sm-6 col-md-4 col-lg-4 card-group mb-sm-4">
                                        <div class="card card-sm">
                                            <a class="card-img card-img-sm" href="/film/{{ $video->slug }}">
                                                <img src="/storage/other/youtube_unavaliable_1110x624.png" alt="Ten film nie jest już dostępny w serwisie YouTube.">
                                            </a>
                                            <div class="card-body">
                                                <h6 class="card-title"><a href="/film/{{ $video->slug }}">Ten film nie jest już dostępny w serwisie YouTube.</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @php
                                        $videoDuration = $apiData->contentDetails->duration;
                                        $duration = new DateInterval($videoDuration);
                                        $channelTitle = $apiData->snippet->channelTitle;
                                        $channelId = $apiData->snippet->channelId;
                                        $views = $apiData->statistics->viewCount;
                                        $description = $apiData->snippet->description;
                                    @endphp


                                    <div class="col-sm-6 col-md-4 col-lg-4 card-group mb-sm-4">
                                        <div class="card card-sm">
                                            <a class="card-img card-img-sm" href="{{ route('video', ['slug' => $video->slug]) }}">
                                                <img src="https://i1.ytimg.com/vi/{{ $video->youtube_video_id }}/maxresdefault.jpg" alt="Miniatura — {{ $apiData->snippet->title }}">
                                                <div class="card-meta">
                                                    <span>{{ $duration->format('%I:%S') }}</span>
                                                </div>
                                            </a>
                                            <div class="card-body">
                                                <h6 class="card-title"><a href="{{ route('video', ['slug' => $video->slug]) }}">{{ $apiData->snippet->title }}</a></h6>
                                                <p class="card-text font-size-md">{{ Str::limit($description, 150, '...') }}</p>
                                            </div>
                                            <div class="card-footer">
                                    <span><i class="far fa-user"></i>
                                        <a href="https://www.youtube.com/channel/{{$channelId}}">{{$channelTitle}}</a>
                                    </span>
                                                <span class="ml-auto"><i class="far fa-eye"></i>{{ number_format($views, 0) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
        @endif

        @if(isset($articles))
            <div class="tab-pane fade" id="articles" role="tabpanel">
                <section class="pb-5 pt-4 pt-md-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-11 col-md-8 text-center mx-auto mb-4">
                                <i class="ya ya-content icon"></i>
                                <h2 class="font-weight-bold font-size-lg">Powiązane artykuły</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-11 mx-auto">
                                <div class="row row-md">
                                    @foreach($articles as $article)
                                        <div class="col-md-4 card-group mb-4">
                                            <div class="card">
                                                <a class="card-img card-img-lg" href="{{ route('article', ['slug' => $article->slug]) }}">
                                                    <img src="/storage/{{ $article->image }}" alt="{{ $article->name }}">
                                                </a>
                                                <div class="card-body">
                                                    <h6 class="card-title"><a href="{{ route('article', ['slug' => $article->slug]) }}">{{ $article->name }}</a></h6>
                                                    <p class="card-text font-size-md">{{ Str::limit($article->excerpt, 150, '...') }}</p>
                                                </div>
                                                <div class="card-footer">
                                                    <span><i class="ya ya-calendar"></i> {{ Carbon::createFromTimestamp(strtotime($article->published_at))->toPolishString() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endif

        @if(!empty($game->minReq_os))
            <div class="tab-pane fade" id="requirements" role="tabpanel">
                <section class="pb-5 pt-4 pt-md-5">
                    <div class="container">

                        <div class="row">
                            <div class="col-11 col-md-8 mx-auto text-center mb-5">
                                <i class="fas fa-tools icon"></i>
                                <h2 class="font-size-lg">Wymagania sprzętowe</h2>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 mb-4 mb-lg-0">
                                <table class="table table-striped table-bordered align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width: 10%" scope="col"></th>
                                        <th scope="col">Minimalne</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center"><i class="fab fa-windows"></i></td>
                                        <td>{{ $game->minReq_os }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fas fa-microchip"></i></td>
                                        <td>{{ $game->minReq_cpu }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fas fa-memory"></i></td>
                                        <td>{{ $game->minReq_ram }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fas fa-desktop"></i></td>
                                        <td>{{ $game->minReq_gpu }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fas fa-hdd"></i></td>
                                        <td>{{ $game->minReq_hdd }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fas fa-microphone"></i></td>
                                        <td>{{ $game->minReq_directx }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <table class="table table-striped table-bordered align-items-center mb-0">
                                    <thead>
                                    <tr>
                                        <th style="width: 10%" scope="col"></th>
                                        <th scope="col">Rekomendowane</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center"><i class="fab fa-windows"></i></td>
                                        <td>{{ $game->recReq_os }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fas fa-microchip"></i></td>
                                        <td>{{ $game->recReq_cpu }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fas fa-memory"></i></td>
                                        <td>{{ $game->recReq_ram }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fas fa-desktop"></i></td>
                                        <td>{{ $game->recReq_gpu }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fas fa-hdd"></i></td>
                                        <td>{{ $game->recReq_hdd }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><i class="fas fa-microphone"></i></td>
                                        <td>{{ $game->recReq_directx }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endif

        @if($game->type_id == 1 && count($game->hasDlc) >= 1)

            <div class="tab-pane fade" id="dlcs" role="tabpanel">
                <section class="pb-5 pt-4 pt-md-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-11 col-md-8 text-center mx-auto mb-4">
                                <i class="ya ya-player icon"></i>
                                <h2 class="font-weight-bold font-size-lg">Dodatki i rozszerzenia</h2>
                            </div>
                        </div>
                        <div class="row row-md">
                            @foreach($game->hasDlc as $dlc)

                            <div class="col-sm-6 col-md-4">
                                <div class="card card-sm mb-4">
                                    <a class="card-img card-img-lg" href="{{ route('game', ['slug' => $dlc->slug]) }}">
                                        <img class="card-img-top" src="/storage/{{ $dlc->box_image }}" alt="{{ $dlc->name }}"/>
                                        <div class="card-meta">
                                            <span>{{ $dlc->type->name }}</span>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('game', ['slug' => $dlc->slug]) }}">{{ $dlc->name }}</a>
                                        </h5>
                                        <p class="card-text font-size-md">{{ Str::limit($dlc->excerpt, 150, '...') }}</p>
                                        <div class="btn-group">
                                            @foreach($dlc->platforms as $platform)
                                                <a class="btn btn-default btn-xs">{{ $platform->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <span><i class="ya ya-calendar"></i> Data premiery: {{ Carbon::createFromTimestamp(strtotime($dlc->release_date))->toPolishString() }}</span>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </section>
            </div>

        @endif

    </div>
@endsection
