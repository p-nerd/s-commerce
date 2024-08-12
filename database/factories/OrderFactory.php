<?php

namespace Database\Factories;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 10, 1000);
        $discount = fake()->randomFloat(2, 0, $subtotal * 0.2);
        $delivery = fake()->randomFloat(2, 5, 20);

        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'coupon_id' => fake()->optional() ? Coupon::inRandomOrder()->first()->id : null,
            'name' => fake()->name,
            'email' => fake()->safeEmail,
            'phone' => fake()->numerify('##########'),
            'division' => fake()->state,
            'district' => fake()->city,
            'address' => fake()->address,
            'landmark' => fake()->optional()->sentence(3),
            'payment_method' => fake()->randomElement(PaymentMethod::values()),
            'subtotal' => $subtotal,
            'discount' => $discount,
            'delivery' => $delivery,
            'total' => $subtotal - $discount + $delivery,
            'paid' => fake()->boolean(80),
            'bank_tran_id' => fake()->optional()->uuid,
            'status' => fake()->randomElement(OrderStatus::values()),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => function (array $attributes) {
                return $this->faker->dateTimeBetween($attributes['created_at'], 'now');
            },
        ];
    }

    public function recent()
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
            ];
        });
    }

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => OrderStatus::DELIVERED->value,
                'paid' => true,
            ];
        });
    }

    public function lastYear()
    {
        return $this->state(function (array $attributes) {
            return [
                'created_at' => $this->faker->dateTimeBetween('-1 year', '-1 day'),
            ];
        });
    }
}
