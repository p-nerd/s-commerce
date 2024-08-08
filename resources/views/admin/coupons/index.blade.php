<x-admin-layout>
    <x-slot name="header">
        <x-dash.title>Coupons ({{ count($coupons) }})</x-dash.title>
        <x-dash.new-button href="{{ route('admin.coupons.create') }}">
            Create new Coupon
        </x-dash.new-button>
    </x-slot>

    <x-table.filters-row>
        <x-table.search-input placeholder="Search with code, discount..." />
        <x-table.select-per-page />
    </x-table.filters-row>

    @if ($coupons->isEmpty())
        <x-table.empty>There is no coupons available</x-table.empty>
    @else
        <x-table.table>
            <x-table.thead>
                <x-table.tr>
                    <x-table.th>No</x-table.th>
                    <x-table.sortable-th name="id">ID</x-table.sortable-th>
                    <x-table.sortable-th name="code">Code</x-table.sortable-th>
                    <x-table.sortable-th name="type">Type</x-table.sortable-th>
                    <x-table.sortable-th name="discount">
                        Discount
                    </x-table.sortable-th>
                    <x-table.sortable-th name="expires_at">
                        Expires At
                    </x-table.sortable-th>
                    <x-table.sortable-th class="w-[130px]" name="created_at">
                        Status
                    </x-table.sortable-th>
                    <x-table.sortable-th name="created_at">
                        Created At
                    </x-table.sortable-th>
                    <x-table.th></x-table.th>
                </x-table.tr>
            </x-table.thead>
            <x-table.tbody>
                @php
                    $isDesc = request()->query('coupon') === 'desc';
                    $no = $isDesc ? $coupons->toArray()['to'] : $coupons->toArray()['from'];
                @endphp

                @foreach ($coupons as $coupon)
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
                                href="{{ route('admin.coupons.show', $coupon) }}"
                                class="underline underline-offset-2"
                            >
                                #{{ $coupon->id }}
                            </a>
                        </x-table.td>
                        <x-table.td>{{ $coupon->code }}</x-table.td>
                        <x-table.td>{{ $coupon->type }}</x-table.td>
                        <x-table.td>{{ $coupon->discount }}</x-table.td>
                        <x-table.td>
                            @if ($coupon->expires_at)
                                {{ $coupon->expires_at->format('d M, Y h:m:s') }}
                            @endif
                        </x-table.td>
                        <x-table.td>
                            <x-show.change-select
                                name="status"
                                method="PATCH"
                                class="text-xs"
                                :href="route('admin.coupons.update', $coupon)"
                                :value="$coupon->status->value"
                                :options="$statuses"
                            />
                        </x-table.td>
                        <x-table.td>
                            {{ $coupon->created_at->format('d M, Y h:m:s') }}
                        </x-table.td>
                        <x-table.actions-td>
                            <x-table.view-button
                                href="{{ route('admin.coupons.show', $coupon) }}"
                            />
                            <x-table.edit-button
                                href="{{ route('admin.coupons.edit', $coupon) }}"
                            />
                            <x-table.delete-button
                                href="{{ route('admin.coupons.destroy', $coupon) }}"
                                confirm="Are you sure?"
                            />
                        </x-table.actions-td>
                    </x-table.tr>
                @endforeach
            </x-table.tbody>
        </x-table.table>
        <x-table.pagination :data="$coupons" />
    @endif
</x-admin-layout>
