<x-layouts.guest title="{{ __('public/about.title')}}" >

    <x-public.sections.section title="{{ __('public/about.story_title') }}">
        <div class="flex justify-between gap-8">
            <div class="flex flex-col gap-6">
                <div class="flex flex-col gap-4 font-sans font-normal text-lg text-blue-strong opacity-50">
                    <p>{{ __('public/about.story_content_1') }}</p>
                    <p>{{ __('public/about.story_content_2') }}</p>
                    <p>{{ __('public/about.story_content_3') }}</p>
                </div>
            </div>

            <figure class="flex">
                <x-public.sections.image src="{{ asset('assets/img/public/hero_bg_2_1280.webp') }}"
                     alt="{{ __('public/about.alt_story_img') }}">
                </x-public.sections.image>
            </figure>
        </div>
    </x-public.sections.section>

    <x-public.sections.section title="{{ __('public/about.mission_title') }}">
        <div class="flex flex-col gap-6">
            <p class="font-sans font-normal text-lg text-blue-strong opacity-50">
                {{ __('public/about.mission_content') }}
            </p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-8">
                <div class="flex flex-col gap-4 items-center text-center">
                    <div class="w-16 h-16 bg-red-strong rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-blue-strong">{{ __('public/about.mission_1_title') }}</h3>
                    <p class="text-blue-strong opacity-50">{{ __('public/about.mission_1_content') }}</p>
                </div>

                <div class="flex flex-col gap-4 items-center text-center">
                    <div class="w-16 h-16 bg-red-strong rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-blue-strong">{{ __('public/about.mission_2_title') }}</h3>
                    <p class="text-blue-strong opacity-50">{{ __('public/about.mission_2_content') }}</p>
                </div>

                <div class="flex flex-col gap-4 items-center text-center">
                    <div class="w-16 h-16 bg-red-strong rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-blue-strong">{{ __('public/about.mission_3_title') }}</h3>
                    <p class="text-blue-strong opacity-50">{{ __('public/about.mission_3_content') }}</p>
                </div>
            </div>
        </div>
    </x-public.sections.section>

    <x-public.sections.stats></x-public.sections.stats>

    <x-public.sections.section title="{{ __('public/about.values_title') }}">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="flex flex-col gap-4 p-6 bg-white rounded-lg border border-gray-200">
                <h3 class="text-xl font-bold text-red-strong">{{ __('public/about.value_1_title') }}</h3>
                <p class="text-blue-strong opacity-50">{{ __('public/about.value_1_content') }}</p>
            </div>

            <div class="flex flex-col gap-4 p-6 bg-white rounded-lg border border-gray-200">
                <h3 class="text-xl font-bold text-red-strong">{{ __('public/about.value_2_title') }}</h3>
                <p class="text-blue-strong opacity-50">{{ __('public/about.value_2_content') }}</p>
            </div>

            <div class="flex flex-col gap-4 p-6 bg-white rounded-lg border border-gray-200">
                <h3 class="text-xl font-bold text-red-strong">{{ __('public/about.value_3_title') }}</h3>
                <p class="text-blue-strong opacity-50">{{ __('public/about.value_3_content') }}</p>
            </div>
        </div>
    </x-public.sections.section>

    <x-public.sections.section title="{{ __('public/about.team_title') }}">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="flex flex-col gap-4 items-center text-center">
                <div class="w-32 h-32 bg-gray-200 rounded-full overflow-hidden">
                    <img src="{{ asset('assets/img/public/hero_bg_2_1280.webp') }}" alt="{{ __('public/about.team_1_name') }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/about.team_1_name') }}</h3>
                    <p class="text-red-strong">{{ __('public/about.team_1_role') }}</p>
                </div>
            </div>

            <div class="flex flex-col gap-4 items-center text-center">
                <div class="w-32 h-32 bg-gray-200 rounded-full overflow-hidden">
                    <img src="{{ asset('assets/img/public/hero_bg_2_1280.webp') }}" alt="{{ __('public/about.team_2_name') }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/about.team_2_name') }}</h3>
                    <p class="text-red-strong">{{ __('public/about.team_2_role') }}</p>
                </div>
            </div>

            <div class="flex flex-col gap-4 items-center text-center">
                <div class="w-32 h-32 bg-gray-200 rounded-full overflow-hidden">
                    <img src="{{ asset('assets/img/public/hero_bg_2_1280.webp') }}" alt="{{ __('public/about.team_3_name') }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/about.team_3_name') }}</h3>
                    <p class="text-red-strong">{{ __('public/about.team_3_role') }}</p>
                </div>
            </div>

            <div class="flex flex-col gap-4 items-center text-center">
                <div class="w-32 h-32 bg-gray-200 rounded-full overflow-hidden">
                    <img src="{{ asset('assets/img/public/hero_bg_2_1280.webp') }}" alt="{{ __('public/about.team_4_name') }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <h3 class="text-lg font-bold text-blue-strong">{{ __('public/about.team_4_name') }}</h3>
                    <p class="text-red-strong">{{ __('public/about.team_4_role') }}</p>
                </div>
            </div>
        </div>
    </x-public.sections.section>

    <x-public.sections.section class="items-center" title="{{ __('public/about.cta_title') }}">
        <p class="text-center text-lg text-blue-strong opacity-50">{{ __('public/about.cta_subtitle') }}</p>

        <div class="flex gap-4 mt-8">
            <x-buttons.button
                href="{{ route('public.animals.index', app()->getLocale()) }}"
                title="{{ __('public/about.cta_button_1_title') }}"
                class="bg-red-strong border-red-strong text-white
                        hover:bg-white hover:text-red-strong hover:border-red-strong"
            >
                {{ __('public/about.cta_button_1') }}
            </x-buttons.button>

            <x-buttons.button
                href="{{ route('public.volunteer', app()->getLocale()) }}"
                title="{{ __('public/about.cta_button_2_title') }}"
                class="bg-white border-red-strong text-red-strong
                        hover:bg-red-strong hover:text-white hover:border-red-strong"
            >
                {{ __('public/about.cta_button_2') }}
            </x-buttons.button>
        </div>
    </x-public.sections.section>

</x-layouts.guest>
