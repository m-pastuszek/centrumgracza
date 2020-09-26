<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Article;
use App\Models\Review;

class UserController extends Controller
{
    public function showRedactor($username)
    {
        $user = User::where('username', $username)->where('role_id', 3)->firstOrFail();
        $userId = $user->id;

        $editors = User::where('username', '!=', $username)->where('role_id', 3)->orderBy('first_name', 'asc')->get();

        $articles = Article::latest('published_at')->where('author_id', $userId)->published()->where('status', 'PUBLISHED')->limit(6)->get();
        $reviews = Review::latest('published_at')->where('author_id', $userId)->published()->where('status', 'PUBLISHED')->limit(6)->get();

        return view('profiles.redactor', compact('user', 'editors', 'articles', 'reviews'));
    }
}
