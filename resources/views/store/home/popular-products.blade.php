<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div
            class="section-title style-2 wow animate__animated animate__fadeIn"
        >
            <h3>Popular Products</h3>
        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div
                class="tab-pane fade show active"
                id="tab-one"
                role="tabpanel"
                aria-labelledby="tab-one"
            >
                <div class="row product-grid-4">
                    @foreach ($featuredProducts as $product)
                        @php
                            $productLink = route('products.show', $product->slug);
                        @endphp

                        <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                            <div
                                class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn"
                                data-wow-delay=".1s"
                            >
                                <div class="product-img-action-wrap">
                                    <div class="product-img product-img-zoom">
                                        <a href="{{ $productLink }}">
                                            <img
                                                class="default-img"
                                                src="{{ $product->featuredImage()->url }}"
                                                alt=""
                                            />
                                            <img
                                                class="hover-img"
                                                src="{{ $product->featuredImage()->url }}"
                                                alt=""
                                            />
                                        </a>
                                    </div>
                                    <div class="product-action-1">
                                        <a
                                            aria-label="Quick view"
                                            class="action-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#quick-view-modal-{{ $product->id }}"
                                        >
                                            <i class="fi-rs-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-content-wrap">
                                    <div class="product-category">
                                        <a
                                            href="{{ route('products', ['category' => $product->category->slug]) }}"
                                        >
                                            {{ $product->category->name }}
                                        </a>
                                    </div>
                                    <h2>
                                        <a href="{{ $productLink }}">
                                            Seeds of Change Organic Quinoa,
                                            Brown, & Red Rice
                                        </a>
                                    </h2>
                                    <div class="product-rate-cover">
                                        <div
                                            class="product-rate d-inline-block"
                                        >
                                            <div
                                                class="product-rating"
                                                style="width: 90%"
                                            ></div>
                                        </div>
                                        <span
                                            class="font-small text-muted ml-5"
                                        >
                                            (4.0)
                                        </span>
                                    </div>
                                    <div class="product-card-bottom">
                                        <div class="product-price">
                                            <span>
                                                ৳{{ $product->discount_price ?? $product->price }}
                                            </span>
                                            @if ($product->discount_price)
                                                <span class="old-price">
                                                    ৳{{ $product->price }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="add-cart">
                                            <a
                                                class="add"
                                                href="shop-cart.html"
                                            >
                                                <i
                                                    class="fi-rs-shopping-cart mr-5"
                                                ></i>
                                                Add
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
            <!--End tab seven-->
        </div>
        <!--End tab-content-->
    </div>
</section>
