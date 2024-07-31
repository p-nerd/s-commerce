@props([
    'route',
])

<a
    class="{{ request()->routeIs($route) ? 'active' : '' }}"
    href="{{ route($route) }}"
>
    {{ $slot }}
</a>
