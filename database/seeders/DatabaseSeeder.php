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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ShoutBoxSeeder::class,
            CategorySeeder::class,
            SubCategorySeeder::class,
            ThreadSeeder::class,

            // Add more seeders if needed
        ]);
    }
}
