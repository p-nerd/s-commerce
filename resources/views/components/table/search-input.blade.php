@props([
    'href',
    'placeholder' => 'Search...',
])

<form method="GET" class="flex w-full items-center">
    <input
        name="search"
        value="{{ request('search') }}"
        action=""
        type="text"
        placeholder="{{ $placeholder }}"
        class="w-full rounded-l-md border border-gray-300 px-3 py-3 focus:border-gray-300 focus:ring-0"
    />

    <button
        type="submit"
        class="rounded-r-md border-b border-r border-t border-gray-300 bg-green-500 px-4 py-3 font-semibold text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
    >
        Search
    </button>
</form>
