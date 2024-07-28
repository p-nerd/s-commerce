<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Order;

class AccountController extends Controller
{
    public function index()
    {
        return view('store/account/index');
    }

    public function orders()
    {
        $orders = Order::with('orderItems')->get();

        return view('store/account/orders', [
            'orders' => $orders,
        ]);
    }

    public function ordersShow(Order $order)
    {
        $order = Order::with('orderItems.product', 'coupon')->find($order->id);

        return view('store/account/order', [
            'order' => $order,
        ]);
    }

    public function ordersInvoice(Order $order)
    {
        $order = Order::with('orderItems.product', 'coupon')->find($order->id);

        return view('store/account/invoice', [
            'order' => $order,
        ]);
    }

    public function addresses()
    {
        return view('store/account/addresses');
    }

    public function details()
    {
        return view('store/account/details');
    }
}
