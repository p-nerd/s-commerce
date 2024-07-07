@props(['label'])

<div>
    <div class="font-semibold">{{ $label }}</div>
    <div {{ $attributes->merge(['class' => 'text-gray-700']) }}>{{ $slot }}</div>
</div>
