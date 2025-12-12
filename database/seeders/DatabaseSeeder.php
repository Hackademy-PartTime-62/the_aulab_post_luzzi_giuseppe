<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // CREA UN UTENTE ADMIN
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'is_revisor' => true,
            'is_revisor_request' => false,
        ]);

        // CREA UN UTENTE NORMALE
        User::create([
            'name' => 'User Demo',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
            'is_revisor' => false,
            'is_revisor_request' => false,
        ]);

        // SEEDER DEGLI ARTICOLI
        $this->call([
            ArticleSeeder::class,
        ]);
    }
}
