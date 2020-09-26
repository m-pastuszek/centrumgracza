@extends('layouts.app')
@section('page_title')Tag: {{ $tag->name }}@endsection
@section('other_metas')
    <meta name="robots" content="noindex" />
@endsection
@section('content')

    <nav class="bg-light border-bottom" aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Centrum Gracza</a></li>
                <li class="breadcrumb-item active" aria-current="page">Artykuły powiązane z tagiem: {{ $tag->name }}</li>
            </ol>
        </div>
    </nav>

    <section class="py-lg-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    @forelse($articles as $article)
                        <div class="post post-medium">
                            <div class="post-thumbnail">
                                <a href="{{ route('article', ['slug' => $article->slug ]) }}">
                                    <img class="post-img" src="{{ Voyager::image($article->thumbnail('small')) }}" alt="{{ $article->name }}">
                                </a>
                            </div>
                            <div class="post-body">
                                <h2 class="post-title h4"><a href="{{ route('article', ['slug' => $article->slug ]) }}">{{ $article->name }}</a></h2>
                                <div class="post-meta">
                                    <span class="post-meta-item"><i class="ya ya-calendar"></i> {{ Carbon::createFromTimestamp(strtotime($article->published_at))->toPolishString() }}</span>
                                    <span class="post-meta-item"><i class="ya ya-user"></i> <a href="{{ route('redaktor', ['username' => $article->author->username]) }}">{{ $article->author->FullName }}</a></span>
                                </div>
                                <a href="{{ route('article', ['slug' => $article->slug ]) }}"><p>{{ Str::limit($article->excerpt, 300, '...') }}</p></a>
                            </div>
                        </div>

                    @empty

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card border-warning mb-3">
                                    <div class="card-header">
                                        Oh nie!
                                    </div>
                                    <div class="card-body">
                                        <h1 class="display-4">Nic tu nie ma!</h1>
                                        <p class="card-text lead">
                                            Z tym tagiem nie ma jeszcze żadnych powiązanych artykułów.
                                        </p>
                                        <div class="text-right m-4">
                                            <a class="btn btn-warning" href="{{ route('index') }}">Wróć do strony głównej</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img src="/storage/other/404-dribb.gif" alt=""/>

                            </div>
                        </div>
                    @endforelse

                    <div class="pagination-results m-t-30">
                        <nav aria-label="Nawigacja stroną">
                            {{ $articles->links() }}
                        </nav>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="widget">
                        <h5 class="widget-header">Polub nas na Facebooku</h5>
                        <div class="fb-page text-md-center" data-href="https://www.facebook.com/CentrumGraczaPL/"
                             data-small-header="false" data-adapt-container-width="true"
                             data-hide-cover="false" data-show-facepile="true">
                            <blockquote cite="https://www.facebook.com/CentrumGraczaPL/" class="fb-xfbml-parse-ignore">
                                <a href="https://www.facebook.com/CentrumGraczaPL/">Centrum Gracza</a>
                            </blockquote>
                        </div>
                    </div>
                    <div class="widget widget-tags">
                        <div class="widget-header">Popularne tagi</div>
                        <div class="tags">
                            @foreach($tags as $tag)
                                <a href="/tag/{{ $tag->slug }}">#{{ $tag->slug }}</a>
                            @endforeach
                        </div>
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
