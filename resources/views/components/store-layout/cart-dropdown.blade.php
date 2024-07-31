@props(['items' => [], 'price' => 0])

<div class="cart-dropdown-wrap cart-dropdown-hm2">
    <ul>
        @foreach ($items as $item)
            @php
                $productLink = route('products.show', $item['productSlug']);
            @endphp

            <li>
                <div class="shopping-cart-img">
                    <a href="{{ $productLink }}">
                        <img alt="Nest" src="{{ $item['featuredImage'] }}" />
                    </a>
                </div>
                <div class="shopping-cart-title">
                    <h4>
                        <a href="{{ $productLink }}">
                            {{ $item['productName'] }}
                        </a>
                    </h4>
                    <h4>
                        <span>{{ $item['quantity'] }} ×</span>
                        ${{ $item['price'] }}
                    </h4>
                </div>
                <div class="shopping-cart-delete">
                    <a
                        id="delete-from-cart-button"
                        data-cart-id="{{ $item['id'] }}"
                    >
                        <i class="fi-rs-cross-small"></i>
                    </a>
                </div>
            </li>
        @endforeach
    </ul>
    <div class="shopping-cart-footer">
        <div class="shopping-cart-total">
            <h4>
                Total
                <span>${{ $price }}</span>
            </h4>
        </div>
        <div class="shopping-cart-button">
            <a href="{{ route('cart') }}" class="outline">View cart</a>
            <a href="{{ route('checkout') }}">Checkout</a>
        </div>
    </div>
</div>
