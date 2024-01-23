<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::factory(5)->create();
        User::create([
            'name' => 'admin',
            'username' => 'test',
            'email' => 'admin@example.com',
            'image' => 'default_image.webp',
            'password' => bcrypt('password'), // Don't forget to hash the password
            'role_id' => 3, // Assuming 'role' is used to represent user roles
        ]);
    }
}
