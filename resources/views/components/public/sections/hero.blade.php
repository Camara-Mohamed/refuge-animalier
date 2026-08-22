<section class="hero_home min-h-dvh flex items-center bg-cover bg-center px-6 py-24 md:px-12 md:py-32 lg:px-20 lg:py-40 transition-all duration-300 ease-in-out"
         style="
        background-image:
            linear-gradient(90deg,rgba(0, 0, 0, 0.75) 30%, rgba(0, 0, 0, 0.1) 100%),
            url('{{ asset('assets/img/public/hero_bg.webp') }}');
    ">

    <div class="grid grid-cols-12">
        <div class="flex flex-col items-start col-span-12 md:col-span-9 lg:col-span-6">
            <h2 class="font-serif text-white text-3xl md:text-4xl lg:text-5xl font-bold leading-tight lg:leading-16">
                {{ __('public/home.hero_title') }}
            </h2>

            <p class="text-white text-lg lg:text-xl font-light mt-6">
                {{ __('public/home.hero_subtitle') }}
            </p>

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
                        href="{{ route('public.volunteer', app()->getLocale()) }}"
                        title="{{ __('public/home.title_hero_button_2') }}"
                        class="bg-white border-white text-red-strong justify-center
                        hover:bg-red-strong hover:text-white hover:border-red-strong"
                >
                        {{ __('public/home.hero_button_2') }}
                </x-buttons.button>
            </div>
        </div>
    </div>
</section>
