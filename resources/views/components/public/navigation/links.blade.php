@php
    $links = [
        [
            'name' => __('/public/navigation/header.home'),
            'title' => __('/public/navigation/header.go_home'),
            'href' => route('home'),
            'current' => request()->routeIs('home') ? 'text-red-strong hover:border-b-2 border-red-strong' : '',
        ],
        [
            'name' => __('/public/navigation/header.animals'),
            'title' => __('/public/navigation/header.go_animals'),
            'href' => route('public.animals.index'),
            'current' => request()->routeIs('public.animals.index') ? 'text-red-strong hover:border-b-2 border-red-strong' : '',
        ],
        [
            'name' => __('/public/navigation/header.about'),
            'title' => __('/public/navigation/header.go_about'),
            'href' => route('public.about'),
            'current' => request()->routeIs('public.about') ? 'text-red-strong border-b-2 border-red-strong' : '',
        ],
        [
            'name' => __('/public/navigation/header.contact_us'),
            'title' => __('/public/navigation/header.go_contact_us'),
            'href' => route('public.contact'),
            'current' => request()->routeIs('public.contact') ? 'text-red-strong border-b-2 border-red-strong' : '',
        ],
    ];

@endphp

<ul class="flex items-center gap-6">
    @foreach ($links as $link)
        <li class="flex items-center justify-center py-2 font-sans font-semibold text-blue-strong

        hover:text-red-strong

        transition-colors duration-300
        relative
        before:content-['']
        before:absolute before:left-0 before:bottom-0
        before:w-full before:h-[0.125rem]
        before:bg-red-strong
        before:scale-x-0
        before:origin-left
        before:transition-transform before:duration-300 hover:before:scale-x-100">
            <x-public.navigation.link :href="$link['href']" :title="$link['title']">
                {{ $link['name'] }}
            </x-public.navigation.link>
        </li>
    @endforeach

    <x-public.navigation.language.selector />
</ul>
