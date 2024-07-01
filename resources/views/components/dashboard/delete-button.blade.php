@props(['id', 'href'])

<form id="{{ $id }}" method="POST" action="{{ $href }}">
    @csrf
    <input type="hidden" name="_method" value="delete" />
    <x-dashboard.primary-button id="{{ $id }}">{{ $slot }}</x-dashboard>
</form>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById(
            "{{ $id }}"
        );

        form.addEventListener("submit", function(event) {
            const confirmed = confirm(
                "Are you sure you want to delete this category?"
            );
            if (!confirmed) {
                event.preventDefault();
            }
        });
    });
</script>
