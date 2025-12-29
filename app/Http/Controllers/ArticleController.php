<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    /**
     * Lista articoli pubblici (solo accettati)
     */
    public function index()
    {
        $articles = Article::where('is_accepted', true)
            ->latest()
            ->get();

        return view('articles.index', compact('articles'));
    }

    /**
     * Mostra singolo articolo
     */
    public function show(Article $article)
    {
        // Se non è accettato, può vederlo solo autore o admin/revisore
        if (
            $article->is_accepted !== true &&
            Auth::id() !== $article->user_id &&
            !Auth::user()?->is_admin &&
            !Auth::user()?->is_revisor
        ) {
            abort(403);
        }

        return view('articles.show', compact('article'));
    }

    /**
     * Form creazione articolo
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Salvataggio articolo
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    => 'required|min:3',
            'subtitle' => 'required|min:3',
            'body'     => 'required|min:10',
            'image'    => 'nullable|image',
        ]);

        $article = Article::create([
            'title'       => $request->title,
            'subtitle'    => $request->subtitle,
            'body'        => $request->body,
            'user_id'     => Auth::id(),
            'is_accepted' => null, // sempre in revisione
        ]);

        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
            $article->save();
        }

        return redirect()
            ->route('articles.index')
            ->with('success', 'Articolo inviato in revisione!');
    }

    /**
     * Form modifica
     */
    public function edit(Article $article)
    {
        $this->authorizeArticle($article);

        return view('articles.edit', compact('article'));
    }

    /**
     * Aggiornamento articolo
     */
    public function update(Request $request, Article $article)
    {
        $this->authorizeArticle($article);

        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'body'     => 'required|string',
        ]);

        $article->update($data);

        // Torna in revisione dopo modifica
        $article->is_accepted = null;
        $article->save();

        return redirect()
            ->route('articles.show', $article)
            ->with('success', 'Articolo aggiornato e inviato di nuovo alla revisione.');
    }

    /**
     * Eliminazione articolo
     */
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

    /**
     * Controllo autorizzazione autore/admin
     */
    private function authorizeArticle(Article $article): void
    {
        if (Auth::id() !== $article->user_id && !Auth::user()?->is_admin) {
            abort(403);
        }
    }
}
