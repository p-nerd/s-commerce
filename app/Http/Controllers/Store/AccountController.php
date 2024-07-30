<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

use function Spatie\LaravelPdf\Support\pdf;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        return view('store/account/index', [
            'user' => $user,
        ]);
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

        return pdf()
            ->view('store/account/invoice', ['order' => $order])
            ->name("invoice-#{$order->id}.pdf");
    }

    public function addresses(Request $request)
    {
        $user = $request->user();

        return view('store/account/addresses', [
            'user' => $user,
        ]);
    }

    public function addressesBillingEdit(Request $request)
    {
        $user = $request->user();

        $divisions = Location::query()
            ->with('districts')
            ->where('division_id', null)
            ->get();

        return view('store/account/billing-edit', [
            'user' => $user,
            'divisions' => $divisions,
        ]);
    }

    public function addressesBillingUpdate(Request $request)
    {
        $user = $request->user();

        $payload = $request->validate([
            'phone' => ['required', 'string'],
            'division' => ['required', 'string'],
            'district' => ['required', 'string'],
            'address' => ['required', 'string'],
        ]);

        $user->update($payload);

        return redirect()
            ->route('account.addresses')
            ->with('success', 'Billing address updated successfully');
    }

    public function addressesShippingEdit(Request $request)
    {
        $user = $request->user();

        $divisions = Location::query()
            ->with('districts')
            ->where('division_id', null)
            ->get();

        return view('store/account/shipping-edit', [
            'user' => $user,
            'divisions' => $divisions,
        ]);
    }

    public function addressesShippingUpdate(Request $request)
    {
        $user = $request->user();

        $payload = $request->validate([
            'phone' => ['required', 'string'],
            'division' => ['required', 'string'],
            'district' => ['required', 'string'],
            'address' => ['required', 'string'],
            'landmark' => ['nullable', 'string'],
        ]);

        $user->update([
            'shipping_phone' => $payload['phone'],
            'shipping_division' => $payload['division'],
            'shipping_district' => $payload['district'],
            'shipping_address' => $payload['address'],
            'shipping_landmark' => $payload['landmark'],
        ]);

        return redirect()
            ->route('account.addresses')
            ->with('success', 'Shipping address updated successfully');
    }

    public function details(Request $request)
    {
        $user = $request->user();

        return view('store/account/details', [
            'user' => $user,
        ]);
    }

    public function detailsUpdate(Request $request)
    {
        $user = $request->user();

        $payload = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'string'],
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $user->update($payload);

        return redirect()
            ->route('account.details')
            ->with('success', 'Details updated successfully');
    }
}
