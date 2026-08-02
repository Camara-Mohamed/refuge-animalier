<section class="hero_home min-h-dvh flex bg-cover bg-center px-20 py-20"
         style="
        background-image:
            linear-gradient(to left, rgba(0,0,0,0.2), rgba(0,0,0,0.8)),
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

            <div class="flex gap-4 text-base font-bold mt-8">
                <x-public.navigation.link
                    href="#"
                    class="px-4 py-3 bg-red-strong
                    rounded-lg flex justify-between items-center text-white border
                    border-red-strong"
                    title="{{ __('public/home.title_hero_button_1') }}">
                    {{ __('public/home.hero_button_1') }}
                </x-public.navigation.link>
                <x-public.navigation.link
                    href="#"
                    class="px-4 py-3 bg-white rounded-lg flex justify-between items-center text-red-strong border
                    border-white"
                    title="{{ __('public/home.title_hero_button_2') }}">
                    {{ __('public/home.hero_button_2') }}
                </x-public.navigation.link>
            </div>
        </div>
    </div>
</section>
