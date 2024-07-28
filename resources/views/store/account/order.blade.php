<x-account-layout>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="invoice-title-1">Order Details</h3>
                    <p class="invoice-addr-1">
                        <strong>Order: </strong>#{{ $order->id }} <br />
                        <strong>Placed on:
                        </strong>{{ $order->created_at->format('d M Y h:m:s') }}<br />
                        <strong>Payment method: </strong>{{ $order->payment_method }}<br />
                        <strong>Is Paid: </strong>{{ $order->paid ? 'Yes' : 'No' }}<br />
                        <strong>Bank tran id: </strong>{{ $order->bank_tran_id }}<br />
                        @if ($order->coupon)
                            <strong>Used Coupon: </strong>{{ $order->coupon->code }}<br />
                        @endif
                        <strong>Status:</strong> <span class="text-brand">{{ ucwords($order->status->value) }}</span>
                    </p>
                </div>
                <div class="col-sm-6">
                    <h3 class="invoice-title-1">Shipping Address</h3>
                    <p class="invoice-addr-1">
                        <strong>{{ $order->name }}</strong> <br />
                        @if ($order->landmark)
                            {{ $order->landmark }}<br />
                        @endif
                        {{ $order->address }}<br />
                        {{ $order->district }}, {{ $order->division }}<br />
                        <strong>Phone: </strong>{{ $order->phone }} <br />
                        <strong>Email: </strong>{{ $order->user->email }} <br />
                    </p>
                </div>
            </div>
            <div class="table-responsive mt-4">
                <h3 class="invoice-title-1">Order Items</h3>
                <table class="table-striped invoice-table table">
                    <thead class="bg-active">
                        <tr>
                            <th>name</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->orderItems as $orderItem)
                            <tr>
                                <td> {{ $orderItem->product->name }}</td>
                                <td class="text-center">৳{{ $orderItem->price }}</td>
                                <td class="text-center">{{ $orderItem->quantity }}</td>
                                <td class="text-right">৳{{ $orderItem->price * $orderItem->quantity }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="f-w-600 text-end">SubTotal</td>
                            <td class="text-right">৳{{ $order->subtotal }}</td>
                        </tr>
                        @if ($order->discount)
                            <tr>
                                <td colspan="3" class="f-w-600 text-end">Discount</td>
                                <td class="text-right">- ৳{{ $order->discount }}</td>
                            </tr>
                        @endif
                        @if ($order->delivery)
                            <tr>
                                <td colspan="3" class="f-w-600 text-end">Delivery</td>
                                <td class="text-right">+ ৳{{ $order->delivery }}</td>
                            </tr>
                        @endif

                        <tr>
                            <td colspan="3" class="f-w-600 text-end">Grand Total</td>
                            <td class="f-w-600 text-right">৳{{ $order->total }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <a href="{{ route('account.orders') }}" class="btn btn-danger" style="background-color: var(--bs-dark);">
                Go Back
            </a>
            <a class="btn" href="{{ route('account.orders.invoice', $order) }}">
                <img src="assets/imgs/theme/icons/icon-download.svg" alt="">
                Download Invoice
            </a>
        </div>
    </div>
</x-account-layout>
