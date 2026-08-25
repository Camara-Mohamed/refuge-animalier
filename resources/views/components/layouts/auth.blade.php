@props(['title' => 'Les Pattes Heureuses'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Camara Mohamed">
    <meta name="description" content="Les Pattes Heureuses - Gestionnaire de Refuge.">
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title }}</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="min-h-screen font-sans bg-white">

<x-public.navigation.skip-link />

<h1 class="sr-only">{{ $title }}</h1>

<div class="min-h-screen flex flex-col md:flex-row">
    <div class="w-full md:w-[44%] shrink-0 bg-red-strong flex items-center justify-center py-10 md:py-0">
        <a href="{{ route('public.home', app()->getLocale()) }}"
           class="font-serif font-black text-white text-2xl md:text-3xl text-center px-6">
            Les Pattes Heureuses
        </a>
    </div>

    <main id="main-content" class="flex-1 flex items-start md:items-center justify-center p-6 md:p-12">
        <div class="w-full max-w-md flex flex-col gap-6">
            <a href="{{ route('public.home', app()->getLocale()) }}"
               class="inline-flex items-center gap-2 font-serif text-sm text-blue-strong hover:text-red-strong transition self-start">
                <x-icons.arrow-left class="w-4 h-4" fill="fill-current" />
                Retour à l'accueil
            </a>

            {{ $slot }}
        </div>
    </main>
</div>

</body>

</html>
