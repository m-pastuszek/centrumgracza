<footer class="site-footer bg-dark">
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-6 mb-md-0 pb-1 pb-md-0">
                <div class="footer-title">O Centrum Gracza</div>
                <p>{{ setting('site.description') }}</p>
                <p><strong>Centrum Gracza — Wszystko o grach w jednym miejscu!</strong></p>
            </div>
            <div class="col-md-6 mb-6 mb-md-0 pb-1 pb-md-0">
                <div class="footer-title">Popularne tagi</div>
                <div class="footer-tags">
                    @foreach($tags as $tag)
                        <a href="{{ route('tag', ['slug' => $tag->slug ]) }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container d-flex flex-column flex-md-row">
            <div class="order-2 order-md-1">
                <div class="footer-links d-none d-md-inline-block">
                    <a href="{{ route('o-nas') }}">O nas</a>
                    <a href="{{ route('kontakt') }}">Kontakt</a>
                    <a href="{{ route('page', ['slug' => 'polityka-prywatnosci']) }}">Polityka prywatności</a>
                    <a href="{{ route('page', ['slug' => 'regulamin-serwisu']) }}">Regulamin Serwisu</a>
                </div>
                <p class="footer-copyright">Copyright &copy; {{ date("Y") }} <a href="https://centrum-gracza.pl">Centrum Gracza</a>. Wszelkie prawa zastrzeżone.</p>
            </div>
            <div class="footer-social order-1 order-md-2 ml-md-auto text-center text-md-right">
                <span class="d-none d-sm-block mb-2">Obserwuj nas w mediach społecznościowych</span>
                <a href="{{ setting('site.facebook') }}" target="_blank" data-toggle="tooltip"><i class="ya ya-facebook"></i></a>
                <a href="{{ setting('site.twitter') }}" target="_blank" data-toggle="tooltip"><i class="ya ya-twitter"></i></a>
                <a href="{{ setting('site.instagram') }}" target="_blank" data-toggle="tooltip"><i class="ya ya-instagram"></i></a>
                <a href="{{ setting('site.youtube') }}" target="_blank" data-toggle="tooltip"><i class="ya ya-youtube"></i></a>
            </div>
        </div>
    </div>
</footer>
