<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-dashboard.title>
               Products
            </x-dashboard.title>
            <x-dashboard.anchor-link href="{{ route('dashboard.products.create') }}">Create new
                product</x-dashboard.anchor-link>
        </div>
    </x-slot>

    @if ($products->isEmpty())
        <div class="text-center py-4 text-red-500">You didn't create any product yet</div>
    @else
        <div class="relative w-full overflow-auto">
            <table class="w-full caption-bottom rounded-md bg-white text-sm">
                <thead class="border-b">
                    <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                        <th class="text-muted-foreground h-12 w-[17%] px-4 text-left align-middle font-medium">
                            Title
                        </th>
                        <th class="text-muted-foreground h-12 w-[20%] px-4 text-left align-middle font-medium">
                            Description
                        </th>
                        <th class="text-muted-foreground h-12 w-[14%] px-4 text-left align-middle font-medium">
                            Price
                        </th>
                        <th class="text-muted-foreground h-12 w-[14%] px-4 text-left align-middle font-medium">
                            Category
                        </th>
                        <th class="text-muted-foreground h-12 w-[14%] px-4 text-left align-middle font-medium">
                            Stock
                        </th>
                        <th class="text-muted-foreground h-12 w-[14%] px-4 text-left align-middle font-medium">
                            Created At
                        </th>
                        <th class="text-muted-foreground h-12 w-[7%] px-4 text-left align-middle font-medium">
                        </th>
                    </tr>
                </thead>
                <tbody class="[&amp;_tr:last-child]:border-0">
                    @foreach ($products as $product)
                        <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                            <td class="w-[17%] p-4 align-middle">
                                <x-dashboard.anchor-link
                                    href="/_/{{ $product->slug }}">{{ $product->name }}</x-dashboard>
                            </td>
                            <td class="w-[20%] p-4 align-middle">
                                {{ substr($product->description, 0, 20) }}...
                            </td>
                            <td class="w-[14%] p-4 align-middle">
                                ৳{{ $product->price }}
                            </td>
                            <td class="w-[14%] p-4 align-middle">
                                {{ $product->category->name }}
                            </td>
                            <td class="w-[14%] p-4 align-middle">
                                {{ $product->stock }}
                            </td>
                            <td class="w-[14%] p-4 align-middle">
                                {{ $product->created_at->format('M, j Y') }}
                            </td>
                            <td class="w-[7%] p-4 align-middle">
                                <div class="flex items-center justify-end gap-2">
                                    <x-dashboard.link-button
                                        href="{{ route('dashboard.products.edit', ['product' => $product->id]) }}">
                                        Edit
                                    </x-dashboard.link-button>
                                    <x-dashboard.delete-button id="delete-product-{{ $product->id }}"
                                        href="{{ route('dashboard.products.destroy', ['product' => $product->id]) }}">
                                        Delete
                                    </x-dashboard.delete-button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

</x-dashboard-layout>
