@props([
    'name',
    'label',
    'value' => '',
    'placeholder' => '',
])

<div class="w-full space-y-2">
    <x-form.input-label for="{{ $name }}" value="{{ $label }}" />
    <input
        id="{{ $name }}"
        type="hidden"
        name="{{ $name }}"
        value="{!! old($name) ?? $value !!}"
    />
    <trix-editor
        input="{{ $name }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'prose lg:prose-sm prose-a:text-blue-600 bg-white rounded-md min-h-[400px] max-w-full w-full']) }}
    />
    <x-form.input-error :messages="$errors->get($name)" class="mt-2" />
</div>
