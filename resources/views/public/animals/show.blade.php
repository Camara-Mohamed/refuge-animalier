@php use App\Enums\House;use Carbon\Carbon; @endphp
<x-layouts.guest title="{{ $animal->name }} - {{ __('public/animals/animals_show.title')}}">

    <section class="relative h-96 bg-cover bg-center" style="background-image: url('{{ asset($animal->avatar) }}');">
        <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/70"></div>
        <div class="relative h-full flex items-end px-20 pb-12">
            <div class="text-white">
                <h1 class="text-5xl font-black font-serif mb-2">{{ $animal->name }}</h1>
                @if($animal->race)
                    <p class="text-xl uppercase text-red-light">{{ $animal->race->name }}</p>
                @endif
            </div>
        </div>
    </section>

    <section class="py-20 px-20">
        <div class="grid grid-cols-2 gap-12">
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-black font-serif text-blue-strong mb-6">
                        {{ __('public/animals/animals_show.about_title') }}
                    </h2>

                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="flex p-2 rounded-full border border-blue-strong bg-blue-strong/5">
                                @if($animal->gender->value === 'male')
                                    <x-icons.male class="fill-blue-strong w-5 h-5"></x-icons.male>
                                @else
                                    <x-icons.female class="fill-blue-strong w-5 h-5"></x-icons.female>
                                @endif
                            </span>
                            <div>
                                <p class="text-sm text-blue-strong/60">{{ __('public/animals/animals_show.gender') }}</p>
                                <p class="font-semibold text-blue-strong capitalize">{{ $animal->gender->value }}</p>
                            </div>
                        </div>

                        @if($animal->birth_date)
                            <div class="flex items-center gap-3">
                            <span class="flex p-2 rounded-full border border-blue-strong bg-blue-strong/5">
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
                            <div class="flex items-center gap-3">
                            <span class="flex p-2 rounded-full border border-blue-strong bg-blue-strong/5">
                            </span>
                                <div>
                                    <p class="text-sm text-blue-strong/60">{{ __('public/animals/animals_show.species') }}</p>
                                    <p class="font-semibold text-blue-strong">{{ $animal->specie->name }}</p>
                                </div>
                            </div>
                        @endif

                        @if($animal->coat)
                            <div class="flex items-center gap-3">
                            <span class="flex p-2 rounded-full border border-blue-strong bg-blue-strong/5">
                                {{-- svg --}}
                            </span>
                                <div>
                                    <p class="text-sm text-blue-strong/60">{{ __('public/animals/animals_show.coat') }}</p>
                                    <p class="font-semibold text-blue-strong">{{ $animal->coat->name }}</p>
                                </div>
                            </div>
                        @endif

                        @if($animal->chip)
                            <div class="flex items-center gap-3">
                            <span class="flex p-2 rounded-full border border-blue-strong bg-blue-strong/5">
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

            <div class="bg-blue-strong/5 p-8 rounded-2xl border border-blue-strong/10">
                <h2 class="text-3xl font-black font-serif text-blue-strong mb-2">
                    {{ __('public/animals/animals_show.form_title') }}
                </h2>
                <p class="text-blue-strong/60 mb-6">
                    {{ __('public/animals/animals_show.form_subtitle') }}
                </p>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('public.animals.store', [app()->getLocale(), $animal]) }}">
                    <x-forms.send></x-forms.send>

                    @csrf

                    <div class="space-y-4">
                        <h3 class="font-bold text-blue-strong">{{ __('public/animals/animals_show.personal_info') }}</h3>

                        <x-forms.input for="name" type="text" :required="true">
                            {{ __('public/animals/animals_show.name') }}
                        </x-forms.input>

                        <x-forms.input for="email" type="email" :required="true">
                            {{ __('public/animals/animals_show.email') }}
                        </x-forms.input>

                        <x-forms.input for="phone" type="tel" :required="true">
                            {{ __('public/animals/animals_show.phone') }}
                        </x-forms.input>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-blue-strong/10">
                        <h3 class="font-bold text-blue-strong">{{ __('public/animals/animals_show.address_info') }}</h3>

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

                        <x-forms.select for="house_type" :required="true"
                                        label_title="{{ __('public/animals/animals_show.house_type') }}">
                            @foreach(House::cases() as $houseType)
                                <option value="{{ $houseType->value }}">
                                    {{ __('public/animals/animals_show.house_' . $houseType->value) }}
                                </option>
                            @endforeach
                        </x-forms.select>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="have_garden" name="have_garden" value="1"
                                   class="w-4 h-4 text-red-strong border-blue-strong rounded focus:ring-red-strong">
                            <label for="have_garden" class="text-sm text-blue-strong">
                                {{ __('public/animals/animals_show.have_garden') }}
                            </label>
                        </div>
                    </div>

                    <div class="space-y-4 pt-4 border-t border-blue-strong/10">
                        <x-forms.textarea for="message" :required="true">
                            {{ __('public/animals/animals_show.message') }}
                        </x-forms.textarea>
                        <p class="text-xs text-blue-strong/60">
                            {{ __('public/animals/animals_show.message_help') }}
                        </p>
                    </div>

                    <x-forms.button type="submit" class="w-full bg-red-strong border-red-strong text-white
                        hover:bg-white hover:text-red-strong hover:border-red-strong">
                        {{ __('public/animals/animals_show.submit_button') }}
                    </x-forms.button>
                </form>
            </div>
        </div>
    </section>

</x-layouts.guest>
