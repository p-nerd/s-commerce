<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div>
            <x-form.input-label for="password" :value="__('Password')" />

            <x-shared.text-input id="password" class="mt-1 block w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4 flex justify-end">
            <x-shared.primary-button>
                {{ __('Confirm') }}
            </x-shared.primary-button>
        </div>
    </form>
</x-guest-layout>
