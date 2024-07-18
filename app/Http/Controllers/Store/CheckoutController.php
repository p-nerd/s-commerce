<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Location;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        if (! count($request->user()->carts)) {
            return to_route('products');
        }

        $divisions = Location::query()
            ->with('districts')
            ->where('division_id', null)
            ->get();

        return view('store/checkout/index', [
            'carts' => $request->user()->carts()->with('product.images')->get(),
            'subtotal' => Cart::totalPrice(),
            'divisions' => $divisions,
        ]);
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'coupon' => ['nullable', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15', 'regex:/^\d+$/'],
            'division' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'payment_method' => ['required', 'in:online-getway,cash-on-delivery'],
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
            'amount' => 15,
        ];
    }
}
