<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-form.input-label for="name" :value="__('Name')" />
            <x-shared.text-input id="name" class="mt-1 block w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-form.input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-form.input-label for="email" :value="__('Email')" />
            <x-shared.text-input id="email" class="mt-1 block w-full" type="email" name="email"
                :value="old('email')" required autocomplete="username" />
            <x-form.input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-form.input-label for="password" :value="__('Password')" />

            <x-shared.text-input id="password" class="mt-1 block w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-form.input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-form.input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-shared.text-input id="password_confirmation" class="mt-1 block w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-form.input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-4 flex items-center justify-end">
            <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-shared.primary-button class="ms-4">
                {{ __('Register') }}
            </x-shared.primary-button>
        </div>
    </form>
</x-guest-layout>
