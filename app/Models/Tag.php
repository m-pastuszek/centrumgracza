<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function articles() {
        return $this->belongsToMany(Article::class, 'article_tag');
    }

    public function relatedArticlesByTag() {
        return Article::whereHas('tags', function ($query) {
            $articleIds = $this->articles()->pluck('article.id')->all();
            $query->whereIn('article.id', $articleIds);
        })->where('id', '<>', $this->id)->get();
    }
}
