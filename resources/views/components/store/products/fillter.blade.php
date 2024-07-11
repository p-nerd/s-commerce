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
                    <li><x-store.products.per-page-link :items="50"  /></li>
                    <li><x-store.products.per-page-link :items="100" /></li>
                    <li><x-store.products.per-page-link :items="150" /></li>
                    <li><x-store.products.per-page-link :items="200" /></li>
                    <li><x-store.products.per-page-link :items="$products->total()" label="All" /></li>
                </ul>
            </div>
        </div>
        <div class="sort-by-cover">
            <div class="sort-by-product-wrap">
                <div class="sort-by">
                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                </div>
                <div class="sort-by-dropdown-wrap">
                    <span>
                        {{ request("sort_by") === "featured" ? 'Featured' : '' }}
                        {{ request("sort_by") === "price" && request("order") === "asc" ? 'Price: Low to High' : '' }}
                        {{ request("sort_by") === "price" && request("order") === "desc" ? 'Price: High to Low' : '' }}
                        {{ request("sort_by") === "released_date" ? 'Release Date' : '' }}
                        {{ request("sort_by") === "rating" ? 'Avg. Rating' : '' }}
                        <i class="fi-rs-angle-small-down"></i>
                    </span>
                </div>
            </div>
            <div class="sort-by-dropdown">
                <ul>
                    <li><x-store.products.sort-link column="featured" order="desc" label="Featured"  /></li>
                    <li><x-store.products.sort-link column="price" order="asc" label="Price: Low to High"  /></li>
                    <li><x-store.products.sort-link column="price" order="desc" label="Price: High to Low"  /></li>
                    <li><x-store.products.sort-link column="released_date" order="desc" label="Release Date"  /></li>
                    <li><x-store.products.sort-link column="rating" order="desc" label="Avg. Rating"  /></li>
                </ul>
            </div>
        </div>
    </div>
</div>
