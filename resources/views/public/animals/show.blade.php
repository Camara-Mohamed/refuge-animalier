@php use App\Enums\House;use Carbon\Carbon; @endphp
<x-layouts.guest title="{{ $animal->name }} - {{ __('public/animals/animals_show.title')}}">

    <section class="relative h-72 md:h-80 lg:h-96 bg-cover bg-center px-6 md:px-12 lg:px-20 py-4 flex flex-col justify-end" style="
        background-image:
            linear-gradient(90deg, rgba(0,0,0,0.2) 0%, rgba(0,0,0,0.75) 100%),
            url('{{ $animal->avatarUrl(1280) }}');
    ">
        <div class="relative flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div class="text-white">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-black font-serif mb-2">{{ $animal->name }}</h1>
                @if($animal->race)
                    <p class="text-base md:text-lg uppercase font-medium">{{ $animal->race->name }}</p>
                @endif
            </div>

            <x-public.share-button
                :url="route('public.animals.show', ['locale' => app()->getLocale(), 'animal' => $animal])"
                subject="Rencontrez {{ $animal->name }}"
                body="Je veux adopter {{ $animal->name }}."
            >
                Partager
            </x-public.share-button>
        </div>
    </section>

    <section class="py-10 px-6 md:py-12 md:px-12 lg:py-16 lg:px-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-24">
            <div class="space-y-8">
                <div>
                    <div class="flex flex-row flex-wrap gap-4">
                        <div class="flex items-center gap-3 w-full sm:w-[calc(50%-0.5rem)]">
                            <span class="flex p-3 rounded-2xl bg-red-strong">
                                @if($animal->gender->value === 'male')
                                    <x-icons.male class="fill-white w-5 h-5"></x-icons.male>
                                @else
                                    <x-icons.female class="fill-white w-5 h-5"></x-icons.female>
                                @endif
                            </span>
                            <div>
                                <p class="text-sm text-blue-strong/60">{{ __('public/animals/animals_show.gender') }}</p>
                                <p class="font-semibold text-blue-strong capitalize">{{ $animal->gender->label() }}</p>
                            </div>
                        </div>

                        @if($animal->birth_date)
                            <div class="flex items-center gap-3 w-full sm:w-[calc(50%-0.5rem)]">
                            <span class="flex p-3 rounded-2xl bg-blue-strong">
                                <x-icons.calender class="w-5 h-5 fill-white"></x-icons.calender>
                            </span>
                                <div>
                                    <p class="text-sm text-blue-strong/60">{{ __('public/animals/animals_show.age') }}</p>
                                    <p class="font-semibold text-blue-strong">
                                        {{ Carbon::parse($animal->birth_date)->age }} {{ __('public/animals/animals_show.years') }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if($animal->specie)
                            <div class="flex items-center gap-3 w-full sm:w-[calc(50%-0.5rem)]">
                            <span class="flex p-3 rounded-2xl bg-red-strong">
                                <x-icons.paw-print class="w-5 h-5 fill-white"></x-icons.paw-print>
                            </span>
                                <div>
                                    <p class="text-sm text-blue-strong/60">{{ __('public/animals/animals_show.species') }}</p>
                                    <p class="font-semibold text-blue-strong">{{ $animal->specie->name }}</p>
                                </div>
                            </div>
                        @endif

                        @if($animal->coat)
                            <div class="flex items-center gap-3 w-full sm:w-[calc(50%-0.5rem)]">
                            <span class="flex p-3 rounded-2xl bg-blue-strong">
                                <x-icons.note class="w-5 h-5 fill-white"></x-icons.note>
                            </span>
                                <div>
                                    <p class="text-sm text-blue-strong/60">{{ __('public/animals/animals_show.coat') }}</p>
                                    <p class="font-semibold text-blue-strong">{{ $animal->coat->name }}</p>
                                </div>
                            </div>
                        @endif

                        @if($animal->chip)
                            <div class="flex items-center gap-3 w-full sm:w-[calc(50%-0.5rem)]">
                            <span class="flex p-3 rounded-2xl bg-red-strong">
                                <x-icons.database class="w-5 h-5 fill-white"></x-icons.database>
                            </span>
                                <div>
                                    <p class="text-sm text-blue-strong/60">{{ __('public/animals/animals_show.chip') }}</p>
                                    <p class="font-semibold text-blue-strong font-mono text-sm">{{ $animal->chip }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <div>
                    <h3 class="text-2xl font-black font-serif text-blue-strong mb-4">
                        {{ __('public/animals/animals_show.description_title') }}
                    </h3>
                    <p class="text-blue-strong/80 leading-relaxed">
                        {{ $animal->description }}
                    </p>
                </div>

                @if($vaccines->count() > 0)
                    <div>
                        <h3 class="text-2xl font-black font-serif text-blue-strong mb-4">
                            {{ __('public/animals/animals_show.vaccines_title') }}
                        </h3>
                        <ul class="flex gap-2 flex-wrap">
                            @foreach($vaccines as $vaccine)
                                <li class="px-3 py-2 rounded-lg border text-sm
                                        odd:border-red-strong odd:bg-red-strong/5 odd:text-red-strong
                                        even:border-blue-strong even:bg-blue-strong/5 even:text-blue-strong">
                                    {{ $vaccine->name }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div class="p-6 md:p-8 bg-white rounded-lg shadow-[0px_5px_20px_0px_rgba(0,0,0,0.10)] border border-red-strong/20">
                <h2 class="text-3xl font-black font-serif text-blue-strong mb-6">
                    {{ __('public/animals/animals_show.form_title') }}
                </h2>

                <x-forms.send></x-forms.send>

                <form method="POST" action="{{ route('public.animals.store', [app()->getLocale(), $animal]) }}" class="flex flex-col gap-6">
                    @csrf

                    <x-forms.fieldset title="{{ __('public/animals/animals_show.personal_info') }}">
                        <x-forms.input for="name" type="text" :required="true">
                            {{ __('public/animals/animals_show.name') }}
                        </x-forms.input>

                        <x-forms.input for="email" type="email" :required="true">
                            {{ __('public/animals/animals_show.email') }}
                        </x-forms.input>

                        <x-forms.input for="phone" type="tel" :required="true">
                            {{ __('public/animals/animals_show.phone') }}
                        </x-forms.input>
                    </x-forms.fieldset>

                    <x-forms.fieldset title="{{ __('public/animals/animals_show.address_info') }}">

                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-2">
                                <x-forms.input for="address" type="text" :required="true">
                                    {{ __('public/animals/animals_show.address') }}
                                </x-forms.input>
                            </div>
                            <x-forms.input for="number" type="text" :required="true">
                                {{ __('public/animals/animals_show.number') }}
                            </x-forms.input>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <x-forms.input for="city" type="text" :required="true">
                                {{ __('public/animals/animals_show.city') }}
                            </x-forms.input>

                            <x-forms.input for="postal_code" type="text" :required="true">
                                {{ __('public/animals/animals_show.postal_code') }}
                            </x-forms.input>
                        </div>

                        <div class="grid grid-cols-2 gap-4 items-end">
                            <div class="flex flex-col gap-2">
                                <label for="house_type" class="font-medium font-serif text-blue-strong">
                                    {{ __('public/animals/animals_show.house_type') }}
                                    <small><abbr class="text-red-normal" title="{{ __('public/form.abbr_require') }}">*</abbr></small>
                                </label>
                                <x-forms.select for="house_type" :required="true" class="h-12 w-full">
                                    @foreach(House::cases() as $houseType)
                                        <option value="{{ $houseType->value }}">
                                            {{ __('public/animals/animals_show.house_' . $houseType->value) }}
                                        </option>
                                    @endforeach
                                </x-forms.select>
                            </div>

                            <label for="have_garden"
                                   class="h-12 flex items-center justify-center gap-2 px-4 rounded-lg border border-gray-300 text-blue-strong font-medium cursor-pointer transition-colors has-checked:bg-red-strong has-checked:text-white has-checked:border-red-strong">
                                <input type="checkbox" id="have_garden" name="have_garden" value="1" class="sr-only">
                                {{ __('public/animals/animals_show.have_garden') }}
                            </label>
                        </div>
                    </x-forms.fieldset>

                    <x-forms.fieldset title="{{ __('public/animals/animals_show.motivation_title') }}">
                        <x-forms.textarea for="message" :required="true">
                            {{ __('public/animals/animals_show.message') }}
                        </x-forms.textarea>
                    </x-forms.fieldset>

                    <x-forms.button type="submit" class="w-full bg-red-strong border-red-strong text-white
                        hover:bg-white hover:text-red-strong hover:border-red-strong">
                        {{ __('public/animals/animals_show.submit_button') }}
                    </x-forms.button>
                </form>
            </div>
        </div>
    </section>

</x-layouts.guest>
