<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($reviews as $review)
        <url>
            <loc>https://centrum-gracza.pl/recenzja/{{ $review->slug }}</loc>
            <lastmod>{{ \Carbon\Carbon::createFromTimestamp(strtotime($review->updated_at))->format('Y-m-d\Th:m:s+00:00') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
    @endforeach
</urlset>