<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Se la tabella non ha la colonna is_accepted, evitiamo errori
        $hasAccepted = Schema::hasColumn('articles', 'is_accepted');

        $user = User::first() ?? User::factory()->create([
            'name' => 'Utente Demo',
            'email' => 'demo@example.com',
        ]);

        for ($i = 1; $i <= 6; $i++) {
            Article::create([
                'title' => "Articolo numero $i",
                'subtitle' => "Sottotitolo dell'articolo $i",
                'body' => "Questo è il corpo dell'articolo numero $i, generato automaticamente.",
                'user_id' => $user->id,
                'is_accepted' => $hasAccepted ? ($i % 2 === 0 ? true : null) : null,
            ]);
        }
    }
}
