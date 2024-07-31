<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // create a product
        $testProduct = Product::factory()->create([
            'name' => 'test-product',
            'slug' => 'test-product',
            'long_description' => '<div>Text <strong>Product</strong></div>',
        ]);
        ProductImage::factory(5)->create([
            'product_id' => $testProduct->id]
        );
        $testProduct->images->random()->update([
            'featured' => true,
        ]);

        // create products with featured categories
        $featuredCategories = Category::where('featured', true);
        $featuredCategoryId = fn () => $featuredCategories->inRandomOrder()->first()->id;
        Product::factory(200)->create(['category_id' => $featuredCategoryId()])->each(function ($product) {
            ProductImage::factory(5)->create(['product_id' => $product->id]);
            $product->images->random()->update(['featured' => true]);
        });

        // create normal products
        Product::factory(200)->create()->each(function ($product) {
            ProductImage::factory(5)->create(['product_id' => $product->id]);
            $product->images->random()->update(['featured' => true]);
        });
    }
}
