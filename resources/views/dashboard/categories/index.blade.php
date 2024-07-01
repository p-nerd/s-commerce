<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <a href="{{ route('dashboard.categories.create') }}" class="underline">Create new category</a>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($categories->isEmpty())
                <div class="text-center text-red-500">You didn't create any category yet</div>
            @else
            <div class="relative w-full overflow-auto">
                <table class="w-full bg-white rounded-md caption-bottom text-sm">
                    <thead class="[&amp;_tr]:border-b">
                        <tr
                            class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                        >
                            <th
                                class="w-[25%] h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                            >
                                Title
                            </th>
                            <th
                                class="w-[25%] h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                            >
                                Description
                            <th
                                class="w-[12.5%] h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                            >
                                Created At
                            </th>
                            <th
                                class="w-[12.5%] h-12 px-4 text-right align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                                <th
                                class="h-12 px-4 text-left align-middle font-medium text-muted-foreground [&amp;:has([role=checkbox])]:pr-0"
                            ></th>
                        </tr>
                    </thead>
                    <tbody class="[&amp;_tr:last-child]:border-0">
                        @foreach ($categories as $category)
                        <tr
                            class="border-b transition-colors hover:bg-muted/50 data-[state=selected]:bg-muted"
                        >
                            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                <a
                                    href="/_/{{ $category->slug }}"
                                    class="underline"
                                    >{{ $category->name }}</a
                                >
                            </td>
                            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                {{ $category->description }}
                            </td>
                            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                {{ $category->created_at->format("M, j Y") }}
                            </td>
                            <td class="p-4 align-middle [&amp;:has([role=checkbox])]:pr-0">
                                <div class="flex items-center justify-end gap-2">
                                    <a
                                        href="/dashboard/categories/{{ $category->id }}/edit"
                                        class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3"
                                    >
                                        Edit
                                    </a>
                                    <form
                                        id="delete-form-{{ $category->id }}"
                                        method="category"
                                        action="/dashboard/categories/{{ $category->id }}"
                                    >
                                        @csrf
                                        <input type="hidden" name="_method" value="delete" />
                                        <button
                                            type="submit"
                                            class="inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3"
                                            color="destructive"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            const form = document.getElementById(
                                                "delete-form-{{ $category->id }}"
                                            );

                                            form.addEventListener("submit", function (event) {
                                                const confirmed = confirm(
                                                    "Are you sure you want to delete this category?"
                                                );
                                                if (!confirmed) {
                                                    event.preventDefault();
                                                }
                                            });
                                        });
                                    </script>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

</x-dashboard-layout>
