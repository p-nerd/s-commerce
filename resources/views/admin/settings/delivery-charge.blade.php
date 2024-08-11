<x-admin-layout>
    <x-slot name="header">
        <x-dash.title>Adjust Delivery Charge</x-dash.title>
    </x-slot>
    <div class="space-y-6 pb-10 pr-6">
        <x-form.form
            method="POST"
            action="{{ route('admin.settings.delivery-charge.store') }}"
            class="mx-auto"
            style="padding: 0"
        >
            @csrf
            <div class="flex items-center space-x-2">
                <x-form.select
                    name="division"
                    label="Select Division"
                    placeholder="Select Division"
                    required
                />
                <x-form.select
                    name="district"
                    label="Select District"
                    placeholder="Select District"
                    required
                    disabled
                    x-data-divisions="{{ json_encode($divisionsConfig) }}"
                />
                <x-form.text
                    type="number"
                    name="price"
                    label="Price"
                    required
                />
                <x-dash.primary-button
                    class="mt-[20px] bg-green-500 text-white"
                >
                    ADD
                </x-dash.primary-button>
            </div>
        </x-form.form>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const selectDivision = document.querySelector('#division');
                const selectDistrict = document.querySelector('#district');

                if (!selectDivision || !selectDistrict) return;

                const setupLocationsSelectEventListener = () => {
                    const divisions = JSON.parse(
                        selectDistrict.getAttribute('x-data-divisions'),
                    );

                    if (!divisions) return;

                    const divisionValue = selectDivision.getAttribute('value');

                    divisions.forEach(({ value, label }, index) => {
                        const option = document.createElement('option');
                        option.value = value;
                        option.textContent = label;
                        if (divisionValue === value) {
                            option.selected = true;
                        }

                        selectDivision.appendChild(option);

                        if (index === divisions.length - 1) {
                            selectDivision.disabled = false;
                        }
                    });

                    const division = divisions.find(
                        (d) => d.value == divisionValue,
                    );

                    division?.districts?.forEach(
                        ({ label, value, price }, index) => {
                            const option = document.createElement('option');
                            option.value = value;
                            option.textContent = label;
                            if (
                                selectDistrict.getAttribute('value') === value
                            ) {
                                option.selected = true;
                            }

                            selectDistrict.appendChild(option);

                            if (index === division?.districts.length - 1) {
                                selectDistrict.disabled = false;
                            }
                        },
                    );

                    selectDivision.addEventListener('change', function (event) {
                        selectDistrict.disabled =
                            event.target.value == '' ? true : false;

                        const division = divisions.find(
                            (d) => d.value == event.target.value,
                        );

                        selectDistrict.innerHTML = '';

                        const option = document.createElement('option');
                        option.value = '';
                        option.textContent = 'Select District';
                        selectDistrict.appendChild(option);

                        division.districts?.forEach(({ label, value }) => {
                            const option = document.createElement('option');
                            option.value = value;
                            option.textContent = label;
                            selectDistrict.appendChild(option);
                        });
                    });

                    selectDistrict.addEventListener('change', function (event) {
                        const district = divisions
                            .find((d) => d.value === selectDivision.value)
                            .districts.find(
                                (d) => d.value === event.target.value,
                            );
                    });
                };

                setupLocationsSelectEventListener();
            });
        </script>
        @if ($districts->isEmpty())
            <x-table.empty>There is no districts available</x-table.empty>
        @else
            <x-table.table>
                <x-table.thead>
                    <x-table.tr>
                        <x-table.th>No</x-table.th>
                        <x-table.th>District</x-table.th>
                        <x-table.th>Division</x-table.th>
                        <x-table.th class="text-end">Price</x-table.th>
                    </x-table.tr>
                </x-table.thead>
                <x-table.tbody>
                    @php
                        $desc = request()->query('order') === 'desc';
                        $no = $desc ? $districts->toArray()['to'] : $districts->toArray()['from'];
                    @endphp

                    @foreach ($districts as $district)
                        <x-table.tr>
                            <x-table.td>
                                {{ $no }}
                                @php
                                    $no += $desc ? -1 : 1;
                                @endphp
                            </x-table.td>
                            <x-table.td>{{ $district->label }}</x-table.td>
                            <x-table.td>
                                {{ $district->division->label }}
                            </x-table.td>
                            <x-table.td class="py-2 text-end">
                                <div
                                    x-data="{ editing: false }"
                                    class="flex items-center justify-end"
                                >
                                    <form
                                        x-show="editing"
                                        method="POST"
                                        action="{{ route('admin.settings.delivery-charge.update') }}"
                                        x-on:submit="editing = false"
                                        class="flex items-end"
                                    >
                                        @csrf
                                        @method('PATCH')
                                        <input
                                            type="hidden"
                                            name="district_id"
                                            value="{{ $district->id }}"
                                        />
                                        <input
                                            type="number"
                                            name="price"
                                            class="w-20 rounded border px-2 py-1"
                                            min="0"
                                            step="0.01"
                                            value="{{ $district['price'] }}"
                                        />
                                        <x-dash.primary-button
                                            type="submit"
                                            class="ml-2 bg-green-500 text-white"
                                        >
                                            Update
                                        </x-dash.primary-button>
                                    </form>
                                    <span x-show="!editing">
                                        ৳ {{ $district['price'] }}
                                    </span>
                                    <x-dash.primary-button
                                        x-show="!editing"
                                        x-on:click="editing = true"
                                        class="ml-2 bg-blue-500 text-white"
                                    >
                                        Edit
                                    </x-dash.primary-button>
                                </div>
                            </x-table.td>
                        </x-table.tr>
                    @endforeach
                </x-table.tbody>
            </x-table.table>
            <x-table.pagination :data="$districts" />
        @endif
    </div>
</x-admin-layout>
