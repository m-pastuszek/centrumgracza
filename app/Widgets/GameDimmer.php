<?php

namespace App\Widgets;

use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Widgets\BaseDimmer;


class GameDimmer extends BaseDimmer
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
        $count = \App\Models\Game::count();
        $string = "gier";

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-controller',
            'title'  => "{$count} {$string}",
            'text'   => __('Stale dodawaj nowe pozycje do bazy!'),
            'button' => [
                'text' => __('Przejdź'),
                'link' => route('voyager.games.index'),
            ],
            'image' => asset('storage/other/widget-backgrounds/03.jpg'),
        ]));
    }
}
