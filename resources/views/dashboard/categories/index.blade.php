<x-dashboard-layout>
    <x-slot name="header">
        <x-dash.title>
            @if (isset($category))
                Sub-categories of '{{ $category->name }}'
            @else
                Categories
            @endif
        </x-dash.title>
        <x-dash.new-button href="{{ route('dashboard.categories.create') }}">
            Create new category
        </x-dash.new-button>
    </x-slot>

    <x-table.filters-row>
        <x-table.search-input />
        <x-table.select-per-page />
    </x-table.filters-row>

    @if ($categories->isEmpty())
        <x-table.empty>You didn't create any category yet</x-table.empty>
    @else
        <x-table.table>
            <x-table.thead>
                <x-table.tr>
                    <x-table.th>No</x-table.th>
                    <x-table.sortable-th name="name">Name</x-table.sortable-th>
                    <x-table.th>Description</x-table.th>
                    <x-table.sortable-th name="created_at">Created At</x-table.th>
                </x-table.tr>
            </x-table.thead>
            <x-table.tbody>
                @php
                    $isDesc = request()->query('order') === 'desc';
                    $no = $isDesc ? $categories->toArray()['to'] : $categories->toArray()['from'];
                @endphp

                @foreach ($categories as $category)
                    <x-table.tr>
                        <x-table.td>
                            {{ $no }}

                            @php
                                if ($isDesc) {
                                    $no--;
                                } else {
                                    $no++;
                                }
                            @endphp
                        </x-table.td>
                        <x-table.td>{{ $category->name }}</x-table.td>
                        <x-table.td>{{ $category->description }}</x-table.td>
                        <x-table.td class="w-[120px]">{{ $category->created_at->format('M, j Y') }}</x-table.td>
                        <x-table.actions-td>
                            <x-table.edit-button
                                href="{{ route('dashboard.categories.edit', $category) }}" />
                            <x-table.delete-button href="{{ route('dashboard.categories.destroy', $category) }}" />
                        </x-table.actions-td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table.table>
        <x-table.pagination :data="$categories" />
    @endif
</x-dashboard-layout>
