<x-admin-layout>
    <x-slot name="back">
        {{ route('admin.categories') }}
    </x-slot>
    <x-slot name="header">
        <x-dash.title>Update category #{{ $category->id }}</x-dash.title>
    </x-slot>
    <x-form.form
        method="PATCH"
        action="{{ route('admin.categories.update', $category) }}"
        confirm="Are you sure?"
        confirmText="This will update the category with the given values"
    >
        <div class="mx-auto w-1/2 space-y-5">
            <x-form.text
                name="name"
                label="Name"
                :value="$category->name"
                required
                autofocus
            />
            <x-form.textarea
                name="description"
                label="Description"
                :value="$category->description"
                required
                autofocus
            />
            <x-form.select
                name="parent_id"
                label="Parent Category (You choose any category then this category will be sub category of that)"
                placeholder="Select parent category"
                :value="$category->parent_id"
                :options="$categories"
            />
            <x-form.submit>Update</x-form.submit>
        </div>
    </x-form.form>
</x-admin-layout>
