<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        return view('store/cart/index', [
            'carts' => $request->user()->carts()->with('product.images')->get(),
            'price' => Cart::price(),
            'totalPrice' => Cart::totalPrice(),
            'shippingPrice' => Cart::shippingPrice(),
        ]);
    }

    public function store(Request $request)
    {
        $payload = $request->validate([
            'product_id' => ['required'],
            'quantity' => ['nullable', 'integer', 'min:1'],
            'addQuantity' => ['nullable', 'integer', 'min:1'],
        ]);

        $cart = Cart::where('product_id', $payload['product_id'])->first();
        if (! $cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $payload['product_id'],
                'quantity' => $payload['quantity'] ?? $payload['addQuantity'] ?? 1,
            ]);
        } else {
            $quantity = $payload['quantity'] ?? ($cart->quantity + ($payload['addQuantity'] ?? 1));
            $cart->update([
                'quantity' => $quantity,
            ]);
        }

        return $this->renderCartDropdown();
    }

    public function update(Request $request)
    {
        $payload = $request->validate([
            'carts' => ['required', 'array'],
            'carts.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'carts.*.quantity' => ['required', 'integer', 'min:1'],
        ]);

        foreach ($payload['carts'] as $cartItem) {
            $cart = Cart::where('product_id', $cartItem['product_id'])
                ->where('user_id', auth()->id())
                ->first();
            if ($cart) {
                $cart->quantity = $cartItem['quantity'];
                $cart->save();
            }
        }

        return $this->renderCartDropdown();
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        if ($cart) {
            $cart->delete();
        }

        return $this->renderCartDropdown();
    }

    protected function renderCartDropdown()
    {

        $quantity = Cart::quantity();
        header("X-Cart-Items-Quantity: {$quantity}");

        return view('store/cart/cart-dropdown', [
            'items' => Cart::items(),
            'price' => Cart::price(),
        ]);

    }
}
