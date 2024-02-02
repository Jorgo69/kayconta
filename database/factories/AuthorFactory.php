<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->name(),
            'prenom' => $this->faker->lastName(),
            'pseudo' => $this->faker->userName(),
            'numero' => $this->faker->phoneNumber(),
            'email' => $this->faker->unique()->safeEmail(),
            'localisation' => $this->faker->country(),
        ];
    }
}
