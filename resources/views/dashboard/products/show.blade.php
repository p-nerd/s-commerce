<x-dashboard-layout>
    <x-slot name="back">
        {{ route('dashboard.products') }}
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
    </x-show.card>
</x-dashboard-layout>
