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

    <div class="mx-auto py-6 sm:px-6 lg:px-8">
        @if ($categories->isEmpty())
            <div class="text-center text-red-500">You didn't create any category yet</div>
        @else
            <div class="relative w-full overflow-auto">
                <table class="w-full caption-bottom rounded-md bg-white text-sm">
                    <thead class="border-b">
                        <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                            <th class="text-muted-foreground h-12 w-[25%] px-4 text-left align-middle font-medium">
                                Title
                            </th>
                            <th class="text-muted-foreground h-12 w-[37.5%] px-4 text-left align-middle font-medium">
                                Description
                            </th>
                            <th class="text-muted-foreground h-12 w-[12.5%] px-4 text-left align-middle font-medium">
                                Created At
                            </th>
                            <th class="text-muted-foreground h-12 w-[25%] px-4 text-left align-middle font-medium">
                            </th>
                        </tr>
                    </thead>
                    <tbody class="[&amp;_tr:last-child]:border-0">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors">
                                <td class="w-[25%] p-4 align-middle">
                                    <x-dashboard.anchor-link
                                        href="/_/{{ $category->slug }}">{{ $category->name }}</x-dashboard>
                                </td>
                                <td class="w-[25%] p-4 align-middle">
                                    {{ $category->description }}
                                </td>
                                <td class="w-[25%] p-4 align-middle">
                                    {{ $category->created_at->format('M, j Y') }}
                                </td>
                                <td class="w-[25%] p-4 align-middle">
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
