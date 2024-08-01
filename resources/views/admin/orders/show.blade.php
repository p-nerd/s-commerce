<x-admin-layout>
    <div class="flex w-full space-x-5">
        <x-show.info label="Order Details">
            <x-show.line label="ID">{{ $order->id }}</x-show.line>
            <x-show.line label="Payment Method">
                {{ $order->payment_method }}
            </x-show.line>
            <x-show.line label="Subtotal">৳{{ $order->subtotal }}</x-show.line>
            <x-show.line label="Discount">৳{{ $order->discount }}</x-show.line>
            <x-show.line label="Delivery">৳{{ $order->Delivery }}</x-show.line>
            <x-show.line label="Total">৳{{ $order->total }}</x-show.line>
            <x-show.line label="Payment Status">
                {{ $order->paid ? 'Paid' : 'Not Paid' }}
            </x-show.line>
            <x-show.line label="Used Coupon">
                <a
                    href="{{ route('admin.coupons.show', $coupon) }}"
                    class="underline"
                >
                    {{ $coupon->code }}
                </a>
            </x-show.line>
            <x-show.line label="bank_tran_id">
                {{ $order->bank_tran_id }}
            </x-show.line>
            <x-show.line label="Status" class="flex items-center space-x-2">
                <div class="w-[130px]">
                    <x-show.change-select
                        href="{{ route('admin.orders.update', $order) }}"
                        method="PATCH"
                        name="status"
                        :value="$order->status->value"
                        :options="$statuses"
                    />
                </div>
            </x-show.line>
            <x-show.line label="Placed On">
                {{ $order->created_at->format('d M, Y h:m:s A (T)') }}
            </x-show.line>
        </x-show.info>
        <div class="flex w-full flex-col space-y-5">
            <x-show.info label="Shipping Address">
                <x-show.line label="Name">
                    {{ $order->name }}
                </x-show.line>
                <x-show.line label="Email">
                    {{ $order->email }}
                </x-show.line>
                <x-show.line label="Phone">
                    {{ $order->phone }}
                </x-show.line>
                <x-show.line label="Division">
                    {{ $order->division }}
                </x-show.line>
                <x-show.line label="District">
                    {{ $order->district }}
                </x-show.line>
                <x-show.line label="Address">
                    {{ $order->address }}
                </x-show.line>
                <x-show.line label="Landmark">
                    {{ $order->landmark }}
                </x-show.line>
            </x-show.info>
            <x-show.info label="User Details">
                <div
                    class="mx-auto mb-2 h-36 w-36 overflow-hidden rounded-full"
                >
                    @if ($user->avatar)
                        <img
                            src="{{ $order->user->avatar }}"
                            class="h-full w-full object-contain"
                        />
                    @else
                        <div class="h-full w-full bg-gray-600"></div>
                    @endif
                </div>
                <x-show.line label="ID">
                    <a
                        href="{{ route('admin.users.show', $order->user) }}"
                        class="underline"
                    >
                        #{{ $order->user->id }}
                    </a>
                </x-show.line>
                <x-show.line label="Name">
                    {{ $user->name }}
                </x-show.line>
                <x-show.line label="Email">
                    {{ $user->email }}
                </x-show.line>
                <x-show.line label="Status">
                    {{ $user->status->capitalized() }}
                </x-show.line>
            </x-show.info>
        </div>
    </div>
    <div class="flex justify-between py-5">
        <x-dash.back :href="route('admin.orders')" />
        <x-table.delete-button
            label="Delete"
            confirm="Are you sure? you are delete order #{{ $order->id }}"
            :href="route('admin.orders.destroy', [$order,  'redirect' => route('admin.orders')])"
        />
    </div>
</x-admin-layout>
