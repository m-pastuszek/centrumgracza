<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($videos as $video)
        @php

            $id = $video->id;
            $seconds = config('settings.cache_seconds');


            $apiData = Cache::remember('youtube.video.' . $id, $seconds, function() use ($id) {
                $video = App\Models\Video::find($id);
                $apiData = Youtube::getLocalizedVideoInfo($video->youtube_video_id, 'pl');

                return $apiData;
            });

        @endphp

        @if (empty($apiData))
            @continue
        @else
        <url>
            <loc>https://centrum-gracza.pl/film/{{ $video->slug }}</loc>
            <lastmod>{{ \Carbon\Carbon::createFromTimestamp(strtotime($video->updated_at))->format('Y-m-d\Th:m:s+00:00') }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.6</priority>
        </url>
        @endif
    @endforeach
</urlset>
