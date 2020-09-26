<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>https://centrum-gracza.pl/sitemap/main</loc>
        <lastmod>{{ \Carbon\Carbon::now()->format('Y-m-d\Th:m:s+00:00') }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://centrum-gracza.pl/sitemap/articles</loc>
        <lastmod>{{ \Carbon\Carbon::createFromTimestamp(strtotime($article->updated_at))->format('Y-m-d\Th:m:s+00:00') }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://centrum-gracza.pl/sitemap/reviews</loc>
        <lastmod>{{ \Carbon\Carbon::createFromTimestamp(strtotime($review->updated_at))->format('Y-m-d\Th:m:s+00:00') }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://centrum-gracza.pl/sitemap/games</loc>
        <lastmod>{{ \Carbon\Carbon::createFromTimestamp(strtotime($game->updated_at))->format('Y-m-d\Th:m:s+00:00') }}</lastmod>
    </sitemap>
    <sitemap>
        <loc>https://centrum-gracza.pl/sitemap/videos</loc>
        <lastmod>{{ \Carbon\Carbon::createFromTimestamp(strtotime($video->updated_at))->format('Y-m-d\Th:m:s+00:00') }}</lastmod>
    </sitemap>
</sitemapindex>