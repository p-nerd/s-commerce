<x-dashboard-layout>
    <x-slot name="header">
        <x-dashboard.title>
            Create a category
        </x-dashboard.title>
    </x-slot>

    <div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-6 py-3 rounded">
            <form method="POST" action="{{ route('dashboard.categories.store') }}" class="space-y-5">
                @csrf

                <div>
                    <x-input-label for="name" value="Name" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                        required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="description" value="Description" />
                    <x-dashboard.textarea-input id="description" class="mt-1 w-full h-[110px] resize-y"
                        name="description" :value="old('description')" required autofocus
                        autocomplete="description"></x-dashboard.textarea-input>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="parent-category"
                        value="Parent Category (You choose any category then this category will be sub category of that)" />
                    <x-dashboard.select-input id="parent-category" class="block mt-1 w-full"
                        name="Select parent category" :value="old('parent_category')" required autofocus
                        autocomplete="parent-category" :options="$categories" />
                    <x-input-error :messages="$errors->get('parent_category')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-3">
                        Save
                    </x-primary-button>
                </div>
            </form>
        </div>
</x-dashboard-layout>
