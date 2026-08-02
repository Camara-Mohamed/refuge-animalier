<x-layouts.guest title="{{ __('public/home.title') }}">
    <x-public.sections.hero></x-public.sections.hero>
    <x-public.sections.section title="{{ __('public/home.story_title') }}">

        <div class="flex justify-between gap-8">
            <div class="flex flex-col gap-6">
                <div class="flex flex-col gap-4 font-sans font-normal text-lg text-blue-strong opacity-50">
                    <p>{{ __('public/home.story_content_1') }}</p>
                    <p>{{ __('public/home.story_content_2') }}</p>
                    <p>{{ __('public/home.story_content_3') }}</p>
                </div>
                <x-public.navigation.link
                    href="{{ __('') }}"
                    title="{{ __('public/home.story_link_title') }}"
                    class="text-red-strong font-bold after:content-['→'] hover:underline">
                    {{ __('public/home.story_link_content') }}
                </x-public.navigation.link>
            </div>

            <figure class="flex">
                <x-public.sections.image src="{{ asset('assets/img/public/hero_bg_2_1280.webp') }}"
                     alt="{{ __('public/home.alt_story_img') }}">
                </x-public.sections.image>
            </figure>
        </div>
    </x-public.sections.section>
    <x-public.sections.stats></x-public.sections.stats>

</x-layouts.guest>
