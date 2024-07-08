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
        $category = Category::factory()->count(50)->create();

        Category::factory()->count(30)->create([
            'parent_id' => fn () => $category->random()->id,
        ]);

        Category::factory()->count(30)->create([
            'parent_id' => fn () => $category->random()->id,
        ]);

        Category::factory()->count(30)->create([
            'parent_id' => fn () => $category->random()->id,
        ]);

    }
}
