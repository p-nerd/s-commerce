@props([
    'href',
])

<x-dash.link-button href="{{ $href }}" class="bg-green-500 text-white">
    {{ $slot }}
</x-dash.link-button>
