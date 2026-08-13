<div>
    <h2>Modifier {{ $animal->name }}</h2>

    <form wire:submit="save">
        <label for="name">Nom</label>
        <input type="text" id="name" wire:model="name">
        @error('name') <p>{{ $message }}</p> @enderror

        <label for="description">Description</label>
        <textarea id="description" wire:model="description"></textarea>

        <label for="specie_id">Espèce</label>
        <select id="specie_id" wire:model="specie_id">
            <option value="">-- aucune --</option>
            @foreach ($species as $specie)
                <option value="{{ $specie->id }}">{{ $specie->name }}</option>
            @endforeach
        </select>

        <label for="race_id">Race</label>
        <select id="race_id" wire:model="race_id">
            <option value="">-- aucune --</option>
            @foreach ($races as $race)
                <option value="{{ $race->id }}">{{ $race->name }}</option>
            @endforeach
        </select>

        <label for="coat_id">Pelage</label>
        <select id="coat_id" wire:model="coat_id">
            <option value="">-- aucun --</option>
            @foreach ($coats as $coat)
                <option value="{{ $coat->id }}">{{ $coat->name }}</option>
            @endforeach
        </select>

        <label for="avatarFile">Remplacer la photo principale</label>
        @if ($animal->avatar && ! $avatarFile)
            <img src="{{ Storage::url($animal->avatar) }}" width="150">
        @endif
        <input type="file" id="avatarFile" wire:model="avatarFile">
        @error('avatarFile') <p>{{ $message }}</p> @enderror
        @if ($avatarFile) <img src="{{ $avatarFile->temporaryUrl() }}" width="150"> @endif

        <button type="submit">Enregistrer</button>
    </form>
</div>
