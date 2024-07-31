@props([
    'label',
])

<div class="w-full">
    <div class="font-semibold">{{ $label }}</div>
    <div
        class="{{ twMerge('text-gray-700 max-w-full w-full prose lg:prose-sm prose-a:text-blue-600', $attributes['class']) }}"
        {{ $attributes }}
    >
        {{ $slot }}
    </div>
</div>
