@php
    $links = [
        [
            'name' => 'Accueil',
            'title' => 'Aller à la page d\'accueil',
            'href' => route('public.home'),
        ],
        [
            'name' => 'Nos Résidents',
            'title' => 'Aller à la page des animaux',
            'href' => '#',
        ],
        [
            'name' => 'À propos',
            'title' => 'Aller à la page à propos',
            'href' => '#',
        ],
        [
            'name' => 'Nous Contact',
            'title' => 'Aller à la page de contact',
            'href' => '#',
        ],
    ];

    $buttonLink = [
        'name_button' => 'Devenir Bénévole',
        'title_button' => 'Aller à la page pour devenir bénévole',
        'href_button' => '#',
    ];
@endphp

<ul>
    @foreach($links as $link)
        <li>
            <x-public.navigation.link
                :href="$link['href']"
                :title="$link['title']"
            >
                {{ $link['name'] }}
            </x-public.navigation.link>
        </li>
    @endforeach
    <li>
        <x-public.navigation.button
            :href="$buttonLink['href_button']"
            :title="$buttonLink['title_button']"
        >
            {{ $buttonLink['name_button'] }}
        </x-public.navigation.button>
    </li>
</ul>
