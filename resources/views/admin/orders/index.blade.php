<x-admin-layout>
    <x-slot name="header">
        <x-dash.title>Orders ({{ count($orders) }})</x-dash.title>
    </x-slot>

    <x-table.filters-row>
        <x-table.search-input placeholder="Search with id, email, name..." />
        <x-table.select-per-page />
    </x-table.filters-row>

    @if ($orders->isEmpty())
        <x-table.empty>There is no orders available</x-table.empty>
    @else
        <x-table.table>
            <x-table.thead>
                <x-table.tr>
                    <x-table.th>No</x-table.th>
                    <x-table.sortable-th name="name">ID</x-table.sortable-th>
                    <x-table.sortable-th name="email">
                        Email
                    </x-table.sortable-th>
                    <x-table.sortable-th name="name">Name</x-table.sortable-th>
                    <x-table.sortable-th name="payment_method">
                        Payment Method
                    </x-table.sortable-th>
                    <x-table.sortable-th name="total">
                        Amount
                    </x-table.sortable-th>
                    <x-table.sortable-th name="paid">
                        Payment Status
                    </x-table.sortable-th>
                    <x-table.sortable-th class="w-[130px]" name="status">
                        Status
                    </x-table.sortable-th>
                    <x-table.sortable-th name="created_at">
                        Placed On
                    </x-table.sortable-th>
                    <x-table.th></x-table.th>
                </x-table.tr>
            </x-table.thead>
            <x-table.tbody>
                @php
                    $isDesc = request()->query('order') === 'desc';
                    $no = $isDesc ? $orders->toArray()['to'] : $orders->toArray()['from'];
                @endphp

                @foreach ($orders as $order)
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
                        <x-table.td>
                            <a
                                href="{{ route('admin.orders.show', $order) }}"
                                class="underline underline-offset-2"
                            >
                                #{{ $order->id }}
                            </a>
                        </x-table.td>
                        <x-table.td>{{ $order->email }}</x-table.td>
                        <x-table.td>{{ $order->name }}</x-table.td>
                        <x-table.td>
                            {{ $order->payment_method }}
                        </x-table.td>
                        <x-table.td>{{ $order->total }}</x-table.td>
                        <x-table.td>
                            {{ $order->paid ? 'Paid' : 'Not Paid' }}
                        </x-table.td>
                        <x-table.td>
                            <x-show.change-select
                                name="status"
                                method="PATCH"
                                :href="route('admin.orders.update', $order)"
                                :value="$order->status->value"
                                :options="$statuses"
                                class="text-xs"
                            />
                        </x-table.td>
                        <x-table.td>
                            {{ $order->created_at->format('d M, Y h:m:s') }}
                        </x-table.td>
                        <x-table.actions-td>
                            <x-table.view-button
                                href="{{ route('admin.orders.show', $order) }}"
                            />
                            <x-table.delete-button
                                href="{{ route('admin.orders.destroy', $order) }}"
                                confirm="Are you sure?"
                            />
                        </x-table.actions-td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table.table>
        <x-table.pagination :data="$orders" />
    @endif
</x-admin-layout>
