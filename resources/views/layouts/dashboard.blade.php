<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} Dashboard</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="scrollbar scrollbar-w-3 scrollbar-thumb-rounded-[0.25rem] scrollbar-track-slate-200 scrollbar-thumb-gray-400 dark:scrollbar-track-gray-900 dark:scrollbar-thumb-gray-700 bg-gray-50 selection:bg-red-500 selection:text-white dark:bg-gray-800">

    @include('layouts.navbar')

    @include('layouts.sidebar')

    <div class="flex overflow-hidden bg-gray-50 pt-16 dark:bg-gray-900">
        <div id="main-content"
            class="relative h-full w-full overflow-y-auto bg-gray-50 text-center dark:bg-gray-900 lg:ml-64">
            @isset($header)
                <header class="flex items-center justify-between rounded-md p-4 py-4 text-start">
                    {{ $header }}
                </header>
            @endisset
            <main class="p-4 text-start">
                <div class="space-y-4 rounded-md">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</body>

</html>
