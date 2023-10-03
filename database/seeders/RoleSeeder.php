<?php

namespace Database\Seeders;

use App\Models\User_role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User_role::create(['name' => 'User']);
        User_role::create(['name' => 'Moderator']);
        User_role::create(['name' => 'Administrator']);
    }
}
