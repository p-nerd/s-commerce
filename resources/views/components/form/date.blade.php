@props([
    'name',
    'label',
    'type' => 'text',
    'value' => '',
])

<div class="w-full">
    <x-form.input-label for="{{ $name }}" value="{{ $label }}" />
    <x-shared.text-input
        type="date"
        id="{{ $name }}"
        name="{{ $name }}"
        :value="old($name) ?? $value"
        {{ $attributes->merge(['class' => 'mt-1 block w-full']) }}
    />
    <x-form.input-error :messages="$errors->get($name)" class="mt-2" />
</div>
