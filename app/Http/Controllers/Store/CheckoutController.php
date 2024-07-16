<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        return view('store/checkout/index', [
            'carts' => $request->user()->carts()->with('product.images')->get(),
            'total' => Cart::totalPrice(),
        ]);
    }

    public function store(Request $request)
    {
        //
    }

    public function applyCoupon(Request $request)
    {
        $payload = $request->validate([
            'coupon' => ['required', 'string'],
        ]);

        if ($payload['coupon'] !== 'shihab') {
            return response()->json([
                'message' => 'Coupon is invalid',
            ], 400);
        }

        return [
            'message' => 'Coupon applied successfully',
            'amount' => 1000,
        ];
    }
}
