<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($articles as $article)
        <url>
            <loc>https://centrum-gracza.pl/artykul/{{ $article->slug }}</loc>
            <lastmod>{{ \Carbon\Carbon::createFromTimestamp(strtotime($article->updated_at))->format('Y-m-d\Th:m:s+00:00') }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>
