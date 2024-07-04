@props(['href'])

<form x-data="{ href: '{{ $href }}' }" method="POST" action="{{ $href }}">
    @csrf
    <input type="hidden" name="_method" value="delete" />
    <button type="submit"
        class="{{ twMerge('inline-flex items-center justify-center whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3 bg-red-500 text-white', $attributes['class']) }}"
        @click.prevent="
            if(confirm('Are you sure you want to delete this item?')) {
                $el.closest('form').submit()
            }
        "
        {{ $attributes }}
        >
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4">
            <path d="M3 6h18" />
            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
            <line x1="10" x2="10" y1="11" y2="17" />
            <line x1="14" x2="14" y1="11" y2="17" />
        </svg>
    </button>
</form>
