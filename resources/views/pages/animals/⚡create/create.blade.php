<div>
    <h2>Ajouter un animal</h2>

    <form wire:submit="save">
        <label for="name">Nom</label>
        <input type="text" id="name" wire:model="name">
        @error('name') <p>{{ $message }}</p> @enderror

        <label for="gender">Sexe</label>
        <select id="gender" wire:model="gender">
            <option value="">-- choisir --</option>
            <option value="male">Mâle</option>
            <option value="female">Femelle</option>
        </select>
        @error('gender') <p>{{ $message }}</p> @enderror

        <label for="birth_date">Date de naissance</label>
        <input type="date" id="birth_date" wire:model="birth_date">

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

        <label for="avatarFile">Photo principale</label>
        <input type="file" id="avatarFile" wire:model="avatarFile">
        @error('avatarFile') <p>{{ $message }}</p> @enderror
        @if ($avatarFile) <img src="{{ $avatarFile->temporaryUrl() }}" width="150"> @endif

        <button type="submit">Enregistrer</button>
    </form>
</div>
