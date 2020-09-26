<footer class="app-footer">
    <div class="site-footer-right">
        @php $version = Voyager::getVersion(); @endphp
        Copyright &copy; {{ date("Y") }} <strong><a href="/" target="_blank">Centrum Gracza</a></strong> | Wersja Voyagera: <strong>{{ $version }}</strong>
    </div>
</footer>
