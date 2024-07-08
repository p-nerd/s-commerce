@props(['name', 'label', 'value' => '', 'placeholder' => ''])

<div class="w-full space-y-2">
    <x-form.input-label for="{{ $name }}" value="{{ $label }}" />
    <input id="{{ $name }}" type="hidden" name="{{ $name }}" value="{!! old($name) ?? $value !!}">
    <trix-editor input="{{ $name }}" placeholder="{{ $placeholder }}"
        class="{{ twMerge('prose lg:prose-sm prose-a:text-blue-600 min-h-[400px] max-w-full w-full', $attributes['class']) }}"
        {{ $attributes }} />
    <x-form.input-error :messages="$errors->get($name)" class="mt-2" />
</div>
