<x-layouts.guest title="{{ __('public/animals/animals_index.title')}}" >
    <x-public.sections.section title="{{ __('public/animals/animals_index.section_title')}}" >
        <p class="font-medium opacity-60">
            {{ __('public/animals/animals_index.section_subtitle') }}
        </p>
    </x-public.sections.section>

    <section class="pb-20 px-20 flex flex-col text-blue-strong transition-all duration-200 ease-in-out">
        <h2 class="sr-only">{{ __('public/animals/animals_index.section_animals_title') }}</h2>

        <form method="GET" action="{{ route('public.animals.index', app()->getLocale()) }}" class="flex justify-between gap-4">
            <x-forms.hidden for="search" type="search"
                            placeholder="{{ __('public/animals/animals_index.search_placeholder') }}">
                {{ __('public/animals/animals_index
                            .search') }}
            </x-forms.hidden>

            <div class="flex items-center gap-4">
                <x-forms.select for="sexe" label_title="{{ __('public/animals/animals_index.filtre_sexe') }}">
                    <option value="all">{{ __('public/animals/animals_index.filtre_tous') }}</option>
                    <option value="male">{{ __('public/animals/animals_index.filtre_sexe_male') }}</option>
                    <option value="female">{{ __('public/animals/animals_index.filtre_sexe_female') }}</option>
                </x-forms.select>
                <x-forms.select for="race" label_title="{{ __('public/animals/animals_index.filtre_race') }}">
                    <option value="all">{{ __('public/animals/animals_index.filtre_toutes') }}</option>
                    <option value="labrador">{{ __('public/animals/animals_index.filtre_race_labrador') }}</option>
                    <option value="beagle">{{ __('public/animals/animals_index.filtre_race_beagle') }}</option>
                </x-forms.select>
                <x-forms.select for="species" label_title="{{ __('public/animals/animals_index.filtre_species') }}">
                    <option value="all">{{ __('public/animals/animals_index.filtre_tous') }}</option>
                    <option value="dog">{{ __('public/animals/animals_index.filtre_species_dog') }}</option>
                    <option value="dog">{{ __('public/animals/animals_index.filtre_species_cat') }}</option>
                </x-forms.select>
            </div>
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
