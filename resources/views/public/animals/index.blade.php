@php use App\Enums\Gender; @endphp
<x-layouts.guest title="{{ __('public/animals/animals_index.title')}}">
    <x-public.sections.section title="{{ __('public/animals/animals_index.section_title')}}">
        <p class="font-medium opacity-60">
            {{ __('public/animals/animals_index.section_subtitle') }}
        </p>
    </x-public.sections.section>

    <section class="pb-20 px-20 flex flex-col text-blue-strong transition-all duration-200 ease-in-out">
        <h2 class="sr-only">{{ __('public/animals/animals_index.section_animals_title') }}</h2>

        <form method="GET" action="{{ route('public.animals.index', app()->getLocale()) }}"
              class="flex justify-between gap-4">
            <x-forms.hidden for="search" type="search"
                            placeholder="{{ __('public/animals/animals_index.search_placeholder') }}">
                {{ __('public/animals/animals_index
                            .search') }}
            </x-forms.hidden>

            <div class="flex items-center gap-4">
                <x-forms.select class="capitalize" for="sexe" label_title="{{ __('public/animals/animals_index.filtre_sexe') }}">
                    <option value="all">{{ __('public/animals/animals_index.filtre_tous') }}</option>
                    @foreach(Gender::cases() as $gender)
                        <option value="{{ $gender->name }}">
                            {{ $gender->value }}
                        </option>
                    @endforeach
                </x-forms.select>
                <x-forms.select for="race" label_title="{{ __('public/animals/animals_index.filtre_race') }}">
                    <option value="all">{{ __('public/animals/animals_index.filtre_toutes') }}</option>
                    @foreach($races as $race)
                        <option  value="{{ $race->name }}">{{ $race->name }}</option>
                    @endforeach
                </x-forms.select>
                <x-forms.select for="species" label_title="{{ __('public/animals/animals_index.filtre_species') }}">
                    <option value="all">{{ __('public/animals/animals_index.filtre_tous') }}</option>
                    @foreach($species as $specie)
                        <option  value="{{ $specie->name }}">{{ $specie->name }}</option>
                    @endforeach
                </x-forms.select>
            </div>
        </form>

        <div class="flex justify-between mt-4">
            <p class="font-normal text-blue-strong">
                <span class="font-bold text-red-strong">{{ $animals->count() }}</span> {{ __('public/animals/animals_index.animals_found') }}</p>
            <a href="{{ route('public.animals.index', app()->getLocale()) }}"
               class="text-red-strong font-normal hover:underline text-sm" title="{{ __
               ('public/animals/animals_index.title_reset') }}">
                {{ __('public/animals/animals_index.reset') }}
            </a>
        </div>

        <div class="grid grid-cols-3 gap-6 justify-center mt-12">
            @forelse ($animals as $animal)
                <details class="p-2 bg--white rounded-lg shadow-2xl">
                    <summary class="list-none cursor-pointer flex flex-col gap-2 items-center">
                        <div class="self-stretch h-72 p-4 rounded-lg bg-gradient-to-b from-black/0 to-black/70 flex flex-col justify-end bg-cover bg-center" style="background-image: url('{{ asset('assets/img/public/animals/cats/cat_1_320.webp') }}');">
                        </div>

                        <x-icons.caret-down></x-icons.caret-down>
                    </summary>

                    <div class="px-2 pb-4 mt-4 flex flex-col gap-6">
                        <div class="flex justify-between items-end">
                            <div>
                                <h3 class="text-3xl font-black font-serif text-blue-strong">
                                    {{ $animal->name }}
                                </h3>

                                @if($animal->race)
                                    <p class="text-sm uppercase text-red-strong">
                                        {{ $animal->race->name}}
                                    </p>
                                @endif
                            </div>

                            <span class="flex p-1 rounded-3xl border border-blue-strong bg-blue-strong/5">
                                @if($animal->gender->value === 'male' )
                                    <x-icons.male class="fill-blue-strong"></x-icons.male>
                                @else
                                    <x-icons.female class="fill-blue-strong"></x-icons.female>
                                @endif
                            </span>
                        </div>

                        <p class="text-blue-strong opacity-60 font-sans">
                            {{ $animal->description }}
                        </p>

                        @if(isset($vaccines))
                            <ul class="flex gap-2 pt-4 border-t border-blue-strong flex-wrap">
                                @foreach($vaccines as $vaccine)
                                    <li class="px-3 py-1 rounded-lg border text-sm
                                                odd:border-red-strong odd:bg-red-strong/5 odd:text-red-strong
                                                even:border-blue-strong even:bg-blue-strong/5 even:text-blue-strong">
                                        {{ $vaccine->name }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <x-buttons.button href="#" class="bg-red-strong border-red-strong text-white
                        hover:bg-white hover:text-red-strong hover:border-red-strong">
                            {{ __('public/animals/animals_index.cta_adopt') }}
                        </x-buttons.button>
                    </div>
                </details>
            @empty
                <p class="mt-8 font-serif font-medium text-center opacity-60">
                    {{ __('public/animals/animals_index.not_found') }}</p>
            @endforelse
        </div>
    </section>
</x-layouts.guest>
