<?php

namespace App\Http\Controllers;

use App\Models\FeaturedVideo;
use App\Models\Slider;
use App\Models\Article;
use App\Models\TopGame;
use App\Models\Video;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;

class IndexController extends Controller
{
    // Kontroler strony głównej
    public function index()
    {
        $sliders = Slider::latest('created_at')->get();
        $articles = Article::latest('published_at')->where('status', 'PUBLISHED')->where('published_at', '<=', Carbon::now('Europe/Warsaw'))->paginate(4);
        $topGames = TopGame::orderBy('place')->get();
        $videos = Video::latest('created_at')->limit(3)->get();
        $reviews = Review::latest('published_at')->where('status', 'PUBLISHED')->paginate(3);

        $featured_video = FeaturedVideo::all();

        return view('pages.index', compact(
            'sliders', 'articles', 'topGames',
            'featured_video', 'videos', 'reviews'));
    }

    public function aboutUs() {
        $editors = User::where('role_id', 3)->get();

        return view('pages.our-team', compact('editors'));
    }
}
