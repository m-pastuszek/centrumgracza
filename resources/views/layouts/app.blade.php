<!DOCTYPE html>
<html lang="pl" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Metadane -->
        <meta name="description" property="og:description" content="@yield('meta_description')" />
        <meta name="keywords" content="@yield('meta_keywords')">
        <meta name="author" content="@yield('author')">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        @yield('other_metas')

        @include('feed::links')

        @if ($_SERVER['REQUEST_URI'] == '/')
            <title>Centrum Gracza</title>
        @else
            <title>@yield('page_title') | {{ config('app.name', 'Centrum Gracza') }}</title>
        @endif

        <link rel="icon" href="/storage/{{ setting('site.favicon') }}" type="image/png" sizes="16x16">
        <link rel="apple-touch-icon" sizes="180x180" href="/storage/{{ setting('favicons.apple_touch') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="/storage/{{ setting('favicons.favicon_32x32') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="/storage/{{ setting('favicons.favicon_16x16') }}">
        <link rel="manifest" href="/storage/{{ setting('favicons.site_webmanifest') }}">
        <meta name="msapplication-TileColor" content="{{ setting('favicons.msapplication') }}">
        <meta name="theme-color" content="{{ setting('favicons.theme_color') }}">

        <link href="{{ asset('css/theme.css') }}" rel="stylesheet">

        @yield('additional_css')

        {!! Analytics::render() !!}

    </head>
    <body class="fixed-navbar">

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/pl_PL/sdk.js#xfbml=1&version=v3.3&appId=2202739136437223&autoLogAppEvents=1"></script>

    <div class="site">
        <header class="site-header">
            @include('partials.navbar')
        </header>
        <div class="site-content" id="app">

            @yield('content')

            @include('partials.footer')
        </div>
    </div>
    <!-- Skrypty -->


    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom.js') }}" type="text/javascript"></script>

    @yield('additional_js')

    </body>
</html>
