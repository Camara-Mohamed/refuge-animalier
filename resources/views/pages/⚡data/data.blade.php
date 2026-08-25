<div>
    <x-flash />

    <h2>Gestion des données</h2>

    <div>
        <h3>Espèces</h3>

        @can('create', \App\Models\Specie::class)
            <form wire:submit="addSpecie">
                <input type="text" wire:model="newSpecie" placeholder="Nouvelle espèce">
                <button type="submit">Ajouter</button>
            </form>
            @error('newSpecie') <p>{{ $message }}</p> @enderror
        @endcan

        <ul>
            @forelse ($species as $specie)
                <li wire:key="specie-{{ $specie->id }}">
                    {{ $specie->name }}

                    @can('delete', $specie)
                        <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $specie->id }}', model_type: 'specie' } })">
                            Supprimer
                        </button>
                    @endcan
                </li>
            @empty
                <li>Aucune espèce.</li>
            @endforelse
        </ul>
    </div>

    <div>
        <h3>Races</h3>

        @can('create', \App\Models\Race::class)
            <form wire:submit="addRace">
                <select wire:model="newRaceSpecieId">
                    <option value="">-- espèce --</option>
                    @foreach ($species as $specie)
                        <option value="{{ $specie->id }}">{{ $specie->name }}</option>
                    @endforeach
                </select>
                <input type="text" wire:model="newRace" placeholder="Nouvelle race">
                <button type="submit">Ajouter</button>
            </form>
            @error('newRace') <p>{{ $message }}</p> @enderror
            @error('newRaceSpecieId') <p>{{ $message }}</p> @enderror
        @endcan

        <ul>
            @forelse ($races as $race)
                <li wire:key="race-{{ $race->id }}">
                    {{ $race->name }} ({{ $race->specie->name }})

                    @can('delete', $race)
                        <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $race->id }}', model_type: 'race' } })">
                            Supprimer
                        </button>
                    @endcan
                </li>
            @empty
                <li>Aucune race.</li>
            @endforelse
        </ul>
    </div>

    <div>
        <h3>Pelages</h3>

        @can('create', \App\Models\Coat::class)
            <form wire:submit="addCoat">
                <input type="text" wire:model="newCoat" placeholder="Nouveau pelage">
                <button type="submit">Ajouter</button>
            </form>
            @error('newCoat') <p>{{ $message }}</p> @enderror
        @endcan

        <ul>
            @forelse ($coats as $coat)
                <li wire:key="coat-{{ $coat->id }}">
                    {{ $coat->name }}

                    @can('delete', $coat)
                        <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $coat->id }}', model_type: 'coat' } })">
                            Supprimer
                        </button>
                    @endcan
                </li>
            @empty
                <li>Aucun pelage.</li>
            @endforelse
        </ul>
    </div>
</div>
