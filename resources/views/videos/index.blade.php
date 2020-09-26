@extends('layouts.app')
@section('page_title', 'Filmy')
@section('meta_description')Bądź na bieżąco z najnowszymi zwiastunami i filmami z rozgrywek. Nowy zwiastun? Już go mamy!@endsection
@section('meta_keywords', 'Centrum Gracza, zwiastuny gier, rozgrywka, gameplay, youtube')
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
            "name": "Filmy",
            "item": "https://centrum-gracza.pl/filmy"
        }]
        }
    </script>
@endsection

@section('content')

    <section class="border-bottom-dashed">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <form method="get" action="{{ route('search') }}" role="search" class="form-inline w-100">
                    <h5 class="h6 text-uppercase font-weight-bold mb-0 pl-1"><i class="ya ya-player mr-2"></i> Baza filmów</h5>
                    <div class="input-group mr-auto ml-md-4 mb-2 mb-md-0 mt-3 mt-md-0">
                        <input type="text" name="q"  class="form-control form-control-inline" placeholder="Szukaj filmu...">
                        <div class="input-group-append">
                            <button type="button" class="btn btn-light border-left-0"><i class="ya ya-search m-0"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row row-md">

                @foreach($videos as $video)

                    @php

                    $id = $video->id;

                    $apiData = Cache::remember('youtube.video.' . $id, $seconds, function() use ($id) {
                        $video = App\Models\Video::find($id);
                        $apiData = Youtube::getLocalizedVideoInfo($video->youtube_video_id, 'pl');

                        return $apiData;
                    });

                    @endphp

                    @if (empty($apiData))
                        <div class="col-sm-6 col-md-4 col-lg-4 card-group mb-sm-4">
                            <div class="card card-sm">
                                <a class="card-img card-img-sm" href="javascript:void(0)">
                                    <img class="lazyload" data-src="/storage/other/youtube_unavaliable_1110x624.png" alt="Ten film nie jest już dostępny w serwisie YouTube.">
                                </a>
                                <div class="card-body">
                                    <h6 class="card-title"><a href="javascript:void(0)">Ten film nie jest już dostępny w serwisie YouTube.</a></h6>
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

                <div class="pagination-results m-t-30">
                    <nav aria-label="Nawigacja stroną">
                        <ul class="pagination">
                            {{ $videos->render() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

@endsection