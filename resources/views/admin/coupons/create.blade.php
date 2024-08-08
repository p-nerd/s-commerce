<x-admin-layout>
    <x-slot name="back">
        {{ route('admin.coupons') }}
    </x-slot>
    <x-slot name="header">
        <x-dash.title>Create a new coupon</x-dash.title>
    </x-slot>
    <x-form.form method="POST" action="{{ route('admin.coupons.store') }}">
        <div class="mx-auto w-1/2 space-y-5">
            <x-form.text name="code" label="Code" required autofocus />
            <x-form.select
                name="type"
                label="Type"
                placeholder="Select coupon type"
                :options="$types"
            />
            <x-form.text
                type="number"
                step="00.1"
                name="discount"
                label="Discount"
                required
            />
            <x-form.text type="date" name="expires_at" label="Expires At" />
            <x-form.select
                name="status"
                label="Status"
                placeholder="Select coupon status"
                :options="$statuses"
            />
            <x-form.submit />
        </div>
    </x-form.form>
</x-admin-layout>
