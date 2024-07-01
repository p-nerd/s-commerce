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
        $rootCategories = Category::factory()->count(5)->create();

        // Create child categories with random parent_id
        Category::factory()->count(10)->create([
            'parent_id' => $rootCategories->random()->id,
        ]);
    }
}
