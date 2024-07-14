<x-store-layout>
    <script>
        const addQuery = (queries) => {
            const url = window.location.href;
            const urlObj = new URL(url);
            for (const query in queries) {
                urlObj.searchParams.set(query, queries[query]);
            }
            return urlObj.toString();
        }

        const updateProducts = async (url) => {
            const products = document.querySelector('#products');
            const response = await fetch(url, {
                headers: {
                    "X-Type": "partial"
                }
            });
            const data = await response.text();
            products.innerHTML = data;
            history.pushState(null, '', url);
        }
    </script>
    <main class="main mt-30 mb-50">
        <div class="mb-30 container">
            <div class="row flex-row-reverse">
                <div class="col-lg-4-5">
                    @include('store/products/per-page-sort')
                    <div id="products">
                        @include('store/products/products')
                    </div>
                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    @include('store/products/categories')
                    @include('store/products/fill-by-price')
                    @include('store/products/new-products')
                </div>
            </div>
        </div>
    </main>
</x-store-layout>
