<x-admin-layout>
    <x-slot name="back">
        {{ route('admin.products') }}
    </x-slot>
    <div class="flex w-full space-x-5">
        <div class="flex w-full flex-col space-y-5">
            <x-show.info label="Product Details">
                <x-show.line label="ID">{{ $product->id }}</x-show.line>
                <x-show.line label="Slug">
                    {{ $product->slug }}
                </x-show.line>
                <x-show.line label="Name">
                    {{ $product->name }}
                </x-show.line>
                <x-show.line label="Short Description">
                    {{ $product->short_description }}
                </x-show.line>
                <x-show.line label="Type">
                    {{ $product->type }}
                </x-show.line>
                <x-show.line label="Sku">{{ $product->sku }}</x-show.line>
                <x-show.line label="Price">
                    {{ $product->price }}
                </x-show.line>
                <x-show.line label="Discount Price">
                    {{ $product->discount_price }}
                </x-show.line>
                <x-show.line label="Manufactured Date">
                    {{ $product->manufactured_date }}
                </x-show.line>
                <x-show.line label="Expired Date">
                    {{ $product->expired_date }}
                </x-show.line>
                <x-show.line label="Stock">
                    {{ $product->stock }}
                </x-show.line>
                <x-show.line label="Category">
                    @if ($product->category->parent)
                        <x-dash.anchor-link
                            href="{{ route('admin.categories.show', $product->category->parent) }}"
                        >
                            {{ $product->category->parent->name }}
                        </x-dash.anchor-link>
                        >
                    @endif

                    <x-dash.anchor-link
                        href="{{ route('admin.categories.show', $product->category) }}"
                    >
                        {{ $product->category->name }}
                    </x-dash.anchor-link>
                </x-show.line>
            </x-show.info>
            <x-show.info label="Long Description">
                <x-show.rich-text>
                    {!! $product->long_description !!}
                </x-show.rich-text>
            </x-show.info>
        </div>
        <div class="flex w-full flex-col space-y-5">
            <x-show.info label="Orders ({{ count($orders) }})">
                @foreach ($orders as $order)
                    <x-show.line class="flex items-center justify-between">
                        <div>
                            <span class="font-medium">Order</span>
                            <a
                                href="{{ route('admin.orders.show', $order) }}"
                                class="underline"
                            >
                                #{{ $order->id }}
                            </a>
                            ,
                            <span class="font-medium">Total:</span>
                            {{ $order->total }},
                            <span class="font-medium">Is Paid:</span>
                            {{ $order->paid ? 'Yes' : 'No' }},
                            <span class="font-medium">Status:</span>
                            {{ $order->status->capitalized() }}
                        </div>
                        <x-table.view-button
                            href="{{ route('admin.orders.show', $order) }}"
                        />
                    </x-show.line>
                @endforeach
            </x-show.info>
        </div>
    </div>
</x-admin-layout>
