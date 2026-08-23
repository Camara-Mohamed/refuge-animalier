@php use App\Enums\Gender; @endphp
<x-layouts.guest title="{{ __('public/animals/animals_index.title')}}" :schema="[
    '@context' => 'https://schema.org',
    '@type' => 'CollectionPage',
    'name' => __('public/animals/animals_index.title'),
    'url' => route('public.animals.index', app()->getLocale()),
]">
    <x-public.sections.intro title="{{ __('public/animals/animals_index.section_title')}}">
        {{ __('public/animals/animals_index.section_subtitle') }}
    </x-public.sections.intro>

    <section class="pb-20 px-20 flex flex-col text-blue-strong transition-all duration-200 ease-in-out">
        <h2 class="sr-only">{{ __('public/animals/animals_index.section_animals_title') }}</h2>
        <div class="flex flex-wrap items-center justify-between gap-4 mt-4">
            <form method="GET" action="{{ route('public.animals.index', app()->getLocale()) }}" class="flex items-center gap-2">
                <x-forms.hidden
                    for="search"
                    type="search"
                    placeholder="{{ __('public/animals/animals_index.search_placeholder') }}">
                    {{ __('public/animals/animals_index.search') }}
                </x-forms.hidden>

                <x-forms.button
                    type="submit"
                    class="h-10 bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong"
                    title="Rechercher un animal">
                    Rechercher
                </x-forms.button>
            </form>

            <form method="GET" action="{{ route('public.animals.index', app()->getLocale()) }}" class="flex items-center gap-2 flex-wrap">
                <x-forms.select class="h-10 capitalize" for="sexe" label_title="{{ __('public/animals/animals_index.filtre_sexe') }}">
                    <option value="all">{{ __('public/animals/animals_index.filtre_tous') }}</option>
                    @foreach(Gender::cases() as $gender)
                        <option value="{{ $gender->name }}" @selected(request('sexe') === $gender->name)>{{
                        $gender->label() }}</option>
                    @endforeach
                </x-forms.select>

                <x-forms.select class="h-10" for="race" label_title="{{ __('public/animals/animals_index.filtre_race') }}">
                    <option value="all">{{ __('public/animals/animals_index.filtre_toutes') }}</option>
                    @foreach($races as $race)
                        <option value="{{ $race->name }}" @selected(request('race') === $race->name)>{{ $race->name }}</option>
                    @endforeach
                </x-forms.select>

                <x-forms.select class="h-10" for="species" label_title="{{ __('public/animals/animals_index.filtre_species') }}">
                    <option value="all">{{ __('public/animals/animals_index.filtre_tous') }}</option>
                    @foreach($species as $specie)
                        <option value="{{ $specie->name }}" @selected(request('species') === $specie->name)>{{ $specie->name }}</option>
                    @endforeach
                </x-forms.select>

                <x-forms.button
                    type="submit"
                    class="h-10 bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong"
                    title="Filtrer les animaux">
                    Filter
                </x-forms.button>
            </form>
        </div>

        <div class="flex justify-between mt-4">
            <p class="font-normal text-blue-strong">
                <span class="font-bold text-red-strong">{{ $animals->total() }}</span> {{ __
                ('public/animals/animals_index.animals_found') }}</p>
            <a href="{{ route('public.animals.index', app()->getLocale()) }}"
               class="text-red-strong font-normal hover:underline text-sm" title="{{ __
               ('public/animals/animals_index.title_reset') }}">
                {{ __('public/animals/animals_index.reset') }}
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 justify-center items-start mt-8">
            @forelse ($animals as $animal)
                <details class="group p-2 bg-white rounded-lg shadow-2xl border-b-4 border-red-strong transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-b-8">
                    <summary class="list-none cursor-pointer flex flex-col gap-2 items-center">
                        <div class="self-stretch h-72 rounded-lg overflow-hidden">
                            <div class="w-full h-full p-4 rounded-lg bg-gradient-to-b from-black/0 to-black/70 flex flex-col justify-end bg-cover bg-center transition-transform duration-500 ease-out hover:scale-105"
                                 style="background-image: url('{{ $animal->avatarUrl(640) }}');"
                                 role="img"
                                 aria-label="Photo de {{ $animal->name }}">
                            </div>
                        </div>

                        <x-icons.caret-down class="w-6 h-6 transition-transform duration-300 group-open:rotate-180" fill="fill-blue-strong"></x-icons.caret-down>
                    </summary>

                    <div class="px-2 pb-4 mt-4 flex flex-col gap-6 transition-[opacity,translate] duration-300 ease-out starting:opacity-0 starting:-translate-y-2">
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

                            <span class="w-8 h-8 shrink-0 flex items-center justify-center rounded-full border border-blue-strong bg-blue-strong/5">
                                @if($animal->gender->value === 'male' )
                                    <x-icons.male class="w-4 h-4 fill-blue-strong"></x-icons.male>
                                @else
                                    <x-icons.female class="w-4 h-4 fill-blue-strong"></x-icons.female>
                                @endif
                            </span>
                        </div>

                        <p class="text-blue-strong opacity-70 font-sans">
                            {{ $animal->description }}
                        </p>

                        @if(isset($animal->specie->vaccines))
                            <x-public.vaccine-badges :vaccines="$animal->specie->vaccines" class="pt-4 border-t border-blue-strong" />
                        @endif

                        <x-buttons.button
                            href="{{ route('public.animals.show', [app()->getLocale(), $animal]) }}"
                            class="bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong">
                            {{ __('public/animals/animals_index.cta_adopt') }}
                        </x-buttons.button>
                    </div>
                </details>
            @empty
                <p class="mt-8 font-serif font-medium text-center opacity-60">
                    {{ __('public/animals/animals_index.not_found') }}</p>
            @endforelse
        </div>

        <div class="flex justify-center mt-8">
            {{ $animals->links() }}
        </div>
    </section>
</x-layouts.guest>
