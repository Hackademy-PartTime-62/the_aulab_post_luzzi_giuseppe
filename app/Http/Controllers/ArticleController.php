<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    // Lista articoli pubblici
    public function index()
    {
        $articles = Article::where('is_accepted', true)
            ->latest()
            ->get();

        return view('articles.index', compact('articles'));
    }

    // Mostra singolo articolo
    public function show(Article $article)
    {
        // Mostra se accettato oppure se è autore/admin/revisore
        if (
            !$article->is_accepted &&
            !Auth::user()?->is_admin &&
            !Auth::user()?->is_revisor &&
            Auth::id() !== $article->user_id
        ) {
            abort(403);
        }

        return view('articles.show', compact('article'));
    }

    // Form creazione
    public function create()
    {
        return view('articles.create');
    }

    // Salvataggio
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|min:3',
        'subtitle' => 'required|min:3',
        'body' => 'required|min:10',
        'image' => 'nullable|image'
    ]);

    $article = Article::create([
        'title' => $request->title,
        'subtitle' => $request->subtitle,
        'body' => $request->body,
        'user_id' => auth()->id(),
        'is_accepted' => null, // deve essere revisionato
    ]);

    if ($request->hasFile('image')) {
        $article->image = $request->file('image')->store('articles', 'public');
        $article->save();
    }

    return redirect()->route('articles.index')
        ->with('success', 'Articolo inviato in revisione!');
}


    // Form modifica
    public function edit(Article $article)
    {
        $this->authorizeArticle($article);

        return view('articles.edit', compact('article'));
    }

    // Aggiornamento
    public function update(Request $request, Article $article)
    {
        $this->authorizeArticle($article);

        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'body'     => 'required|string',
        ]);

        $article->update($data);

        // ogni modifica torna "in attesa" se vuoi
        $article->is_accepted = null;
        $article->save();

        return redirect()
            ->route('articles.show', $article)
            ->with('success', 'Articolo aggiornato e inviato di nuovo alla revisione.');
    }

    // Cancellazione
    public function destroy(Article $article)
    {
        $this->authorizeArticle($article);

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('success', 'Articolo eliminato.');
    }

    private function authorizeArticle(Article $article): void
    {
        if (Auth::id() !== $article->user_id && !Auth::user()->is_admin) {
            abort(403, 'Non sei autorizzato.');
        }
    }
}
