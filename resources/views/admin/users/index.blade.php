<x-admin-layout>
    <x-slot name="header">
        <x-dash.title>Users</x-dash.title>
    </x-slot>

    <x-table.filters-row>
        <x-table.search-input placeholder="Search with id, name, email..." />
        <x-table.select-per-page />
    </x-table.filters-row>

    @if ($users->isEmpty())
        <x-table.empty>There is no users available</x-table.empty>
    @else
        <x-table.table>
            <x-table.thead>
                <x-table.tr>
                    <x-table.th>No</x-table.th>
                    <x-table.sortable-th name="name">Name</x-table.sortable-th>
                    <x-table.sortable-th name="email">Email</x-table.sortable-th>
                    <x-table.sortable-th name="role">Role</x-table.sortable-th>
                    <x-table.sortable-th name="status">Status</x-table.sortable-th>
                    <x-table.sortable-th name="created_at">Created At</x-table.sortable-th>
                    <x-table.th></x-table.th>
                </x-table.tr>
            </x-table.thead>
            <x-table.tbody>
                @php
                    $isDesc = request()->query('order') === 'desc';
                    $no = $isDesc ? $users->toArray()['to'] : $users->toArray()['from'];
                @endphp

                @foreach ($users as $user)
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
                        <x-table.td>{{ $user->name }}</x-table.td>
                        <x-table.td>{{ $user->email }}</x-table.td>
                        <x-table.td>{{ $user->role }}</x-table.td>
                        <x-table.td>{{ $user->status }}</x-table.td>
                        <x-table.td>{{ $user->created_at->format('d M, Y h:m:s') }}</x-table.td>
                        <x-table.actions-td>
                            <x-table.view-button href="{{ route('admin.users.show', $user) }}" />
                            <x-table.edit-button href="{{ route('admin.users.edit', $user) }}" />
                            <x-table.delete-button href="{{ route('admin.users.destroy', $user) }}"
                                confirm="Are you sure?" />
                        </x-table.actions-td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table.table>
        <x-table.pagination :data="$users" />
    @endif
</x-admin-layout>
