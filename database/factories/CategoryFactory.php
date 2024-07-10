<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->words(2, true);

        return [
            'name' => ucfirst($name),
            'parent_id' => null,
            'description' => fake()->paragraph,
            'slug' => str()->slug($name.'-'.fake()->randomNumber()),
            'featured' => fake()->boolean,
            'image' => fake()->imageUrl(),
        ];
    }
}
