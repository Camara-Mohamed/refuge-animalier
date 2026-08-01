@props([
    'name' => 'Les Pattes Heureuses',
])

<nav class="flex items-center justify-between bg-white px-20 py-4 font-sans shadow">
    <h2 class="hidden">Navigation principale</h2>

    <a class="text-red-strong text-2xl font-black" href="{{ route('home') }}" title="Aller à la page d'accueil">
        {{ $name }}
    </a>

    <x-public.navigation.links />

</nav>
