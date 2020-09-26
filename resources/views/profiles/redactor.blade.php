@extends('layouts.app')

@section('page_title')
    {{ $user->FullName }}
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
            "name": "Redaktorzy",
            "item": "https://centrum-gracza.pl/o-nas"
        },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $user->FullName }}",
            "item": "{{ route('redaktor', ['username' => $user->username]) }}"
        }]
        }
    </script>
@endsection
@section('content')

    <section class="bg-image bg-dark d-flex align-items-end py-3" style="background-color: #3a3a3c !important;min-height: 320px;">
        <img class="background" src="/storage/{{ $user->profile->background }}" alt="" ya-style="opacity: .25">
        <div class="container position-relative">
            <div class="row">
                <div class="col d-flex flex-column flex-lg-row align-items-center text-center position-absolute bottom left pl-lg-8">
                    <a class="avatar-thumbnail avatar-lg d-lg-none bg-dark mb-3 mb-lg-0 border-0" href="#">
                        <img src="/storage/{{ $user->profile->avatar }}" alt="">
                    </a>
                    <h2 class="h4 text-white mb-0 ml-2 pl-lg-8">
                        @if($user->verified_user == 1)
                            <i class="ya ya-check bg-primary float-left font-size-xs rounded-circle p-2 mr-2"  data-toggle="tooltip" title="Zweryfikowany"></i>
                        @endif
                            {{ $user->FullName }}</h2>
                    <div class="ml-lg-auto mt-4 mb-3 my-lg-0">
                        <a class="btn btn-primary btn-sm btn-icon-left font-weight-semibold ml-2" href="mailto:{{ $user->email }}"><i class="ya ya-email"></i> Kontakt mailowy</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-white border-bottom nav-profile py-0" ya-sticky>
        <div class="container">
            <div class="row">
                <div class="col d-flex align-items-center">
                    <a class="avatar-thumbnail avatar-xl position-absolute d-none d-lg-block" href="#">
                        <img src="/storage/{{ $user->profile->avatar }}" alt="">
                    </a>
                    <div class="avatar-fixed d-none d-lg-block">
                        <a class="avatar-tile" href="#">
                            <img src="/storage/{{ $user->profile->avatar }}" alt="">
                            <div>
                                <strong>{{ $user->FullName }}</strong>
                                <span class="d-block">&#64;{{ $user->username }}</span>
                            </div>
                        </a>
                    </div>

                    <div class="nav-scroll">
                        <div class="nav nav-list nav-list-profile" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" data-toggle="tab" href="#articles" role="tab" aria-controls="articles">Najnowsze artykuły</a>
                            <a class="nav-item nav-link" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews">Najnowsze recenzje</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 order-2 order-lg-1">
                    <div class="widget mt-4">
                        <div class="widget-header">O Redaktorze</div>
                        <div class="widget-body">
                            <p>{{ $user->profile->bio }}</p>
                            <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-pin mr-1"></i> {{ $user->profile->country->name }}</p>
                            @if(!is_null($user->profile->facebook_url))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-facebook mr-1"></i> <a href="{{ $user->profile->facebook_url }}" target="_blank">{{ $user->FullName }}</a></p>
                            @endif

                            @if(!is_null($user->profile->twitter_url ))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-twitter mr-1"></i> <a href="https://twitter.com/{{ $user->profile->twitter_url }}" target="_blank">{{ $user->profile->twitter_url }}</a></p>
                            @endif

                            @if(!is_null($user->profile->instagram_url ))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-instagram mr-1"></i> <a href="https://instragram.com/{{ $user->profile->instagram_url }}" target="_blank">{{ $user->profile->instagram_url }}</a></p>
                            @endif

                            @if(!is_null($user->profile->twitch_url ))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-twitch mr-1"></i> <a href="https://twitch.com/{{ $user->profile->twitch_url }}" target="_blank">{{ $user->profile->twitch_url }}</a></p>
                            @endif

                            @if(!is_null($user->profile->website_url ))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-link mr-1"></i> <a href="{{ $user->profile->website_url }}" target="_blank">{{ $user->profile->website_url }}</a></p>
                            @endif

                            <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-calendar mr-1"></i> Dołączył: {{ Carbon::createFromTimestamp(strtotime($user->created_at))->isoFormat('MMMM YYYY') }}</p>

                            @if(!is_null($user->profile->birth_date ))
                                <p class="font-size-sm font-weight-semibold mb-1"><i class="ya ya-star-o mr-1"></i> Wiek: {{ Carbon::createFromTimestamp(strtotime($user->profile->birth_date))->diff(Carbon::now())->format('%y lat') }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="widget widget-users">
                        <div class="widget-header">Redaktorzy</div>
                        <div class="widget-body">
                            @foreach ($editors as $editor)
                                <a href="/redaktor/{{ $editor->username }}" data-toggle="tooltip" title="{{ $editor->FullName }}">
                                    <img src="/storage/{{ $editor->profile->avatar }}" alt="{{ $editor->FullName }}">
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <!-- end .widget -->
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="tab-content">
                        <div class="tab-pane active" id="articles" role="tabpanel">
                            <h3 class="mb-4">Ostatnio dodane artykuły</h3>
                            @forelse($articles as $article)
                                <div class="card mb-3">
                                    <div class="card-body p-2">
                                        <div class="post post-medium border-0 p-0 m-0">
                                            <div class="post-thumbnail">
                                                <a href="{{ route('article', ['slug' => $article->slug]) }}">
                                                    <img class="post-img" src="/storage/{{ $article->image }}" alt="{{ $article->name }}">
                                                </a>
                                            </div>
                                            <div class="post-body pt-1">
                                                <h2 class="post-title h4 mb-1"><a href="{{ route('article', ['slug' => $article->slug]) }}">{{ $article->name }}</a></h2>
                                                <div class="post-meta">
                                                    <span class="post-meta-item"><i class="ya ya-calendar"></i> {{ Carbon::createFromTimestamp(strtotime($article->published_at))->toPolishString() }}</span>
                                                    <span class="post-meta-item"><i class="ya ya-clock"></i> {{ Carbon::createFromTimestamp(strtotime($article->published_at))->format('G:i') }}</span>
                                                </div>
                                                <p>{{ $article->excerpt }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-9 order-1 order-lg-2">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card border-warning mb-3">
                                                <div class="card-body">
                                                    <h1 class="display-6">Oh nie!</h1>
                                                    <p class="card-text lead">
                                                        Ten redaktor nie dodał jeszcze żadnego artykułu.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="/storage/other/404-dribb.gif" alt=""/>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <div class="tab-pane fade" id="reviews" role="tabpanel">
                            <h3 class="mb-4">Ostatnio dodane recenzje</h3>
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
                                                </div>
                                                <p>{{ $review->excerpt }}</p>
                                                <div class="tags tags-secondary">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-lg-9 order-1 order-lg-2">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="card border-warning mb-3">
                                                <div class="card-body">
                                                    <h1 class="display-6">Oh nie!</h1>
                                                    <p class="card-text lead">
                                                        Ten redaktor nie dodał jeszcze żadnej recenzji.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <img src="/storage/other/404-dribb.gif" alt=""/>
                                        </div>
                                    </div>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection