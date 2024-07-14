<!-- Modal -->
<!--
<div class="modal fade custom-modal" id="onloadModal" tabindex="-1" aria-labelledby="onloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="deal" style="background-image: url('assets/imgs/banner/popup-1.png')">
                    <div class="deal-top">
                        <h6 class="text-brand-2 mb-10">Deal of the Day</h6>
                    </div>
                    <div class="deal-content detail-info">
                        <h4 class="product-title"><a href="shop-product-right.html" class="text-heading">Organic fruit
                                for your family's health</a></h4>
                        <div class="clearfix product-price-cover">
                            <div class="product-price primary-color float-left">
                                <span class="current-price text-brand">$38</span>
                                <span>
                                    <span class="save-price font-md color3 ml-15">26% Off</span>
                                    <span class="old-price font-md ml-15">$52</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="deal-bottom">
                        <p class="mb-20">Hurry Up! Offer End In:</p>
                        <div class="deals-countdown pl-5" data-countdown="2025/03/25 00:00:00">
                            <span class="countdown-section"><span class="countdown-amount hover-up">03</span><span
                                    class="countdown-period"> days </span></span><span class="countdown-section"><span
                                    class="countdown-amount hover-up">02</span><span class="countdown-period"> hours
                                </span></span><span class="countdown-section"><span
                                    class="countdown-amount hover-up">43</span><span class="countdown-period"> mins
                                </span></span><span class="countdown-section"><span
                                    class="countdown-amount hover-up">29</span><span class="countdown-period"> sec
                                </span></span>
                        </div>
                        <div class="product-detail-rating">
                            <div class="product-rate-cover text-end">
                                <div class="product-rate d-inline-block">
                                    <div class="product-rating" style="width: 90%"></div>
                                </div>
                                <span class="font-small text-muted ml-5"> (32 rates)</span>
                            </div>
                        </div>
                        <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i
                                class="fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
-->

<!-- Quick view -->
<?php

use App\Models\Product;

$products = Product::with('images')->get();

?>

@foreach ($products as $product)
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
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <span class="qty-val">1</span>
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart"><i
                                                class="fi-rs-shopping-cart"></i>Add to cart</button>
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
