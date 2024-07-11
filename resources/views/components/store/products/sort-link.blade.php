@props(["column", "label", "order"])

<a
    class="{{ request('sort_by') === $column && request('order') === $order ? 'active' : '' }}"
    href="?sort_by={{ $column }}&order={{ $order }}"
>
    {{ $label }}
</a>
