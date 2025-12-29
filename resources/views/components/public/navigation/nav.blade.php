@props([
    'name' => __('public/home.name_website'),
])

<nav class="flex items-center justify-between bg-white px-20 py-4 font-sans border-b-[0.25rem] border-b-red-strong">
    <h2 class="hidden">{{ __('public/home.main_navigation') }}</h2>

    <a class="text-red-strong text-2xl font-black" href="{{ route('home', app()->getLocale()) }}" title="{{__('public/navigation/header.go_home')
    }}">
        {{ $name }}
    </a>

    <x-public.navigation.links />

</nav>
