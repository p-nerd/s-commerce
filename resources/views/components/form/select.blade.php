@props([
    'name',
    'label' => null,
    'placeholder',
    'value' => '',
    'options' => [],
])

<div class="w-full">
    <x-form.input-label for="{{ $name }}" value="{{ $label }}" />
    <x-dash.select-input
        id="{{ $name }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder ?? 'Select option' }}"
        :value="old($name) ?? $value"
        :options="$options"
        {{ $attributes->merge(['class' => 'mt-1 block w-full']) }}
    />
    <x-form.input-error :messages="$errors->get($name)" class="mt-2" />
</div>
