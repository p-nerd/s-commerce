<x-dashboard-layout>
    <x-slot name="back">
        {{ route('admin.products') }}
    </x-slot>
    <x-slot name="header">
        <x-dash.title>
            Create a new product
        </x-dash.title>
    </x-slot>

    <x-form.form method="POST" action="{{ route('admin.products.store') }}">
        <x-form.text name="name" label="Name" required autofocus />
        <x-form.textarea name="short_description" label="Short Description" required />
        <x-form.two>
            <x-form.select name="type" label="Type" placeholder="Select product type" :options="$types" />
            <x-form.text name="sku" label="SKU" required />
        </x-form.two>
        <x-form.two>
            <x-form.text type="number" step="00.1" name="price" label="Price" required />
            <x-form.text type="number" step="00.1" name="discount_price" label="Discount Price" />
        </x-form.two>
        <x-form.two>
            <x-form.date name="manufactured_date" label="Manufactured Date" required />
            <x-form.date name="expired_date" label="Expired Date" required />
        </x-form.two>
        <x-form.two>
            <x-form.text type="number" step="1" name="stock" label="Stock" required />
            <x-form.select name="category_id" label="Category" placeholder="Select product category" :options="$categories"
                required />
        </x-form.two>
        <x-form.markdown name="long_description" label="Long Description" />
        <x-form.submit />
    </x-form.form>
</x-dashboard-layout>
