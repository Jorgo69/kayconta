<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MangaGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crée 50 enregistrements dans la table pivot "genre_manga"
        for ($i = 0; $i < 50; $i++) {
            DB::table('manga_genres')->insert([
                'manga_id' => rand(1, 30), // Remplacez 20 par l'ID maximal de la table "mangas"
                'genre_id' => rand(1, 6), // Remplacez 10 par l'ID maximal de la table "genres"
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
