<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Video extends Model
{
    use Searchable;

    protected $table = 'videos';

    public function toSearchableArray()
    {
        $record = $this->toArray();

        unset(
            $record['youtube_video_id'], $record['slug']
        );

        return $record;
    }

    public function game() {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }

    public function getYoutubeVideoId() {
        return  $this->youtube_video_id;
    }

}
