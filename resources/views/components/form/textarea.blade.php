@props(['name', 'label', 'value' => ''])

<div class="w-full">
    <x-form.input-label for="{{ $name }}" value="{{ $label }}" />
    <x-dash.textarea-input id="{{ $name }}" name="{{ $name }}" autocomplete="{{ $name }}"
        class="{{ twMerge('mt-1 h-[110px] w-full resize-y', $attributes['class']) }}" {{ $attributes }}>
        {{ old($name) ?? $value }}
    </x-dash.textarea-input>
    <x-form.input-error :messages="$errors->get($name)" class="mt-2" />
</div>
