<section class="popular-categories section-padding">
    <div class="wow animate__animated animate__fadeIn container">
        <div class="section-title">
            <div class="title">
                <h3>Featured Categories</h3>
                <ul class="list-inline nav nav-tabs links">
                    @foreach ($featuredParentCategories as $featuredParentCategory)
                        <li class="list-inline-item nav-item">
                            <a class="nav-link" href="shop-grid-right.html">
                                {{ $featuredParentCategory->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div
                class="slider-arrow slider-arrow-2 flex-right carausel-10-columns-arrow"
                id="carausel-10-columns-arrows"
            ></div>
        </div>
        <div class="carausel-10-columns-cover position-relative">
            <div class="carausel-10-columns" id="carausel-10-columns">
                @foreach ($featuredSubCategories as $featuredSubCategory)
                    <div
                        class="card-2 bg-9 wow animate__animated animate__fadeInUp"
                        data-wow-delay=".1s"
                    >
                        <figure class="img-hover-scale overflow-hidden">
                            <a href="{{ $featuredSubCategory->slug }}">
                                <img
                                    src="{{ $featuredSubCategory->image }}"
                                    alt="{{ $featuredSubCategory->name }}"
                                />
                            </a>
                        </figure>
                        <h6>
                            <a href="{{ $featuredSubCategory->slug }}">
                                {{ $featuredSubCategory->name }}
                            </a>
                        </h6>
                        <span>
                            {{ $featuredSubCategory->productCounts() }} items
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
