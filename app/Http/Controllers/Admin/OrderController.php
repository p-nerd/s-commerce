<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Events\OrderCompleted;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::query()
            ->with(['user', 'coupon'])
            ->when(
                $request->query('search'),
                function ($query, $search) {
                    $query->where(function ($subQuery) use ($search) {
                        $subQuery->where('id', 'like', '%'.$search.'%')
                            ->orWhere('email', 'like', '%'.$search.'%')
                            ->orWhere('name', 'like', '%'.$search.'%');
                    });
                }
            )
            ->orderBy(
                $request->query('sort_by', 'created_at'),
                $request->query('order', 'desc')
            )
            ->paginate(
                $request->query('per_page', 6)
            )
            ->withQueryString();

        return view('admin/orders/index', [
            'orders' => $orders,
            'statuses' => OrderStatus::options(),
        ]);
    }

    public function show(Order $order)
    {
        return view('admin/orders/show', [
            'order' => $order,
            'user' => $order->user,
            'coupon' => $order->coupon,
            'orderItems' => $order->orderItems,
            'statuses' => OrderStatus::options(),
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $payload = $request->validate([
            'status' => ['nullable', Rule::enum(OrderStatus::class)],
        ]);

        $order->fill($payload)->save();

        if ($payload['status'] === OrderStatus::DELIVERED->value) {
            event(new OrderCompleted(Order::with('orderItems.product')->find($order->id)));
        }

        return message(['success' => 'Order updated successfully']);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return message(['success' => 'Order deleted successfully']);

    }
}
