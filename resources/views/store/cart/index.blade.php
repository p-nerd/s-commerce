<x-store-layout>
    <main class="main">
        <div class="mt-50 container mb-80">
            <div class="mr-50 ml-50">
                <div class="row">
                    <div class="col-lg-8 mb-40">
                        <h1 class="heading-2 mb-10">Your Cart</h1>
                        <div class="d-flex justify-content-between">
                            <h6 class="text-body">
                                There are <span class="text-brand">3</span> products in your cart
                            </h6>
                            <h6 class="text-body">
                                <a class="text-muted"><i class="fi-rs-trash mr-5"></i>Clear Cart</a>
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="table-responsive shopping-summery">
                            <table class="table-wishlist table">
                                <thead>
                                    <tr class="main-heading">
                                        <th colspan="2" class="start pl-30">Product</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Subtotal</th>
                                        <th scope="col" class="end">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($carts as $cart)
                                        <tr class="pt-30" id="cart-index-items" data-cart-id="{{ $cart->id }}"
                                            data-cart-product-id="{{ $cart->product->id }}">
                                            <td class="image product-thumbnail pt-40"><img
                                                    src="{{ $cart->product->featuredImage()->url }}" alt="#">
                                            </td>
                                            <td class="product-des product-name">
                                                <h6 class="mb-5">
                                                    <a class="product-name text-heading mb-10"
                                                        href="{{ route('products.show', $cart->product->slug) }}">
                                                        {{ $cart->product->name }}
                                                    </a>
                                                </h6>
                                                <div class="product-rate-cover">
                                                    <div class="product-rate d-inline-block">
                                                        <div class="product-rating" style="width:90%">
                                                        </div>
                                                    </div>
                                                    <span class="font-small text-muted ml-5"> (4.0)</span>
                                                </div>
                                            </td>
                                            <td class="price" data-title="Price">
                                                <h4 class="text-body"
                                                    id="cart-item-price-unit-value-{{ $cart->product->id }}">
                                                    ${{ $cart->product->discount_price ?? $cart->product->price }}
                                                </h4>
                                            </td>
                                            <td class="detail-info text-center" data-title="Stock">
                                                <div class="detail-extralink mr-15">
                                                    <div class="detail-qty radius border">
                                                        <a id="quantity-down-button"
                                                            data-product-id="{{ $cart->product->id }}"
                                                            class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                        <span class="qty-val"
                                                            id="quantity-value-{{ $cart->product->id }}">{{ $cart->quantity }}</span>
                                                        <a id="quantity-up-button"
                                                            data-product-id="{{ $cart->product->id }}"
                                                            class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="price" data-title="Price">
                                                <h4 class="text-brand"
                                                    id="cart-item-price-subtotal-value-{{ $cart->product->id }}">
                                                    ${{ ($cart->product->discount_price ?? $cart->product->price) * $cart->quantity }}
                                                </h4>
                                            </td>
                                            <td class="action text-center" data-title="Remove">
                                                <a class="text-body" id="delete-from-cart-button"
                                                    data-cart-id="{{ $cart->id }}">
                                                    <i class="fi-rs-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="cart-action d-flex justify-content-between">
                            <a class="btn" href="{{ route('products') }}"><i
                                    class="fi-rs-arrow-left mr-10"></i>Continue Shopping</a>
                            <a class="btn mb-sm-15 mr-10" id="cart-index-page-cart-button"><i
                                    class="fi-rs-refresh mr-10"></i>Update Cart</a>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="p-md-4 cart-totals ml-30 border">
                            <div class="table-responsive">
                                <table class="no-border table">
                                    <tbody>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Subtotal</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 class="text-brand text-end">${{ $price }}</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Shipping</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 class="text-heading text-end">
                                                    {{ $shippingPrice == 0 ? 'Free' : "$$shippingPrice" }}</h4>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="cart_total_label">
                                                <h6 class="text-muted">Total</h6>
                                            </td>
                                            <td class="cart_total_amount">
                                                <h4 class="text-brand text-end">${{ $totalPrice }}</h4>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a class="btn w-100 mb-20" href="{{ route('checkout') }}">Proceed To CheckOut<i
                                    class="fi-rs-sign-out ml-15"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-store-layout>
