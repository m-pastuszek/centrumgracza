<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Article;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest('published_at')->where('status', 'PUBLISHED')->where('published_at', '<=', Carbon::now('Europe/Warsaw'))->paginate(10);
        $latestReview = Review::latest('published_at')->where('status', 'PUBLISHED')->where('published_at', '<=', Carbon::now('Europe/Warsaw'))->limit(1)->get();
        $articles = Article::latest('published_at')->where('status', 'PUBLISHED')->where('published_at', '<=', Carbon::now('Europe/Warsaw'))->paginate(5);
        return view('reviews.index', compact( 'reviews', 'latestReview', 'articles'));
    }

    public function show($slug) {

        $review = Review::where('slug',$slug)->firstOrFail();
        return view('reviews.show', compact('review'));
    }
}
