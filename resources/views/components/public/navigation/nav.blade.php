@props([
    'name' => __('public/home.name_website'),
])

<nav class="flex items-center justify-between bg-white px-20 py-4 font-sans shadow">
    <h2 class="hidden">{{ __('public/home.main_navigation') }}</h2>

    <a class="text-red-strong text-2xl font-black" href="{{ route('home', app()->getLocale()) }}" title="Aller à la page
    d'accueil">
        {{ $name }}
    </a>

    <x-public.navigation.links />

</nav>
