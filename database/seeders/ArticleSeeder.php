<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        // Recupero un utente (admin o primo utente disponibile)
        $user = User::first() ?? User::factory()->create([
            'name' => 'Utente Demo',
            'email' => 'demo@example.com',
        ]);

        // Creazione articoli di esempio
        for ($i = 1; $i <= 6; $i++) {
            Article::create([
                'title'       => "Articolo numero $i",
                'subtitle'    => "Sottotitolo dell'articolo $i",
                'body'        => "Questo è il corpo dell'articolo numero $i, generato automaticamente.",
                'user_id'     => $user->id,

                // Alcuni articoli accettati, altri no (simula revisione reale)
                'is_accepted' => $i % 2 === 0,
            ]);
        }
    }
}
