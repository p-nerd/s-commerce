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
}
