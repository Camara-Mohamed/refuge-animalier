@php
    $links = [
        [
            'name' => __('/public/navigation/footer.home'),
            'title' => __('/public/navigation/footer.go_home'),
            'href' => route('public.home',  app()->getLocale()),
            'current' => request()->routeIs('public.home') ? 'text-red-strong hover:border-b-2 border-red-strong' : '',
        ],
        [
            'name' => __('/public/navigation/footer.animals'),
            'title' => __('/public/navigation/footer.go_animals'),
            'href' => route('public.animals.index',  app()->getLocale()),
            'current' => request()->routeIs('public.animals.index') ? 'text-red-strong hover:border-b-2 border-red-strong' : '',
        ],
        [
            'name' => __('/public/navigation/footer.about'),
            'title' => __('/public/navigation/footer.go_about'),
            'href' => route('public.about',  app()->getLocale()),
            'current' => request()->routeIs('public.about') ? 'text-red-strong border-b-2 border-red-strong' : '',
        ],
        [
            'name' => __('/public/navigation/footer.contact_us'),
            'title' => __('/public/navigation/footer.go_contact_us'),
            'href' => route('public.contact',  app()->getLocale()),
            'current' => request()->routeIs('public.contact') ? 'text-red-strong border-b-2 border-red-strong' : '',
        ],
    ];

    $currentRoute = request()->route()->getName();
    $params = request()->route()->parameters();

@endphp

<footer class="bg-red-strong text-white py-6 px-6 md:px-12 lg:px-20 transition-all easy-in-out duration-300">
            <nav class="flex flex-wrap justify-center md:justify-end gap-x-6 gap-y-2 mb-4">
                <h2 class="sr-only">{{ __('/public/navigation/footer.footer_title') }}</h2>
                <ul class="flex flex-wrap items-center justify-center gap-x-6 gap-y-2">
                    @foreach ($links as $link)
                        <li class="flex items-center justify-center py-2 font-sans font-medium
                     hover:underline">
                            <x-public.navigation.link :href="$link['href']" :title="$link['title']">
                                {{ $link['name'] }}
                            </x-public.navigation.link>
                        </li>
                    @endforeach
                </ul>
            </nav>

        <div class="flex flex-col md:flex-row gap-4 justify-between items-center pt-1 border-t-1 text-sm text-center md:text-left">
            <ul class="capitalize flex gap-2">
                @foreach(config('app.locales') as $locale)
                    <li>
                        <x-public.navigation.link :href="route($currentRoute, array_merge($params, ['locale' =>
                        $locale]))" :title="__('public/navigation/lang.switch_'.$locale)" class="hover:underline"
                                                  :hrefLang="$locale">
                            {{ $locale }}
                        </x-public.navigation.link>
                    </li>
                @endforeach
            </ul>

            <p class="flex flex-wrap items-center justify-center gap-1">
                &copy; {{ date('Y') }} {{ __('/public/navigation/footer.website_name') }}
                <x-public.navigation.link
                    href="#"
                    title="{{ __('/public/navigation/footer.go_mention_legal') }}"
                    class="underline hover:text-white">
                    {{ __('/public/navigation/footer.mention_legal') }}
                </x-public.navigation.link>
                |
                <x-public.navigation.link
                    href="https://mohamed-camara.com/"
                    title="{{ __('/public/navigation/footer.go_developer') }}"
                    class="underline hover:text-white"
                    target="_blank"
                    rel="noopener noreferrer">
                    {{ __('/public/navigation/footer.developed_by') }}
                </x-public.navigation.link>
            </p>
        </div>
</footer>
