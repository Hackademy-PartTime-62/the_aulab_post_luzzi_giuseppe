<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        for ($i = 1; $i <= 10; $i++) {
            Article::create([
                'title' => "Articolo numero $i",
                'subtitle' => "Questo è il sottotitolo dell'articolo $i",
                'body' => "Questo è un testo di esempio per l'articolo numero $i. Puoi modificarlo quando vuoi.",
                'image' => null,
                'user_id' => $user->id,
            ]);
        }
    }
}
