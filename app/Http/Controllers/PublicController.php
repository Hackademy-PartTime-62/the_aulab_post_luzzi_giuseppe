<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Support\Facades\Schema;

class PublicController extends Controller
{
    public function home()
    {
        // Se la colonna 'is_accepted' NON esiste (es. migrations non eseguite),
        // mostro semplicemente gli ultimi 3 articoli senza filtro.
        if (!Schema::hasColumn('articles', 'is_accepted')) {
            $latestArticles = Article::latest()
                ->take(3)
                ->get();
        } else {
            $latestArticles = Article::where('is_accepted', true)
                ->latest()
                ->take(3)
                ->get();
        }

        return view('home', compact('latestArticles'));
    }
}
