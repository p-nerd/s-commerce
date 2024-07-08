<x-dashboard-layout>
    <x-slot name="back">
        {{ route('dashboard.products') }}
    </x-slot>
    <x-slot name="header">
        <x-dash.title>
            Update '{{ $product->name }}' category
        </x-dash.title>
    </x-slot>

    <x-form.form method="POST" action="{{ route('dashboard.products.update', $product) }}">
        <x-form.text name="name" label="Name" value="{{ $product->name }}" required autofocus />
        <x-form.textarea name="short_description" value="{{ $product->short_description }}" label="Short Description"
            required />
        <div class="flex w-full space-x-5">
            <x-form.select name="type" label="Type" value="{{ $product->type }}" placeholder="Select product type"
                :options="$productTypeOptions" />
            <x-form.text name="sku" label="SKU" value="{{ $product->sku }}" required />
        </div>
        <div class="flex w-full space-x-5">
            <x-form.text type="number" step="00.1" name="price" label="Price" value="{{ $product->price }}"
                required />
            <x-form.text type="number" step="00.1" name="discount_price" label="Discount Price"
                value="{{ $product->discount_price }}" />
        </div>
        <div class="flex space-x-5">
            <x-form.date name="manufactured_date" label="Manufactured Date" value="{{ $product->manufactured_date }}"
                required />
            <x-form.date name="expired_date" label="Expired Date" required />
        </div>
        <div class="flex space-x-5">
            <x-form.text type="number" step="1" name="stock" label="Stock" value="{{ $product->stock }}"
                required />
            <x-form.select name="category_id" label="Category" value="{{ $product->category_id }}"
                placeholder="Select product category" :options="$categories" required />
        </div>
        <x-form.markdown name="long_description" label="Long Description" value="{{ $product->long_description }}"
            placeholder="Long Description (Markdown is allowed here)" />
        <x-form.submit />
    </x-form.form>
</x-dashboard-layout>
