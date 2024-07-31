@props([
    'href',
    'label' => null,
    'confirm' => null,
    'confirmText' => '',
])

<form
    method="POST"
    action="{{ $href }}"
    onsubmit="{{ $confirm ? 'handleDeleteSubmit()' : '' }} "
>
    @csrf
    @method('delete')
    <button
        type="submit"
        class="{{ twMerge('inline-flex w-full items-center justify-start whitespace-nowrap text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-9 rounded-md px-3 bg-red-500 text-white space-x-1', $attributes['class']) }}"
        {{ $attributes }}
    >
        <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            class="h-4 w-4"
        >
            <path d="M3 6h18" />
            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
            <line x1="10" x2="10" y1="11" y2="17" />
            <line x1="14" x2="14" y1="11" y2="17" />
        </svg>
        @if ($label)
            <span>{{ $label }}</span>
        @endif
    </button>
</form>

<script>
    function handleDeleteSubmit(event) {
        event.preventDefault();
        sweetalert({
            title: '{{ $confirm }}',
            text: '{{ $confirmText }}',
            icon: 'warning',
            dangerMode: true,
            buttons: ['Cancel', 'Confirm'],
        }).then((result) => {
            if (result) {
                event.target.submit();
            }
        });
    }
</script>
