@props(['name', 'label', 'type' => 'text', 'value' => ''])

<div>
    <x-input-label for="{{ $name }}" value="{{ $label }}" />
    <x-text-input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" :value="old($name) ?? $value"
        class="{{ twMerge('mt-1 block w-full', $attributes['class']) }}" {{ $attributes }} />
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
