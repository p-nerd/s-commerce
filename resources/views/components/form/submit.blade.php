<div class="mt-4 flex items-center justify-end">
    <x-shared.primary-button class="ms-3">
        @if ($slot->isEmpty())
            Save
        @else
            {{ $slot }}
        @endif
    </x-shared.primary-button>
</div>
