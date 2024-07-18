<?php

namespace App\Http\Controllers\Store;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethod;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'payment_method' => ['required', 'string', 'in:'.implode(',', PaymentMethod::values())],
        ]);

        $carts = $request->user()->carts()->with('product')->get();
        $subtotal = $carts->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $coupon = null;
        $discount = 0;
        if ($payload['coupon']) {
            $coupon = Coupon::where('code', $payload['coupon'])->first();
            if ($coupon) {
                $discount = $coupon->type === 'percentage'
                    ? $subtotal * ($coupon->discount / 100)
                    : $coupon->discount;
            }
        }

        $delivery = Location::where('value', $payload['district'])->first()?->price ?? 0;

        $total = $subtotal - $discount + $delivery;

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $request->user()->id,
                'coupon_id' => $coupon ? $coupon->id : null,
                'status' => OrderStatus::PENDING,
                'name' => $payload['name'],
                'phone' => $payload['phone'],
                'division' => $payload['division'],
                'district' => $payload['district'],
                'address' => $payload['address'],
                'landmark' => $payload['landmark'],
                'subtotal' => $subtotal,
                'discount' => $discount,
                'delivery' => $delivery,
                'total' => $total,
                'payment_method' => PaymentMethod::from($payload['payment_method']),
            ]);

            foreach ($carts as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            $request->user()->carts()->delete();

            DB::commit();

            return redirect()
                ->route($order->payment_method->value === 'cash-on-delivery' ? 'orders.show' : 'checkout.show', $order)
                ->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order creation failed: '.$e->getMessage());

            return back()
                ->with('error', 'There was an error processing your order. Please try again.');
        }
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

    public function show(Request $request, Order $order)
    {
        //
    }
}
