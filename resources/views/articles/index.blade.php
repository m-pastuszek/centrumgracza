@extends('layouts.app')
@section('page_title')
    {{ $category->name }}
@endsection
@section('meta_description', setting('seo.news_meta_description'))
@section('meta_keywords', setting('seo.news_meta_keywords'))

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
            "name": "{{ $category->name }}",
            "item": "https://centrum-gracza.pl/{{ $category->slug }}"
        }]
        }
    </script>
@endsection

@section('content')
    <nav class="bg-light border-bottom" aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Centrum Gracza</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
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
                            <img class="post-img lazyload" data-src="{{ Voyager::image($article->thumbnail('small')) }}" alt="{{ $article->name }}">
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
                                        W kategorii <strong>{{ $category->name }}</strong> nie ma jeszcze żadnych artykułów.
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

                <div class="col-lg-3 border-left">
                    <div class="widget">
                        <h5 class="widget-header">Polub nas na Facebooku</h5>
                        {!! setting('site.facebook_widget') !!}
                    </div>
                    <div class="widget widget-tags">
                        <div class="widget-header">Popularne tagi</div>
                        <div class="tags">
                            @foreach($tags as $tag)
                                <a href="{{ route('tag', ['slug' => $tag->slug]) }}">#{{ $tag->slug }}</a>
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
