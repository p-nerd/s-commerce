<div class="{{ twMerge('relative w-full overflow-auto rounded-md border bg-white shadow', $attributes['divClass']) }}">
    <table class="{{ twMerge('w-full caption-bottom text-xs', $attributes['class']) }}" {{ $attributes }}>
        {{ $slot }}
    </table>
</div>
