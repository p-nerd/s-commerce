<?php

$adminIcon = '
    <svg
        class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
    </svg>
';

$userIcon = '
    <svg
        class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path fill-rule="evenodd" d="M10 12a5 5 0 100-10 5 5 0 000 10zm-7 8a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
    </svg>
';

$categoryIcon = '
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
        class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
    >
        <rect width="7" height="7" x="3" y="3" rx="1"></rect>
        <rect width="7" height="7" x="14" y="3" rx="1"></rect>
        <rect width="7" height="7" x="14" y="14" rx="1"></rect>
        <rect width="7" height="7" x="3" y="14" rx="1"></rect>
    </svg>
';

$productIcon = '
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
        class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
    >
        <path d="m7.5 4.27 9 5.15"></path>
        <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
        <path d="m3.3 7 8.7 5 8.7-5"></path>
        <path d="M12 22V12"></path>
    </svg>
';

$orderIcon = '
    <svg
        class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
        fill="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
    >
        <path d="M19 4h-4a2 2 0 00-2-2h-2a2 2 0 00-2 2H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V6a2 2 0 00-2-2zm-7 0h2v2h-2V4zM5 20V6h14v14H5zm4-7h6v2H9v-2zm0 4h6v2H9v-2zM9 9h6v2H9V9z"></path>
    </svg>
';

$listIcon = '
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
        class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
    >
        <line x1="8" x2="21" y1="6" y2="6"/>
        <line x1="8" x2="21" y1="12" y2="12"/>
        <line x1="8" x2="21" y1="18" y2="18"/>
        <line x1="3" x2="3.01" y1="6" y2="6"/>
        <line x1="3" x2="3.01" y1="12" y2="12"/>
        <line x1="3" x2="3.01" y1="18" y2="18"/>
    </svg>
';

$newIcon = '
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
        class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900"
    >
        <path d="M3.85 8.62a4 4 0 0 1 4.78-4.77 4 4 0 0 1 6.74 0 4 4 0 0 1 4.78 4.78 4 4 0 0 1 0 6.74 4 4 0 0 1-4.77 4.78 4 4 0 0 1-6.75 0 4 4 0 0 1-4.78-4.77 4 4 0 0 1 0-6.76Z"/>
        <line x1="12" x2="12" y1="8" y2="16"/>
        <line x1="8" x2="16" y1="12" y2="12"/>
    </svg>
';

$sidebarLinks = [
    [
        'label' => 'Overview',
        'href' => route('admin'),
        'icon' => $adminIcon,
    ],
    [
        'label' => 'Users',
        'icon' => $userIcon,
        'href' => route('admin.users'),
        'subLinks' => [
            [
                'label' => 'List',
                'href' => route('admin.users'),
                'icon' => $listIcon,
            ],
            [
                'label' => 'New',
                'href' => route('admin.users.create'),
                'icon' => $newIcon,
            ],
        ],
    ],
    [
        'label' => 'Categories',
        'icon' => $categoryIcon,
        'href' => route('admin.categories'),
        'subLinks' => [
            [
                'label' => 'List',
                'href' => route('admin.categories'),
                'icon' => $listIcon,
            ],
            [
                'label' => 'New',
                'href' => route('admin.categories.create'),
                'icon' => $newIcon,
            ],
        ],
    ],
    [
        'label' => 'Products',
        'icon' => $productIcon,
        'href' => route('admin.products'),
        'subLinks' => [
            [
                'label' => 'List',
                'href' => route('admin.products'),
                'icon' => $listIcon,
            ],
            [
                'label' => 'New',
                'href' => route('admin.products.create'),
                'icon' => $newIcon,
            ],
        ],
    ],
    [
        'label' => 'Orders',
        'icon' => $orderIcon,
        'href' => route('admin.orders'),
        'subLinks' => [
            [
                'label' => 'List',
                'href' => route('admin.orders'),
                'icon' => $listIcon,
            ],
            [
                'label' => 'New',
                'href' => route('admin.orders.create'),
                'icon' => $newIcon,
            ],
        ],
    ],
];

?>

<aside id="sidebar"
    class="fixed top-0 left-0 z-20 flex-col flex-shrink-0 hidden h-full pt-16 font-normal duration-75 transition-width w-60 lg:flex">
    <div
        class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200 dark:border-gray-700 dark:bg-gray-800">
        <div
            class="overflow-y-autoscrollbar scrollbar-w-2 scrollbar-thumb-rounded-[0.1667rem] scrollbar-thumb-slate-200 scrollbar-track-gray-400 dark:scrollbar-thumb-slate-900 dark:scrollbar-track-gray-800 flex flex-1 flex-col pb-28 pt-5">
            <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                <ul class="pb-2 space-y-2">
                    <li>
                        <form action="#" method="GET" class="lg:hidden">
                            <label for="mobile-search" class="sr-only">Search</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
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
                                    class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700">
                                    {!! $link['icon'] !!}
                                    <span class="flex-1 ml-3 text-left whitespace-nowrap"
                                        sidebar-toggle-item>{{ $link['label'] }}</span>
                                    <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <ul x-show="open" class="py-2 space-y-2">
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
    </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50 dark:bg-gray-900/90" id="sidebarBackdrop">
</div>
