<x-store-layout>
    <main
        class="main pages page-content row col-lg-10 pt-150 pb-150 container m-auto"
    >
        <div class="col-md-3 admin-menu">
            <?php
            $links = [
                [
                    'route' => 'account',
                    'label' => 'Dashboard',
                    'icon' => 'fi-rs-settings-sliders',
                ],
                [
                    'route' => 'account.orders',
                    'label' => 'Orders',
                    'icon' => 'fi-rs-shopping-bag',
                ],
                [
                    'route' => 'account.addresses',
                    'label' => 'My Address',
                    'icon' => 'fi-rs-marker',
                ],
                [
                    'route' => 'account.details',
                    'label' => 'Account details',
                    'icon' => 'fi-rs-user',
                ],
            ];
            ?>

            <ul class="nav flex-column">
                @foreach ($links as $link)
                    <li class="nav-item">
                        <a
                            href="{{ route($link['route']) }}"
                            class="nav-link {{ request()->routeIs($link['route']) ? 'active' : '' }}"
                        >
                            <i class="{{ $link['icon'] }} mr-10"></i>
                            {{ $link['label'] }}
                        </a>
                    </li>
                @endforeach

                <li class="nav-item">
                    <form
                        id="logout-form"
                        action="{{ route('logout') }}"
                        method="POST"
                        style="display: none"
                    >
                        @csrf
                    </form>
                    <a
                        class="nav-link"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    >
                        <i class="fi-rs-sign-out mr-10"></i>
                        Logout
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-md-9">
            {{ $slot }}
        </div>
    </main>
</x-store-layout>
