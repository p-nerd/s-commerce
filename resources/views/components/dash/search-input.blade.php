@props(['href'])

<form method="GET" class="flex w-full items-center">
    <input name="search" value="{{ request()->query('search') }}" action="" type="text" placeholder="Search..."
        class="w-full rounded-l-md border border-gray-300 px-3 py-3 focus:border-gray-300 focus:ring-0" />

    <button type="submit"
        class="rounded-r-md bg-green-500 text-white border-b border-r border-t border-gray-300 px-4 py-3 font-semibold focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        Search
    </button>
</form>
