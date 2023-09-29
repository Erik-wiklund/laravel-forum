<?php

namespace Database\Seeders;

use App\Models\Thread;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Thread::create([
            'title' => 'Thread Title 1',
            'content' => 'Thread content for the first thread.',
            'sub_category_id' => 1, // Replace with the actual subcategory ID
        ]);
        Thread::create([
            'title' => 'Thread Title 3',
            'content' => 'Thread content for the first thread.',
            'sub_category_id' => 1, // Replace with the actual subcategory ID
        ]);
        Thread::create([
            'title' => 'Thread Title 4',
            'content' => 'Thread content for the first thread.',
            'sub_category_id' => 1, // Replace with the actual subcategory ID
        ]);

        Thread::create([
            'title' => 'Thread Title 2',
            'content' => 'Thread content for the second thread.',
            'sub_category_id' => 2, // Replace with the actual subcategory ID
        ]);
    }
}
