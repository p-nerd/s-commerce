<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <x-dashboard.title>
                @if (isset($category))
                    Sub-categories of '{{ $category->name }}'
                @else
                    Categories
                @endif
            </x-dashboard.title>
            <x-dashboard.anchor-link href="{{ route('dashboard.categories.create') }}">Create new
                category</x-dashboard.anchor-link>
        </div>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if ($categories->isEmpty())
            <div class="text-center text-red-500">You didn't create any category yet</div>
        @else
            <div class="relative w-full overflow-auto">
                <table class="w-full bg-white rounded-md caption-bottom text-sm">
                    <thead class="border-b">
                        <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                            <th class="w-[25%] h-12 px-4 text-left align-middle font-medium text-muted-foreground">
                                Title
                            </th>
                            <th class="w-[37.5%] h-12 px-4 text-left align-middle font-medium text-muted-foreground">
                                Description
                            </th>
                            <th class="w-[12.5%] h-12 px-4 text-left align-middle font-medium text-muted-foreground">
                                Created At
                            </th>
                            <th class="w-[25%] h-12 px-4 text-left align-middle font-medium text-muted-foreground">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="[&amp;_tr:last-child]:border-0">
                        @foreach ($categories as $category)
                            <tr class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted">
                                <td class="w-[25%]  p-4 align-middle">
                                    <x-dashboard.anchor-link
                                        href="/_/{{ $category->slug }}">{{ $category->name }}</x-dashboard>
                                </td>
                                <td class="w-[25%]  p-4 align-middle">
                                    {{ $category->description }}
                                </td>
                                <td class="w-[25%]  p-4 align-middle">
                                    {{ $category->created_at->format('M, j Y') }}
                                </td>
                                <td class="w-[25%]  p-4 align-middle">
                                    <div class="flex items-center justify-end gap-2">
                                        @if (!$category->subCategories->isEmpty())
                                            <x-dashboard.link-button
                                                href="{{ route('dashboard.categories.sub-categories', ['category' => $category->id]) }}">
                                                View Sub-Categories
                                            </x-dashboard.link-button>
                                        @endif
                                        <x-dashboard.link-button
                                            href="{{ route('dashboard.categories.edit', ['category' => $category->id]) }}">
                                            Edit
                                        </x-dashboard.link-button>
                                        <x-dashboard.delete-button id="delete-category-{{ $category->id }}"
                                            href="{{ route('dashboard.categories.destroy', ['category' => $category->id]) }}">
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
    </div>

</x-dashboard-layout>
