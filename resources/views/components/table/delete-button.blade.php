@props(['id', 'href'])

<form id="{{ $id }}" method="POST" action="{{ $href }}">
    @csrf
    <input type="hidden" name="_method" value="delete" />
    <x-dash.primary-button id="{{ $id }}" class="bg-red-500 text-white">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
            <path d="M3 6h18" />
            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
            <line x1="10" x2="10" y1="11" y2="17" />
            <line x1="14" x2="14" y1="11" y2="17" />
        </svg>
    </x-dash.primary-button>
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
