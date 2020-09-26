<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Game;
use App\Models\Review;
use App\Models\Video;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request) {

        $searchKey = $request->input('q');

        $articles = Article::search($searchKey)->orderBy('published_at', 'desc')->get();
        $games = Game::search($searchKey)->orderBy('release_date', 'desc')->get();
        $reviews = Review::search($searchKey)->orderBy('published_at', 'desc')->get();
        $videos = Video::search($searchKey)->orderBy('updated_at', 'desc')->get();

        return view('pages.search', compact('articles', 'games', 'reviews', 'videos', 'searchKey'));
    }
}