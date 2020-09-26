<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Alaouy\Youtube\Facades\Youtube;
use Facades\App\Repository\VideoRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VideoController extends Controller
{
    public function index() {

    /*
     * Request duration
     *
     * Before caching: 6,78s
     * After caching: 293,13s
     *
     * IT'S BETTER!
     */

    $videos = Video::latest('created_at')->paginate(12);

    $seconds = config('settings.cache_seconds');

    foreach($videos as $video) {
        $id = $video->id;
        $apiData = Cache::remember('youtube.video.' . $id, $seconds, function() use ($id) {
            $video = Video::find($id);
            $apiData = Youtube::getLocalizedVideoInfo($video->youtube_video_id, 'pl');

            return $apiData;
        });
    }

    return view('videos.index', compact('videos', 'seconds'));
}

    public function show($slug) {

        $seconds = config('settings.cache_seconds');
        $video = Video::where('slug', $slug)->firstOrFail();

        // Caching video
        $apiData = Cache::remember('youtube.video.' . $video->id, $seconds, function() use ($slug) {
            $video = Video::where('slug', $slug)->firstOrFail();
            $apiData = Youtube::getLocalizedVideoInfo($video->youtube_video_id, 'pl');

            return $apiData;
        });

        // Catch deleted video exception
        if (empty($apiData)) {
            abort(404);
        }

        // YT Channel caching

        $channelId = $apiData->snippet->channelId;
        $seconds = config('settings.cache_seconds');

        $channelJson = Cache::remember('youtube.channel.' . $channelId, $seconds, function () use ($channelId) {
            $channelJson = Youtube::getChannelById($channelId);
            return $channelJson;
        });

        $videos = Video::latest('created_at')->paginate(5);

        return view('videos.show', compact('apiData', 'video', 'videos', 'channelJson', 'seconds'));
    }
}
