<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Company extends Model
{
    use Searchable;

    public function toSearchableArray()
    {
        $record = $this->toArray();
        unset($record['game_id'], $record['meta_description'], $record['slug'], $record['url']);

        return $record;
    }


    public function parent()
    {
        return $this->belongsTo(self::class);
    }

    public function developedGames(){
        return $this->belongsToMany(Game::class, 'game_developer');
    }

    public function publishedGames(){
        return $this->belongsToMany(Game::class, 'game_publisher');
    }
}
