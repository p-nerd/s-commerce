<?php

namespace Database\Factories;

use App\Enums\ProductType;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->name;
        $slug = str()->slug($name);

        return [
            'name' => $name,
            'slug' => $slug,
            'category_id' => Category::inRandomOrder()->first()->id,
            'price' => fake()->randomFloat(2, 10, 1000),
            'discount_price' => fake()->randomElement([null, $this->faker->randomFloat(2, 5, 500)]),
            'short_description' => fake()->sentence,
            'type' => fake()->randomElement(ProductType::values()),
            'sku' => fake()->unique()->ean13,
            'manufactured_date' => fake()->date(),
            'expired_date' => fake()->optional()->date(),
            'long_description' => fake()->paragraph,
            'stock' => fake()->numberBetween(0, 100),
            'featured' => fake()->boolean(),
        ];
    }
}
