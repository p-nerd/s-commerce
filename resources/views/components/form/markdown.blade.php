@props(['name', 'label', 'value' => '', 'placeholder' => ''])

<div class="w-full space-y-2">
    <x-input-label for="{{ $name }}" value="{{ $label }}" />
    <input id="{{ $name }}" type="hidden" name="{{ $name }}">
    <trix-editor input="{{ $name }}" placeholder="{{ $placeholder }}"
        class="{{ twMerge('h-[400px] w-full resize-y', $attributes['class']) }}" {{ $attributes }}>
        {{ old($name) ?? $value }}</trix-editor>
    <x-input-error :messages="$errors->get($name)" class="mt-2" />
</div>
