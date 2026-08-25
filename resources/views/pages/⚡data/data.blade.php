<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.data'), 'url' => route('admin.data.index', ['locale' => app()->getLocale()])],
    ]" :key="'data-index-breadcrumb'" />

    <h2 class="font-serif font-bold text-2xl text-blue-strong">Gestion des données</h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-forms.fieldset title="Espèces">
            <x-flash key="success_specie" />

            @can('create', \App\Models\Specie::class)
                <form wire:submit="addSpecie" class="flex flex-col gap-2">
                    <label for="newSpecie" class="font-medium font-serif text-blue-strong">Nouvelle espèce</label>
                    <div class="flex gap-2">
                        <input type="text" id="newSpecie" wire:model="newSpecie" placeholder="Nom de l'espèce"
                               class="flex-1 min-w-0 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-red-strong focus:border-2">
                        <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong text-sm px-4 py-2 shrink-0">
                            Ajouter
                        </x-forms.button>
                    </div>
                    @error('newSpecie') <p class="font-serif text-sm text-red-normal">{{ $message }}</p> @enderror
                </form>
            @endcan

            <ul class="flex flex-col gap-2">
                @forelse ($species as $specie)
                    <li wire:key="specie-{{ $specie->id }}" class="flex items-center justify-between gap-2 p-2 rounded-lg bg-blue-strong/5">
                        <span class="font-sans text-sm text-blue-strong">{{ $specie->name }}</span>

                        @can('delete', $specie)
                            <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $specie->id }}', model_type: 'specie' } })"
                                    class="font-sans text-sm text-red-normal hover:text-red-strong cursor-pointer shrink-0">
                                Supprimer
                            </button>
                        @endcan
                    </li>
                @empty
                    <li class="font-sans text-sm text-blue-strong/40">Aucune espèce.</li>
                @endforelse
            </ul>
        </x-forms.fieldset>

        <x-forms.fieldset title="Races">
            <x-flash key="success_race" />

            @can('create', \App\Models\Race::class)
                <form wire:submit="addRace" class="flex flex-col gap-2">
                    <div class="flex flex-col gap-2">
                        <label for="newRaceSpecieId" class="font-medium font-serif text-blue-strong">Espèce</label>
                        <x-forms.select for="newRaceSpecieId" wire:model="newRaceSpecieId" class="w-full">
                            @foreach ($species as $specie)
                                <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                            @endforeach
                        </x-forms.select>
                        @error('newRaceSpecieId') <p class="font-serif text-sm text-red-normal">{{ $message }}</p> @enderror
                    </div>

                    <label for="newRace" class="font-medium font-serif text-blue-strong">Nouvelle race</label>
                    <div class="flex gap-2">
                        <input type="text" id="newRace" wire:model="newRace" placeholder="Nom de la race"
                               class="flex-1 min-w-0 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-red-strong focus:border-2">
                        <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong text-sm px-4 py-2 shrink-0">
                            Ajouter
                        </x-forms.button>
                    </div>
                    @error('newRace') <p class="font-serif text-sm text-red-normal">{{ $message }}</p> @enderror
                </form>
            @endcan

            <ul class="flex flex-col gap-2">
                @forelse ($races as $race)
                    <li wire:key="race-{{ $race->id }}" class="flex items-center justify-between gap-2 p-2 rounded-lg bg-blue-strong/5">
                        <span class="font-sans text-sm text-blue-strong">{{ $race->name }} <span class="text-blue-strong/50">({{ $race->specie->name }})</span></span>

                        @can('delete', $race)
                            <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $race->id }}', model_type: 'race' } })"
                                    class="font-sans text-sm text-red-normal hover:text-red-strong cursor-pointer shrink-0">
                                Supprimer
                            </button>
                        @endcan
                    </li>
                @empty
                    <li class="font-sans text-sm text-blue-strong/40">Aucune race.</li>
                @endforelse
            </ul>
        </x-forms.fieldset>

        <x-forms.fieldset title="Pelages">
            <x-flash key="success_coat" />

            @can('create', \App\Models\Coat::class)
                <form wire:submit="addCoat" class="flex flex-col gap-2">
                    <label for="newCoat" class="font-medium font-serif text-blue-strong">Nouveau pelage</label>
                    <div class="flex gap-2">
                        <input type="text" id="newCoat" wire:model="newCoat" placeholder="Nom du pelage"
                               class="flex-1 min-w-0 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-red-strong focus:border-2">
                        <x-forms.button type="submit" class="bg-red-strong border-red-strong text-white hover:bg-white hover:text-red-strong hover:border-red-strong text-sm px-4 py-2 shrink-0">
                            Ajouter
                        </x-forms.button>
                    </div>
                    @error('newCoat') <p class="font-serif text-sm text-red-normal">{{ $message }}</p> @enderror
                </form>
            @endcan

            <ul class="flex flex-col gap-2">
                @forelse ($coats as $coat)
                    <li wire:key="coat-{{ $coat->id }}" class="flex items-center justify-between gap-2 p-2 rounded-lg bg-blue-strong/5">
                        <span class="font-sans text-sm text-blue-strong">{{ $coat->name }}</span>

                        @can('delete', $coat)
                            <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $coat->id }}', model_type: 'coat' } })"
                                    class="font-sans text-sm text-red-normal hover:text-red-strong cursor-pointer shrink-0">
                                Supprimer
                            </button>
                        @endcan
                    </li>
                @empty
                    <li class="font-sans text-sm text-blue-strong/40">Aucun pelage.</li>
                @endforelse
            </ul>
        </x-forms.fieldset>
    </div>
</div>
