@props(['href'])

<form method="GET" class="flex items-center">
    <input name="search" value="{{ request()->query('search') }}" action="" type="text" placeholder="Search..."
        class="w-full rounded-l-md border border-gray-300 px-3 py-3 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500" />

    <button type="submit"
        class="rounded-r-md bg-blue-500 px-4 py-3 font-semibold text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
        Search
    </button>
</form>
