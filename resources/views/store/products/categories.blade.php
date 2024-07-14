<div class="sidebar-widget widget-category-2 mb-30">
    <h5 class="section-title style-1 mb-30">Category</h5>
    <ul>
        @foreach ($categories as $category)
            @php
                $active = $category['slug'] === request('category');
            @endphp

            @if ($active)
                <li class="categories-link" style="border-color: green;	cursor: pointer;"
                    data-slug="{{ $category['slug'] }}">
                @else
                <li class="categories-link" style="cursor: pointer;" data-slug="{{ $category['slug'] }}">
            @endif
            <a>
                <img src="{{ $category['image'] }}" alt="" />
                @if ($active)
                    <span style="color: green">
                    @else
                        <span>
                @endif
                {{ $category['name'] }}
                </span>
            </a>
            <span class="count">{{ $category['productCount'] }}</span>
            </li>
        @endforeach
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoriesLinks = document.querySelectorAll('.categories-link')

        categoriesLinks.forEach(link => {
            link.addEventListener('click', async function(event) {
                event.preventDefault();

                updateProducts(addQuery({
                    "category": this.getAttribute("data-slug")
                }));

                // Remove the active class from all category links
                categoriesLinks.forEach(l => {
                    l.style.borderColor = '';
                    l.querySelector('span').style.color = '';
                });

                // Add the active class to the clicked category link
                this.style.borderColor = 'green';
                this.querySelector('span').style.color = 'green';
            });
        });
    });
</script>
