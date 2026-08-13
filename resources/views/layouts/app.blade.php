<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Camara Mohamed">
    <meta name="description" content="Les Pattes Heureuses - Gestionnaire de Refuge.">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title . ' - Les Pattes Heureuses' }}</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="min-h-screen font-sans bg-white">

<x-public.navigation.no-script />

<h1 class="sr-only">{{ $title ?? 'Espace de gestion' }}</h1>

<x-public.navigation.skip-link />

<div class="flex min-h-screen">
    <aside class="w-64 shrink-0 border-r border-gray-200 flex flex-col">
        <div class="flex items-center px-4 py-4">
            <a href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}"
               class="font-serif font-bold text-lg text-blue-strong whitespace-nowrap">
                Les Pattes Heureuses
            </a>
        </div>

        <nav class="flex-1 flex flex-col gap-1 px-3 mt-2">
            <a href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg font-serif text-blue-strong hover:bg-red-light whitespace-nowrap {{ request()->routeIs('admin.dashboard') ? 'bg-red-light font-bold' : '' }}">
                <x-icons.house class="w-5 h-5 text-blue-strong shrink-0" />
                <span>Tableau de bord</span>
            </a>

            @can('manage-animals')
                <a href="{{ route('admin.animals.index', ['locale' => app()->getLocale()]) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg font-serif text-blue-strong hover:bg-red-light whitespace-nowrap {{ request()->routeIs('admin.animals.*') ? 'bg-red-light font-bold' : '' }}">
                    <x-icons.paw-print class="w-5 h-5 text-blue-strong shrink-0" />
                    <span>Animaux</span>
                </a>
            @endcan

            @can('manage-adoptions')
                <a href="{{ route('admin.adoptions.index', ['locale' => app()->getLocale()]) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg font-serif text-blue-strong hover:bg-red-light whitespace-nowrap {{ request()->routeIs('admin.adoptions.*') ? 'bg-red-light font-bold' : '' }}">
                    <x-icons.hand-heart class="w-5 h-5 text-blue-strong shrink-0" />
                    <span>Adoptions</span>
                </a>
            @endcan

            @can('manage-data')
                <a href="{{ route('admin.data.index', ['locale' => app()->getLocale()]) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg font-serif text-blue-strong hover:bg-red-light whitespace-nowrap {{ request()->routeIs('admin.data.*') ? 'bg-red-light font-bold' : '' }}">
                    <x-icons.database class="w-5 h-5 text-blue-strong shrink-0" />
                    <span>Données</span>
                </a>
            @endcan

            @if (auth()->user()->isAdmin())
                <p class="px-3 mt-4 mb-1 font-sans text-xs uppercase tracking-wide text-blue-strong/40">
                    Admin
                </p>
            @endif

            @can('manage-messages')
                <a href="{{ route('admin.messages.index', ['locale' => app()->getLocale()]) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg font-serif text-blue-strong hover:bg-red-light whitespace-nowrap {{ request()->routeIs('admin.messages.*') ? 'bg-red-light font-bold' : '' }}">
                    <x-icons.mail class="w-5 h-5 text-blue-strong shrink-0" />
                    <span>Messages</span>
                </a>
            @endcan

            @can('manage-volunteers')
                <a href="{{ route('admin.volunteers.index', ['locale' => app()->getLocale()]) }}"
                   class="flex items-center gap-3 px-3 py-2 rounded-lg font-serif text-blue-strong hover:bg-red-light whitespace-nowrap {{ request()->routeIs('admin.volunteers.*') ? 'bg-red-light font-bold' : '' }}">
                    <x-icons.users class="w-5 h-5 text-blue-strong shrink-0" />
                    <span>Bénévoles</span>
                </a>
            @endcan

        </nav>

        <div class="px-3 py-4 border-t border-gray-200 flex flex-col gap-1">
            <a href="{{ route('admin.profile', ['locale' => app()->getLocale()]) }}"
               class="flex items-center gap-3 px-3 py-2 rounded-lg font-serif text-blue-strong hover:bg-red-light whitespace-nowrap {{ request()->routeIs('admin.profile') ? 'bg-red-light font-bold' : '' }}">
                <span class="w-8 h-8 rounded-full bg-red-light flex items-center justify-center overflow-hidden shrink-0">
                    @if (auth()->user()->avatar)
                        <img src="{{ Storage::url(auth()->user()->avatar) }}" alt=""
                             class="w-full h-full object-cover">
                    @else
                        <span class="font-serif font-bold text-xs text-blue-strong">{{ auth()->user()->initials() }}</span>
                    @endif
                </span>
                <span class="truncate">{{ auth()->user()->name }}</span>
            </a>

            <form method="POST" action="{{ route('logout', ['locale' => app()->getLocale()]) }}">
                @csrf
                <button type="submit"
                        class="w-full text-left flex items-center gap-3 px-3 py-2 rounded-lg font-serif text-red-normal hover:bg-red-light cursor-pointer whitespace-nowrap">
                    <x-icons.sign-out class="w-5 h-5 text-red-normal shrink-0" />
                    <span>Se déconnecter</span>
                </button>
            </form>
        </div>
    </aside>

    <main id="main-content" class="flex-1 p-8 min-w-0">
        {{ $slot }}
    </main>
</div>

</body>

</html>
