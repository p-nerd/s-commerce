<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::factory(200)->create([
            'category_id' => fn () => Category::where('featured', true)->inRandomOrder()->first()->id,
        ]);

        Product::factory(200)->create();
    }
}
