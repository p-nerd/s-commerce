<?php

$dashboardIcon = '
    <svg
        class="h-6 w-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg">
        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
    </svg>
';

$listIcon = '
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-list"><line x1="8" x2="21" y1="6" y2="6"/><line x1="8" x2="21" y1="12" y2="12"/><line x1="8" x2="21" y1="18" y2="18"/><line x1="3" x2="3.01" y1="6" y2="6"/><line x1="3" x2="3.01" y1="12" y2="12"/><line x1="3" x2="3.01" y1="18" y2="18"/>
    </svg>
';

$newIcon = '
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-badge-plus"><path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/><line x1="12" x2="12" y1="8" y2="16"/><line x1="8" x2="16" y1="12" y2="12"/>
    </svg>
';

$sidebarLinks = [
    [
        'label' => 'Dashboard',
        'href' => route('dashboard'),
        'icon' => $dashboardIcon,
    ],
    [
        'label' => 'Categories',
        'icon' => $dashboardIcon,
        'subLinks' => [
            [
                'label' => 'List',
                'href' => route('dashboard.categories'),
                'icon' => $listIcon,
            ],
            [
                'label' => 'New',
                'href' => route('dashboard.categories.create'),
                'icon' => $newIcon,
            ],
        ],
    ],
    [
        'label' => 'Products',
        'icon' => $dashboardIcon,
        'subLinks' => [
            [
                'label' => 'List',
                'href' => route('dashboard.products'),
                'icon' => $listIcon,
            ],
            [
                'label' => 'New',
                'href' => route('dashboard.products.create'),
                'icon' => $newIcon,
            ],
        ],
    ],
];

?>

<aside id="sidebar"
    class="transition-width fixed left-0 top-0 z-20 hidden h-full w-64 flex-shrink-0 flex-col pt-16 font-normal duration-75 lg:flex">
    <div
        class="relative flex min-h-0 flex-1 flex-col border-r border-gray-200 bg-white pt-0 dark:border-gray-700 dark:bg-gray-800">
        <div
            class="overflow-y-autoscrollbar scrollbar-w-2 scrollbar-thumb-rounded-[0.1667rem] scrollbar-thumb-slate-200 scrollbar-track-gray-400 dark:scrollbar-thumb-slate-900 dark:scrollbar-track-gray-800 flex flex-1 flex-col pb-28 pt-5">
            <div class="flex-1 space-y-1 divide-y divide-gray-200 bg-white px-3 dark:divide-gray-700 dark:bg-gray-800">
                <ul class="space-y-2 pb-2">
                    <li>
                        <form action="#" method="GET" class="lg:hidden">
                            <label for="mobile-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                    <svg class="h-5 w-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <input type="text" name="email" id="mobile-search"
                                    class="focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 pl-10 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 dark:placeholder-gray-400"
                                    placeholder="Search" />
                            </div>
                        </form>
                    </li>
                    @foreach ($sidebarLinks as $link)
                        @if (isset($link['subLinks']))
                            <li x-data="{ open: {{ !!array_filter($link['subLinks'], fn($sublink) => $sublink['href'] === request()->url()) ? 'true' : 'false' }} }">
                                <button @click="open = !open" type="button"
                                    class="group flex w-full items-center rounded-lg p-2 text-base text-gray-900 transition duration-75 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    {!! $link['icon'] !!}
                                    <span class="ml-3 flex-1 whitespace-nowrap text-left"
                                        sidebar-toggle-item>{{ $link['label'] }}</span>
                                    <svg sidebar-toggle-item class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <ul x-show="open" class="space-y-2 py-2">
                                    @foreach ($link['subLinks'] as $subLink)
                                        <li>
                                            <a href="{{ $subLink['href'] }}"
                                                class="{{ request()->url() === $subLink['href'] ? 'bg-gray-100' : '' }} group flex items-center space-x-2 rounded-lg p-2 pl-11 text-base text-gray-900 transition duration-75 hover:bg-gray-100">

                                                <span>

                                                    {!! $subLink['icon'] !!}
                                                </span>
                                                <span>
                                                    {{ $subLink['label'] }}
                                                </span>

                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li>
                                <a href="{{ $link['href'] }}"
                                    class="{{ request()->url() === $link['href'] ? 'bg-gray-100' : '' }} group flex items-center rounded-lg p-2 text-base text-gray-900 hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">

                                    {!! $link['icon'] !!}
                                    <span class="ml-3" sidebar-toggle-item>{{ $link['label'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 hidden w-full justify-center space-x-4 bg-white p-4 dark:bg-gray-800 lg:flex"
            sidebar-bottom-menu>
            <a href="/settings/" data-tooltip-target="tooltip-settings"
                class="inline-flex cursor-pointer justify-center rounded p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-700 dark:hover:text-white">
                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
            <div id="tooltip-settings" role="tooltip"
                class="tooltip invisible absolute z-10 inline-block rounded-lg bg-gray-900 px-3 py-2 text-sm font-medium text-white opacity-0 shadow-sm transition-opacity duration-300 dark:bg-gray-700">
                Settings page
                <div class="tooltip-arrow" data-popper-arrow></div>
            </div>
        </div>
    </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop">
</div>
