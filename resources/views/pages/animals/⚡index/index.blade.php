<div>
    <x-flash />

    <h2>Animaux</h2>

    @can('create', \App\Models\Animal::class)
        <x-admin-link :href="route('admin.animals.create', ['locale' => app()->getLocale()])">Ajouter un animal</x-admin-link>
    @endcan

    <div>
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Rechercher un nom...">

        <select wire:model.live="statusFilter">
            <option value="">Tous les statuts</option>
            @foreach (\App\Enums\AnimalStatus::cases() as $status)
                <option value="{{ $status->value }}">{{ $status->label() }}</option>
            @endforeach
        </select>

        <select wire:model.live="specieFilter">
            <option value="">Toutes les espèces</option>
            @foreach ($species as $specie)
                <option value="{{ $specie->id }}">{{ $specie->name }}</option>
            @endforeach
        </select>
    </div>

    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Espèce</th>
                <th>Statut</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($animals as $animal)
                <tr wire:key="animal-{{ $animal->id }}">
                    <td>{{ $animal->name }}</td>
                    <td>{{ $animal->specie?->name ?? '—' }}</td>
                    <td>
                        @can('update', $animal)
                            <select wire:change="changeStatus({{ $animal->id }}, $event.target.value)">
                                @foreach (\App\Enums\AnimalStatus::cases() as $status)
                                    <option value="{{ $status->value }}" @selected($status === $animal->status)>{{ $status->label() }}</option>
                                @endforeach
                            </select>
                        @else
                            {{ $animal->status->label() }}
                        @endcan
                    </td>
                    <td>
                        <x-admin-link :href="route('admin.animals.show', ['locale' => app()->getLocale(), 'animal' => $animal])">Voir</x-admin-link>
                        @can('update', $animal)
                            <x-admin-link :href="route('admin.animals.edit', ['locale' => app()->getLocale(), 'animal' => $animal])">Modifier</x-admin-link>
                        @endcan
                        @can('delete', $animal)
                            <button wire:click="$dispatch('open_modal', { payload: { form: 'modals::confirm-delete', model_id: '{{ $animal->id }}', model_type: 'animal', model_label: @js($animal->name) } })">Supprimer</button>
                        @endcan
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Aucun animal trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $animals->links() }}
</div>
