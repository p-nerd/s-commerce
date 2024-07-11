<div class="dropdown">
    <button class="sort-by-product-wrap dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fi-rs-apps"></i><span style="margin-left: 10px;">Show:</span> <span
            style="margin-left: 5px; margin-right: 10px;">50</span>
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <button class="dropdown-item" type="button">Action</button>
        <button class="dropdown-item" type="button">Another action</button>
        <button class="dropdown-item" type="button">Something else here</button>
    </div>
</div>

<div class="shop-product-fillter">
    <div class="totall-product">
        <p>We found <strong class="text-brand">{{ count($products) }}</strong> items for you!</p>
    </div>

    <div class="sort-by-product-area">

        <div class="mr-10 sort-by-cover">
            <div class="sort-by-product-wrap">
                <div class="sort-by">
                    <span><i class="fi-rs-apps"></i>Show:</span>
                </div>
                <div class="sort-by-dropdown-wrap">
                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                </div>
            </div>
            <div class="sort-by-dropdown">
                <ul>
                    <li><a class="active" href="#">50</a></li>
                    <li><a href="#">100</a></li>
                    <li><a href="#">150</a></li>
                    <li><a href="#">200</a></li>
                    <li><a href="#">All</a></li>
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
