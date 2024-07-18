<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function items()
    {
        $items = static::with('product.images')->where('user_id', Auth::id())->get();

        return collect($items)->map(fn ($item) => [
            'id' => $item->id,
            'productSlug' => $item->product->slug,
            'featuredImage' => $item->product->featuredImage()->url,
            'productName' => substr($item->product->name, 0, 15).'...',
            'quantity' => $item->quantity,
            'price' => $item->product->discount_price ?? $item->product->price,
            'product_id' => $item->product_id,
        ])->toArray();
    }

    public static function quantity()
    {
        return static::where('user_id', Auth::id())->sum('quantity');
    }

    public static function price()
    {
        $total = 0;
        foreach (static::items() as $item) {
            $price = isset($item['price']) ? $item['price'] : 0;
            $total += ($price * $item['quantity']);
        }

        return $total;
    }

    public static function totalPrice()
    {
        return static::price() + static::shippingPrice();
    }

    public static function shippingPrice()
    {
        return 0;
    }

    public static function productQuantity($productId)
    {
        $cart = static::where('user_id', Auth::id())->where('product_id', $productId)->first();
        if (! $cart) {
            return 0;
        }

        return $cart->quantity;
    }
}
