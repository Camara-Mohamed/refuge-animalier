<div>
    <h2>Animaux</h2>

    @can('create', \App\Models\Animal::class)
        <a href="{{ route('admin.animals.create', ['locale' => app()->getLocale()]) }}">Ajouter un animal</a>
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
                    <td>{{ $animal->status->label() }}</td>
                    <td>
                        <a href="{{ route('admin.animals.show', ['locale' => app()->getLocale(), 'animal' => $animal]) }}">Voir</a>
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
