<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-dash.title>
                Products
            </x-dash.title>
            <x-dash.anchor-link href="{{ route('dashboard.products.create') }}">Create new
                product</x-dash.anchor-link>
        </div>
    </x-slot>

    <x-dash.search-input :href="route('dashboard.products') . '?'" />

    @if ($products->isEmpty())
        <div class="py-4 text-center text-red-500">You didn't create any product yet</div>
    @else
        <div class="relative w-full overflow-auto rounded-md border">
            <table class="w-full caption-bottom rounded-md bg-white text-xs shadow">
                <thead class="border-b">
                    <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                        <x-dash.th>No</x-dash.th>
                        <x-dash.sortable-th name="name">Name</x-dash.sortable-th>
                        <x-dash.th>Description</x-dash.th>
                        <x-dash.sortable-th name="price">Price</x-dash.sortable-th>
                        <x-dash.sortable-th name="discount_price">Discount Price</x-dash.sortable-th>
                        <x-dash.sortable-th name="category">Category</x-dash.sortable-th>
                        <x-dash.sortable-th name="stock">Stock</x-dash.sortable-th>
                        <x-dash.th></x-dash.th>
                    </tr>
                </thead>
                <tbody class="[&amp;_tr:last-child]:border-0">
                    @php
                        $isDesc = request()->query('order') === 'desc';
                        $no = $isDesc ? count($products) : 1;
                    @endphp

                    @foreach ($products as $product)
                        <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                            <td class="border-r p-4 align-middle">
                                {{ $no }}

                                @php
                                    if ($isDesc) {
                                        $no--;
                                    } else {
                                        $no++;
                                    }
                                @endphp

                            </td>
                            <td class="border-r p-4 align-middle">
                                {{ $product->name }}
                            </td>
                            <td class="border-r p-4 align-middle">
                                {{ $product->short_description }}
                            </td>
                            <td class="border-r p-4 align-middle">
                                ৳{{ $product->price }}
                            </td>
                            <td class="border-r p-4 align-middle">
                                {{ $product->discount_price ? "৳{$product->discount_price}" : '-' }}
                            </td>
                            <td class="border-r p-4 align-middle">
                                {{ $product->category->name }}
                            </td>
                            <td class="border-r p-4 align-middle">
                                {{ $product->stock }}
                            </td>
                            <td class="p-4 align-middle">
                                <div class="flex items-center justify-end gap-2">
                                    <x-dash.link-button
                                        href="{{ route('dashboard.products.show', ['product' => $product->id]) }}">
                                        View
                                    </x-dash.link-button>
                                    <x-dash.edit-button
                                        href="{{ route('dashboard.products.edit', ['product' => $product->id]) }}" />
                                    <x-dash.delete-button id="delete-product-{{ $product->id }}"
                                        href="{{ route('dashboard.products.destroy', ['product' => $product->id]) }}" />
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</x-dashboard-layout>
