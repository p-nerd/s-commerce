@props([
    'label',
])

<div class="w-full">
    <div class="font-semibold">{{ $label }}</div>
    <div
        {{ $attributes->merge(['class' => 'text-gray-700 max-w-full w-full prose lg:prose-sm prose-a:text-blue-600']) }}
    >
        {{ $slot }}
    </div>
</div>
