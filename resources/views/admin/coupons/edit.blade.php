<x-admin-layout>
    <x-slot name="back">
        {{ route('admin.coupons') }}
    </x-slot>
    <x-slot name="header">
        <x-dash.title>Update Coupon #{{ $coupon->id }}</x-dash.title>
    </x-slot>
    <x-form.form
        method="POST"
        action="{{ route('admin.coupons.update', $coupon) }}"
    >
        @method('PATCH')
        <div class="mx-auto w-1/2 space-y-5">
            <x-form.text
                name="code"
                label="Code"
                :value="$coupon->code"
                required
                autofocus
            />
            <x-form.select
                name="type"
                label="Type"
                placeholder="Select coupon type"
                :value="$coupon->type->value"
                :options="$types"
                required
            />
            <x-form.text
                type="number"
                step="00.1"
                name="discount"
                label="Discount"
                :value="$coupon->discount"
                required
            />
            <x-form.text
                type="date"
                name="expires_at"
                label="Expires At"
                :value="$coupon->expires_at?->format('Y-m-d')"
            />
            <x-form.select
                name="status"
                label="Status"
                placeholder="Select coupon status"
                :value="$coupon->status->value"
                :options="$statuses"
            />
            <x-form.submit />
        </div>
    </x-form.form>
</x-admin-layout>
