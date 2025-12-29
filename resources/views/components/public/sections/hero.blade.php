<section class="hero_home min-h-dvh flex bg-cover bg-center px-20 py-40 transition-all duration-300 ease-in-out"
         style="
        background-image:
            linear-gradient(90deg,rgba(0, 0, 0, 0.75) 30%, rgba(0, 0, 0, 0.1) 100%),
            url('{{ asset('assets/img/public/hero_bg.webp') }}');
    ">

    {{-- TODO: Change remove style on section balise --}}

    <div class="grid grid-cols-12">
        <div class="flex flex-col items-start col-span-6">
            <h2 class="font-serif text-white text-5xl font-bold leading-16">
                {{ __('public/home.hero_title') }}
            </h2>

            <p class="text-white text-xl font-light mt-6">
                {{ __('public/home.hero_subtitle') }}
            </p>

            <div class="flex gap-4 mt-8">
                <x-buttons.button
                        href="#"
                        title="{{ __('public/home.title_hero_button_1') }}"
                        class="bg-red-strong border-red-strong text-white
                        hover:bg-white hover:text-red-strong hover:border-red-strong"
                >
                        {{ __('public/home.hero_button_1') }}
                </x-buttons.button>

                <x-buttons.button
                        href="#"
                        title="{{ __('public/home.title_hero_button_2') }}"
                        class="bg-white border-white text-red-strong
                        hover:bg-red-strong hover:text-white hover:border-red-strong"
                >
                        {{ __('public/home.hero_button_2') }}
                </x-buttons.button>¬
            </div>
        </div>
    </div>
</section>
