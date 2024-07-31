@php
    $search = request()->query('search');
    $page = request()->query('page');

    $sortBy = request()->query('sort_by');
    $order = request()->query('order');

    $perPage = request()->query('per_page');
@endphp

<form method="GET" action="" class="flex items-center space-x-4">
    @if ($search)
        <input type="hidden" name="search" value="{{ $search }}" />
    @endif

    @if ($sortBy)
        <input type="hidden" name="sort_by" value="{{ $sortBy }}" />
    @endif

    @if ($order)
        <input type="hidden" name="order" value="{{ $order }}" />
    @endif

    <span class="w-[70px] text-end text-sm font-medium text-gray-700">
        Per page:
    </span>
    <select
        name="per_page"
        id="per_page"
        onchange="this.form.submit()"
        class="w-[80px] rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
    >
        @foreach ([10, 15, 20, 50, 100, 300, 500, 900] as $value)
            <option
                value="{{ $value }}"
                {{ $perPage == $value ? 'selected' : '' }}
            >
                {{ $value }}
            </option>
        @endforeach
    </select>
</form>
