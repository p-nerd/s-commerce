<x-dashboard-layout>
    <x-slot name="back">
        {{ route('dashboard.categories') }}
    </x-slot>
    <x-slot name="header">
        <x-dash.title>
            Showing '{{ $category->name }}' category
        </x-dash.title>
    </x-slot>
    <div class="space-y-4 rounded-lg bg-white p-5 shadow">
        <x-show.item label="Slug">{{ $category->slug }}</x-show.item>
        <x-show.item label="Name">{{ $category->name }}</x-show.item>
        <x-show.item label="Description">{{ $category->description }}</x-show.item>
        @if ($parent)
            <x-show.item label="Parent Category">
                <x-dash.anchor-link
                    href="{{ route('dashboard.categories.show', $parent) }}">{{ $parent->name }}</x-dash.anchor-link>
            </x-show.item>
        @endif
        @if (count($subCategories) !== 0)
            <x-show.item label="Sub categories" class="flex gap-2">
                @foreach ($subCategories as $key => $subCategory)
                    <x-dash.anchor-link href="{{ route('dashboard.categories.show', $subCategory) }}">
                        {{ $key !== count($subCategories) - 1 ? "{$subCategory->name}, " : $subCategory->name }}
                    </x-dash.anchor-link>
                @endforeach
            </x-show.item>
        @endif
    </div>
</x-dashboard-layout>
