<?php

namespace App\Http\Controllers;

use App\Models\Article;

class PublicController extends Controller
{
    /**
     * Homepage
     */
    public function home()
    {
        // Mostra solo articoli ACCETTATI
        // Gestisce correttamente anche DB vuoto
        $latestArticles = Article::whereNotNull('is_accepted')
            ->where('is_accepted', true)
            ->latest()
            ->take(3)
            ->get();

        return view('home', compact('latestArticles'));
    }

    /**
     * Lista di tutti gli articoli accettati
     */
    public function articles()
    {
        $articles = Article::whereNotNull('is_accepted')
            ->where('is_accepted', true)
            ->latest()
            ->get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Dettaglio singolo articolo
     */
    public function show(Article $article)
    {
        // Sicurezza: se l'articolo non è accettato → 404
        if ($article->is_accepted !== true) {
            abort(404);
        }

        return view('articles.show', compact('article'));
    }
}
