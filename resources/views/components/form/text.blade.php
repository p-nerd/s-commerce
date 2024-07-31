@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
])

<div class="w-full">
    <x-form.input-label for="{{ $name }}" value="{{ $label }}" />
    <x-shared.text-input
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        :value="old($name) ?? $value"
        {{ $attributes->merge(['class' => 'text-gray-700'])}}
    />
    <x-form.input-error :messages="$errors->get($name)" class="mt-2" />
</div>
