<?php

namespace App\Providers;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        /*
         * Wyświetlanie popularnych tagów w stopce
         * @return $view
         */

        View::composer('layouts.app', function($view) {
            // Popularne tagi
            $popularTags = DB::table('article_tag')
                ->select(DB::raw('count(tag_id) as repetition, tag_id'))
                ->groupBy('tag_id')
                ->orderBy('repetition', 'desc')
                ->limit(10)
                ->get();

            $tagsDecoded = json_decode($popularTags, true);

            $tags = Tag::find($tagsDecoded);

            $view->with('tags', $tags);
        });
    }
}
