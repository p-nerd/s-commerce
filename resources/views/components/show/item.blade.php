@props(['label'])

<div class="w-full">
    <div class="font-semibold">{{ $label }}</div>
    <div {{ $attributes->merge(['class' => 'text-gray-700']) }}>{{ $slot }}</div>
</div>
