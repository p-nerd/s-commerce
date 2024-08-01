<x-admin-layout>
    <div class="mt-5 flex w-full space-x-5">
        <div class="w-full space-y-5">
            <x-show.info label="User Details">
                <x-show.line label="ID">{{ $user->id }}</x-show.line>
                <x-show.line label="Name">{{ $user->name }}</x-show.line>
                <x-show.line label="Email">{{ $user->email }}</x-show.line>
                <x-show.line label="Role">
                    {{ $user->role->capitalized() }}
                </x-show.line>
                <x-show.line label="Status" class="flex items-center space-x-2">
                    <div class="w-[100px]">
                        <x-show.change-select
                            href="{{ route('admin.users.update', $user) }}"
                            method="PATCH"
                            name="status"
                            :value="$user->status->value"
                            :options="$statuses"
                        />
                    </div>
                </x-show.line>
                <x-show.line label="Joined On">
                    {{ $user->created_at->format('d M, Y h:m:s A (T)') }}
                </x-show.line>
            </x-show.info>
            <x-show.info label="Billing Address">
                <x-show.line label="Division">
                    {{ $user->division }}
                </x-show.line>
                <x-show.line label="District">
                    {{ $user->district }}
                </x-show.line>
                <x-show.line label="Address">
                    {{ $user->address }}
                </x-show.line>
                <x-show.line label="Phone">{{ $user->phone }}</x-show.line>
            </x-show.info>
            <x-show.info label="Shipping Address">
                <x-show.line label="Phone">
                    {{ $user->shipping_phone }}
                </x-show.line>
                <x-show.line label="Division">
                    {{ $user->shipping_division }}
                </x-show.line>
                <x-show.line label="District">
                    {{ $user->shipping_district }}
                </x-show.line>
                <x-show.line label="Address">
                    {{ $user->shipping_address }}
                </x-show.line>
                <x-show.line label="Landmark">
                    {{ $user->shipping_landmark }}
                </x-show.line>
            </x-show.info>
        </div>
        <div class="w-full space-y-5">
            <div
                class="flex w-full flex-col items-center justify-center text-base font-medium"
            >
                <div class="mb-2 h-36 w-36 overflow-hidden rounded-full">
                    @if ($user->avatar)
                        <img
                            src="{{ $user->avatar }}"
                            class="h-full w-full object-contain"
                        />
                    @else
                        <div class="h-full w-full bg-gray-600"></div>
                    @endif
                </div>
                <div>{{ $user->name }}</div>
                <div>{{ $user->email }}</div>
            </div>
            <x-show.info label="Orders ({{ count($orders) }})">
                @foreach ($orders as $order)
                    <x-show.line class="flex items-center justify-between">
                        <div>
                            <span class="font-medium">Order</span>
                            <a
                                href="{{ route('admin.orders.show', $order) }}"
                                class="underline"
                            >
                                #{{ $order->id }}
                            </a>
                            ,
                            <span class="font-medium">Total:</span>
                            {{ $order->total }},
                            <span class="font-medium">Is Paid:</span>
                            {{ $order->paid ? 'Yes' : 'No' }},
                            <span class="font-medium">Status:</span>
                            {{ $order->status->capitalized() }}
                        </div>
                        <x-table.view-button
                            href="{{ route('admin.orders.show', $order) }}"
                        />
                    </x-show.line>
                @endforeach
            </x-show.info>
        </div>
    </div>
    <div class="flex justify-between py-5">
        <x-dash.back :href="route('admin.users')" />
        <x-table.delete-button
            label="Delete"
            confirm="Are you sure? you are delete user #{{ $user->id }}"
            :href="route('admin.users.destroy', [$user,  'redirect' => route('admin.users')])"
        />
    </div>
</x-admin-layout>
