<x-store-layout>
    <main class="main">
        <div class="container mb-80 mt-50">
            <div class="mr-50 ml-50">
                <div class="row">
                    <div class="col-lg-8 mb-40">
                        <h1 class="heading-2 mb-10">Checkout</h1>
                        <div class="d-flex justify-content-between">
                            <h6 class="text-body">There are <span class="text-brand">3</span> products in your cart</h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-7">
                        <div class="row mb-50">
                            <div class="col-lg-6">
                                <form method="post" class="apply-coupon">
                                    <input type="text" placeholder="Enter Coupon Code...">
                                    <button class="btn btn-md" name="login">Apply Coupon</button>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <h4 class="mb-30">Billing Details</h4>
                            <form method="post">
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <input type="text" required="" name="fname" placeholder="First name *">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input type="text" required="" name="lname" placeholder="Last name *">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <input type="text" name="billing_address" required=""
                                            placeholder="Address *">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input type="text" name="billing_address2" required=""
                                            placeholder="Address 2">
                                    </div>
                                </div>
                                <div class="row shipping_calculator">
                                    <div class="form-group col-lg-6">
                                        <input required="" type="text" name="city" placeholder="City / Town *">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input required="" type="text" name="zipcode"
                                            placeholder="Postcode / ZIP *">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <input required="" type="text" name="phone" placeholder="Phone *">
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <input required="" type="text" name="cname" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <input required="" type="text" name="email"
                                            placeholder="Email address *">
                                    </div>
                                </div>
                                <div class="form-group mb-30">
                                    <textarea rows="5" placeholder="Additional information"></textarea>
                                </div>
                                <div id="collapsePassword" class="form-group create-account collapse in">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <input required="" type="password" placeholder="Password"
                                                name="password">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="border p-40 cart-totals ml-30 mb-50">
                            <div class="d-flex align-items-end justify-content-between mb-30">
                                <h4>Your Order</h4>
                                <h6 class="text-muted">Total: <span class="text-brand">{{ $total }}</span></h6>
                            </div>
                            <div class="divider-2 mb-30"></div>
                            <div class="table-responsive order_table checkout">
                                <table class="table no-border">
                                    <tbody>
                                        @foreach ($carts as $cart)
                                            <tr>
                                                <td class="image product-thumbnail"><img
                                                        src="{{ $cart->product->featuredImage()->url }}" alt="#">
                                                </td>
                                                <td>
                                                    <h6 class="w-160 mb-5">
                                                        <a href="{{ route('products.show', $cart->product->slug) }}"
                                                            class="text-heading">
                                                            {{ $cart->product->name }}
                                                        </a>
                                                    </h6>
                                                    <div class="product-rate-cover">
                                                        <div class="product-rate d-inline-block">
                                                            <div class="product-rating" style="width:90%">
                                                            </div>
                                                        </div>
                                                        <span class="font-small ml-5 text-muted"> (4.0)</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="text-muted pl-20 pr-20">x {{ $cart->quantity }}</h6>
                                                </td>
                                                <td>
                                                    <h4 class="text-brand">
                                                        ${{ $cart->quantity * $cart->product->currentPrice() }}
                                                    </h4>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="payment ml-30">
                            <h4 class="mb-30">Payment</h4>
                            <div class="payment_option">
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio"
                                        name="payment_option" id="exampleRadios4" checked="">
                                    <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse"
                                        data-target="#checkPayment" aria-controls="checkPayment">
                                        Cash on delivery
                                    </label>
                                </div>
                                <div class="custome-radio">
                                    <input class="form-check-input" required="" type="radio"
                                        name="payment_option" id="exampleRadios5" checked="">
                                    <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse"
                                        data-target="#paypal" aria-controls="paypal">Online Getway</label>
                                </div>
                            </div>
                            <div class="payment-logo d-flex">
                                <img class="mr-15" src="assets/imgs/theme/icons/payment-paypal.svg" alt="">
                                <img class="mr-15" src="assets/imgs/theme/icons/payment-visa.svg" alt="">
                                <img class="mr-15" src="assets/imgs/theme/icons/payment-master.svg" alt="">
                                <img src="assets/imgs/theme/icons/payment-zapper.svg" alt="">
                            </div>
                            <a href="#" class="btn btn-fill-out btn-block mt-30">Place an Order<i
                                    class="fi-rs-sign-out ml-15"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</x-store-layout>
