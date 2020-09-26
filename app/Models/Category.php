<?php

namespace App\Models;

use TCG\Voyager\Models\Category as VoyagerCategory;

class Category extends VoyagerCategory
{
    public function articles()
    {
        return $this->hasMany(Article::class)
            ->published()
            ->orderBy('published_at', 'DESC');
    }
}
