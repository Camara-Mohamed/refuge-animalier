<x-layouts.guest title="{{ __('public/home.title') }}" :schema="[
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => __('public/home.name_website'),
    'url' => route('public.home', app()->getLocale()),
]">
    <x-public.sections.home.hero></x-public.sections.home.hero>
    <x-public.sections.story
        title="{{ __('public/home.story_title') }}"
        image="{{ asset('assets/img/public/hero_bg_2_1280.webp') }}"
        imageAlt="{{ __('public/home.alt_story_img') }}">
        <p>{{ __('public/home.story_content_1') }}</p>
        <p>{{ __('public/home.story_content_2') }}</p>
        <p>{{ __('public/home.story_content_3') }}</p>

        <x-slot:link>
            <x-public.navigation.link
                href="{{ __('') }}"
                title="{{ __('public/home.story_link_title') }}"
                class="text-red-strong font-bold after:content-['→'] hover:underline">
                {{ __('public/home.story_link_content') }}
            </x-public.navigation.link>
        </x-slot:link>
    </x-public.sections.story>
    <x-public.sections.values></x-public.sections.values>
    <x-public.sections.section class="items-center" title="{{ __('public/home.cta_title') }}">

        <p class="text-center max-w-2xl">{{ __('public/home.cta_subtitle') }}</p>


        <div class="flex flex-col sm:flex-row gap-4 mt-8 w-full sm:w-auto">
            <x-buttons.button
                href="{{ route('public.animals.index', app()->getLocale()) }}"
                title="{{ __('public/home.title_hero_button_1') }}"
                class="bg-red-strong border-red-strong text-white justify-center
                        hover:bg-white hover:text-red-strong hover:border-red-strong"
            >
                {{ __('public/home.hero_button_1') }}
            </x-buttons.button>

            <x-buttons.button
                href="{{ route('public.contact', app()->getLocale()) }}"
                title="{{ __('public/home.title_hero_button_3') }}"
                class="bg-white border-red-strong text-red-strong justify-center
                        hover:bg-red-strong hover:text-white hover:border-red-strong"
            >
                {{ __('public/home.hero_button_3') }}
            </x-buttons.button>
        </div>
    </x-public.sections.section>

</x-layouts.guest>
