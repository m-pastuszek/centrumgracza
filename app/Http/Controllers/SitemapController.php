<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Review;
use App\Models\Game;
use App\Models\Video;

class SitemapController extends Controller
{
    public function index()
    {
        $article = Article::where('status', 'PUBLISHED')->orderBy('updated_at', 'desc')->first();
        $review = Review::where('status', 'PUBLISHED')->orderBy('updated_at', 'desc')->first();
        $game = Game::where('visibility', '1')->orderBy('updated_at', 'desc')->first();
        $video = Video::orderBy('updated_at', 'desc')->first();

        return response()->view('sitemap.index', [
            'article' => $article,
            'review' => $review,
            'game' => $game,
            'video' => $video,
        ])->header('Content-Type', 'text/xml');
    }


    public function articles()
    {
        $articles = Article::where('status', 'PUBLISHED')->orderBy('published_at', 'desc')->get();
        return response()->view('sitemap.articles', [
            'articles' => $articles,
        ])->header('Content-Type', 'text/xml');
    }

    public function reviews()
    {
        $reviews = Review::where('status', 'PUBLISHED')->orderBy('published_at', 'desc')->get();
        return response()->view('sitemap.reviews', [
            'reviews' => $reviews,
        ])->header('Content-Type', 'text/xml');
    }

    public function games()
    {
        $games = Game::where('visibility', '1')->orderBy('name', 'desc')->get();
        return response()->view('sitemap.games', [
            'games' => $games,
        ])->header('Content-Type', 'text/xml');
    }

    public function videos()
    {
        $videos = Video::orderBy('created_at', 'desc')->get();
        return response()->view('sitemap.videos', [
            'videos' => $videos,
        ])->header('Content-Type', 'text/xml');
    }
}
