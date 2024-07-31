@props([
    'href',
    'label' => 'Go Back',
])

<a href="{{ $href }}" class="rounded-md bg-gray-600 px-3 py-2 text-white">
    {{ $label }}
</a>
