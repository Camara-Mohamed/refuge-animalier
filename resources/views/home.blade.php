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
<x-public.sections.section title="{{ __('public/home.stats_title') }}">
        <div class="grid grid-cols-4 items-center gap-6 text-center font-serif">
            <div class="w-64 bg-white rounded-lg shadow-lg p-8 flex flex-col justify-center items-center
            gap-2 text-center">
                <div class="col-span-3 p-4 bg-blue-strong rounded-2xl flex justify-center items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#000000" viewBox="0 0 256
                    256" class="fill-white">
                        <path
                            d="M117.25,157.92a60,60,0,1,0-66.5,0A95.83,95.83,0,0,0,3.53,195.63a8,8,0,1,0,13.4,8.74,80,80,0,0,1,134.14,0,8,8,0,0,0,13.4-8.74A95.83,95.83,0,0,0,117.25,157.92ZM40,108a44,44,0,1,1,44,44A44.05,44.05,0,0,1,40,108Zm210.14,98.7a8,8,0,0,1-11.07-2.33A79.83,79.83,0,0,0,172,168a8,8,0,0,1,0-16,44,44,0,1,0-16.34-84.87,8,8,0,1,1-5.94-14.85,60,60,0,0,1,55.53,105.64,95.83,95.83,0,0,1,47.22,37.71A8,8,0,0,1,250.14,206.7Z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold font-serif mt-4">{{ __('public/home.stats_number_1') }}</h3>
                <p class="font-normal">{{ __('public/home.stats_number_1_content') }}</p>
            </div>
        </div>

</x-public.sections.section>

</x-layouts.guest>
