<nav aria-label="Choisir une langue">
    @php
        $currentRoute = request()->route()->getName();
        $params = request()->route()->parameters();
        $locales = ['fr', 'en', 'nl', 'de'];
    @endphp

    <details class="relative">
        <summary class="capitalize cursor-pointer px-3 py-2 font-semibold text-blue-strong hover:text-red-strong">
            {{ app()->getLocale() }}
        </summary>

        <ul class="capitalize min-w-max absolute right-0 mt-2 bg-white border shadow rounded">
            @foreach($locales as $locale)
                <li class="text-[0.75rem]">
                    <x-public.navigation.link
                        href="{{ route($currentRoute, array_merge($params, ['locale' => $locale])) }}"
                        :title="__('public/navigation/lang.switch_'.$locale)"
                        class="block px-3 py-2 hover:bg-red-strong hover:text-white"
                        :hrefLang="$locale"
                    >
                        {{ $locale }}
                    </x-public.navigation.link>
                </li>
            @endforeach
        </ul>
    </details>
</nav>
