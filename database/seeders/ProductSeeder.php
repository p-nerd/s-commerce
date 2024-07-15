<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testProduct = Product::factory()->create([
            'name' => 'test-product',
            'slug' => 'test-product',
            'long_description' => '<div>Text <strong>Product</strong></div>',
        ]);
        ProductImage::factory(5)->create(['product_id' => $testProduct->id]);
        $featuredImage = $testProduct->images->random();
        $featuredImage->update(['featured' => true]);

        Product::factory(200)->create([
            'category_id' => fn () => Category::where('featured', true)->inRandomOrder()->first()->id,
        ])->each(function ($product) {
            ProductImage::factory(5)->create(['product_id' => $product->id]);
            $featuredImage = $product->images->random();
            $featuredImage->update(['featured' => true]);
        });

        Product::factory(200)->create()->each(function ($product) {
            ProductImage::factory(5)->create(['product_id' => $product->id]);
            $featuredImage = $product->images->random();
            $featuredImage->update(['featured' => true]);
        });
    }

    public function images() {}
}
