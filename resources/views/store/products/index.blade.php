<x-store-layout>
    <main class="main mt-30 mb-50">
        <div class="mb-30 container">
            <div class="row flex-row-reverse">
                <div class="col-lg-4-5">
                    @include('store/products/per-page-sort')
                    <div id="products">
                        @include('store/products/list')
                    </div>
                    @include('store/products/deals-of-the-day')
                </div>
                <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                    @include('store/products/categories')
                    @include('store/products/fill-by-price')
                    @include('store/products/new-products')
                    @include('store/products/product-page-small-banner')
                </div>
            </div>
        </div>
    </main>
</x-store-layout>
