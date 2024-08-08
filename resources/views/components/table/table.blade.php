<div
    class="{{ $attributes['divClass'] }} relative w-full overflow-auto rounded-md border border-b-0 shadow-sm"
>
    <table
        {{ $attributes->merge(['class' => 'w-full caption-bottom text-xs']) }}
    >
        {{ $slot }}
    </table>
</div>
