<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Article;

class RevisorController extends Controller
{
    public function requestForm()
    {
        return view('revisor.request');
    }

    public function sendRequest(Request $request)
    {
        $request->validate([
            'message' => 'required|min:10',
        ]);

        $user = auth()->user();

        if ($user->is_revisor) {
            return redirect()->route('home')->with('error', 'Sei già un revisore');
        }

        if ($user->is_revisor_request) {
            return redirect()->route('home')->with('error', 'Hai già inviato una richiesta');
        }

        $user->is_revisor_request = true;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Richiesta inviata con successo');
    }

    public function dashboard()
    {
        $articles = Article::whereNull('is_accepted')->get();

        return view('revisor.dashboard', compact('articles'));
    }

    public function accept(Article $article)
    {
        $article->is_accepted = true;
        $article->save();

        return redirect()->back()->with('success', 'Articolo accettato');
    }

    public function reject(Article $article)
    {
        $article->is_accepted = false;
        $article->save();

        return redirect()->back()->with('success', 'Articolo rifiutato');
    }
}
