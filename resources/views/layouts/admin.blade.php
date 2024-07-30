<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} / Admin</title>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body
    class="scrollbar scrollbar-w-3 scrollbar-thumb-rounded-[0.25rem] scrollbar-track-slate-200 scrollbar-thumb-gray-400 dark:scrollbar-track-gray-900 dark:scrollbar-thumb-gray-700 relative bg-gray-50 selection:bg-red-500 selection:text-white dark:bg-gray-800">

    <x-dash.navbar />
    <x-dash.sidebar />

    <div class="flex overflow-hidden bg-gray-50 pt-16 dark:bg-gray-900">
        <div id="main-content"
            class="relative h-full w-full overflow-y-auto bg-gray-50 text-center dark:bg-gray-900 lg:ml-64">
            @isset($header)
                <header class="flex items-center justify-between rounded-md p-4 text-start">
                    {{ $header }}
                </header>
            @endisset
            <main class="p-4 text-start">
                <div class="space-y-4 rounded-md">
                    {{ $slot }}
                </div>
                @isset($back)
                    <div class="flex py-8">
                        <a href="{{ $back }}" class="rounded-md bg-gray-700 px-3 py-2 text-white">Go Back</a>
                    </div>
                @endisset
            </main>
        </div>
    </div>

    <x-dash.success-message />

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>
