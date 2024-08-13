<x-admin-layout>
    <x-slot name="header">
        <x-dash.title>Site Customization</x-dash.title>
    </x-slot>
    <div class="mx-auto flex flex-col space-y-8 pb-10">
        @include('admin.settings.customize.news-flashes')
        @include('admin.settings.customize.hero-sliders')
    </div>
</x-admin-layout>
