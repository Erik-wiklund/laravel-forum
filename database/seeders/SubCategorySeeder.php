<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::create(['title' => 'Introduction', 'category_id' => 1]); // Associate with Category 1
        Subcategory::create(['title' => 'News', 'category_id' => 1]); // Associate with Category 1
        Subcategory::create(['title' => 'Games', 'category_id' => 2]); // Associate with Category 2
    }
}
