<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Pour creer une Factory avec son model cibler
        // php artisan make:factory NameFactory --model=ModelName

        
        // Pour creer un Seeder
        // php artisan make:seeder NameSeeder


        // Pour peuple une table specifique
        // php artisan db:seed --class=TableNameSeeder


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
