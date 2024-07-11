<div class="shop-product-fillter">
    <div class="totall-product">
        <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
    </div>

    <div class="sort-by-product-area">

        <div class="sort-by-cover mr-10">
            <div class="sort-by-product-wrap">
                <div class="sort-by">
                    <span><i class="fi-rs-apps"></i>Show:</span>
                </div>
                <div class="sort-by-dropdown-wrap">
                    <span> {{ $products->perPage() }} <i class="fi-rs-angle-small-down"></i></span>
                </div>
            </div>
            <div class="sort-by-dropdown">
                <ul>
                    <li><x-store.products.per-page-link :items="50" :perPage="$products->perPage()" /></li>
                    <li><x-store.products.per-page-link :items="100" :perPage="$products->perPage()" /></li>
                    <li><x-store.products.per-page-link :items="150" :perPage="$products->perPage()" /></li>
                    <li><x-store.products.per-page-link :items="200" :perPage="$products->perPage()" /></li>
                    <li><x-store.products.per-page-link :items="$products->total()" :perPage="$products->perPage()" label="All" /></li>
                </ul>
            </div>
        </div>
        <div class="sort-by-cover">
            <div class="sort-by-product-wrap">
                <div class="sort-by">
                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                </div>
                <div class="sort-by-dropdown-wrap">
                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                </div>
            </div>
            <div class="sort-by-dropdown">
                <ul>
                    <li><a class="active" href="#">Featured</a></li>
                    <li><a href="#">Price: Low to High</a></li>
                    <li><a href="#">Price: High to Low</a></li>
                    <li><a href="#">Release Date</a></li>
                    <li><a href="#">Avg. Rating</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
