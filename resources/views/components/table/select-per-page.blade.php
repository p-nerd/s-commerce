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
    <input type="hidden" name="sort_by" value="{{ $sortBy }}">
    <input type="hidden" name="order" value="{{ $order }}">
    @if ($page)
        <input type="hidden" name="page" value="{{ $page }}" />
    @endif
    <span class="w-[70px] text-end text-sm font-medium text-gray-700">Per page:</span>
    <select name="per_page" id="per_page" onchange="this.form.submit()"
        class="w-[80px] rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
        <option value="10" {{ !$perPage || $perPage == 10 ? 'selected' : '' }}>10</option>
        <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15</option>
        <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
        <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
        <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
    </select>
</form>
