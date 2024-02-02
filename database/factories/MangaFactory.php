<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manga>
 */
class MangaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->sentence(),
            'description' => $this->faker->text(),
            'cover_image' => 'https://via.placeholder.com/600x800.png/0022bb?text=600+',
            // 'cover_image' => $this->faker->imageUrl('public/images', 800, 600, null, false),
            'user_id' => $this->faker->numberBetween(1, 10),
            'author_id' => $this->faker->numberBetween(1, 20),
        ];

        /* Le premier paramètre spécifie le dossier de destination dans lequel l'image sera enregistrée. Dans cet exemple, nous avons utilisé le dossier "public/images".
        Le deuxième paramètre spécifie la largeur de l'image (800 pixels dans cet exemple).
        Le troisième paramètre spécifie la hauteur de l'image (600 pixels dans cet exemple).
        Le quatrième paramètre est le répertoire où se trouvent les images aléatoires à utiliser pour générer l'image. Dans cet exemple, nous utilisons null pour utiliser les images aléatoires fournies par Faker.
        Le cinquième paramètre spécifie si l'image doit être floue ou non. Dans cet exemple, nous utilisons false pour obtenir une image non floue. */

    }
}
