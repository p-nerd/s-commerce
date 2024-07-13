<div class="totall-product" style="margin-bottom: 30px;">
    <p>We found <strong class="text-brand" id="items-count">{{ count($products) }}</strong> items for you!</p>
</div>

<div class="row product-grid">
    @foreach ($products as $product)
        @php
            $productLink = "/products/{$product->slug}";
        @endphp

        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
            <div class="product-cart-wrap mb-30">
                <div class="product-img-action-wrap">
                    <div class="product-img product-img-zoom">
                        <a href="{{ $productLink }}">
                            <img class="default-img" src="{{ $product->featuredImage()->url }}" alt="" />
                            <img class="hover-img" src="{{ $product->featuredImage()->url }}" alt="" />
                        </a>
                    </div>
                    <div class="product-action-1">
                        <a aria-label="Add To Wishlist" class="action-btn"><i class="fi-rs-heart"></i></a>
                        <a aria-label="Compare" class="action-btn"><i class="fi-rs-shuffle"></i></a>
                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal"
                            data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                    </div>
                    <div class="product-badges product-badges-position product-badges-mrg">
                        <span class="sale">Sale</span>
                    </div>
                </div>
                <div class="product-content-wrap">
                    <div class="product-category">
                        <a href="{{ $productLink }}">{{ $product->name }}</a>
                    </div>
                    <h2><a href="{{ $productLink }}">{{ $product->short_description }}</a></h2>
                    <div class="product-rate-cover">
                        <div class="product-rate d-inline-block">
                            <div class="product-rating" style="width: 80%"></div>
                        </div>
                        <span class="font-small text-muted ml-5"> (3.5)</span>
                    </div>
                    <div class="product-card-bottom">
                        <div class="product-price">
                            <span>${{ $product->discount_price ?? $product->price }}</span>
                            @if ($product->price)
                                <span class="old-price">${{ $product->price }}</span>
                            @endif
                        </div>
                        <div class="add-cart">
                            <a class="add" href="#"><i class="fi-rs-shopping-cart mr-5"></i>Add</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<x-store.products.pagination :products="$products" href='/products' />
