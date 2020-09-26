<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    public function article() {
        return $this->belongsTo(Article::class);
    }
}
