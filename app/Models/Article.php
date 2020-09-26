<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;
use Carbon\Carbon;
use TCG\Voyager\Models\Category;
use Laravel\Scout\Searchable;
use TCG\Voyager\Traits\Resizable;


class Article extends Model implements Feedable
{
    use Searchable;
    use Resizable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'articles';


    public function toSearchableArray()
    {
        $record = $this->toArray();
        unset($record['body'], $record['meta_description'], $record['author_id'], $record['category_id'], $record['created_at'], $record['updated_at']);

        // Jeśli artykuł jest w wersji roboczej - nie indeksuj.
        if ($record['status'] === 'DRAFT') {
            $this->unsearchable();
            return [];
        }
        // Jeśli artykuł oczekuje na korektę - nie indeksuj.
        if ($record['status'] === 'PENDING') {
            $this->unsearchable();
            return [];
        }
        return $record;
    }

    public function toFeedItem()
    {
        return FeedItem::create()
            ->id($this->id)
            ->title($this->name)
            ->image($this->image)
            ->summary($this->excerpt)
            ->updated($this->updated_at)
            ->link($this->slug)
            ->author($this->author->FullName);
    }


    public static function getFeedItems()
    {
        return Article::all();
    }

    public function scopePublished($query) {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query) {
        $query->where('published_at', '>=', Carbon::now());
    }

    public function setPublishAttribute($date) {
        $this->attributes['published_at'] = Carbon::parse($date);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function author() {
        return $this->belongsTo(User::class);
    }

    public function sliders() {
        return $this->belongsTo(Slider::class);
    }
}
