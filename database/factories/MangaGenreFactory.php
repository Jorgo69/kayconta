<?php

namespace Database\Factories;

use App\Models\Genre;
use App\Models\Manga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MangaGenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'manga_id' => Manga::inRandomOrder()->first()->id,
            'genre_id' => Genre::inRandomOrder()->first()->id,
        ];
    }
}
