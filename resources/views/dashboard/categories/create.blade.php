<x-dashboard-layout>
    <x-slot name="header">
        <x-dashboard.title>
            Create a category
        </x-dashboard.title>
    </x-slot>

    <div class="mx-auto max-w-4xl px-4 py-6 sm:px-6 lg:px-8">
        <div class="rounded bg-white p-6 py-3">
            <form method="POST" action="{{ route('dashboard.categories.store') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" value="Description" />
                    <x-dashboard.textarea-input id="description" class="mt-1 h-[110px] w-full resize-y"
                        name="description" :value="old('description')" required autofocus
                        autocomplete="description"></x-dashboard.textarea-input>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="parent-category"
                        value="Parent Category (You choose any category then this category will be sub category of that)" />
                    <x-dashboard.select-input id="parent-category" class="mt-1 block w-full"
                        name="Select parent category" :value="old('parent_category')" required autofocus
                        autocomplete="parent-category" :options="$categories" />
                    <x-input-error :messages="$errors->get('parent_category')" class="mt-2" />
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <x-primary-button class="ms-3">
                        Save
                    </x-primary-button>
                </div>
            </form>
        </div>
</x-dashboard-layout>
