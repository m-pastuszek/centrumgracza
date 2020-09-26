<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Platform;
use App\Models\Tag;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Indeks gier
    public function index(Request $request) {
        $games = Game::latest('release_date')->where('visibility', 1)->paginate(15);
        $platforms = Platform::all();
        $data = $request->all();

        if ($request->has('platform')) {
            $platform = Platform::where('slug', $request->platform)->firstOrFail();
            $games = Game::latest('release_date')->where('visibility', '1')->whereHas('platforms', function($query) use ($platform) {
                $query->where('platform_id', $platform->id);
            })->paginate(15);

            return view('games.index', compact('games', 'platform', 'platforms', 'data'));
        }
        else
        {
            return view('games.index', compact('games', 'platforms', 'data'));

        }
    }

    // Wyświetlanie gry
    public function show($slug)
    {
        $game = Game::where('slug', $slug)->where('visibility', 1)->firstOrFail();
        $videos = Game::find($game->id)->videos()->latest('created_at')->paginate(9);
        $review = Game::find($game->id)->review();

        $images = json_decode($game->images);

        // Artykuły powiązane z tagiem takim samym jak nazwa gry
        $tag = Tag::where('slug', $slug)->first();
        if (!$tag) {
            return view('games.show', compact('game', 'videos', 'review', 'images'));
        }
        else {
            $articles = $tag->articles()->latest('published_at')->paginate(4);
            return view('games.show', compact('game', 'videos', 'review', 'images', 'articles'));
        }

    }
}
