<x-dashboard-layout>
    <x-slot name="header">
        <x-dash.title>
            Update '{{ $category->name }}' category
        </x-dash.title>
    </x-slot>

    <x-form.form method="PATCH" action="{{ route('dashboard.categories.update', $category) }}" confirm="Are you sure?"
        confirmText="This will update the category with the given values">
        <x-form.text name="name" label="Name" :value="$category->name" required autofocus />
        <x-form.textarea name="description" label="Description" :value="$category->description" required autofocus />
        <x-form.select name="parent_id"
            label="Parent Category (You choose any category then this category will be sub category of that)"
            placeholder="Select parent category" :value="$category->parent_id" :options="$categories" />
        <x-form.submit>Update</x-form>
    </x-form.form>
</x-dashboard-layout>
