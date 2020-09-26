<!DOCTYPE html>
<html lang="pl">
    <head>
        <!-- meta -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Wracamy niebawem! | {{ config('app.name', 'Centrum Gracza') }}</title>

        <link rel="icon" href="/storage/{{ setting('site.favicon') }}" type="image/png" sizes="16x16">

        <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

        @yield('additional_css')
    </head>
    <body>
        <div class="site d-flex align-items-center">
            <div class="site-content w-100" role="main">
                @yield('content')
            </div>
        </div>
        <script src="{{ asset('plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script
        <script src="{{ asset('js/theme.bundle.min.js') }}" type="text/javascript"></script>

        @yield('additional_js')
    </body>
</html>