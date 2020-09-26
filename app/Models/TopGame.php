<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopGame extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'top_games';

    protected $primaryKey = 'place';

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
