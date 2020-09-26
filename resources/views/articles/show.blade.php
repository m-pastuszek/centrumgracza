@extends('layouts.app')
@section('page_title'){{ $article->name }}@endsection
@section('meta_description'){{ $article->meta_description }}@endsection
@section('meta_keywords'){{ $article->meta_keywords }}@endsection
@section('meta_author'){{ $article->author->FullName }}@endsection
@section('other_metas')
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $article->name }}"/>
<meta property="og:image" content="https://centrum-gracza.pl/storage/{{ $article->image }}">
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
            "name": "{{ $article->category->name }}",
            "item": "https://centrum-gracza.pl/{{ $article->category->slug }}"
        },{
            "@type": "ListItem",
            "position": 3,
            "name": "{{ $article->name }}",
            "item": "{{ route('article', ['slug' => $article->slug]) }}"
        }]
        }
    </script>

    <script type="application/ld+json">
        {
        "@context":"http://schema.org",
        "@type": "NewsArticle",
        "url": "https://centrum-gracza.pl/artykul/{{ $article->slug }}",
        "author": {
            "@type": "Person",
            "name": "{{ $article->author->FullName }}"
            },
        "publisher": {
            "@type": "Organization",
            "name": "Centrum Gracza",
            "logo": {
                "@type": "ImageObject",
                "url": "https://www.centrum-gracza.pl/storage/{{ str_replace('\\', '/', setting('site.favicon')) }}"}
            },
        "headline": "{{ $article->name }}",
        "mainEntityOfPage": "https://centrum-gracza.pl/artykul/{{ $article->slug }}",
        "articleBody": "{{ $article->meta_description }}",
        "image": "https://centrum-gracza.pl/storage/{{ str_replace('\\', '/', $article->image) }}",
        "datePublished": "{{ Carbon::createFromTimestamp(strtotime($article->published_at))->format('Y-m-d\Th:m:s+00:00') }}",
        "dateModified": "{{ Carbon::createFromTimestamp(strtotime($article->updated_at))->format('Y-m-d\Th:m:s+00:00') }}"
        }
    </script>
@endsection

@section('content')

    <nav class="bg-light" aria-label="breadcrumb">
        <div class="container d-flex align-items-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Centrum Gracza</a></li>
                <li class="breadcrumb-item"><a href="/{{ $article->category->slug }}">{{ $article->category->name }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $article->name }}</li>
            </ol>
        @auth
            <div class="btn-group ml-auto">
                <a class="btn btn-primary btn-icon-left btn-xs" href="{{ route('voyager.articles.edit', ['article' => $article->id ]) }}"><i class="ya ya-edit"></i> Edytuj artykuł</a>
            </div>
        @endauth
        </div>
    </nav>


    <section class="py-lg-5 border-bottom-dashed">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="post post-single">
                        <div class="post-header">
                            <h1 class="post-title">{{ $article->name }}</h1>
                            <div class="post-meta">
                                <span class="post-meta-item"><i class="ya ya-calendar"></i>
                                    @php
                                        $yesterday = Carbon::yesterday();

                                        if (Carbon::createFromTimestamp(strtotime($article->published_at)) >= $yesterday) {
                                            print ucfirst(Carbon::createFromTimestamp(strtotime($article->published_at))->diffForHumans());
                                        }
                                        else {
                                            print ucfirst(Carbon::createFromTimestamp(strtotime($article->published_at))->isoFormat('dddd, '));
                                            print ucfirst(Carbon::createFromTimestamp(strtotime($article->published_at))->toPolishString());
                                        }
                                    @endphp
                                </span>
                               <i class="ya ya-user"></i> Autor: <a class="post-meta-item" href="{{ route('redaktor', ['username' => $article->author->username]) }}">{{ $article->author->FullName }}</a>
                            </div>
                        </div>
                        <div class="post-thumbnail">
                            <img class="post-img" src="/storage/{{ str_replace('\\', '/', $article->image) }}" alt="{{ $article->name }}">
                        </div>
                        <p class="lead">{{ $article->excerpt }}</p>
                        <hr/>
                        <div class="post-body">
                            {!! $article->body !!}
                        </div>
                        <div class="d-flex align-items-center mt-4 pt-1">
                            <div class="tags">
                                @foreach( $article->tags as $tag)
                                    <a href="{{ route('tag', ['slug' => $tag->slug]) }}">#{{ $tag->slug }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-inline-flex d-md-flex flex-column flex-md-row align-items-center justify-content-center text-center text-md-left w-100 px-1 px-md-0 mb-3 mb-md-0">
                    <div class="mb-4 mb-md-0 mr-md-auto"></div>
                    <a class="avatar-card" href="{{ route('redaktor', ['username' => $article->author->username]) }}">
                        <div>
                            <div class="avatar-title">{{ $article->author->FullName }}</div>
                            <p class="avatar-text">Redaktor</p>
                        </div>
                        <img src="/storage/{{ $article->author->profile->avatar }}" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-lg-5 px-1 px-md-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div id="disqus_thread"></div>
                    <script>

                        var disqus_config = function () {
                        this.page.url = "{{ Request::url() }}";  // Replace PAGE_URL with your page's canonical URL variable
                        this.page.identifier = "{{ 'article.' . $article->id }}"; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
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
    </section>

    @if (!$relatedArticles->isEmpty())
        <section class="py-lg-5 border-top-dashed">
            <div class="container">
                <div class="row">
                    <div class="col-11 col-md-8 text-center mx-auto mb-4">
                        <i class="ya ya-time-alarm icon"></i>
                        <h2 class="font-weight-bold">Sprawdź także te artykuły</h2>
                        <p class="lead">W nawiązaniu do tego, o czym czytałeś, przygotowaliśmy zestaw trzech artykułów, <br>które także mogą Cię zainteresować.</p>
                    </div>
                </div>
                <div class="row">
                    @foreach($relatedArticles as $relatedArticle)
                        <div class="col-md-4">
                            <div class="card bg-light">
                                <a class="card-img" href="{{ route('article', ['slug' => $relatedArticle->slug ]) }}">
                                    <img src="/storage/{{ $relatedArticle->image }}" alt="{{ $relatedArticle->name }}">
                                </a>
                                <div class="card-body">
                                    <h6 class="card-title"><a href={{ route('article', ['slug' => $relatedArticle->slug ]) }}>{{ $relatedArticle->name }}</a></h6>
                                    <div class="card-meta">
                                        <span class="card-meta-item"><i class="ya ya-calendar"></i> {{ Carbon::createFromTimestamp(strtotime($relatedArticle->published_at))->toPolishString() }}</span>
                                    </div>
                                    <p class="card-text">{{ Str::limit($relatedArticle->excerpt, 150, '...') }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection
