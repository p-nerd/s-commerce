@props(['label' => null, 'class' => ''])

<div class="{{ $class }} border-t px-3 py-2">
    @if ($label)
        <span class="font-medium">{{ $label }}:</span>
    @endif

    {{ $slot }}
</div>
