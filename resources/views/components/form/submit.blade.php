<div class="mt-4 flex items-center justify-end">
    <x-primary-button class="ms-3">
        @if ($slot->isEmpty())
            Save
        @else
            {{ $slot }}
        @endif
    </x-primary-button>
</div>
