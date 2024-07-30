<x-dashboard-layout>
    <x-slot name="back">
        {{ route('admin.products') }}
    </x-slot>
    <x-slot name="header">
        <x-dash.title>
            Showing '{{ $product->name }}' product
        </x-dash.title>
    </x-slot>
    <x-show.card>
        <x-show.item label="Slug">{{ $product->slug }}</x-show.item>
        <x-show.item label="Name">{{ $product->name }}</x-show.item>
        <x-show.item label="Short Description">{{ $product->short_description }}</x-show.item>
        <x-show.two>
            <x-show.item label="Type">{{ $product->type }}</x-show.item>
            <x-show.item label="Sku">{{ $product->sku }}</x-show.item>
        </x-show.two>
        <x-show.two>
            <x-show.item label="Price">{{ $product->price }}</x-show.item>
            <x-show.item label="Discount Price">{{ $product->discount_price }}</x-show.item>
        </x-show.two>
        <x-show.two>
            <x-show.item label="Manufactured Date">{{ $product->manufactured_date }}</x-show.item>
            <x-show.item label="Expired Date">{{ $product->expired_date }}</x-show.item>
        </x-show.two>
        <x-show.two>
            <x-show.item label="Stock">{{ $product->stock }}</x-show.item>
            <x-show.item label="Category">
                @if ($product->category->parent)
                    <x-dash.anchor-link href="{{ route('admin.categories.show', $product->category->parent) }}">
                        {{ $product->category->parent->name }}
                    </x-dash.anchor-link>
                    >
                @endif
                <x-dash.anchor-link href="{{ route('admin.categories.show', $product->category) }}">
                    {{ $product->category->name }}
                </x-dash.anchor-link>
            </x-show.item>
        </x-show.two>
        <x-show.rich-text label="Long Description">{!! $product->long_description !!}</x-show.rich-text>
    </x-show.card>
</x-dashboard-layout>
