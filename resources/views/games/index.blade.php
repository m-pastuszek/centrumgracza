@extends('layouts.app')
@section('page_title', 'Baza gier')
@section('meta_description', setting('seo.games_meta_description'))
@section('meta_keywords', setting('seo.games_meta_keywords'))

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
            "name": "Baza gier",
            "item": "https://centrum-gracza.pl/gry"
        }]
        }
    </script>
@endsection

@section('content')


<section class="border-bottom-dashed">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <form class="form-inline w-100" method="get" action="{{ route('search') }}" role="search">
                <h5 class="h6 text-uppercase font-weight-bold mb-0 pl-1 d-block"><i class="ya ya-blocks mr-2"></i> Baza gier</h5>
                <div class="input-group mr-auto ml-md-4 mb-2 mb-md-0 mt-3 mt-md-0">
                    <input type="text" class="form-control form-control-inline" name="q" placeholder="Wyszukaj grę...">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-light border-left-0"><i class="ya ya-search m-0"></i></button>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="btn btn-light btn-icon-left dropdown-toggle" id="filter_button" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(isset($platform))
                            {{ $platform->name }}
                        @else
                            Wszystkie platformy
                        @endif
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('games') }}">Wszystkie</a>
                        @foreach($platforms as $platform)
                            <a class="dropdown-item" href="?platform={{ $platform->slug }}">{{ $platform->name }}</a>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row row-md">
            @foreach($games as $game)
                <div class="col-sm-6 col-md-4">
                    <div class="card card-sm mb-4">
                        <a class="card-img card-img-lg" href="{{ route('game', ['slug' => $game->slug]) }}">
                            <img class="card-img-top lazyload" data-src="/storage/{{ $game->background_image }}" alt="{{ $game->name }}">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('game', ['slug' => $game->slug]) }}">{{ $game->name }}</a>
                            </h5>
                            <p class="card-text font-size-md">{{ Str::limit($game->excerpt, 200, '...') }}</p>
                            <div class="btn-group">
                                @if(count($game->platforms) <= 3)
                                    @foreach( $game->platforms as $platform )
                                        <a class="btn btn-default btn-xs">{{ $platform->abbreviation }}</a>
                                    @endforeach
                                @else

                                    @foreach( $game->platforms->take(3) as $platform )
                                        <a class="btn btn-default btn-xs">{{ $platform->abbreviation }}</a>
                                        @if ($loop->last)
                                            <a class="btn btn-default btn-xs">...</a>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="card-footer">
                            <span><i class="ya ya-calendar"></i> Data premiery: {{ Carbon::createFromTimestamp(strtotime($game->release_date))->toPolishString() }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="pagination-results m-t-30">
                <nav aria-label="Nawigacja stroną">
                    {{ $games->appends($data)->links() }}
                </nav>
            </div>

        </div>
    </div>
</section>

@endsection
