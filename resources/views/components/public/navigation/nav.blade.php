@props([
    'name' => 'Les Pattes Heureuses',
])

<nav>
    <h2>Navigation principale</h2>

    <div class="nav-container">
        <a href="{{ route('public.home') }}" title="Aller à la page d'accueil">
            {{ $name }}
        </a>

        <x-public.navigation.links />
    </div>
</nav>
