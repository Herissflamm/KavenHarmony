<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\StateSeeder;
use Database\Seeders\CategoriesSeeder;
use Database\Seeders\StatusSeeder;
use Database\Seeders\TypeSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            CategoriesSeeder::class,
            StateSeeder::class,
            StatusSeeder::class,
            TypeSeeder::class,
            FrequencySeeder::class,
        ]);
    }
}
