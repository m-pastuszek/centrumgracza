@extends('layouts.app')
@section('page_title')
    Wyniki wyszukiwania dla frazy "{{ $searchKey }}"
@endsection

@section('meta_description')Szukasz czegoś konkretnego? Skorzystaj z wyszukiwarki!@endsection
@section('meta_keywords', 'Centrum Gracza, szukaj, wyszukiwarka')

@section('content')

    <nav class="bg-white border-bottom" aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Centrum Gracza</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wyniki wyszukiwania</li>
            </ol>
        </div>
    </nav>

    <section class="border-bottom-dashed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <form action="{{ route('search') }}" method="get">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-lg form-control-inline" placeholder="&quot;{{ $searchKey }}&quot;" name="q">
                            <div class="input-group-append">
                                <button  class="btn btn-light border-left-0 btn-lg px-3" type="submit"><i class="ya ya-search m-0"></i></button>
                            </div>
                        </div>
                        <small class="form-text text-muted">Poniżej prezentujemy wyniki powiązane z wyszukiwaną przez Ciebie frazą.</small>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <form class="form-inline mb-4">
                        <div class="col d-flex align-items-center">
                            <div class="nav-scroll">
                                <div class="nav nav-list" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" data-toggle="tab" href="#articles" role="tab">Artykuły ({{ $articles->count() }})</a>
                                    <a class="nav-item nav-link" data-toggle="tab" href="#videos" role="tab">Filmy ({{ $videos->count() }})</a>
                                    <a class="nav-item nav-link" data-toggle="tab" href="#games" role="tab">Gry ({{ $games->count() }})</a>
                                    <a class="nav-item nav-link" data-toggle="tab" href="#reviews" role="tab">Recenzje ({{ $reviews->count() }})</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- end .form-inline -->
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="articles" role="tabpanel">
                        @forelse($articles as $article)
                        <div class="card mb-3">
                            <div class="card-body p-2">
                                <div class="post post-medium border-0 p-0 m-0">
                                    <div class="post-thumbnail">
                                        <a href="{{ route('article', ['slug' => $article->slug ]) }}">
                                            <img class="post-img" src="{{ Voyager::image($article->thumbnail('small')) }}" alt="{{ $article->name }}">
                                        </a>
                                    </div>
                                    <div class="post-body pt-1">
                                        <h2 class="post-title h4 mb-1"><a href="{{ route('article', ['slug' => $article->slug ]) }}">{{ $article->name }}</a></h2>
                                        <div class="post-meta">
                                            <span class="post-meta-item"><i class="ya ya-calendar"></i> {{ Carbon::createFromTimestamp(strtotime($article->published_at))->toPolishString() }}</span>
                                            <span class="post-meta-item"><i class="ya ya-clock"></i> {{ Carbon::createFromTimestamp(strtotime($article->published_at))->format('G:i') }}</span>
                                            <span class="post-meta-item"><i class="ya ya-user"></i> <a href="{{ route('article', ['slug' => $article->author->username]) }}">{{ $article->author->FullName }}</a></span>
                                        </div>
                                        <p>{{ $article->excerpt }}</p>
                                        <div class="tags tags-secondary">
                                            @foreach( $article->tags as $tag)
                                                <a href="{{ route('tag', ['slug' => $tag->slug ]) }}">#{{ $tag->slug }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="alert alert-darken-primary" role="alert">Nie znaleziono żadnych artykułów powiązanych<br class="d-block d-sm-none"/> z wyszukiwaną przez Ciebie frazą.</div>
                        @endforelse
                    </div>

                    <div class="tab-pane fade" id="videos" role="tabpanel">
                        @forelse($videos as $video)

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
                                <div class="card mb-3">
                                    <div class="card-body p-2">
                                        <div class="post post-medium border-0 p-0 m-0">
                                            <div class="post-thumbnail">
                                                <a href="{{ route('video', ['slug' => $video->slug]) }}">
                                                    <img class="post-img" style="height: unset" src="https://i1.ytimg.com/vi/{{ $video->youtube_video_id }}/maxresdefault.jpg" alt="Miniatura — {{ $apiData->snippet->title }}">
                                                </a>
                                            </div>
                                            <div class="post-body pt-1">
                                                <h2 class="post-title h4 mb-1"><a href="{{ route('video', ['slug' => $video->slug]) }}">{{ $apiData->snippet->title }}</a></h2>
                                                <div class="post-meta">
                                                    <span class="post-meta-item"><i class="far fa-user"></i><a href="https://www.youtube.com/channel/{{$channelId}}">{{$channelTitle}}</a></span>
                                                    <span class="post-meta-item"><i class="far fa-eye"></i>{{ number_format($views, 0) }}</span>
                                                </div>
                                                <p>{{ Str::limit($description, 150, '...') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div class="alert alert-darken-success" role="alert">Nie znaleziono żadnych filmów powiązanych<br class="d-block d-sm-none"/> z wyszukiwaną przez Ciebie frazą.</div>
                        @endforelse
                    </div>

                    <div class="tab-pane fade" id="games" role="tabpanel">
                        @forelse($games as $game)
                            <div class="card mb-3">
                                <div class="card-body p-2">
                                    <div class="post post-medium border-0 p-0 m-0">
                                        <div class="post-thumbnail">
                                            <a href="{{ route('game', ['slug' => $game->slug]) }}">
                                                <img class="post-img" src="/storage/{{ $game->background_image }}" alt="Obrazek wyróżniający - {{ $game->name }}">
                                            </a>
                                        </div>
                                        <div class="post-body pt-1">
                                            <h2 class="post-title h4 mb-1"><a href="{{ route('game', ['slug' => $game->slug]) }}">{{ $game->name }}</a></h2>
                                            <div class="post-meta">
                                                <span class="post-meta-item"><i class="ya ya-calendar"></i> Data premiery: {{ Carbon::createFromTimestamp(strtotime($game->release_date))->toPolishString() }}</span>
                                            </div>
                                            <p>{{ $game->excerpt }}</p>
                                            <div class="tags tags-secondary">
                                                @foreach( $game->platforms as $platform)
                                                    <a>{{ $platform->abbreviation }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-darken-primary" role="alert">Nie znaleziono żadnych gier powiązanych<br class="d-block d-sm-none"/> z wyszukiwaną przez Ciebie frazą.</div>
                        @endforelse
                    </div>


                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        @forelse($reviews as $review)
                            <div class="card mb-3">
                                <div class="card-body p-2">
                                    <div class="post post-medium border-0 p-0 m-0">
                                        <div class="post-thumbnail w-25 mb-2 mb-md-0">
                                            <a href="{{ route('review', ['slug' => $review->slug]) }}">
                                                <img class="post-img" src="/storage/{{ $review->image }}" alt="{{ $review->name }}">
                                            </a>
                                        </div>
                                        <div class="post-body pt-1">
                                            <h2 class="post-title h4 mb-1"><a href="{{ route('review', ['slug' => $review->slug]) }}">{{ $review->name }}</a></h2>
                                            <div class="post-meta">
                                                <span class="post-meta-item"><i class="ya ya-calendar"></i> {{ Carbon::createFromTimestamp(strtotime($review->published_at))->toPolishString() }}</span>
                                                <span class="post-meta-item"><i class="ya ya-clock"></i> {{ Carbon::createFromTimestamp(strtotime($review->published_at))->format('G:i') }}</span>
                                                <span class="post-meta-item"><i class="ya ya-user"></i> <a href="/redaktor/{{ $review->author->username }}">{{ $review->author->FullName }}</a></span>
                                            </div>
                                            <p>{{ $review->excerpt }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-darken-primary" role="alert">Nie znaleziono żadnych recenzji powiązanych<br class="d-block d-sm-none"/> z wyszukiwaną przez Ciebie frazą.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection