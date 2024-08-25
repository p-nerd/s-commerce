<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        Order::factory(5)
            ->create(['user_id' => User::first()->id])
            ->each(fn ($order) => $this->orderItems($order));

        Order::factory(10)
            ->create()
            ->each(fn ($order) => $this->orderItems($order));

        // Generate 1000 orders spread over the last year
        Order::factory()->count(10)->create()
            ->each(fn ($order) => $this->orderItems($order));

        // Generate 100 recent orders (last 30 days)
        Order::factory()->recent()->count(10)->create()
            ->each(fn ($order) => $this->orderItems($order));

        // Generate 500 completed orders
        Order::factory()->completed()->count(10)->create()
            ->each(fn ($order) => $this->orderItems($order));

        // Generate 200 orders from last year
        Order::factory()->lastYear()->count(10)->create()
            ->each(fn ($order) => $this->orderItems($order));

    }

    public function orderItems(Order $order)
    {
        OrderItem::factory(rand(1, 5))->create(['order_id' => $order->id]);
        $subtotal = $order->orderItems->sum(fn ($item) => $item->price * $item->quantity);
        $order->update([
            'subtotal' => $subtotal,
            'total' => $subtotal - ($order->discount ?? 0) + ($order->delivery ?? 0),
        ]);
    }
}
