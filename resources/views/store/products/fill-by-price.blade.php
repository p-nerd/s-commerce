<div class="sidebar-widget range mb-30">
    <h5 class="section-title style-1 mb-30">Fill by price</h5>
    <div class="price-filter mb-30">
        <div class="price-filter-inner">
            <div id="slider-range" class="mb-20"></div>
            <div class="d-flex justify-content-between">
                <div class="caption">
                    From:
                    <strong
                        id="slider-range-value1"
                        class="text-brand"
                    ></strong>
                </div>
                <div class="caption">
                    To:
                    <strong
                        id="slider-range-value2"
                        class="text-brand"
                    ></strong>
                </div>
            </div>
        </div>
    </div>
    <a onclick="handleFilter()" class="btn btn-sm btn-default">
        <i class="fi-rs-filter mr-5"></i>
        Fillter
    </a>
</div>

<script>
    const getPrice = (ranageText) => {
        return Number(ranageText.slice(1).replace(/,/g, ''));
    };

    const handleFilter = () => {
        updateProducts(
            addQuery({
                price_from: getPrice(
                    document.querySelector('#slider-range-value1').innerText,
                ),
                price_to: getPrice(
                    document.querySelector('#slider-range-value2').innerText,
                ),
            }),
        );
    };
</script>
