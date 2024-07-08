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
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'discount_price' => $this->faker->randomElement([null, $this->faker->randomFloat(2, 5, 500)]),
            'short_description' => $this->faker->sentence,
            'type' => $this->faker->randomElement(ProductType::values()),
            'sku' => $this->faker->unique()->ean13,
            'manufactured_date' => $this->faker->date(),
            'expired_date' => $this->faker->optional()->date(),
            'long_description' => $this->faker->paragraph,
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
