<x-dashboard-layout>
    <x-slot name="header">
        <x-dash.title>Products</x-dash.title>
        <x-dash.new-button href="{{ route('admin.products.create') }}">
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
                            <x-table.view-button href="{{ route('admin.products.show', $product) }}" />
                            <x-table.edit-button href="{{ route('admin.products.edit', $product) }}" />
                            <x-table.delete-button href="{{ route('admin.products.destroy', $product) }}"
                                confirm="Are you sure?" />
                        </x-table.actions-td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table.table>
        <x-table.pagination :data="$products" />
    @endif
</x-dashboard-layout>
