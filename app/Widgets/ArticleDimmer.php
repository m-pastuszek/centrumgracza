<?php

namespace App\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;

class ArticleDimmer extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Models\Article::count();
        $string = "artykułów";

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-news',
            'title'  => "{$count} {$string}",
            'text'   => __('Strona musi zawierać dużo treści!'),
            'button' => [
                'text' => __('Przejdź'),
                'link' => route('voyager.articles.index'),
            ],
            'image' => asset('storage/other/widget-backgrounds/01.jpg'),
        ]));
    }
}
