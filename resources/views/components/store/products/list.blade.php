@props(['products' => []])

<div class="row product-grid">
    @foreach ($products as $product)
        <x-store.products.item :product="$product" />
    @endforeach
</div>
