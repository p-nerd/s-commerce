@props(["items", "label" => null])

<a class="{{ request('per_page') == $items ? 'active' : ''}}" href="?per_page={{ $items }}">
   {{ $label ?? $items }}
</a>
