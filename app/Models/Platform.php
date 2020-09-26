<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    public function games() {
        return $this->belongsToMany(Game::class, 'game_platform');
    }

    public function reviews() {
        return $this->belongsTo(Review::class, 'platform_id');
    }
}
