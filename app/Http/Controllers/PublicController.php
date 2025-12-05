<?php

namespace App\Http\Controllers;

use App\Models\Article;

class PublicController extends Controller
{
    public function home()
    {
        $latestArticles = Article::where('is_accepted', true)
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('latestArticles'));
    }
}
