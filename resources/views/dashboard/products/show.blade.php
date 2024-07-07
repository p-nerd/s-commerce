<x-dashboard-layout>
    <x-slot name="header">
        <x-dash.title>Products</x-dash.title>
        <x-dash.new-button href="{{ route('dashboard.products.create') }}">
            Edit the product
        </x-dash.new-button>
    </x-slot>
</x-dashboard-layout>
