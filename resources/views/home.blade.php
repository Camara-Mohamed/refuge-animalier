<x-layouts.guest title="{{ __('public/home.title') }}">
    <x-public.sections.hero></x-public.sections.hero>
    <section class="py-16 px-20 flex flex-col gap-8 text-blue-strong transition-all duration-300 ease-in-out">
        <h2 class="font-serif font-bold text-4xl">
            {{ __('public/home.story_title') }}
        </h2>

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
                    class="text-red-strong font-bold after:content-['→'] after:pl-1 hover:underline">
                    {{ __('public/home.story_link_content') }}
                </x-public.navigation.link>
            </div>

            <figure class="flex">
                <img src="{{ asset('assets/img/public/hero_bg_2_1280.webp') }}"
                     alt="{{ __('public/home.alt_story_img') }}"
                     class="rounded-lg w-full h-full object-cover">
            </figure>
        </div>
    </section>


</x-layouts.guest>
