@foreach (\App\Models\Product::with('images')->get() as $product)
    @php
        $quantity = \App\Models\Cart::productQuantity($product->id);
    @endphp
    <div class="modal fade custom-modal" id="quick-view-modal-{{ $product->id }}" tabindex="-1"
        aria-labelledby="quickViewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">
                                    @foreach ($product->images as $image)
                                        <figure class="border-radius-10">
                                            <img src="{{ $image->url }}" alt="product image" />
                                        </figure>
                                    @endforeach
                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    @foreach ($product->images as $image)
                                        <div><img src="{{ $image->url }}" alt="product image" /></div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">
                                <h3 class="title-detail">
                                    <a href="{{ route('products.show', $product->slug) }}" class="text-heading">
                                        {{ $product->name }}
                                    </a>
                                </h3>
                                <p>{{ $product->short_description }}</p>
                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small text-muted ml-5"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        <span
                                            class="current-price text-brand">${{ $product->discount_price ?? $product->price }}</span>
                                        <span>
                                            @if ($product->discount_price)
                                                <span
                                                    class="save-price font-md color3 ml-15">{{ $product->discountPercentage() }}%
                                                    Off</span>
                                                <span class="old-price font-md ml-15">${{ $product->price }}</span>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="detail-extralink mb-30">
                                    <div class="detail-qty radius border">
                                        <a id="quantity-down-button" data-product-id="{{ $product->id }}"
                                            class="qty-down">
                                            <i class="fi-rs-angle-small-down"></i>
                                        </a>
                                        <span id="quantity-value-{{ $product->id }}"
                                            class="qty-val">{{ $quantity == 0 ? 1 : $quantity }}</span>
                                        <a id="quantity-up-button" data-product-id="{{ $product->id }}"
                                            class="qty-up">
                                            <i class="fi-rs-angle-small-up"></i>
                                        </a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button id="add-to-cart-button" data-product-id="{{ $product->id }}"
                                            data-product-quantity="{{ $quantity == 0 ? 1 : $quantity }}"
                                            data-bs-dismiss="modal" type="submit" class="button button-add-to-cart">
                                            <i class="fi-rs-shopping-cart"></i>
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
