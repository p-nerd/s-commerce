@props(['name', 'label', 'placeholder', 'value' => '', 'options' => []])

<div class="w-full">
    <x-input-label for="{{ $name }}" value="{{ $label }}" />
    <x-dash.select-input id="{{ $name }}" name="{{ $name }}"
        class="{{ twMerge('mt-1 block w-full', $attributes['class']) }}"
        placeholder="{{ $placeholder ?? 'Select option' }}" :value="old($name) ?? $value" :options="$options" {{ $attributes }} />
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
