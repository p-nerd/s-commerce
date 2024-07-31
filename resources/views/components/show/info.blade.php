@props(['label'])

<div class="w-full">
    <div class="w-full rounded border">
        <h3 class="px-3 py-2 text-center text-xl font-semibold">
            {{ $label }}
        </h3>
        {{ $slot }}
    </div>
</div>
