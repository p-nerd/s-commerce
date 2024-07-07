<x-dashboard-layout>
    <x-slot name="header">
        <x-dash.title>
            Create a new category
        </x-dash.title>
    </x-slot>
        <form method="POST" action="{{ route('dashboard.categories.store') }}" class="bg-white p-5 rounded-lg shadow">
            @csrf
            <div class="space-y-5">
            <div>
                <x-input-label for="name" value="Name" />
                <x-text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="description" value="Description" />
                <x-dash.textarea-input id="description" class="mt-1 h-[110px] w-full resize-y" name="description"
                    :value="old('description')" required autofocus
                    autocomplete="description">{{ old('description') }}</x-dash.textarea-input>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="parent-id"
                    value="Parent Category (You choose any category then this category will be sub category of that)" />
                <x-dash.select-input id="parent-id" class="mt-1 block w-full" name="parent_id"
                    placeholder="Select parent category" :value="old('parent_id')" :options="$categories" />
                <x-input-error :messages="$errors->get('parent_id')" class="mt-2" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <x-primary-button class="ms-3">
                    Save
                </x-primary-button>
            </div>
            </div>

        </form>
</x-dashboard-layout>
