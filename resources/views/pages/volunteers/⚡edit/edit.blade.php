<div class="flex flex-col gap-4">
    <livewire:widgets::breadcrumb :items="[
        ['label' => __('breadcrumbs.dashboard'), 'url' => route('admin.dashboard', ['locale' => app()->getLocale()])],
        ['label' => __('breadcrumbs.volunteers'), 'url' => route('admin.volunteers.index', ['locale' => app()->getLocale()])],
        ['label' => $volunteer->name, 'url' => route('admin.volunteers.show', ['locale' => app()->getLocale(), 'volunteer' => $volunteer])],
        ['label' => __('breadcrumbs.edit'), 'url' => '#'],
    ]" :key="'volunteer-edit-breadcrumb'" />

    <h1 class="font-serif font-bold text-2xl text-blue-strong">Modifier {{ $volunteer->name }}</h1>

    <form wire:submit="save" class="flex flex-col gap-4 max-w-xl">
        <x-forms.input for="name" type="text" wire:model="name" :required="true">Nom</x-forms.input>

        <div>
            <label for="role" class="font-medium font-serif">Rôle</label>
            <x-forms.select for="role" wire:model="role" label_title="Rôle" class="w-full">
                @foreach (\App\Enums\UserRole::cases() as $r)
                    <option value="{{ $r->value }}">{{ $r->label() }}</option>
                @endforeach
            </x-forms.select>
            @error('role') <p class="font-serif text-sm text-red-normal mt-1">{{ $message }}</p> @enderror
        </div>

        <x-forms.input for="email" type="email" wire:model="email" :required="true">Email</x-forms.input>
        <x-forms.input for="phone" type="text" wire:model="phone">Téléphone</x-forms.input>
        <x-forms.input for="address" type="text" wire:model="address">Adresse</x-forms.input>
        <x-forms.input for="number" type="text" wire:model="number">Numéro</x-forms.input>
        <x-forms.input for="city" type="text" wire:model="city">Ville</x-forms.input>
        <x-forms.input for="code_postal" type="text" wire:model="code_postal">Code postal</x-forms.input>

        <div class="flex flex-col gap-2">
            <label for="avatarFile" class="font-medium font-serif">Remplacer la photo de profil</label>
            @if ($volunteer->avatar && ! $avatarFile)
                <img src="{{ Storage::url($volunteer->avatar) }}" width="100" class="rounded-full">
            @endif
            <input type="file" id="avatarFile" wire:model="avatarFile">
            @error('avatarFile') <p class="font-serif text-sm text-red-normal mt-1">{{ $message }}</p> @enderror
            @if ($avatarFile) <img src="{{ $avatarFile->temporaryUrl() }}" width="100" class="rounded-full"> @endif
        </div>

        <x-forms.button type="submit" class="bg-red-strong text-white border-red-strong w-fit">
            Enregistrer
        </x-forms.button>
    </form>
</div>
