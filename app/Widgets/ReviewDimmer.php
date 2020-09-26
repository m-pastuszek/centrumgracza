<?php

namespace App\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;


class ReviewDimmer extends BaseDimmer
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
        $count = \App\Models\Review::count();
        $string = "recenzji";

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-thumbs-up',
            'title'  => "{$count} {$string}",
            'text'   => __('Czy poleciłbyś nową grę Czytelnikom?'),
            'button' => [
                'text' => __('Przejdź'),
                'link' => route('voyager.reviews.index'),
            ],
            'image' => asset('storage/other/widget-backgrounds/02.jpg'),
        ]));
    }
}
