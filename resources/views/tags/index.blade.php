@extends('layouts.app')
@section('page_title', 'Chmura tagów')
@section('content')

    <nav class="bg-light border-bottom" aria-label="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index') }}">Centrum Gracza</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('page_title')</li>
            </ol>
        </div>
    </nav>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mt-4 pt-1">
                        <div class="tags">
                        @foreach($tags as $tag)
                            <a href="/tag/{{ $tag->slug }}">{{ $tag->name }}</a>
                        @endforeach
                        </div>
                    </div>
                </div>
                <!-- sidebar -->
                <div class="col-lg-4">
                    <div class="sidebar">
                        <!-- widget facebook -->
                        <div class="widget">
                            <h5 class="widget-title">Polub nas na Facebooku</h5>
                            <div id="fb-root"></div>
                            <script async="" src="https://www.google-analytics.com/analytics.js"></script>
                            <script id="facebook-jssdk" src="//connect.facebook.net/pl_PL/sdk.js#xfbml=1&amp;version=v2.8"></script>
                            <script>
                                (function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = "//connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v2.9";
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                            </script>
                            <div class="fb-page" data-href="https://www.facebook.com/CentrumGraczaPL" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div>
                        </div>
                        <!-- AD Widget  -->
                        <div class="widget widget-post">
                            <h5 class="widget-title">Reklama</h5>
                            @if(!empty(setting('site.ad')))
                                <div class="widget">
                                    <h5 class="widget-header">Reklama</h5>
                                    {!! setting('site.ad') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /main -->

@endsection
