<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index() {
        $tags = Tag::orderBy('name', 'asc')->get();
        return view('tags.index', compact('tags'));
    }

    public function show($slug) {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        $articles = $tag->articles()->paginate(8);

        $popularTags = DB::table('article_tag')
            ->select(DB::raw('count(tag_id) as repetition, tag_id'))
            ->groupBy('tag_id')
            ->orderBy('repetition', 'desc')
            ->limit(10)
            ->get();

        $tagsDecoded = json_decode($popularTags, true);

        $tags = Tag::find($tagsDecoded);

        return view('tags.show', compact('tag', 'articles', 'tags'));
    }
}
