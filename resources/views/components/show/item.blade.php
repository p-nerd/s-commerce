@props([
    'label',
])

<div class="w-full">
    <div class="font-semibold">{{ $label }}</div>
    <div {{ $attributes->twMerge('text-gray-700') }}>{{ $slot }}</div>
</div>
