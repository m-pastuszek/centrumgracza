<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Laravel\Scout\Searchable;
use Spatie\Feed\Feedable;
use Spatie\Feed\FeedItem;

class Review extends Model implements Feedable
{
    use Searchable;

    public function toSearchableArray()
    {
        $record = $this->toArray();

        unset(
            $record['body'], $record['created_at'], $record['updated_at'], $record['published_at'], $record['image'],
            $record['status'], $record['rating'], $record['graphics'], $record['gameplay'], $record['sounds'], $record['slug'],
            $record['positives'], $record['negatives'], $record['ending'], $record['author_id'], $record['game_id']);

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
        return Review::all();
    }

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>=', Carbon::now());
    }

    public function setPublishAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::parse($date);
    }

    public function scopeSearch($query, $s)
    {
        return $query->where('title', 'like', '%' . $s . '%')
            ->orWhere('excerpt', 'like', '%' . $s . '%')
            ->orWhere('body', 'like', '%' . $s . '%');
    }

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }
    public function platform()
    {
        return $this->belongsTo(Platform::class);
    }
}
