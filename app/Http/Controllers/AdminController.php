<?php

namespace App\Http\Controllers;

use App\Models\User;

class AdminController extends Controller
{
    // Elenco richieste revisore
    public function revisorRequests()
    {
        $requests = User::where('is_revisor_request', true)->get();
        return view('admin.revisor_requests', compact('requests'));
    }

    // APPROVA revisore
    public function approve(User $user)
    {
        $user->is_revisor = true;
        $user->is_revisor_request = false;
        $user->save();

        return redirect()
            ->route('admin.revisor_requests')
            ->with('success', "Richiesta di $user->name approvata.");
    }

    // RIFIUTA revisore
    public function reject(User $user)
    {
        $user->is_revisor_request = false;
        $user->save();

        return redirect()
            ->route('admin.revisor_requests')
            ->with('success', "Richiesta di $user->name rifiutata.");
    }
}
