<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create root categories
        $category = Category::factory()->count(5)->create();

        Category::factory()->count(3)->create([
            'parent_id' => $category->random()->id,
        ]);

        Category::factory()->count(3)->create([
            'parent_id' => $category->random()->id,
        ]);

        Category::factory()->count(3)->create([
            'parent_id' => $category->random()->id,
        ]);

    }
}
