<div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
    <h5 class="section-title style-1 mb-30">New products</h5>
    @foreach ($newProducts as $product)
        <div class="single-post clearfix">
            <div class="image">
                <img src="{{ $product->featuredImage()->url }}" alt="#" />
            </div>
            <div class="content pt-10">
                <h5><a href="/products/{{ $product->slug }}">{{ $product->name }}</a></h5>
                <p class="price mb-0 mt-5">${{ $product->discount_price ?? $product->price }}</p>
                <div class="product-rate">
                    <div class="product-rating" style="width: 90%"></div>
                </div>
            </div>
        </div>
    @endforeach
</div>
