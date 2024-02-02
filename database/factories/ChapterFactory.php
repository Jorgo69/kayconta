<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Manga;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapiter>
 */
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     // Variable statique pour suivre le numéro de chapitre
    protected static $currentChapterNumber = 1;

    public function definition(): array
    {
        return [
            'manga_id' => Manga::inRandomOrder()->first()->id,
            'author_id' => Author::inRandomOrder()->first()->id,
            'chapter_number'=> self::$currentChapterNumber++,
            'title'=> $this->faker->text(),
            // 'content'=> $this->faker->imageUrl('public/chapitres', 2400, 1600, 'jpg', false),
            'content' => 'https://via.placeholder.com/2400x1600.jpg/0022bb?text=600+',
        ];
    }
}
