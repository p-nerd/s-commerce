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
        $payload = $request->validate([
            'coupon' => ['nullable', 'string'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'address2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zip' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15', 'regex:/^\d+$/'],
            'payment_option' => ['required', 'in:online-getway,cash-on-delivery'],
        ]);

        dd($payload);
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
