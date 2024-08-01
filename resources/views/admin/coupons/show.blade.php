<x-admin-layout>
    <div class="flex w-full space-x-5">
        <x-show.info label="Coupon Details">
            <x-show.line label="ID">{{ $coupon->id }}</x-show.line>
            <x-show.line label="Code">{{ $coupon->code }}</x-show.line>
            <x-show.line label="Type">{{ $coupon->type }}</x-show.line>
            <x-show.line label="Discount">
                ৳{{ $coupon->discount }}
            </x-show.line>
            @if ($coupon->expires_at)
                <x-show.line label="Expires At">
                    {{ $coupon->expires_at->format('d M, Y h:m:s A (T)') }}
                </x-show.line>
            @endif

            <x-show.line label="Status" class="flex items-center space-x-2">
                <div class="w-[130px]">
                    <x-show.change-select
                        href="{{ route('admin.coupons.update', $coupon) }}"
                        method="PATCH"
                        name="status"
                        :value="$coupon->status->value"
                        :options="$statuses"
                    />
                </div>
            </x-show.line>
            <x-show.line label="Created At">
                {{ $coupon->created_at->format('d M, Y h:m:s A (T)') }}
            </x-show.line>
        </x-show.info>
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
    <div class="flex justify-between py-5">
        <x-dash.back :href="route('admin.coupons')" />
        <x-table.delete-button
            label="Delete"
            confirm="Are you sure? you are delete coupon #{{ $coupon->id }}"
            :href="route('admin.coupons.destroy', [$coupon,  'redirect' => route('admin.coupons')])"
        />
    </div>
</x-admin-layout>
