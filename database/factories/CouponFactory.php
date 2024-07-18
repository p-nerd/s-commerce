<?php

namespace Database\Factories;

use App\Enums\CouponType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => strtoupper(str()->random(10)),
            'discount' => $this->faker->randomFloat(2, 1, 100),
            'type' => $this->faker->randomElement(CouponType::values()),
            'expires_at' => $this->faker->optional()->dateTimeBetween('now', '+1 year'),
        ];
    }
}
