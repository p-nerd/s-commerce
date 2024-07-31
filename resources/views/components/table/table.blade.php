<div
    class="relative w-full overflow-auto rounded-md border border-b-0 bg-white shadow {{ $attributes['divClass'] }}"
>
    <table
        {{ $attributes->merge(['class' => 'w-full caption-bottom text-xs'])}}
        >
        {{ $slot }}
    </table>
</div>
