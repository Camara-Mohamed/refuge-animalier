<div>
    <h2>{{ $animal->name }}</h2>

    @can('update', $animal)
        <a href="{{ route('admin.animals.edit', ['locale' => app()->getLocale(), 'animal' => $animal]) }}">Modifier</a>
    @endcan

    @can('delete', $animal)
        <button wire:click="delete" wire:confirm="Supprimer cet animal ? Cette action est irréversible.">
            Supprimer
        </button>
    @endcan

    @if ($animal->avatar)
        <div>
            <img src="{{ Storage::url($animal->avatar) }}" alt="{{ $animal->name }}" width="250">
        </div>
    @endif

    <ul>
        <li>Sexe : {{ $animal->gender->label() }}</li>
        <li>Statut : {{ $animal->status->label() }}</li>
        <li>Âge : {{ $animal->age() !== null ? $animal->age() . ' an(s)' : '—' }}</li>
        <li>Puce : {{ $animal->chip ?? '—' }}</li>
        <li>Espèce : {{ $animal->specie?->name ?? '—' }}</li>
        <li>Race : {{ $animal->race?->name ?? '—' }}</li>
        <li>Pelage : {{ $animal->coat?->name ?? '—' }}</li>
        <li>Description : {{ $animal->description ?? '—' }}</li>
        <li>Ajouté par : {{ $animal->user?->fullName() ?? '—' }}</li>
    </ul>

    @can('update', $animal)
        <div>
            @foreach (\App\Enums\AnimalStatus::cases() as $status)
                <button wire:click="changeStatus('{{ $status->value }}')">
                    {{ $status->label() }}
                </button>
            @endforeach
        </div>
    @endcan

    {{-- Galerie désactivée pour l'instant --}}
    {{--
    <h3>Galerie</h3>

    <ul>
        @forelse ($pictures as $picture)
            <li wire:key="picture-{{ $picture->id }}">
                <img src="{{ Storage::url($picture->path) }}" alt="{{ $picture->alt }}" width="120">

                @can('update', $animal)
                    <button wire:click="deletePicture({{ $picture->id }})" wire:confirm="Supprimer cette photo ?">
                        Supprimer
                    </button>
                @endcan
            </li>
        @empty
            <li>Aucune photo dans la galerie.</li>
        @endforelse
    </ul>

    @can('update', $animal)
        <form wire:submit="addPicture">
            <input type="file" wire:model="newPicture">
            @error('newPicture') <p>{{ $message }}</p> @enderror
            @if ($newPicture) <img src="{{ $newPicture->temporaryUrl() }}" width="120"> @endif
            <button type="submit">Ajouter une photo</button>
        </form>
    @endcan
    --}}

    <h3>Notes</h3>

    <ul>
        @forelse ($notes as $note)
            <li wire:key="note-{{ $note->id }}">
                <p>{{ $note->content }}</p>
                <p>
                    <small>
                        {{ $note->user?->fullName() ?? '—' }} — {{ $note->created_at->format('d/m/Y H:i') }}
                    </small>
                </p>

                @can('delete', $note)
                    <button wire:click="deleteNote({{ $note->id }})" wire:confirm="Supprimer cette note ?">
                        Supprimer
                    </button>
                @endcan
            </li>
        @empty
            <li>Pas encore de note.</li>
        @endforelse
    </ul>

    @can('create', \App\Models\Note::class)
        <form wire:submit="addNote">
            <textarea wire:model="newNote" placeholder="Ajouter une note..."></textarea>
            @error('newNote') <p>{{ $message }}</p> @enderror
            <button type="submit">Ajouter une note</button>
        </form>
    @endcan
</div>
