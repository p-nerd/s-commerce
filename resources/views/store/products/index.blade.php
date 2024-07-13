<x-store-layout>
    <main class="main">
        <div class="page-header mt-30 mb-50">
            <div class="container">
                <div class="archive-header">
                    <div class="row align-items-center">
                        <div class="col-xl-3">
                            <h1 class="mb-15">Snack</h1>
                            <div class="breadcrumb">
                                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                                <span></span> Shop <span></span> Snack
                            </div>
                        </div>
                        <div class="col-xl-9 d-none d-xl-block text-end">
                            <ul class="tags-list">
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Cabbage</a>
                                </li>
                                <li class="hover-up active">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Broccoli</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Artichoke</a>
                                </li>
                                <li class="hover-up">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Celery</a>
                                </li>
                                <li class="hover-up mr-0">
                                    <a href="blog-category-grid.html"><i class="fi-rs-cross mr-10"></i>Spinach</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-30 container" id="filter-content">
            @include('store/products/filters')

        </div>
    </main>
</x-store-layout>

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
                        document.getElementById('filter-content').innerHTML = data;
                    })
                    .catch(error => {
                        console.log('Error:', error);
                    });
            });
        });
    });
</script>
