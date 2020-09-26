@extends('layouts.app')
@section('page_title'){{ $video->name }} @endsection
@section('meta_description'){{ $video->excerpt }}@endsection
@section('meta_keywords'){{ $video->meta_keywords }}, YouTube @endsection
@section('other_metas')
    <meta property="og:image" content="https://img.youtube.com/vi/{{ $video->youtube_video_id }}/maxresdefault.jpg">
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
            "name": "Filmy",
            "item": "https://centrum-gracza.pl/filmy"
        },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $video->name }}",
            "item": "{{ route('video', ['slug' => $video->slug]) }}"
        }]
        }
    </script>

@endsection
@section('content')


    <nav class="bg-dark" aria-label="breadcrumb">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Centrum Gracza</a></li>
                <li class="breadcrumb-item"><a href="{{ route('videos') }}">Filmy</a></li>
                <li class="breadcrumb-item active d-none d-xl-block" aria-current="page">{{ $video->name }}</li>
            </ol>
        @auth
            <div class="btn-group ml-auto">
                <a class="btn btn-primary btn-icon-left btn-xs" href="{{ route('voyager.videos.edit', ['video' => $video->id ]) }}"><i class="ya ya-edit"></i> Edytuj film</a>
            </div>
        @endauth
        </div>
    </nav>

    <section class="bg-image py-0 py-lg-5">
        <img class="background" src="https://img.youtube.com/vi/{{ $video->youtube_video_id }}/maxresdefault.jpg" alt="{{ $video->name }}">
        <div class="container">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://www.youtube.com/embed/{{ $video->youtube_video_id }}?rel=0&amp;showinfo=0&amp;autoplay=1" rel="0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    <section class="py-lg-5">
        <div class="container">
            <div class="row">

                @php
                    $videoPublishedAt = $apiData->snippet->publishedAt;
                    $videoViews = $apiData->statistics->viewCount;
                    $videoDescription = $apiData->snippet->localized->description;
                    $videoTitle = $apiData->snippet->localized->title;

                    // Informacje o kanale
                    $channelTitle = $apiData->snippet->channelTitle;
                    $channelId = $apiData->snippet->channelId;
                    $channelThumbnail = $channelJson->snippet->thumbnails->high->url;
                @endphp

                @php


                @endphp

                <div class="col-lg-8">
                    <div class="post post-single border-bottom-dashed">
                        <div class="post-header post-header-author">
                            <img src="{{ $channelThumbnail }}" alt="{{$channelTitle}}">
                            <div>
                                <h1 class="post-title">{{ $videoTitle }}</h1>
                                <div class="post-meta">
                                    <span class="badge badge-dark"><i class="ya ya-calendar"></i> {{ Carbon::createFromTimestamp(strtotime($videoPublishedAt))->toPolishString() }}</span>
                                    <span class="badge badge-primary mt-2 mt-sm-0 ml-sm-2"><i class="ya ya-eye"></i> {{ number_format($videoViews, 0) }} odsłon</span>
                                    <a href="https://www.youtube.com/channel/{{$channelId}}" class="badge badge-youtube mt-2 mt-sm-0 ml-sm-2"><i class="ya ya-user"></i> {{$channelTitle}} | <i class="fas fa-external-link-alt"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="post-body">
                            <div class="card">
                                <h5 class="card-header">Opis filmu</h5>
                                <div class="card-body">
                                    <p class="card-text">
                                        {!! nl2br($videoDescription) !!}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div id="disqus_thread"></div>
                        <script>

                            var disqus_config = function () {
                                this.page.url = "{{ Request::url() }}";  // Replace PAGE_URL with your page's canonical URL variable
                                this.page.identifier = "{{ 'article.' . $video->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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
                <div class="col-lg-4">
                    <div class="sidebar">
                        <!-- widget-games -->
                        <div class="widget widget-games">
                            <h5 class="widget-header">Powiązana gra</h5>
                            <a href="/gra/{{ $video->game->slug }}" style="background-image: url('/storage/{{ str_replace('\\', '/', $video->game->background_image ) }}')">
                                <span class="img-overlay"></span>
                                <div class="widget-block">
                                    <div class="description">
                                        <h5 class="title">{{ $video->game->name }}</h5>
                                        <span class="date">Premiera: {{ Carbon::createFromTimestamp(strtotime($video->game->release_date))->toPolishString() }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="widget widget-list">
                            <h5 class="widget-header mb-1">Najnowsze filmy</h5>
                            @foreach($videos as $video)
                                <div class="media">
                                    <a class="img-cover latest-videos img-md" href="/film/{{ $video->slug }}">
                                        <img src="https://i.ytimg.com/vi/{{ $video->youtube_video_id }}/mqdefault.jpg" alt="{{ $video->name }}">
                                    </a>
                                    <div class="media-body">

                                        @php

                                        $id = $video->id;

                                        $videoApi = Cache::remember('youtube.video.' . $id, $seconds, function() use ($id) {
                                            $video = App\Models\Video::find($id);
                                            $videoApi = Youtube::getLocalizedVideoInfo($video->youtube_video_id, 'pl');

                                            return $videoApi;

                                        });

                                        $publishedAt = $videoApi->snippet->publishedAt;

                                        @endphp

                                        <h6><a href="/film/{{ $video->slug }}">{{ Str::limit($video->name, 50, '...') }}</a></h6>
                                        <div class="font-size-sm font-weight-semibold text-muted">{{ Carbon::createFromTimestamp(strtotime($publishedAt))->diffForHumans() }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection