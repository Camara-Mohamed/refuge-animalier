<div>
    <h2>Mon profil</h2>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form wire:submit="save">
        <label for="avatarFile">
            @if ($avatarFile)
                <img src="{{ $avatarFile->temporaryUrl() }}" alt="" width="120">
            @elseif (auth()->user()->avatar)
                <img src="{{ Storage::url(auth()->user()->avatar) }}" alt="" width="120">
            @else
                <span>{{ auth()->user()->initials() }}</span>
            @endif
        </label>
        <input type="file" id="avatarFile" wire:model="avatarFile">
        @error('avatarFile') <p>{{ $message }}</p> @enderror

        @if ($avatarFile)
            <button type="button" wire:click="removeNewAvatar">Annuler la nouvelle photo</button>
        @endif

        <label for="name">Nom</label>
        <input type="text" id="name" wire:model="name">
        @error('name') <p>{{ $message }}</p> @enderror

        <label for="email">Email</label>
        <input type="email" id="email" wire:model="email">
        @error('email') <p>{{ $message }}</p> @enderror

        <label for="receive_emails">
            <input type="checkbox" id="receive_emails" wire:model="receive_emails">
            Recevoir des emails de notification
        </label>

        <fieldset>
            <legend>Disponibilités</legend>
            @foreach (\App\Enums\Day::cases() as $day)
                <label for="availability-{{ $day->value }}">
                    <input type="checkbox" id="availability-{{ $day->value }}" wire:model="availabilities" value="{{ $day->value }}">
                    {{ $day->label() }}
                </label>
            @endforeach
        </fieldset>

        <button type="submit">Enregistrer</button>
    </form>
</div>
