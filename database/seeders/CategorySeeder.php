<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::factory()->count(10)->create();

        // create sub-categories
        Category::factory()->count(90)->create([
            'parent_id' => fn () => $category->random()->id]
        );
    }
}
