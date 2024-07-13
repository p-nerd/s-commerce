<div class="shop-product-fillter">
    <div class="totall-product" >
        <p>We found <strong class="text-brand product-count">{{ count($products) }}</strong> items for you!</p>
    </div>

    <div class="sort-by-product-area">

        <div class="sort-by-cover mr-10">
            <div class="sort-by-product-wrap">
                <div class="sort-by">
                    <span><i class="fi-rs-apps"></i>Show:</span>
                </div>
                <div class="sort-by-dropdown-wrap">
                    <span>
<span class="product-count">{{ $products->perPage() }}</span>
<i class="fi-rs-angle-small-down"></i>
                    </span>
                </div>
            </div>
            <div class="sort-by-dropdown">
                <ul>
                    <li><a class="per-page-select-link {{ request('per_page') == 50 ? 'active' : '' }}"
                            data-per-page="50">50</a></li>
                    <li><a class="per-page-select-link {{ request('per_page') == 100 ? 'active' : '' }}"
                            data-per-page="100">100</a></li>
                    <li><a class="per-page-select-link {{ request('per_page') == 150 ? 'active' : '' }}"
                            data-per-page="150">150</a></li>
                    <li><a class="per-page-select-link {{ request('per_page') == 200 ? 'active' : '' }}"
                            data-per-page="200">200</a></li>
                    <li>
                        <a class="per-page-select-link {{ request('per_page') == $products->total() ? 'active' : '' }}"
                            data-per-page="{{ $products->total() }}">{{ $products->total() }}</a>
                    </li>
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
                        {{ request('sort_by') === 'featured' ? 'Featured' : '' }}
                        {{ request('sort_by') === 'price' && request('order') === 'asc' ? 'Price: Low to High' : '' }}
                        {{ request('sort_by') === 'price' && request('order') === 'desc' ? 'Price: High to Low' : '' }}
                        {{ request('sort_by') === 'released_date' ? 'Release Date' : '' }}
                        {{ request('sort_by') === 'rating' ? 'Avg. Rating' : '' }}
                        <i class="fi-rs-angle-small-down"></i>
                    </span>
                </div>
            </div>
            <div class="sort-by-dropdown">
                <ul>
                    <li><x-store.products.sort-link column="featured" order="desc" label="Featured" /></li>
                    <li><x-store.products.sort-link column="price" order="asc" label="Price: Low to High" /></li>
                    <li><x-store.products.sort-link column="price" order="desc" label="Price: High to Low" /></li>
                    <li><x-store.products.sort-link column="released_date" order="desc" label="Release Date" /></li>
                    <li><x-store.products.sort-link column="rating" order="desc" label="Avg. Rating" /></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.per-page-select-link');

        links.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                const perPage = this.getAttribute('data-per-page');
                const url = '/products/filters?per_page=' + perPage;

                fetch(url)
                    .then(response => response.text())
                    .then(data => {
                        document.querySelector('#products').innerHTML = data;
                        document.querySelectorAll('.product-count').forEach(ele => ele.innerHTML = perPage)
                    })
                    .catch(error => {
                        console.log('Error:', error);
                    });
            });
        });
    });
</script>
