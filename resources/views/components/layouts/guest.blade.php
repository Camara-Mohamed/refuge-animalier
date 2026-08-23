<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Camara Mohamed">
    <meta name="description" content="{{ __('public/home.meta_description') }}">
    <meta name="keywords" content="refuge, adoption, animaux à adopter, bénévoles, chat, chien, Les Pattes Heureuses">

    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ __('public/home.meta_description') }}">
    <meta property="og:type" content="website">

    <title>{{ $title }}</title>

    @php
        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => __('public/home.name_website'),
            'url' => route('public.home', app()->getLocale()),
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Rue des Animaux 12',
                'postalCode' => '1000',
                'addressLocality' => 'Bruxelles',
                'addressCountry' => 'BE',
            ],
            'telephone' => __('public/contact.info_phone'),
            'email' => __('public/contact.info_email'),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($organizationSchema) !!}</script>

    @if ($schema ?? null)
        <script type="application/ld+json">{!! json_encode($schema) !!}</script>
    @endif

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="min-h-screen font-sans bg-white max-w-[1920px] m-auto">

<x-public.navigation.no-script />

<h1 class="sr-only">
    {{ $title }}
</h1>

<x-public.navigation.skip-link />

<x-public.navigation.header></x-public.navigation.header>

<main id="main-content">

    {{ $slot }}

</main>

<x-public.navigation.footer></x-public.navigation.footer>

</body>

</html>
