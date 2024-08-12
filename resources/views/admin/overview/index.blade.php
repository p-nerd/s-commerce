<x-admin-layout>
    <div class="flex flex-col justify-between space-y-5 py-4">
        <div class="flex w-full flex-col rounded-lg border p-6">
            <x-dash.sales />
        </div>
        <div class="flex w-full flex-col rounded-lg border p-6">
            <div class="flex flex-col space-y-1.5 px-2">
                <h3
                    class="whitespace-nowrap text-2xl font-semibold leading-none tracking-tight"
                >
                    Products in Stock (Less then 5)
                </h3>
                <p class="text-sm">Current inventory levels</p>
            </div>
            <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom text-sm">
                    <thead>
                        <tr class="border-b transition-colors">
                            <th
                                class="h-12 w-[80%] px-1 text-left align-middle font-medium"
                            >
                                Product
                            </th>
                            <th
                                class="h-12 w-[10%] px-1 text-left align-middle font-medium"
                            >
                                Stock
                            </th>
                            <th
                                class="h-12 w-[10%] px-1 text-left align-middle font-medium"
                            ></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="border-b transition-colors">
                                <td class="p-1 align-middle font-medium">
                                    <a
                                        class="w-[80%] underline underline-offset-2"
                                        href="{{ route('admin.products.show', $product) }}"
                                    >
                                        {{ $product->name }}
                                    </a>
                                </td>
                                <td class="w-[10%] p-1 align-middle">
                                    {{ $product->stock }}
                                </td>
                                <td class="w-[10%] p-1 align-middle">
                                    <a
                                        href="{{ route('admin.products.edit', $product) }}"
                                        class="inline-flex h-9 items-center justify-center whitespace-nowrap rounded-md border px-3 text-sm font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50"
                                    >
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
