@props(['label' => null, 'class' => ''])

<div
    {{ $attributes->merge(['class' => 'prose w-full max-w-full border-t px-3 py-2']) }}
>
    @if ($label)
        <span class="font-medium">{{ $label }}:</span>
    @endif

    {{ $slot }}
</div>
