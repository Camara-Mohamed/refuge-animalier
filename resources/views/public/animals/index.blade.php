<x-layouts.guest title="{{ __('public/animals/animals_index.title')}}" >
    <x-public.sections.section title="{{ __('public/animals/animals_index.section_title')}}" >
        <p class="font-medium opacity-60">
            {{ __('public/animals/animals_index.section_subtitle') }}
        </p>
    </x-public.sections.section>

    <section class="pb-20 px-20 flex flex-col text-blue-strong transition-all duration-200 ease-in-out">
        <h2 class="sr-only">{{ __('public/animals/animals_index.section_animals_title')}}</h2>

        <form method="GET" action="{{ route('public.animals.index', app()->getLocale()) }}">

        </form>

        <div class="flex justify-between mt-4">
            <p class="font-normal text-blue-strong">
                <span class="font-bold text-red-strong">0</span> {{ __('public/animals/animals_index.animals_found')}}
            </p>
            <button type="button"
                        class="text-red-strong font-normal hover:underline text-sm">
                    {{ __('public/animals/animals_index.reset')}}
            </button>
        </div>

        <p class="mt-8 font-serif font-medium text-center opacity-60">
                {{ __('public/animals/animals_index.not_found')}}
            </p>
    </section>
</x-layouts.guest>
