@props([
    'name' => __('public/home.name_website'),
])

<nav class="relative flex items-center justify-between bg-white px-6 md:px-12 lg:px-20 py-4 font-sans border-b-[0.25rem] border-b-red-strong">
    <h2 class="sr-only">{{ __('public/home.main_navigation') }}</h2>

    {{-- Burger checkbox --}}
    <input type="checkbox" id="nav-toggle" class="sr-only" />

    <a class="text-red-strong text-xl lg:text-2xl font-black shrink-0" href="{{ route('public.home', app()->getLocale()) }}" title="{{__('public/navigation/header.go_home')
    }}">
        {{ $name }}
    </a>

    {{-- Burger icon --}}
    <label id="nav-burger" for="nav-toggle"
           class="lg:hidden cursor-pointer text-blue-strong hover:text-red-strong transition-colors"
           tabindex="0">
        <span class="sr-only">{{ __('public/navigation/header.toggle_menu') }}</span>
        <x-icons.list class="w-7 h-7" fill="fill-current" />
    </label>

    <label id="nav-close" for="nav-toggle"
           class="hidden lg:hidden fixed top-6 right-6 cursor-pointer text-blue-strong hover:text-red-strong transition-colors"
           tabindex="0">
        <span class="sr-only">{{ __('public/navigation/header.close_menu') }}</span>
        <x-icons.close class="w-8 h-8" fill="fill-current" />
    </label>

    <ul id="main-nav-links" class="hidden lg:flex items-center gap-6">
        <x-public.navigation.links />

        <li class="flex flex-col lg:flex-row items-center gap-6 lg:gap-3 lg:ml-2">
            <x-buttons.button
                href="{{ route('public.volunteer', app()->getLocale()) }}"
                title="{{ __('public/navigation/header.go_volunteer') }}"
                class="bg-red-strong border-red-strong text-white justify-center
                        hover:bg-white hover:text-red-strong">
                {{ __('public/navigation/header.volunteer') }}
            </x-buttons.button>

            <x-public.navigation.language.dropdown />
        </li>
    </ul>
</nav>
