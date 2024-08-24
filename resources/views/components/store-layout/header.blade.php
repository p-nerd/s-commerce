@php
    use App\Models\Cart;
    use App\Models\Category;
    use App\Models\Option;

    $categories = Category::all();
    $parentCategories = Category::with('subCategories')
        ->where('parent_id', null)
        ->take(2)
        ->get();
@endphp

@include('components.store-layout.modal')
@include('components.store-layout.toast')

<header class="header-area header-style-1 header-height-2">
    <div class="mobile-promotion">
        <span>
            Grand opening,
            <strong>up to 15%</strong>
            off all items. Only
            <strong>3 days</strong>
            left
        </span>
    </div>
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li>
                                <a href="{{ route('about') }}">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('account') }}">My Account</a>
                            </li>
                            <li>
                                <a href="{{ route('account.orders') }}">
                                    My Orders
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                @foreach (Option::newsFlashes()?->value ?? [] as $nfo)
                                    <li>
                                        {{ $nfo }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li>
                                Need help? Call Us:
                                <strong class="text-brand">
                                    {{ Option::supportNumber()?->value }}
                                </strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href=" {{ url('/') }} ">
                        <img
                            src="{{ url('/assets/imgs/theme/logo.svg') }}"
                            alt="logo"
                        />
                    </a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form>
                            <select class="select-active">
                                <option>All Categories</option>
                                @foreach ($categories as $category)
                                    <option>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <input
                                type="text"
                                placeholder="Search for products..."
                            />
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a
                                    class="mini-cart-icon"
                                    href="{{ route('cart') }}"
                                >
                                    <img
                                        alt="Nest"
                                        src="{{ url('/assets/imgs/theme/icons/icon-cart.svg') }}"
                                    />
                                    <span
                                        class="pro-count blue"
                                        id="header-cart-count"
                                    >
                                        {{ Cart::quantity() }}
                                    </span>
                                </a>
                                <a href="{{ route('cart') }}">
                                    <span class="lable">Cart</span>
                                </a>

                                <span id="header-cart-drowdown">
                                    <x-store-layout.cart-dropdown
                                        :items="Cart::items()"
                                        :price="Cart::price()"
                                    />
                                </span>
                            </div>
                            @auth
                                <div class="header-action-icon-2">
                                    <a href="{{ route('account') }}">
                                        @if (auth()->user()?->avatar)
                                            <img
                                                class="svgInject"
                                                alt="Nest"
                                                style="border-radius: 50%"
                                                src="{{ public_image(auth()->user()->avatar) }}"
                                            />
                                        @else
                                            <img
                                                class="svgInject"
                                                alt="Nest"
                                                src="{{ url('/assets/imgs/theme/icons/icon-user.svg') }}"
                                            />
                                        @endif
                                    </a>
                                    <a href="{{ route('account') }}">
                                        <span class="lable ml-0">Account</span>
                                    </a>
                                    <div
                                        class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown"
                                    >
                                        <ul>
                                            <li>
                                                <a
                                                    href="{{ route('account') }}"
                                                >
                                                    <i
                                                        class="fi fi-rs-user mr-10"
                                                    ></i>
                                                    My Account
                                                </a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('account.orders') }}"
                                                >
                                                    <i
                                                        class="fi fi-rs-location-alt mr-10"
                                                    ></i>
                                                    My Orders
                                                </a>
                                            </li>
                                            <li>
                                                <a
                                                    href="{{ route('account.details') }}"
                                                >
                                                    <i
                                                        class="fi fi-rs-settings-sliders mr-10"
                                                    ></i>
                                                    Setting
                                                </a>
                                            </li>
                                            <li>
                                                <form
                                                    id="header-logout-form"
                                                    action="{{ route('logout') }}"
                                                    method="POST"
                                                    style="display: none"
                                                >
                                                    @csrf
                                                </form>
                                                <a
                                                    onclick="event.preventDefault(); document.getElementById('header-logout-form').submit();"
                                                >
                                                    <i
                                                        class="fi fi-rs-sign-out mr-10"
                                                    ></i>
                                                    Sign out
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                @if (request()->user()->admin())
                                    <div class="header-action-icon-2">
                                        <a href="{{ route('admin') }}">
                                            <span
                                                class="lable"
                                                style="
                                                    border-bottom: 1px solid
                                                        gray;
                                                "
                                            >
                                                Admin Dashboard
                                            </span>
                                        </a>
                                    </div>
                                @endif
                            @endauth

                            @guest
                                <div class="header-action-icon-2">
                                    <a href="{{ route('login') }}">
                                        <span
                                            class="lable"
                                            style="
                                                border-bottom: 1px solid gray;
                                            "
                                        >
                                            Login
                                        </span>
                                    </a>
                                </div>
                                <div class="header-action-icon-2">
                                    <a href="{{ route('register') }}">
                                        <span
                                            class="lable"
                                            style="
                                                border-bottom: 1px solid gray;
                                            "
                                        >
                                            Register
                                        </span>
                                    </a>
                                </div>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ url('/') }}">
                        <img
                            src="{{ url('/assets/imgs/theme/logo.svg') }}"
                            alt="logo"
                        />
                    </a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div
                        class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading"
                    >
                        <nav>
                            <ul>
                                <li>
                                    <x-store-layout.nav-link route="index">
                                        Home
                                    </x-store-layout.nav-link>
                                </li>
                                <li>
                                    <x-store-layout.nav-link route="products">
                                        Products
                                    </x-store-layout.nav-link>
                                </li>
                                <li class="position-static">
                                    <a>
                                        Categories
                                        <i class="fi-rs-angle-down"></i>
                                    </a>
                                    <ul class="mega-menu">
                                        @foreach ($parentCategories as $parentCategory)
                                            <li
                                                class="sub-mega-menu sub-mega-menu-width-22"
                                            >
                                                <a
                                                    class="menu-title"
                                                    href="{{ route('products', ['category' => $parentCategory->slug]) }}"
                                                >
                                                    {{ $parentCategory->name }}
                                                </a>
                                                <ul>
                                                    @foreach ($parentCategory->subCategories as $subCategory)
                                                        <li>
                                                            <a
                                                                href="{{ route('products', ['category' => $subCategory->slug]) }}"
                                                            >
                                                                {{ $subCategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a href="/contact">Contact</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-flex">
                    <img
                        src="/assets/imgs/theme/icons/icon-headphone.svg"
                        alt="hotline"
                    />
                    <p>
                        {{ Option::supportNumber()?->value }}
                        <span>24/7 Support Center</span>
                    </p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="shop-wishlist.html">
                                <img
                                    alt="Nest"
                                    src="/assets/imgs/theme/icons/icon-heart.svg"
                                />
                                <span class="pro-count white">4</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="#">
                                <img
                                    alt="Nest"
                                    src="/assets/imgs/theme/icons/icon-cart.svg"
                                />
                                <span class="pro-count white">2</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <ul>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="shop-product-right.html">
                                                <img
                                                    alt="Nest"
                                                    src="/assets/imgs/shop/thumbnail-3.jpg"
                                                />
                                            </a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4>
                                                <a
                                                    href="shop-product-right.html"
                                                >
                                                    Plain Striola Shirts
                                                </a>
                                            </h4>
                                            <h3>
                                                <span>1 ×</span>
                                                $800.00
                                            </h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#">
                                                <i
                                                    class="fi-rs-cross-small"
                                                ></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="shopping-cart-img">
                                            <a href="shop-product-right.html">
                                                <img
                                                    alt="Nest"
                                                    src="/assets/imgs/shop/thumbnail-4.jpg"
                                                />
                                            </a>
                                        </div>
                                        <div class="shopping-cart-title">
                                            <h4>
                                                <a
                                                    href="shop-product-right.html"
                                                >
                                                    Macbook Pro 2022
                                                </a>
                                            </h4>
                                            <h3>
                                                <span>1 ×</span>
                                                $3500.00
                                            </h3>
                                        </div>
                                        <div class="shopping-cart-delete">
                                            <a href="#">
                                                <i
                                                    class="fi-rs-cross-small"
                                                ></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>
                                            Total
                                            <span>$383.00</span>
                                        </h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="shop-cart.html">View cart</a>
                                        <a href="shop-checkout.html">
                                            Checkout
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="index.html">
                    <img src="/assets/imgs/theme/logo.svg" alt="logo" />
                </a>
            </div>
            <div
                class="mobile-menu-close close-style-wrap close-style-position-inherit"
            >
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search for items…" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="/">Home</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="/products">Products</a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="#">Mega menu</a>
                            <ul class="dropdown">
                                <li class="menu-item-has-children">
                                    <a href="#">Women's Fashion</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a href="shop-product-right.html">
                                                Dresses
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-product-right.html">
                                                Blouses & Shirts
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-product-right.html">
                                                Hoodies & Sweatshirts
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-product-right.html">
                                                Women's Sets
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">Men's Fashion</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a href="shop-product-right.html">
                                                Jackets
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-product-right.html">
                                                Casual Faux Leather
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-product-right.html">
                                                Genuine Leather
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children">
                                    <a href="#">Technology</a>
                                    <ul class="dropdown">
                                        <li>
                                            <a href="shop-product-right.html">
                                                Gaming Laptops
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-product-right.html">
                                                Ultraslim Laptops
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-product-right.html">
                                                Tablets
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-product-right.html">
                                                Laptop Accessories
                                            </a>
                                        </li>
                                        <li>
                                            <a href="shop-product-right.html">
                                                Tablet Accessories
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="/blog">Blog</a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">
                <div class="single-mobile-header-info">
                    <a href="/contact">
                        <i class="fi-rs-marker"></i>
                        Our location
                    </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="/store-login">
                        <i class="fi-rs-user"></i>
                        Log In / Sign Up
                    </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="/contact">
                        <i class="fi-rs-headphones"></i>
                        (+01) - 2345 - 6789
                    </a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#">
                    <img
                        src="/assets/imgs/theme/icons/icon-facebook-white.svg"
                        alt=""
                    />
                </a>
                <a href="#">
                    <img
                        src="/assets/imgs/theme/icons/icon-twitter-white.svg"
                        alt=""
                    />
                </a>
                <a href="#">
                    <img
                        src="/assets/imgs/theme/icons/icon-instagram-white.svg"
                        alt=""
                    />
                </a>
                <a href="#">
                    <img
                        src="/assets/imgs/theme/icons/icon-pinterest-white.svg"
                        alt=""
                    />
                </a>
                <a href="#">
                    <img
                        src="/assets/imgs/theme/icons/icon-youtube-white.svg"
                        alt=""
                    />
                </a>
            </div>
            <div class="site-copyright">
                Copyright 2022 © Nest. All rights reserved. Powered by
                AliThemes.
            </div>
        </div>
    </div>
</div>
<!--End header-->
