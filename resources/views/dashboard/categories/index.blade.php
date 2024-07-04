<x-dashboard-layout>
    <x-slot name="header">
        <x-dash.title>
            @if (isset($category))
                    Sub-categories of '{{ $category->name }}'
                @else
                    Categories
                @endif</x-table.title>
            <x-dash.new-button href="{{ route('dashboard.products.create') }}">
                Create new product
            </x-dash.new-button>
    </x-slot>

    <x-table.filters-row>
        <x-table.search-input />
        <x-table.select-per-page />
    </x-table.filters-row>

    @if ($products->isEmpty())
        <x-table.empty>You didn't create any product yet</x-table.empty>
    @else
        <x-table.table>
            <x-table.thead>
                <x-table.tr>
                    <x-table.th>No</x-table.th>
                    <x-table.sortable-th name="name">Name</x-table.sortable-th>
                    <x-table.th>Description</x-table.th>
                    <x-table.th name="price">Price</x-table.th>
                    <x-table.th name="discount_price">Discount Price</x-table.th>
                    <x-table.sortable-th name="category">Category</x-table.sortable-th>
                    <x-table.sortable-th name="stock">Stock</x-table.sortable-th>
                    <x-table.th></x-table.th>
                </x-table.tr>
            </x-table.thead>
            <x-table.tbody>
                @php
                    $isDesc = request()->query('order') === 'desc';
                    $no = $isDesc ? $products->toArray()['to'] : $products->toArray()['from'];
                @endphp

                @foreach ($products as $product)
                    <x-table.tr>
                        <x-table.td>
                            {{ $no }}

                            @php
                                if ($isDesc) {
                                    $no--;
                                } else {
                                    $no++;
                                }
                            @endphp
                        </x-table.td>
                        <x-table.td>{{ $product->name }}</x-table.td>
                        <x-table.td>{{ $product->short_description }}</x-table.td>
                        <x-table.td>৳{{ $product->price }}</x-table.td>
                        <x-table.td>{{ $product->discount_price ? "৳{$product->discount_price}" : '-' }}</x-table.td>
                        <x-table.td>{{ $product->category->name }}</x-table.td>
                        <x-table.td>{{ $product->stock }}</x-table.td>
                        <x-table.actions-td>
                            <x-table.view-button
                                href="{{ route('dashboard.products.show', ['product' => $product->id]) }}" />
                            <x-table.edit-button
                                href="{{ route('dashboard.products.edit', ['product' => $product->id]) }}" />
                            <x-table.delete-button
                                href="{{ route('dashboard.products.destroy', $product) }}" />
                        </x-table.actions-td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table.table>
        <x-table.pagination :data="$products" />
    @endif
</x-dashboard-layout>

<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-dash.title>

            </x-dash.title>
            <x-dash.anchor-link href="{{ route('dashboard.categories.create') }}">Create new
                category</x-dash.anchor-link>
        </div>
    </x-slot>

    @if ($categories->isEmpty())
        <div class="py-4 text-center text-red-500">You didn't create any category yet</div>
    @else
        <div class="relative w-full overflow-auto">
            <table class="w-full caption-bottom rounded-md bg-white text-sm">
                <thead class="border-b">
                    <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                        <th class="text-muted-foreground h-12 w-[25%] px-4 text-left align-middle font-medium">
                            Title
                        </th>
                        <th class="text-muted-foreground h-12 w-[37.5%] px-4 text-left align-middle font-medium">
                            Description
                        </th>
                        <th class="text-muted-foreground h-12 w-[12.5%] px-4 text-left align-middle font-medium">
                            Created At
                        </th>
                        <th class="text-muted-foreground h-12 w-[25%] px-4 text-left align-middle font-medium">
                        </th>
                    </tr>
                </thead>
                <tbody class="[&amp;_tr:last-child]:border-0">
                    @foreach ($categories as $category)
                        <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                            <td class="w-[25%] p-4 align-middle">
                                <x-dash.anchor-link href="/_/{{ $category->slug }}">{{ $category->name }}</x-dash>
                            </td>
                            <td class="w-[25%] p-4 align-middle">
                                {{ $category->description }}
                            </td>
                            <td class="w-[25%] p-4 align-middle">
                                {{ $category->created_at->format('M, j Y') }}
                            </td>
                            <td class="w-[25%] p-4 align-middle">
                                <div class="flex items-center justify-end gap-2">
                                    @if (!$category->subCategories->isEmpty())
                                        <x-dash.link-button
                                            href="{{ route('dashboard.categories.sub-categories', ['category' => $category->id]) }}">
                                            View Sub-Categories
                                        </x-dash.link-button>
                                    @endif
                                    <x-dash.link-button
                                        href="{{ route('dashboard.categories.edit', ['category' => $category->id]) }}">
                                        Edit
                                    </x-dash.link-button>
                                    <x-dash.delete-button id="delete-category-{{ $category->id }}"
                                        href="{{ route('dashboard.categories.destroy', ['category' => $category->id]) }}">
                                        Delete
                                    </x-dash.delete-button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</x-dashboard-layout>
