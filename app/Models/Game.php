<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Game extends Model
{
    use Searchable;

    protected $table = 'games';

    public function toSearchableArray()
    {
        $record = $this->toArray();
        unset(
            $record['official_website'], $record['trailer'], $record['body'], $record['body'],
            $record['background_image'], $record['box_image'], $record['slug'], $record['video_id'],
            $record['minReq_os'], $record['minReq_cpu'], $record['minReq_ram'], $record['minReq_gpu'], $record['minReq_hdd'], $record['minReq_directx'],
            $record['recReq_os'], $record['recReq_cpu'], $record['recReq_ram'], $record['recReq_gpu'], $record['recReq_hdd'], $record['recReq_directx'],
            $record['created_at'], $record['updated_at'], $record['images'], $record['release_date']);

        if ($record['visibility'] === '0') {
            $this->unsearchable();
            return [];
        }

        return $record;
    }

    public function gameType() {
        return $this->belongsTo(GameType::class);
    }

    public function genres() {
        return $this->belongsToMany(Genre::class, 'game_genre');
    }
    public function platforms() {
        return $this->belongsToMany(Platform::class, 'game_platform');
    }
    public function modes() {
        return $this->belongsToMany(Mode::class, 'game_mode');
    }
    public function videos() {
        return $this->hasMany(Video::class);
    }
    public function review() {
        return $this->hasOne(Review::class);
    }
    public function perspectives() {
        return $this->belongsToMany(PlayerPerspective::class, 'game_player_perspective');
    }
    public function developers() {
        return $this->belongsToMany(Company::class, 'game_developer');
    }
    public function publishers()
    {
        return $this->belongsToMany(Company::class, 'game_publisher');
    }
    public function pol_publishers() {
        return $this->belongsToMany(Company::class, 'game_polish_publisher');
    }

    public function type() {
        return $this->belongsTo(GameType::class);
    }

    // Parent Game can be set when adding DLC or Edition.
    public function parentGame() {
        return $this->belongsTo(self::class, 'parent_game');
    }
    public function hasDlc() {
        return $this->hasMany(self::class, 'parent_game');
    }
}
