<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Artykuł
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Powiązane artykuły
        $relatedArticles = Article::whereHas('tags', function ($q) use ($article) {
            return $q->whereIn('name', $article->tags->pluck('name'));
        })
            ->where('id', '!=', $article->id)->orderBy('published_at')
            ->limit(3)->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function index($category_slug, Request $request)
    {

        $category = Category::where('slug', $category_slug)->firstOrFail();

        $articles = $category->articles()->
        where('status', 'PUBLISHED')->
        where('published_at', '<=', Carbon::now('Europe/Warsaw'))->
        latest('published_at')->paginate(10);
        // Popularne tagi
        $popularTags = DB::table('article_tag')
            ->select(DB::raw('count(tag_id) as repetition, tag_id'))
            ->groupBy('tag_id')
            ->orderBy('repetition', 'desc')
            ->limit(10)
            ->get();

        $tagsDecoded = json_decode($popularTags, true);

        $tags = Tag::find($tagsDecoded);


        return view('articles.index',compact('category', 'articles', 'tags'));

    }
}
