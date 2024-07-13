<div class="sidebar-widget widget-category-2 mb-30">
    <h5 class="section-title style-1 mb-30">Category</h5>
    <ul>
        @foreach($categories as $category)
        <li style="background-color: red;">
            <a href="/products?category={{ $category->slug }}" >
                <img src="{{ $category->image }}" alt="" />
                {{ $category->name }}
            </a>
            <span class="count">{{ $category->productCounts() }}</span>
        </li>
        @endforeach
    </ul>
</div>
