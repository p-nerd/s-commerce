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
    public function definition(): array
    {
        $name = fake()->name();

        $htmlDescription = "
            <p>{$this->faker->sentence}</p>
            <ul>
                <li>{$this->faker->sentence}</li>
                <li>{$this->faker->sentence}</li>
                <li>{$this->faker->sentence}</li>
            </ul>
            <p>{$this->faker->paragraph}</p>
        ";

        return [
            'name' => $name,
            'slug' => str()->slug($name).time().time(),
            'category_id' => Category::inRandomOrder()->first()->id,
            'price' => fake()->randomFloat(2, 10, 1000),
            'discount_price' => fake()->randomElement([null, $this->faker->randomFloat(2, 5, 500)]),
            'short_description' => fake()->sentence(),
            'type' => fake()->randomElement(ProductType::values()),
            'sku' => fake()->unique()->ean13(),
            'manufactured_date' => fake()->date(),
            'expired_date' => fake()->optional()->date(),
            'long_description' => $htmlDescription,
            'stock' => fake()->numberBetween(0, 100),
            'featured' => false,
        ];
    }
}
