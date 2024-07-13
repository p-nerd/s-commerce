@props(['products' => []])

<div class="row product-grid" id="products">
    @foreach ($products as $product)
        <x-store.products.item :product="$product" />
    @endforeach
</div>
