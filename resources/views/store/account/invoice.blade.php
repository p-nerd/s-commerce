<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Order Invoice #{{ $order->id }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="{{ url('assets/css/main.css?v=5.5') }}" />
    </head>

    <body
        class="invoice invoice-content invoice-3"
        style="padding-top: 0; padding-bottom: 0; background: white"
    >
        <div class="invoice-inner">
            <div
                class="invoice-info"
                id="invoice_wrapper"
                style="border-radius: 0; margin-bottom: 0"
            >
                <div
                    class="invoice-header"
                    style="
                        padding-top: 20px;
                        padding-bottom: 20px;
                        border-radius: 0;
                    "
                >
                    <div
                        class="row"
                        style="
                            display: flex;
                            justify-content: space-between;
                            align-items: center;
                        "
                    >
                        <div class="col-sm-6">
                            <div class="invoice-name">
                                <div class="logo">
                                    <a href="{{ route('index') }}">
                                        <img
                                            src="{{ url('assets/imgs/theme/logo-light.svg') }}"
                                            alt="logo"
                                        />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 invoice-numb text-end">
                            <h4
                                class="invoice-header-1 mb-10 mt-20"
                                style="color: white"
                            >
                                Order #{{ $order->id }}
                            </h4>
                            <h6 style="color: white">
                                {{ $order->created_at->format('d M Y h:m:s') }}
                            </h6>
                        </div>
                    </div>
                </div>
                <div
                    class="invoice-top"
                    style="
                        padding-top: 20px;
                        padding-bottom: 0px;
                        margin-bottom: 30px;
                    "
                >
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="invoice-number">
                                <h4 class="invoice-title-1 mb-8">
                                    Order Details
                                </h4>
                                <p class="invoice-addr-1">
                                    <strong>Order:</strong>
                                    #{{ $order->id }}
                                    <br />
                                    <strong>Placed on:</strong>
                                    {{ $order->created_at->format('d M Y h:m:s') }}
                                    <br />
                                    <strong>Payment method:</strong>
                                    {{ $order->payment_method }}
                                    <br />
                                    <strong>Is Paid:</strong>
                                    {{ $order->paid ? 'Yes' : 'No' }}
                                    <br />
                                    <strong>Bank tran id:</strong>
                                    {{ $order->bank_tran_id }}
                                    <br />
                                    @if ($order->coupon)
                                        <strong>Used Coupon:</strong>
                                        {{ $order->coupon->code }}
                                        <br />
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="invoice-number">
                                <h4 class="invoice-title-1 mb-8">
                                    Shipping Address
                                </h4>

                                <p class="invoice-addr-1">
                                    <strong>{{ $order->name }}</strong>
                                    <br />
                                    @if ($order->landmark)
                                        {{ $order->landmark }}
                                        <br />
                                    @endif

                                    {{ $order->address }}
                                    <br />
                                    {{ $order->district }},
                                    {{ $order->division }}
                                    <br />
                                    <strong>Phone:</strong>
                                    {{ $order->phone }}
                                    <br />
                                    <strong>Email:</strong>
                                    {{ $order->user->email }}
                                    <br />
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="invoice-center">
                    <div class="table-responsive">
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
                                        <td>
                                            {{ $orderItem->product->name }}
                                        </td>
                                        <td class="text-center">
                                            ৳{{ $orderItem->price }}
                                        </td>
                                        <td class="text-center">
                                            {{ $orderItem->quantity }}
                                        </td>
                                        <td class="text-right">
                                            ৳{{ $orderItem->price * $orderItem->quantity }}
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <td colspan="3" class="f-w-600 text-end">
                                        SubTotal
                                    </td>
                                    <td class="text-right">
                                        ৳{{ $order->subtotal }}
                                    </td>
                                </tr>
                                @if ($order->discount)
                                    <tr>
                                        <td
                                            colspan="3"
                                            class="f-w-600 text-end"
                                        >
                                            Discount
                                        </td>
                                        <td class="text-right">
                                            - ৳{{ $order->discount }}
                                        </td>
                                    </tr>
                                @endif

                                @if ($order->delivery)
                                    <tr>
                                        <td
                                            colspan="3"
                                            class="f-w-600 text-end"
                                        >
                                            Delivery
                                        </td>
                                        <td class="text-right">
                                            + ৳{{ $order->delivery }}
                                        </td>
                                    </tr>
                                @endif

                                <tr>
                                    <td colspan="3" class="f-w-600 text-end">
                                        Grand Total
                                    </td>
                                    <td class="f-w-600 text-right">
                                        ৳{{ $order->total }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
