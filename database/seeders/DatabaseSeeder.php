<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder dei ruoli (admin, writer, revisor)
        $this->call(RoleSeeder::class);

        // Crea un utente admin di default
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'role_id' => 1, // admin
        ]);

        // Seeder articoli
        $this->call(ArticleSeeder::class);
    }
}
