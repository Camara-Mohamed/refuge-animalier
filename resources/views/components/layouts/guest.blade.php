<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Camara Mohamed">
    <meta name="description"
          content="Les Pattes Heureuses - Plateforme de gestion et d'adoption d'animaux. Gérez les
     fiches animaux, les demandes d'adoption, les bénévoles et suivez les statistiques du refuge.">
    <meta name="keywords" content="refuge, adoption, animaux à adopter, bénévoles, chat, chien, Les Pattes Heureuses">

    <meta property="og:title" content="Les Pattes Heureuses - Application">
    <meta property="og:description" content="Gérez votre refuge animalier avec notre application">
    <meta property="og:type" content="website">

    <title>{{ $title }}</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="min-h-screen font-sans bg-white max-w-[1920px] m-auto">

<x-no-script />

<h1 class="sr-only">
    {{ $title }}
</h1>

<x-skip-link />

<x-public.navigation.header></x-public.navigation.header>

<main id="main-content">

    {{ $slot }}

</main>

<x-public.navigation.footer></x-public.navigation.footer>

</body>

</html>
